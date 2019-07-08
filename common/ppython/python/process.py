# -*- coding: UTF-8 -*-

# ------------------------------------------------------------------------------
#    改为继承指定文件夹里的模块 -- by Tommy 2017-5-11
#    新增LOAD_TYPE，可以动态加载包，不需要每次都重启ppython服务 -- by Tommy 2017-9-22
# -------------------------------------------------------------------------------


import sys
import time
import threading
import socket
import importlib
import php_python

REQUEST_MIN_LEN = 10    #合法的request消息包最小长度
TIMEOUT = 180           #socket处理时间180秒
LOAD_TYPE = 0           #0为默认的，只导入一次，若包文件有改动，需重启ppython服务。1为动态加载，每次都会reload这个包，此时不需要重启ppython服务

pc_dict = {}        #预编译字典，key:调用模块、函数、参数字符串，值是编译对象
global_env = {}     #global环境变量

def index(bytes, c, pos=0):
    """
    查找c字符在bytes中的位置(从0开始)，找不到返回-1
    pos: 查找起始位置
    """
    for i in range(len(bytes)):
        if (i <= pos):
            continue
        if bytes[i] == c:
            return i
            break
    else:
        return -1


def z_encode(p):
    """
    encode param from python data
    """
    if p == None:                               #None->PHP中的NULL
        return "N;"
    elif isinstance(p, int):                    #int->PHP整形
        return "i:%d;" % p
    elif isinstance(p, str):                    #String->PHP字符串
        p_bytes = p.encode(php_python.CHARSET);
        ret = 's:%d:"' % len(p_bytes)
        ret = ret.encode(php_python.CHARSET)
        ret = ret + p_bytes + '";'.encode(php_python.CHARSET)
        ret = str(ret, php_python.CHARSET)
        return ret
    elif isinstance(p, bool):                   #boolean->PHP布尔
        b=1 if p else 0
        return 'b:%d;' % b
    elif isinstance(p, float):                  #float->PHP浮点
        return 'd:%r;' % p
    elif isinstance(p, list) or isinstance(p, tuple):        #list,tuple->PHP数组(下标int)
        s=''
        for pos,i in enumerate(p):
            s+=z_encode(pos)
            s+=z_encode(i)
        return "a:%d:{%s}" % (len(p),s)
    elif isinstance(p, dict):                   #字典->PHP数组(下标str)
        s=''
        for key in p:
            s+=z_encode(key)
            s+=z_encode(p[key])
        return "a:%d:{%s}" % (len(p),s)
    else:                                       #其余->PHP中的NULL
        return "N;"


def z_decode(p):
    """
    decode php param from string to python
    p: bytes
    """
    if p[0]==0x4e:                      #NULL 0x4e-'N'
        return None,p[2:]
    elif p[0]==0x62:                    #bool 0x62-'b'
        if p[2] == 0x30:                # 0x30-'0'
            return False,p[4:]
        else:
            return True,p[4:]
    elif p[0]==0x69:                    #int  0x69-'i'
        i = index(p, 0x3b, 1)           # 0x3b-';'
        return int(p[2:i]),p[i+1:]
    elif p[0]==0x64:                    #double 0x64-'d'
        i = index(p, 0x3b, 1)           # 0x3b-';'
        return float(p[2:i]),p[i+1:]
    elif p[0]==0x73:                    #string 0x73-'s'
        len_end = index(p, 0x3a, 2)     # 0x3a-':'
        str_len = int(p[2:len_end])
        end = len_end + 1 + str_len + 2
        v = p[(len_end + 2) : (len_end + 2 + str_len)]
        return str(v, php_python.CHARSET), p[end+1:]
    elif p[0]==0x61:                    #array 0x61-'a'
        list_=[]       #数组
        dict_={}       #字典
        flag=True      #类型，true-元组 false-字典
        second = index(p, 0x3a, 2)      # 0x3a-":"
        num = int(p[2:second])  #元素数量
        pp = p[second+2:]       #所有元素
        for i in range(num):
            key,pp=z_decode(pp)  #key解析
            if (i == 0): #判断第一个元素key是否int 0
                if (not isinstance(key, int)) or (key != 0):
                    flag = False
            val,pp=z_decode(pp)  #value解析
            list_.append(val)
            dict_[key]=val
        return (list_, pp[2:]) if flag else (dict_, pp[2:])
    else:
        return p,''


def parse_php_req(p):
    """
    解析PHP请求消息
    返回：元组（模块名，函数名，入参list）
    """
    while p:
        v,p=z_decode(p)         #v：值  p：bytes(每次z_decode计算偏移量)
        params = v

    modul_func = params[0]      #第一个元素是调用模块和函数名
    #print("模块和函数名:%s" % modul_func)
    #print("参数:%s" % params[1:])
    pos = modul_func.find("::")
    modul = modul_func[:pos]    #模块名
    func = modul_func[pos+2:]   #函数名
    return modul, func, params[1:]


class ProcessThread(threading.Thread):
    """
    preThread 处理线程
    """
    def __init__(self, socket):
        threading.Thread.__init__(self)

        #客户socket
        self._socket = socket

    def run(self):

        #---------------------------------------------------
        #    1.接收消息
        #---------------------------------------------------

        try:
            self._socket.settimeout(TIMEOUT)                  #设置socket超时时间
            firstbuf = self._socket.recv(16 * 1024)           #接收第一个消息包(bytes)
            if len(firstbuf) < REQUEST_MIN_LEN:               #不够消息最小长度
                print ("非法包，小于最小长度: %s" % firstbuf)
                self._socket.close()
                return

            firstComma = index(firstbuf, 0x2c)                #查找第一个","分割符
            totalLen = int(firstbuf[0:firstComma])            #消息包总长度
            print("消息长度:%d" % totalLen)
            reqMsg = firstbuf[firstComma+1:]
            while (len(reqMsg) < totalLen):
                reqMsg = reqMsg + self._socket.recv(16 * 1024)

            #调试
            #print ("请求包：%s" % reqMsg)

        except Exception as e:
            print ('接收消息异常', e)
            self._socket.close()
            return

        #---------------------------------------------------
        #    2.调用模块、函数检查，预编译。
        #---------------------------------------------------

        #从消息包中解析出模块名、函数名、入参list
        modul, func, params = parse_php_req(reqMsg)

        #检查模块、函数是否存在
        if (modul not in pc_dict):   #预编译字典中没有此编译模块
            #检查模块、函数是否存在
            try:
                tommy = modul.find(".") #将模块名和子模块分开
                modulname = modul[tommy+2:] #指定子模块
                callMod = __import__ (modul,fromlist = (modulname,))    #根据module名，反射出module
                pc_dict[modul] = callMod        #预编译字典缓存此模块
            except Exception as e:
                print ('模块不存在:%s' % modul)
                self._socket.sendall(("F" + "module '%s' is not exist or there is an error in your .py file!" % modul).encode(php_python.CHARSET)) #异常
                self._socket.close()
                return
        else:
            callMod = pc_dict[modul]            #从预编译字典中获得模块对象
        
        if (LOAD_TYPE == 1):
            print('reload module')
            callMod = importlib.reload(callMod)   # 重新载入模块

        try:
            callMethod = getattr(callMod, func)
        except Exception as e:
            print ('函数不存在:%s' % func)
            self._socket.sendall(("F" + "function '%s()' is not exist or there is an error in your .py file!" % func).encode(php_python.CHARSET)) #异常
            self._socket.close()
            return

        #---------------------------------------------------
        #    3.Python函数调用
        #---------------------------------------------------

        try:
            params = ','.join([repr(x) for x in params])
            #print ("调用函数及参数：%s(%s)" % (modul+'.'+func, params) )

            #加载函数
            compStr = "import %s\nret=%s(%s)" % (modul, modul+'.'+func, params)
            #print("函数调用代码:%s" % compStr)
            rpFunc = compile(compStr, "", "exec")

            if func not in global_env:
                global_env[func] = rpFunc
            local_env = {}
            exec (rpFunc, global_env, local_env)     #函数调用
            #print (global_env)
            #print (local_env)
        except Exception as e:
            print ('调用Python业务函数异常', e )
            errType, errMsg, traceback = sys.exc_info()
            self._socket.sendall(("F%s" % errMsg).encode(php_python.CHARSET)) #异常信息返回
            self._socket.close()
            return

        #---------------------------------------------------
        #    4.结果返回给PHP
        #---------------------------------------------------
        #retType = type(local_env['ret'])
        #print ("函数返回：%s" % retType)
        rspStr = z_encode(local_env['ret'])  #函数结果组装为PHP序列化字符串

        try:
            #加上成功前缀'S'
            rspStr = "S" + rspStr
            #调试
            #print ("返回包：%s" % rspStr)
            self._socket.sendall(rspStr.encode(php_python.CHARSET))
        except Exception as e:
            print ('发送消息异常', e)
            errType, errMsg, traceback = sys.exc_info()
            self._socket.sendall(("F%s" % errMsg).encode(php_python.CHARSET)) #异常信息返回
        finally:
            self._socket.close()
            return

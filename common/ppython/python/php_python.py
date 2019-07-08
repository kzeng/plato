#!/usr/bin/env python3
# -*- coding: UTF-8 -*-

import time
import socket
import os
import process

# -------------------------------------------------
# 基本配置
# -------------------------------------------------
LISTEN_PORT = 21230     #服务侦听端口
CHARSET = "utf-8"       #设置字符集（和PHP交互的字符集）

# -------------------------------------------------
# 主程序
#    请不要随意修改下面的代码
# -------------------------------------------------
if __name__ == '__main__':

    print ("-------------------------------------------")
    print ("- PPython Service")
    print ("- Time: %s" % time.strftime('%Y-%m-%d %H:%M:%S',time.localtime(time.time())) )
    print ("-------------------------------------------")

    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)  #TCP/IP
    sock.bind(('', LISTEN_PORT))
    sock.listen(5)

    print ("Listen port: %d" % LISTEN_PORT)
    print ("charset: %s" % CHARSET)
    print ("Server startup...")

    while 1:
        connection,address = sock.accept()  #收到一个请求

        #print ("client's IP:%s, PORT:%d" % address)

        # 处理线程
        try:
            process.ProcessThread(connection).start()
        except:
            pass

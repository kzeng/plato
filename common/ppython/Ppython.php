<?php
//------------------------修改自------------------------------
// PPython(PHP and Python).
//   (2012-15 http://code.google.com/p/ppython/)
//
// License: http://www.apache.org/licenses/LICENSE-2.0
//-----------------------------------------------------------
//------------------------作者（汉化+纠错+优化）-------------------------------
// 
// Tommy  QQ:447569003@qq.com
// 
//------------------------优化建议-------------------------------
// Behero
//-----------------------------------------------------------
namespace common\ppython;

define("LAJP_IP", "127.0.0.1");     //Python端IP
define("LAJP_PORT", 21230);         //Python端侦听端口
define("PARAM_TYPE_ERROR", 101);    //参数类型错误
define("SOCKET_ERROR", 102);        //SOCKET错误
define("LAJP_Exception", 104);      //Python端反馈异常

class Ppython
{
	public function py()
	{
	    //参数数量
	    $args_len = func_num_args();

	    //参数数组
	    $arg_array = func_get_args();

	    //参数数量不能小于1
	    if ($args_len < 1){
	        throw new \Exception("[PPython Error] lapp_call function's arguments length < 1", PARAM_TYPE_ERROR);
	    }

	    //第一个参数是Python模块函数名称，必须是string类型
	    if (!is_string($arg_array[0])){
	        throw new \Exception("[PPython Error] lapp_call function's first argument must be string \"module_name::function_name\".", PARAM_TYPE_ERROR);
	    }

		//创建socket套接字
	    if (($socket = socket_create(AF_INET, SOCK_STREAM, 0)) === false){
	        throw new \Exception("[PPython Error] socket create error.", SOCKET_ERROR);
	    }

		// 进行socket连接
	    if (socket_connect($socket, LAJP_IP, LAJP_PORT) === false){
	        throw new \Exception("[PPython Error] socket connect error.", SOCKET_ERROR);
	    }

	    //消息体序列化
	    $request = serialize($arg_array);
	    $req_len = strlen($request);

	    $request = $req_len.",".$request;

	    $send_len = 0;
	    do{
	        //将PHP参数通过socket发送给Python处理
	        if (($sends = socket_write($socket, $request, strlen($request))) === false){
	            throw new \Exception("[PPython Error] socket write error.", SOCKET_ERROR);
	        }
	        $send_len += $sends;
	        $request = substr($request, $sends);

	    }while ($send_len < $req_len);

	    //接收
	    $response = "";

	    while(true){
	        $recv = "";
	        if (($recv = socket_read($socket, 1400)) === false){
	            throw new \Exception("[PPython Error] socket read error.", SOCKET_ERROR);
	        }
	        if ($recv == "") break;
	        $response .= $recv;
	    }

	    //关闭
	    socket_close($socket);

	    $rsp_stat = substr($response, 0, 1);    //返回类型 "S":成功 "F":异常
	    $rsp_msg = substr($response, 1);        //返回信息

		// 抛出Python错误
	    if ($rsp_stat == "F"){  
	        throw new \Exception("[PPython Error] Receive Python \Exception: ".$rsp_msg, LAJP_Exception);//异常信息不用反序列化
	    }
	    else{
	        if ($rsp_msg != "N") { //返回非void
	            return unserialize($rsp_msg);//反序列化
	        }
	    }
	}


}

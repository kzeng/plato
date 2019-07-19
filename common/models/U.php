<?php
namespace common\models;

use Yii;
use yii\base\Exception;
use yii\web\HttpException;

class U
{
    public static function toString($obj="")
    {
        if (is_array($obj))
            $str = print_r($obj, true);
        else if(is_object($obj))         
            $str = print_r($obj, true);                        
        else 
            $str = "{$obj}";
        return $str;    
    }    

    public static function W($obj="", $log_file='')
    {
        $str = U::toString($obj);
        if (empty($log_file))
            $log_file = Yii::$app->getRuntimePath().'/errors.log';
            
        $date =date("Y-m-d H:i:s");
        $log_str = sprintf("%s,%s\n",$date,$str);
        error_log($log_str, 3, $log_file);
    }
    
    public static function kzeng_W($obj="", $log_file='') {
        if (empty($log_file))
            $log_file = \Yii::$app->getRuntimePath().'/kzeng_errors.log';
        self::W($obj, $log_file);
    }

    public static function parseQuery($str, $and=';', $eq=':') 
    {
        $arr = array();
        $pairs = explode($and, $str);
        foreach($pairs as $pair) 
        {
            list($name, $value) = explode($eq, $pair, 2);
            $arr[$name] = $value;
        }
        return $arr;
    }

    public static function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);            
        }

        //U::W($url);            
        if (is_array($postFields) && 0 < count($postFields))
        {
            $postBodyString = "";
            $postMultipart = false;
            foreach ($postFields as $k => $v)
            {
                if("@" != substr($v, 0, 1))
                {
                    $postBodyString .= "$k=" . urlencode($v) . "&"; 
                }
                else
                {
                    $postMultipart = true;
                }
            }
            //U::W($postBodyString);            
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart)
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
            else
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
            }
        }
        else if (!empty($postFields))
        {
            curl_setopt($ch, CURLOPT_POST, true);        
            $postBodyString = $postFields;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postBodyString);
            //U::W($postBodyString);    
        }
        
        $reponse = curl_exec($ch);
        
        if (curl_errno($ch))
        {
            throw new Exception(curl_error($ch),0);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new Exception($reponse,$httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }

    public static function generateRandomString($length = 32)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle(str_repeat($chars, 5)), 0, $length);
    }

    public static function generateRandomStr($length = 16) 
    {  
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
        $str ="";  
        for ($i=0; $i<$length; $i++)
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
        return $str;  
    }

    public static function D($str) 
    {
        U::W($str);
        die($str);    
    }

    public static function getClientIp()
    {
        if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
            $ip = getenv ( "HTTP_CLIENT_IP" );
        else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
            $ip = getenv ( "HTTP_X_FORWARDED_FOR" );
        else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
            $ip = getenv ( "REMOTE_ADDR" );
        else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
            $ip = $_SERVER ['REMOTE_ADDR'];
        else
            $ip = "127.0.0.1";
        return $ip;
    }

/**
   * getRandomWeightedElement()
   * Utility function for getting random values with weighting.
   * Pass in an associative array, such as array('A'=>5, 'B'=>45, 'C'=>50)
   * An array like this means that "A" has a 5% chance of being selected, "B" 45%, and "C" 50%.
   * The return value is the array key, A, B, or C in this case.  Note that the values assigned
   * do not have to be percentages.  The values are simply relative to each other.  If one value
   * weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
   * chance of being selected.  Also note that weights should be integers.
   * 
   * @param array $weightedValues
   */
       //U::getRandomWeightedElement(array('AAA'=>5, 'BBB'=>30, 'CCC'=>65));
    public static function getRandomWeightedElement($weightedValues)
    {
        $rand = mt_rand(1, (int) array_sum($weightedValues));
        foreach ($weightedValues as $key => $value) 
        {
            $rand -= $value;
            if ($rand <= 0) 
            {
                return $key;
            }
        }
    }

    public static function array_field_assoc($items, $field1, $field2) 
    {
        $iids = array();    
        foreach ($items as $item) 
            $iids[$item[$field1]] = $item[$field2];
        return ($iids);    
    }

    public static function getSessionParam($key)
    {
        if (isset($_GET[$key]))
            return $_GET[$key];            
        else if (isset(Yii::$app->session[$key]))
            return Yii::$app->session[$key];
        else if (Yii::$app->params['isWin'] && $key == 'gh_id' && Yii::$app->wx->localTest)
        {
            return \app\models\MGh::GH_XIANGYANGUNICOM;
            //return \app\models\MGh::GH_WOSO;
        }
        else if (Yii::$app->params['isWin'] && $key == 'openid' && Yii::$app->wx->localTest)
        {
            //return \app\models\MGh::GH_XIANGYANGUNICOM_OPENID_HBHE;        
            return \app\models\MGh::GH_XIANGYANGUNICOM_OPENID_KZENG;        
            //return \app\models\MGh::GH_WOSO_OPENID_HBHE;        
            //return \app\models\MGh::GH_WOSO_OPENID_KZENG;                
        }
        else 
        {
            U::W(["no session data for $key", $_SERVER, $_SESSION]);
            throw new HttpException(500, "session does not exist, key=$key", 9000);
        }
    }

    public static function getWid($gh_id, $openid)
    {
        $wid = Yii::$app->request->get('wid');
        if (empty($wid))
        {
            $wid = Yii::$app->session->get('wid');
            if (empty($wid))
            {
                $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
                $wid = "{$user->scene_id}_0";
            }
        }
        else
        {            
            Yii::$app->session->set('wid', $wid);
        }
        return $wid;
    }
    



    // U::getUserHeadimgurl("http://wx.qlogo.cn/mmopen/17ASicSl2de5EHEpImf7IOxZ5w6MibiaWuzsThDo39s0Lq6U0ZG4Kn04AJDfK4XiaxYicCCpsXH3UxW8goFcPnEkfhv7GO2AeFAtR/0", 64);
    public static function getUserHeadimgurl($url, $size)
    {
        if (empty($url))
            return $url;
        if (!in_array($size, [0, 46, 64, 96, 132]))
            return $url;
        $pos = strrpos($url, "/");
        $str = substr($url, 0, $pos) . "/$size";
        return $str;
    }

    public static function mobileIsValid($mobile)
    {    
        $pattern = '/^1\d{10}$/';
        if(preg_match($pattern, $mobile))        
            return true;            
        return false;
    }

    public static function callSimsimi($keyword)
    {
        $params['key'] = "d4677d44-aec1-4045-96c7-d8c521268ace";
        $params['lc'] = "ch";
        $params['ft'] = "1.0";
        $params['text'] = $keyword;
        
        $url = "http://sandbox.api.simsimi.com/request.p?".http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $message = json_decode($output, true);
        $result = "";
        if ($message['result'] == 100){
            $result = $message['response'];
        }else{
            $result = $message['result']."-".$message['msg'];
        }
        return $result;
    }

    public static function getTraceMsg($trace_level)
    {
    	if ($trace_level <= 0)
    		return '';	
    	$msg = "\n";		
    	$traces=debug_backtrace();
    	if(count($traces) >2)
    		$traces=array_slice($traces, 2);
    	if(count($traces) > $trace_level)
    		$traces=array_slice($traces, 0, $trace_level);
    	
    	foreach($traces as $i=>$t)
    	{
    		if(!isset($t['file']))
    			$t['file']='unknown';
    		if(!isset($t['line']))
    			$t['line']=0;
    		if(!isset($t['function']))
    			$t['function']='unknown';
    		$msg.="#$i {$t['file']}({$t['line']}): ";
    		if(isset($t['object']) && is_object($t['object']))
    			$msg.=get_class($t['object']).'->';
    		$msg.="{$t['function']}()\n";
    	}
    	return $msg;
    }

    //10 -> 0.001%
    //10000 -> 1%
    public static function haveProbability($probability=10)
    {
        return mt_rand(0,1000000) < $probability;
    }
    
    public static function current(array $params = [], $scheme = false)
    {
        $currentParams = Yii::$app->getRequest()->getQueryParams();
        $currentParams[0] = '/' . Yii::$app->controller->getRoute();
        $route = \yii\helpers\ArrayHelper::merge($currentParams, $params);
        return \yii\helpers\Url::toRoute($route, $scheme);
    }

    public static function getFirstDate($year, $month)
    {
        return date('Y-m-d H:i:s', mktime(0, 0, 0, $month, 1, $year));
    }

    public static function getLastDate($year, $month)
    {
        return date('Y-m-t H:i:s', mktime(23, 59, 59, $month, 1, $year));
    }

    public static function getFirstDayOfLastMonth()
    {
        $year = date('Y');
        $month = date('m');
        if ($month == 1) {
            $year = $year - 1;
            $last_month = 12;
        } else {        
            $last_month = $month - 1;
        }
        $theFirstDayOfLastMonth = U::getFirstDate($year, $last_month);
        $theLastDayOfLastMonth = U::getLastDate($year, $last_month);        
        return $theFirstDayOfLastMonth;         
    }

    public static function getLastDayOfLastMonth()
    {
        $year = date('Y');
        $month = date('m');
        if ($month == 1) {
            $year = $year - 1;
            $last_month = 12;
        } else {        
            $last_month = $month - 1;
        }
        $theFirstDayOfLastMonth = U::getFirstDate($year, $last_month);
        $theLastDayOfLastMonth = U::getLastDate($year, $last_month);
        return $theLastDayOfLastMonth;
    }

    public static function getRemoteFileSize($url) {
        static $regex = '/^Content-Length: *+\K\d++$/im';
        if (!$fp = @fopen($url, 'rb')) {
            return false;
        }
        if (
            isset($http_response_header) &&
            preg_match($regex, implode("\n", $http_response_header), $matches)
        ) {
            return (int)$matches[0];
        }
        return strlen(stream_get_contents($fp));
    }

    public static function utf8_array_asort(&$array)
    {
        if(!isset($array) || !is_array($array)) {
            return false;
        }
        foreach($array as $k=>$v) {
            $array[$k] = iconv('UTF-8', 'GBK//IGNORE', $v);
        }
        asort($array);
        foreach($array as $k=>$v) {
            $array[$k] = iconv('GBK', 'UTF-8//IGNORE', $v);
        }
        return true;
    }
    
    public static function compress_image_file($orig_filename, $max_width=1000, $new_filename=null)
    {
        if (!file_exists($orig_filename)) return;
        list($width, $height, $imagetype) = getimagesize($orig_filename);
        if ($width == 0) return;
        if ($width <= $max_width) return; 
        else {
            $new_width = $max_width;
            $new_height = intval(floatval($new_width)/$width * $height);
        }
        if ($new_filename == null) $new_filename = $orig_filename;
        if ($imagetype == IMAGETYPE_JPEG) { 
            $old_image = imagecreatefromjpeg($orig_filename);
        } else if ($imagetype == IMAGETYPE_PNG) {
            $old_image = imagecreatefrompng($orig_filename);
        } else {
//            echo "IMAGETYPE: ".$imagetype."\t".$old_filename.PHP_EOL;
            return;
        }
        
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagejpeg($new_image, $new_filename);
        imagedestroy($old_image);
        imagedestroy($new_image);
    }

    public static function getQqAddress($lon, $lat)
    {
        $map = new \app\models\MMapApiQq;
        return $map->getAddress($lon, $lat);
    }



}



<?php
	require('./Include/function.php');
	require('./Include/ip.class.php');
	require('./Include/rsa.php');
	require('./Include/encrypt.class.php');
	//rsa支持中文
	function convert($hexString) 
	{ 
		$hexLenght = strlen($hexString); 
		// only hex numbers is allowed 
		if ($hexLenght % 2 != 0 || preg_match("/[^\da-fA-F]/",$hexString)) return FALSE; 
	
		unset($binString);
		for ($x = 1; $x <= $hexLenght/2; $x++) 
		{ 
			$binString .= chr(hexdec(substr($hexString,2 * $x - 2,2))); 
		} 
	
		return $binString;
	} 
	//手机号码星号处理
	function mobile($phone){
	$p = substr($phone,0,3)."****".substr($phone,7,4);
	return $p;
	}

	//国内
	function intlsmsto1($telphone,$message,$vercode)
	{
	
		$username = 'laichengkeji1';		//用户账号
		$password = 'qwer1234';	//密码
		$apikey = 'd7efa0212e3d5f0159febb0096f71ed3';	//密码
		$mobile	 = $telphone;	//号手机码
		$content = $message;//内容
		//即时发送
		$result = sendSMS($username,$password,$telphone,$content,$apikey);
		return $result;
	}

	//国际
	function intlsmsto($telphone,$message,$vercode)
	{
	
		$username = 'laichengkeji';		//用户账号
		$password = 'qwer1234';	//密码
		$apikey = '269262be3fe42ed2d529caea548b16f8';	//密码
		$mobile	 = $telphone;	//号手机码
		$content = $message;//内容
		//即时发送
		$result = sendSMS($username,$password,$telphone,$content,$apikey);
		return $result;
	}
	
	function sendSMS($username,$password,$mobile,$content,$apikey)
	{
		$url = 'http://m.5c.com.cn/api/send/?';
		$data = array
		(
				'username'=>$username,					//用户账号
				'password'=>$password,				//密码
				'mobile'=>$mobile,					//号码
				'content'=>$content,				//内容
				'apikey'=>$apikey,				    //apikey
		);
		$result= curlSMS($url,$data);			//POST方式提交
		return $result;
	}
	
	function curlSMS($url,$post_fields=array()){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3600); //60秒
		curl_setopt($ch, CURLOPT_HEADER,1);
		curl_setopt($ch, CURLOPT_REFERER,'http://www.yourdomain.com');
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$post_fields);
		$data = curl_exec($ch);
		curl_close($ch);
		$res = explode("\r\n\r\n",$data);
		return $res[2];
			
	}

	function CheckwType($wType){
		$arr = array(0,1);
		return  in_array($wType, $arr);
	}
	
	function TarrayToOarray($Array , $Field){
		$arr = array();
		foreach ($Array as $key=>$value) {
			$arr[$key] = $value["$Field"];
		}
		return $arr;
	}
	
	function CheckLength($data, $Min, $Max){
		if(mb_strlen($data)< $Min || mb_strlen($data)> $Max){
			return true;
		}else{
			return false;
		}
	}
	function CheckNumber($number){
		$preg = '/^[1-9]\d{4,15}$/';
		if(!preg_match($preg, $number)){
			return true;
		}
	}	
	
	/**
	 * 日志记录
	 * @author qxn
	 * @param string $type 日志类型，对应logs目录下的子文件夹名
	 * @param string $content
	 * @return boolean	 日志内容
	 */
	function writelog($type="",$content=""){
		if(!$content || !$type){
			return FALSE;
		}
		$dir=getcwd().DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.$type;
		if(!is_dir($dir)){
			if(!mkdir($dir)){
				return false;
			}
		}
		$filename=$dir.DIRECTORY_SEPARATOR.date("Ymd",time()).'.log.php';
		$logs=include $filename;
		if($logs && !is_array($logs)){
			unlink($filename);
			return false;
		}
		$logs[]=array("time"=>date("Y-m-d H:i:s"),"content"=>$content);
		$str="<?php \r\n return ".var_export($logs, true).";";
		if(!$fp=@fopen($filename,"wb")){
			return false;
		}
		if(!fwrite($fp, $str))return false;
		fclose($fp);
		return true;
	}
	

?>
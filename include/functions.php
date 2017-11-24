<?php
function createToken(){
	$str = "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
	//độ dài chuỗi token là 30
	$strLength = strlen($str)-1;
	$token = '';

	for($i=1; $i <= 30; $i++) { 
		$token .= substr($str, rand(0,$strLength),1);
	}
	return $token;
}

?>
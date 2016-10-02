<?
session_start();

##### DB 접속 정보 #####
require_once("../system/config.php");

##### Code 지정 안되어 있으면 경고 #####
//if(!$code) error2("Error - Code 지정");

$j="sub.html?menu=";

//$member=member();

if($move=="login"||$move=="index") {
	if($MEMBER_PART=="member") movepage("../../main.html?v=$v");
	elseif(check_login($PHP_AUTH_USER,$PHP_AUTH_PW,$keepid)) movepage("../../main.html?v=$v");
	else error2("일치하는 아이디 패스워드가 없습니다.\\n\\n다시 확인 하여 주십시요.");
} elseif($code){
	if($number){
		if($MEMBER_PART=="member") movepage("../../winko.php?code=$code&category=$category&v=$v");
		elseif(check_login($PHP_AUTH_USER,$PHP_AUTH_PW,$keepid)) movepage("../../winko.php?code=$code&body=view&number=$number&category=$category&v=$v");
		else error2("일치하는 아이디 패스워드가 없습니다.\\n\\n다시 확인 하여 주십시요.");
	} else {
		if($MEMBER_PART=="member") movepage("../../winko.php?code=$code&category=$category&v=$v");
		elseif(check_login($PHP_AUTH_USER,$PHP_AUTH_PW,$keepid)) movepage("../../winko.php?code=$code&category=$category&v=$v");
		else error2("일치하는 아이디 패스워드가 없습니다.\\n\\n다시 확인 하여 주십시요.");
	}
}
elseif($move=="admin") {
	if($MEMBER_PART=="member") movepage("../../admin.php");
	elseif(check_login($PHP_AUTH_USER,$PHP_AUTH_PW,$keepid)) movepage("../../admin.php");
	else error2("일치하는 아이디 패스워드가 없습니다.\\n\\n다시 확인 하여 주십시요.");
}
else{
	if($MEMBER_PART=="member") movepage("../../index.html");
	elseif(check_login($PHP_AUTH_USER,$PHP_AUTH_PW,$keepid)) movepage("$move");
	else error2("일치하는 아이디 패스워드가 없습니다.\\n\\n다시 확인 하여 주십시요.");
}
////////////////////////////////////////////////////////////
?>
<?
session_start();

##### DB 접속 정보 #####
require_once("../system/config.php");

##### Code 지정 안되어 있으면 경고 #####
if(!$code) error2("Error - Code 지정");

$member=member();
//if($member[level]!="1" && ($code=="intranet"||$code=="qna")) {$MEMBER_ID="";}
##### 사용자가 아무값도 입력하지 않았거나 입력한 값이 허용되지 않는 값일 경우 에러메시지를 출력하고 스크립트를 종료한다.
if(!ereg("([^[:space:]]+)", $name) && !$MEMBER_ID) {
	error("NOT_ALLOWED_NAME");
	exit;
}

if(!ereg("(^[0-9a-zA-Z]{4,}$)", $passwd) && !$MEMBER_ID) {
	error("NOT_ALLOWED_PASSWD");
	exit;
}

if(!ereg("([^[:space:]]+)", $comment)) {
	error("NOT_ALLOWED_COMMENT");
	exit;
}

##### 각종 변수 설정
$ip=$REMOTE_ADDR; // 아이피값 구함;;
$signdate = time();
$parent=$number;

##### 문자열에 포함된 특수문자를 escape시킨다.
$name = addslashes($name);
$comment = addslashes($comment);
##### 비밀번호란에 입력한 문자열을 암호화한다. 
if($passwd) $encrypted_passwd = crypt($passwd);

#### 회원 로그인 상태
if($MEMBER_ID) {
	$name=$member[name];
	$ismember=$MEMBER_ID;
}

##### 더이상 입력값에 이상이 없으면 데이터베이스에 입력값을 삽입한다.
//if($MEMBER_ID){
$query = "INSERT INTO {$top}_short_{$code} (parent, ismember, name, passwd, comment, ip, signdate) VALUES ('$parent', '$ismember', '$name', '$encrypted_passwd', '$comment', '$ip', $signdate)";
//}
$result = mysql_query($query);

// 회원일 경우 해당 해원의 점수 주기
if($MEMBER_ID) @mysql_query("update {$top}_member set point2=point2+2 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());

if($result) {
	##### 리스트 출력화면으로 이동한다.
	echo ("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&body=view&v=$v&category=$category&page=$page&number=$number'>");
} else {
	error("QUERY_ERROR");
	exit;
}
?>

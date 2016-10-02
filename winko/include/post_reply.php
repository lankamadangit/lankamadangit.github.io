<?
session_start();

##### DB 접속 정보 #####
require_once("../system/config.php");

##### Code 지정 안되어 있으면 경고 #####
if(!$code) error2("Error - Code 지정");

##### 환경설정파일
$cfg_file = "../system/option/option." . $code . ".php";

if(file_exists($cfg_file)) {
	require($cfg_file);
}  else {
	require("../system/option/option.winko.php");
}

$member=member();

##### adminboard 접속 #######
$query2 = "SELECT * FROM {$top}_boardadmin where code='$code'";
$result2 = mysql_query($query2);
if (!$result2) {
	error("QUERY_ERROR");
	exit;
}

$admin=mysql_fetch_array($result2);

##### 관리자 회원 검색 #######
if($admin[grant_member]) {
	function grant_member() {
		global $admin, $mem_id;
		$one_mem=explode("/",$admin[grant_member]);
		return $one_mem;
	}

	$one_mem=grant_member();
	for($i=0;$i<count($one_mem);$i++) {
		if($MEMBER_ID == $one_mem[$i]) {
			$mem=1; 
			break;
		}
		$mem=0;
	}
}

##### 글읽기 허용 하지 않으면 빽 #####
if($mem!=1 && ($admin[grant_reply] < $member[level])){
	error2("답글쓰기 권한이 없습니다.");
}

##### 사용자가 아무값도 입력하지 않았거나 입력한 값이 허용되지 않는 값일 경우 에러메시지를 출력하고 스크립트를 종료한다.
if(!ereg("([^[:space:]]+)", $name) && !$MEMBER_ID) {
	error("NOT_ALLOWED_NAME");
	exit;
}

if(ereg("([^[:space:]]+)", $email) && (!ereg("(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$)", $email))) {
	error("NOT_ALLOWED_EMAIL");   
	exit;
}

if(ereg("([^[:space:]]+)", $homepage) && (!ereg("http://([0-9a-zA-Z./@~?&=_]+)", $homepage))  ) {
	error("NOT_ALLOWED_HOMEPAGE");
	exit;
}

if(!ereg("([^[:space:]]+)", $subject)) {
	error("NOT_ALLOWED_SUBJECT");
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

##### 작업대상 데이터베이스를 선택한다.
$db = mysql_select_db($dbName);
if(!$db) {
	error("FAILED_TO_SELECT_DB");
	exit;
}

##### 원글의 입력값으로부터 답변글에 입력할 정보(정렬 및 indent에 필요한 thread필드값)를 뽑아낸다.
$query = "SELECT thread, ok_secret, passwd, right(thread,1) FROM {$top}_board_{$code} WHERE fid = $fid AND length(thread) = length('$thread')+1 AND locate('$thread',thread) = 1 ORDER BY thread DESC LIMIT 1";
$result = mysql_query($query);

if(!$result) {
	error("QUERY_ERROR");
	exit;
}

$rows = mysql_num_rows($result);

if($rows) {        
	$row = mysql_fetch_row($result);	   
	$thread_head = substr($row[0],0,-1);
	$thread_foot = ++$row[3];
	$new_thread = $thread_head . $thread_foot;

	if($row[1]==1) {
		$ok_secret=1;
		$encrypted_passwd = $row[2];
	} else {
		$ok_secret="";
		$encrypted_passwd = crypt($passwd);
	}
} else {
	$new_thread = $thread . "A";
}

##### 각종 변수 설정
$ip=$REMOTE_ADDR; // 아이피값 구함;;
$signdate = time();

##### 제목과 본문의 문자열에 포함된 특수문자를 escape시킨다.
if($admin[grant_admin] >= $member[level]) $subject=addslashes($subject);
else $subject=addslashes(del_html($subject));
$comment = addslashes($comment);

##### 비밀번호란에 입력한 문자열을 암호화한다. 
$encrypted_passwd = crypt($passwd);

#### 회원 로그인 상태
if($MEMBER_ID) {
	$name=$member[name];
	$ismember=$MEMBER_ID;
	$email=$member[email];
	$homepage=$member[homepage];
}

##### 데이터베이스에 입력값을 삽입한다.
$query = "INSERT INTO {$top}_board_{$code} (fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, ok_html, ok_secret, category, add_a) VALUES ('$fid', '$ismember', '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 0, '$new_thread', '$ip', '$ok_html', '$ok_secret', '$category', '$add_a')";
$result = mysql_query($query);

if ($result) {
	if($notify_admin) {
		########## 답변글이 등록되었을 때 보내는 메일이므로 $type은 "reply"
		$type = "reply";

		########## 메일을 발송하는 스크립트를 불러온다.
		include "include/include.mail.php";
	}
	##### 리스트 출력화면으로 이동한다.
	echo ("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&category=$v_category&page=$page'>");

} else {
	error("QUERY_ERROR");
	exit;
}
?>

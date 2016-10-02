<?
session_start();

##### DB 접속 정보 #####
require_once("../system/config.php");

##### Code 지정 안되어 있으면 경고 #####
if(!$code) error2("Error - Code 지정");

##### Code 지정 안되어 있으면 경고 #####
//if(!$member[no] && $v!="eng") {
//	$spam_block = $top.date("dm",time());	
//	if($secret_num!=$spam_block) error2("Error - 스팸방지 코드값이 일치하지 않습니다.");
//}

##### 환경설정파일
$cfg_file = "../system/option/option." . $code . ".php";
if(file_exists($cfg_file)) {
	require($cfg_file);
}  else {
	require("../system/option/option.winko.php");
}

$member=member();
//if($member[level]!="1" && ($code=="intranet"||$code=="qna")) {$MEMBER_ID="";}
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

##### 글쓰기 허용 하지 않으면 빽 #####
if($mem!=1 && ($admin[grant_write] < $member[level])){
	error2("글쓰기 권한이 없습니다.");
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

##### 새로 작성된 게시물의 fid(family id), uid(unique id)값을 결정한다.
$result = mysql_query("SELECT max(uid), max(fid) FROM {$top}_board_{$code}");

if (!$result) {
	error("QUERY_ERROR");
	exit;
}

$row = mysql_fetch_row($result);
if($row[0]) {
	$new_uid = $row[0] + 1;
} else {
	$new_uid = 1;
}

if($row[1]) {
	$new_fid = $row[1] + 1;
} else {
	$new_fid = 1;
}   

##### 각종 변수 설정
$ip=$REMOTE_ADDR; // 아이피값 구함;;
if($C_year&&$C_month&&$C_day) {
	$signdate = mktime(23,15,23,$C_month,$C_day,$C_year);
} else {
	$signdate = time();
}

##### 제목과 본문의 문자열에 포함된 특수문자를 escape시킨다.
if($admin[grant_admin] >= $member[level]) $subject=addslashes($subject);
else $subject=addslashes(del_html($subject));
$comment = addslashes($comment);
$add_a=addslashes(del_html($add_a));

#### 홈페이지 주소의 경우 http:// 가 없으면 붙임
if((!eregi("http://",$homepage))&&$homepage) $homepage="http://".$homepage;

#### 링크 주소의 경우 http:// 가 없으면 붙임
//if((!eregi("http://",$sitelink))&&$sitelink) $sitelink="http://".$sitelink;

##### 비밀번호란에 입력한 문자열을 암호화한다. 
if($passwd) $encrypted_passwd = crypt($passwd);

#### 회원 로그인 상태
if($MEMBER_ID) {
	$name=$member[name];
	$ismember=$member[no];
	$email=$member[email];
	$homepage=$member[homepage];
}

##### 업로드 one #######
if($userfile && $userfile_size>0) { // 파일 첨부를 허용했을 경우
	$upload = "../data/".$code;

	if(file_exists("$upload/$userfile_name")) {
		//error2("동일한 이름의 파일이 존재합니다.");
		$userfile_name = time()."_".$userfile_name;
	}

	if($admin[upload_size1]<$userfile_size) error2(GetFileSize($admin[upload_size1])." 이상은 업로드 할 수 없습니다.");

	$file_name = substr( strrchr($userfile_name,"."),1);

	if($file_name==inc or $file_name==phtm or $file_name==htm or $file_name==shtm or $file_name==php3 or $file_name==html or $file_name==php or $file_name==asp or $file_name==pl or $file_name==cgi) {
		error2("Html, PHP 관련파일은 업로드할수 없습니다");
	} // 보안을 위해 확장자를 확인 하는 루틴

	$userfile_name=str_replace(" ","_",$userfile_name);
	$userfile_name=str_replace("-","_",$userfile_name);

	//한글파일 엔코드
	$userfile_name_ecd=urlencode($userfile_name); 
	if(!is_dir($upload)) { // 파일을 저장할 디렉토리가 있는지 검사
		error2("디렉토리가 생성되지 않아 파일 업로드를 할 수 없습니다.");
	}
	copy($userfile, "$upload/$userfile_name");
	unlink($userfile);// 작업후 임시 디렉토리에 저장된 파일을 삭제한다.
	$filename = $userfile_name_ecd;
	$filesize = $userfile_size;
}

###### 업로드 two ######
if($userfile2 && $userfile2_size>0) { // 파일 첨부를 허용했을 경우
	$upload = "../data/".$code;

	if(file_exists("$upload/$userfile2_name")) {
		//error2("동일한 이름의 파일이 존재합니다.");
		$userfile2_name = time()."_".$userfile2_name;
	}
	if($admin[upload_size2]<$userfile2_size) error2(GetFileSize($admin[upload_size2])." 이상은 업로드 할 수 없습니다.");

	if($file_name2==inc or $file_name2==phtm or $file_name2==htm or $file_name2==shtm or $file_name2==php3 or $file_name2==html or $file_name2==php or $file_name2==asp or $file_name2==pl or $file_name2==cgi) {
		error2("Html, PHP 관련파일은 업로드할수 없습니다");
	} // 보안을 위해 확장자를 확인 하는 루틴

	$userfile2_name=str_replace(" ","_",$userfile2_name);
	$userfile2_name=str_replace("-","_",$userfile2_name);

	//한글파일 엔코드
	$userfile2_name_ecd=urlencode($userfile2_name);

	if(!is_dir($upload)) { // 파일을 저장할 디렉토리가 있는지 검사
		error2("디렉토리가 생성되지 않아 파일 업로드를 할 수 없습니다.");
	}
	copy($userfile2, "$upload/$userfile2_name");
	unlink($userfile2);// 작업후 임시 디렉토리에 저장된 파일을 삭제한다.
	$filename2 = $userfile2_name_ecd;
	$filesize2 = $userfile2_size;
	$filetype2 = $userfile2_type;
}

if($MEMBER_ID){

	##### 더이상 입력값에 이상이 없으면 데이터베이스에 입력값을 삽입한다.
	$query = "INSERT INTO {$top}_board_{$code} (uid, fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, sitelink, notice, userfile, filesize, userfile2, filesize2, ok_html, ok_secret, category, add_a, add_b, add_c, add_d) VALUES ($new_uid, $new_fid, $ismember, '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 1,'A','$ip','$sitelink','$notice','$filename',$filesize,'$filename2',$filesize2,'$ok_html','$ok_secret','$category','$add_a','$add_b','$add_c','$add_d')";

	$query2 = "INSERT INTO {$top}_board_{$code} (uid, fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, sitelink, notice, userfile, filesize, userfile2, filesize2, ok_html, ok_secret, category, add_a, add_b, add_c, add_d) VALUES ($new_uid, $new_fid, $ismember, '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 1,'A','$ip','$sitelink','$notice','$filename',$filesize,'','','$ok_html','$ok_secret','$category','$add_a','$add_b','$add_c','$add_d')";

	$query3 = "INSERT INTO {$top}_board_{$code} (uid, fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, sitelink, notice, userfile, filesize, userfile2, filesize2, ok_html, ok_secret, category, add_a, add_b, add_c, add_d) VALUES ($new_uid, $new_fid, $ismember, '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 1,'A','$ip','$sitelink','$notice','','','$filename2',$filesize2,'$ok_html','$ok_secret','$category','$add_a','$add_b','$add_c','$add_d')";

	$query4 = "INSERT INTO {$top}_board_{$code} (uid, fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, sitelink, notice, userfile, filesize, userfile2, filesize2, ok_html, ok_secret, category, add_a, add_b, add_c, add_d) VALUES ($new_uid, $new_fid, $ismember, '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 1,'A','$ip','$sitelink','$notice','','','','','$ok_html','$ok_secret','$category','$add_a','$add_b','$add_c','$add_d')";

	if(($userfile_size>0 && $userfile)&&($userfile2_size>0 && $userfile2)){
		$result = mysql_query($query);
	} elseif($userfile_size>0 && $userfile){
		$result = mysql_query($query2);
	} elseif($userfile2_size>0 && $userfile2){
		$result = mysql_query($query3);
	} else{
		$result = mysql_query($query4);
	}
}

else{

	##### 더이상 입력값에 이상이 없으면 데이터베이스에 입력값을 삽입한다.
	$query = "INSERT INTO {$top}_board_{$code} (uid, fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, sitelink, notice, userfile, filesize, userfile2, filesize2, ok_html, ok_secret, category, add_a, add_b, add_c, add_d) VALUES ($new_uid, $new_fid, '', '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 1,'A','$ip','$sitelink','$notice','$filename',$filesize,'$filename2',$filesize2,'$ok_html','$ok_secret','$category','$add_a','$add_b','$add_c','$add_d')";

	$query2 = "INSERT INTO {$top}_board_{$code} (uid, fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, sitelink, notice, userfile, filesize, userfile2, filesize2, ok_html, ok_secret, category, add_a, add_b, add_c, add_d) VALUES ($new_uid, $new_fid, '', '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 1,'A','$ip','$sitelink','$notice','$filename',$filesize,'','','$ok_html','$ok_secret','$category','$add_a','$add_b','$add_c','$add_d')";

	$query3 = "INSERT INTO {$top}_board_{$code} (uid, fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, sitelink, notice, userfile, filesize, userfile2, filesize2, ok_html, ok_secret, category, add_a, add_b, add_c, add_d) VALUES ($new_uid, $new_fid, '', '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 1,'A','$ip','$sitelink','$notice','','','$filename2',$filesize2,'$ok_html','$ok_secret','$category','$add_a','$add_b','$add_c','$add_d')";

	$query4 = "INSERT INTO {$top}_board_{$code} (uid, fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, sitelink, notice, userfile, filesize, userfile2, filesize2, ok_html, ok_secret, category, add_a, add_b, add_c, add_d) VALUES ($new_uid, $new_fid, '', '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 1,'A','$ip','$sitelink','$notice','','','','','$ok_html','$ok_secret','$category','$add_a','$add_b','$add_c','$add_d')";

	if(($userfile_size>0 && $userfile)&&($userfile2_size>0 && $userfile2)){
		$result = mysql_query($query);
	} elseif($userfile_size>0 && $userfile){
		$result = mysql_query($query2);
	} elseif($userfile2_size>0 && $userfile2){
		$result = mysql_query($query3);
	} else{
		$result = mysql_query($query4);
	}
}

// 회원일 경우 해당 해원의 점수 주기
if($MEMBER_ID) @mysql_query("update {$top}_member set point1=point1+1 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());

if($result) {

	if($notify_admin) {

		########## 새글이 등록되었을 때 보내는 메일이므로 $type은 "new"
		$type = "new";
		########## 메일을 발송하는 스크립트를 불러온다.
		//include "include/include.mail.php";
	}

	##### 리스트 출력화면으로 이동한다.
	echo ("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&category=$category'>");
} else {
	error("QUERY_ERROR");
	exit;
}
?>

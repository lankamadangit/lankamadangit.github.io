<?
##### 삭제하고자 하는 글의 내용을 가져와 각각의 변수에 저장한다.
$query = "SELECT fid,ismember,name,subject,email,homepage,thread FROM {$top}_board_{$code} WHERE uid = $number";
$result = mysql_query($query);
if(!$result) {
	error("QUERY_ERROR");
	exit;
}

$row = mysql_fetch_object($result);

$my_fid = $row->fid;
$ismember = $row->ismember;
$my_name = $row->name;
$my_subject = $row->subject;
$my_email = $row->email;
$my_homepage = $row->homepage;
$my_thread = $row->thread;

##### 제목에 대하여 테이블에 저장할 때(post.php) addslashes() 함수로 escape시킨 문자열을 원래대로 되돌려 놓는다.
$my_subject = stripslashes($my_subject);

##### 검색문자열을 인코딩한다.
$encoded_key = urlencode($key);

if(!$my_email) {
	$my_email = "&nbsp;";
}

if(!$my_homepage) {
	$my_homepage = "&nbsp;";
}
/////////////////////////////////////////////////
##### 관리자로 인증된 경우 모든 글을 삭제할 수 있다.
if($MEMBER_ID &&($admin[grant_admin] >= $member[level] || $mem == 1 || $ismember == $member[no])) {

	if($v){$ment="<font color=#ff3300>$my_subject</font> delete";}
	else{$ment="<font color=#ff3300>$my_subject</font>을 삭제합니다.";}
} else{
	if($v){$ment="<font color=#ff3300>$my_subject</font> delete<br>Please enter your Password.";}
	else{$ment="<font color=#ff3300>$my_subject</font>을 삭제합니다.<br>비밀번호를 입력하여 주십시요";}
	$input_password="<input type=password name=passwd size=20 maxlength=20 class=input>";
}

$target="winko/include/post_delete.php?code=$code&page=$page&v=$v&category=$category&fid=$my_fid&thread=$my_thread&keyfield=$keyfield&key=$encoded_key";

$a_list = "<a href=winko.php?code=$code&v=$v&category=$category&page=$page&number=$number>";
include $skin_folder."/password_form.php";
?>
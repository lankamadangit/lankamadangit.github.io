<?
session_start();

##### DB ���� ���� #####
require_once("../system/config.php");

##### Code ���� �ȵǾ� ������ ��� #####
if(!$code) error2("Error - Code ����");

##### Code ���� �ȵǾ� ������ ��� #####
//if(!$member[no] && $v!="eng") {
//	$spam_block = $top.date("dm",time());	
//	if($secret_num!=$spam_block) error2("Error - ���Թ��� �ڵ尪�� ��ġ���� �ʽ��ϴ�.");
//}

##### ȯ�漳������
$cfg_file = "../system/option/option." . $code . ".php";
if(file_exists($cfg_file)) {
	require($cfg_file);
}  else {
	require("../system/option/option.winko.php");
}

$member=member();
//if($member[level]!="1" && ($code=="intranet"||$code=="qna")) {$MEMBER_ID="";}
##### adminboard ���� #######
$query2 = "SELECT * FROM {$top}_boardadmin where code='$code'";
$result2 = mysql_query($query2);

if (!$result2) {
	error("QUERY_ERROR");
	exit;
}

$admin=mysql_fetch_array($result2);

##### ������ ȸ�� �˻� #######
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

##### �۾��� ��� ���� ������ �� #####
if($mem!=1 && ($admin[grant_write] < $member[level])){
	error2("�۾��� ������ �����ϴ�.");
}

##### ����ڰ� �ƹ����� �Է����� �ʾҰų� �Է��� ���� ������ �ʴ� ���� ��� �����޽����� ����ϰ� ��ũ��Ʈ�� �����Ѵ�.
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

##### ���� �ۼ��� �Խù��� fid(family id), uid(unique id)���� �����Ѵ�.
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

##### ���� ���� ����
$ip=$REMOTE_ADDR; // �����ǰ� ����;;
if($C_year&&$C_month&&$C_day) {
	$signdate = mktime(23,15,23,$C_month,$C_day,$C_year);
} else {
	$signdate = time();
}

##### ����� ������ ���ڿ��� ���Ե� Ư�����ڸ� escape��Ų��.
if($admin[grant_admin] >= $member[level]) $subject=addslashes($subject);
else $subject=addslashes(del_html($subject));
$comment = addslashes($comment);
$add_a=addslashes(del_html($add_a));

#### Ȩ������ �ּ��� ��� http:// �� ������ ����
if((!eregi("http://",$homepage))&&$homepage) $homepage="http://".$homepage;

#### ��ũ �ּ��� ��� http:// �� ������ ����
//if((!eregi("http://",$sitelink))&&$sitelink) $sitelink="http://".$sitelink;

##### ��й�ȣ���� �Է��� ���ڿ��� ��ȣȭ�Ѵ�. 
if($passwd) $encrypted_passwd = crypt($passwd);

#### ȸ�� �α��� ����
if($MEMBER_ID) {
	$name=$member[name];
	$ismember=$member[no];
	$email=$member[email];
	$homepage=$member[homepage];
}

##### ���ε� one #######
if($userfile && $userfile_size>0) { // ���� ÷�θ� ������� ���
	$upload = "../data/".$code;

	if(file_exists("$upload/$userfile_name")) {
		//error2("������ �̸��� ������ �����մϴ�.");
		$userfile_name = time()."_".$userfile_name;
	}

	if($admin[upload_size1]<$userfile_size) error2(GetFileSize($admin[upload_size1])." �̻��� ���ε� �� �� �����ϴ�.");

	$file_name = substr( strrchr($userfile_name,"."),1);

	if($file_name==inc or $file_name==phtm or $file_name==htm or $file_name==shtm or $file_name==php3 or $file_name==html or $file_name==php or $file_name==asp or $file_name==pl or $file_name==cgi) {
		error2("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");
	} // ������ ���� Ȯ���ڸ� Ȯ�� �ϴ� ��ƾ

	$userfile_name=str_replace(" ","_",$userfile_name);
	$userfile_name=str_replace("-","_",$userfile_name);

	//�ѱ����� ���ڵ�
	$userfile_name_ecd=urlencode($userfile_name); 
	if(!is_dir($upload)) { // ������ ������ ���丮�� �ִ��� �˻�
		error2("���丮�� �������� �ʾ� ���� ���ε带 �� �� �����ϴ�.");
	}
	copy($userfile, "$upload/$userfile_name");
	unlink($userfile);// �۾��� �ӽ� ���丮�� ����� ������ �����Ѵ�.
	$filename = $userfile_name_ecd;
	$filesize = $userfile_size;
}

###### ���ε� two ######
if($userfile2 && $userfile2_size>0) { // ���� ÷�θ� ������� ���
	$upload = "../data/".$code;

	if(file_exists("$upload/$userfile2_name")) {
		//error2("������ �̸��� ������ �����մϴ�.");
		$userfile2_name = time()."_".$userfile2_name;
	}
	if($admin[upload_size2]<$userfile2_size) error2(GetFileSize($admin[upload_size2])." �̻��� ���ε� �� �� �����ϴ�.");

	if($file_name2==inc or $file_name2==phtm or $file_name2==htm or $file_name2==shtm or $file_name2==php3 or $file_name2==html or $file_name2==php or $file_name2==asp or $file_name2==pl or $file_name2==cgi) {
		error2("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");
	} // ������ ���� Ȯ���ڸ� Ȯ�� �ϴ� ��ƾ

	$userfile2_name=str_replace(" ","_",$userfile2_name);
	$userfile2_name=str_replace("-","_",$userfile2_name);

	//�ѱ����� ���ڵ�
	$userfile2_name_ecd=urlencode($userfile2_name);

	if(!is_dir($upload)) { // ������ ������ ���丮�� �ִ��� �˻�
		error2("���丮�� �������� �ʾ� ���� ���ε带 �� �� �����ϴ�.");
	}
	copy($userfile2, "$upload/$userfile2_name");
	unlink($userfile2);// �۾��� �ӽ� ���丮�� ����� ������ �����Ѵ�.
	$filename2 = $userfile2_name_ecd;
	$filesize2 = $userfile2_size;
	$filetype2 = $userfile2_type;
}

if($MEMBER_ID){

	##### ���̻� �Է°��� �̻��� ������ �����ͺ��̽��� �Է°��� �����Ѵ�.
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

	##### ���̻� �Է°��� �̻��� ������ �����ͺ��̽��� �Է°��� �����Ѵ�.
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

// ȸ���� ��� �ش� �ؿ��� ���� �ֱ�
if($MEMBER_ID) @mysql_query("update {$top}_member set point1=point1+1 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());

if($result) {

	if($notify_admin) {

		########## ������ ��ϵǾ��� �� ������ �����̹Ƿ� $type�� "new"
		$type = "new";
		########## ������ �߼��ϴ� ��ũ��Ʈ�� �ҷ��´�.
		//include "include/include.mail.php";
	}

	##### ����Ʈ ���ȭ������ �̵��Ѵ�.
	echo ("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&category=$category'>");
} else {
	error("QUERY_ERROR");
	exit;
}
?>

<?
session_start();

##### DB ���� ���� #####
require_once("../system/config.php");

##### Code ���� �ȵǾ� ������ ��� #####
if(!$code) error2("Error - Code ����");

##### ȯ�漳������
$cfg_file = "../system/option/option." . $code . ".php";

if(file_exists($cfg_file)) {
	require($cfg_file);
}  else {
	require("../system/option/option.winko.php");
}

$member=member();

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

##### ���б� ��� ���� ������ �� #####
if($mem!=1 && ($admin[grant_reply] < $member[level])){
	error2("��۾��� ������ �����ϴ�.");
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

##### �۾���� �����ͺ��̽��� �����Ѵ�.
$db = mysql_select_db($dbName);
if(!$db) {
	error("FAILED_TO_SELECT_DB");
	exit;
}

##### ������ �Է°����κ��� �亯�ۿ� �Է��� ����(���� �� indent�� �ʿ��� thread�ʵ尪)�� �̾Ƴ���.
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

##### ���� ���� ����
$ip=$REMOTE_ADDR; // �����ǰ� ����;;
$signdate = time();

##### ����� ������ ���ڿ��� ���Ե� Ư�����ڸ� escape��Ų��.
if($admin[grant_admin] >= $member[level]) $subject=addslashes($subject);
else $subject=addslashes(del_html($subject));
$comment = addslashes($comment);

##### ��й�ȣ���� �Է��� ���ڿ��� ��ȣȭ�Ѵ�. 
$encrypted_passwd = crypt($passwd);

#### ȸ�� �α��� ����
if($MEMBER_ID) {
	$name=$member[name];
	$ismember=$MEMBER_ID;
	$email=$member[email];
	$homepage=$member[homepage];
}

##### �����ͺ��̽��� �Է°��� �����Ѵ�.
$query = "INSERT INTO {$top}_board_{$code} (fid, ismember, name, email, homepage, subject, comment, passwd, signdate, ref, thread, ip, ok_html, ok_secret, category, add_a) VALUES ('$fid', '$ismember', '$name', '$email', '$homepage', '$subject', '$comment', '$encrypted_passwd', $signdate, 0, '$new_thread', '$ip', '$ok_html', '$ok_secret', '$category', '$add_a')";
$result = mysql_query($query);

if ($result) {
	if($notify_admin) {
		########## �亯���� ��ϵǾ��� �� ������ �����̹Ƿ� $type�� "reply"
		$type = "reply";

		########## ������ �߼��ϴ� ��ũ��Ʈ�� �ҷ��´�.
		include "include/include.mail.php";
	}
	##### ����Ʈ ���ȭ������ �̵��Ѵ�.
	echo ("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&category=$v_category&page=$page'>");

} else {
	error("QUERY_ERROR");
	exit;
}
?>

<?
session_start();

##### DB ���� ���� #####
require_once("../system/config.php");

##### Code ���� �ȵǾ� ������ ��� #####
if(!$code) error2("Error - Code ����");

$member=member();
//if($member[level]!="1" && ($code=="intranet"||$code=="qna")) {$MEMBER_ID="";}
##### ����ڰ� �ƹ����� �Է����� �ʾҰų� �Է��� ���� ������ �ʴ� ���� ��� �����޽����� ����ϰ� ��ũ��Ʈ�� �����Ѵ�.
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

##### ���� ���� ����
$ip=$REMOTE_ADDR; // �����ǰ� ����;;
$signdate = time();
$parent=$number;

##### ���ڿ��� ���Ե� Ư�����ڸ� escape��Ų��.
$name = addslashes($name);
$comment = addslashes($comment);
##### ��й�ȣ���� �Է��� ���ڿ��� ��ȣȭ�Ѵ�. 
if($passwd) $encrypted_passwd = crypt($passwd);

#### ȸ�� �α��� ����
if($MEMBER_ID) {
	$name=$member[name];
	$ismember=$MEMBER_ID;
}

##### ���̻� �Է°��� �̻��� ������ �����ͺ��̽��� �Է°��� �����Ѵ�.
//if($MEMBER_ID){
$query = "INSERT INTO {$top}_short_{$code} (parent, ismember, name, passwd, comment, ip, signdate) VALUES ('$parent', '$ismember', '$name', '$encrypted_passwd', '$comment', '$ip', $signdate)";
//}
$result = mysql_query($query);

// ȸ���� ��� �ش� �ؿ��� ���� �ֱ�
if($MEMBER_ID) @mysql_query("update {$top}_member set point2=point2+2 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());

if($result) {
	##### ����Ʈ ���ȭ������ �̵��Ѵ�.
	echo ("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&body=view&v=$v&category=$category&page=$page&number=$number'>");
} else {
	error("QUERY_ERROR");
	exit;
}
?>

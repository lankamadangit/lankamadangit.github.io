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
} 
else {
   require("../system/option/option.winko.php");
}

$member=member();

##### adminboard ���� #####
$query_ab = "SELECT * FROM {$top}_boardadmin where code='$code'";
$result_ab = mysql_query($query_ab);
if (!$result_ab) {
   error("QUERY_ERROR");
   exit;
}
$num_ab = mysql_num_rows($result_ab);
if($num_ab==0) error2("Error - �߸��� Code");
$admin=mysql_fetch_array($result_ab);

##### ������ ȸ�� �˻� #######
if($admin[grant_member]) {
function grant_member()
{
global $admin;
$one_mem=explode("/",$admin[grant_member]);
return $one_mem;
}
$one_mem=grant_member();
	for($i=0;$i<count($one_mem);$i++) {
	if($MEMBER_ID == $one_mem[$i]) {$mem=1; break;}
	$mem=0;
	}
}

##### ���б� ��� ���� ������ �� #####
if($v=="eng") {
	if($mem!=1 && ($admin[grant_view] < $MEMBER_LEVEL)){
	error2("Please sign in to download.");
	}
}
else {
	if($mem!=1 && ($admin[grant_view] < $MEMBER_LEVEL)){
	error2("�α��� �� �̿��� �ּ���.");
	}
} //if($v=="eng") {

// ������� Download ���� �ø�;;
mysql_query("update {$top}_board_{$code} set downhit = downhit + 1 where uid='$number'");

// �ٿ�ε�;;
$file=urlencode($file);
$real_file = "../data/".$code."/".$file;
header("location:$real_file")
?>

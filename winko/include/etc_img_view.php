<?
##### DB ���� ����
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

##### ȸ������ ȣ�� #####
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
	if($mem!=1 && ($admin[grant_view] < $member[level])){
	error3("Please sign in to read.");
	}
}
else {
	if($mem!=1 && ($admin[grant_view] < $member[level])){
	error3("�α��� �� �̿��� �ּ���.");
	}
} //if($v=="eng") {

$file=urlencode($file);
$file_name="../data/".$code."/".$file;
?>
<html>
<title><?=$title?></title>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0'>
<table border='0' cellpadding='1' cellspacing='0' align='center' bgcolor='black'>
<tr>
<td align='center'><a href=# onclick=window.close()><img src="<?=$file_name?>" width="<?=$w_photo?>" height="<?=$h_photo?>" border=0></a></p></tr>
</table>
</body>
</html>

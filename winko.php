<?
session_start();

##### DB ���� ���� #####
require_once("winko/system/config.php");

##### Code ���� �ȵǾ� ������ ��� #####
if(!$code) error2("Error - Code ����");

##### ȯ�漳������
$cfg_file = "winko/system/option/option." . $code . ".php";
if(file_exists($cfg_file)) {
	require($cfg_file);
} else {
	require("winko/system/option/option.winko.php");
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
if($admin[table_width] <= 100){
	$table_width = $admin[table_width]."%";
}else{
	$table_width = $admin[table_width];
}

$skin_folder= "winko/skin/$admin[skin]";

##### ������ ȸ�� �˻� #######
if($admin[grant_member]) {
	function grant_member() {
		global $admin;
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
if($v=="eng") {
	if($body=="view"){
		if($mem!=1 && ($admin[grant_view] < $member[level])){
		error2("Please sign in to read.");
		}
	}
	elseif($body=="write"){
		if($mem!=1 && ($admin[grant_write] < $member[level])){
		error2("Please sign in to write.");
		}
	}
	elseif($body=="modify"){
		if($mem!=1 && ($admin[grant_write] < $member[level])){
		error2("Please sign in to modify.");
		}
	}
	elseif($body=="reply"){
		if($mem!=1 && ($admin[grant_reply] < $member[level])){
		error2("Please sign in to reply.");
		}
	}
	//�α��������� (2005-03-09 ����)
	elseif($body=="login"){
	}
	else {
		if($mem!=1 && ($admin[grant_list] < $member[level])){
		error2("Please sign in to read.");
		}
	}
} 
else {
	if($body=="view"){
		if($mem!=1 && ($admin[grant_view] < $member[level])){
		error2("�α��� �� �̿��� �ּ���.");
		}
	}
	elseif($body=="write"){
		if($mem!=1 && ($admin[grant_write] < $member[level])){
		error2("�۾��� ������ �����ϴ�.");
		}
	}
	elseif($body=="modify"){
		if($mem!=1 && ($admin[grant_write] < $member[level])){
		error2("�ۼ��� ������ �����ϴ�.");
		}
	}
	elseif($body=="reply"){
		if($mem!=1 && ($admin[grant_reply] < $member[level])){
		error2("��۾��� ������ �����ϴ�.");
		}
	}
	//�α��������� (2005-03-09 ����)
	elseif($body=="login"){
	}
	else {
		if($mem!=1 && ($admin[grant_list] < $member[level])){
		error2("����Ʈ ���� ������ �����ϴ�.");
		}
	}
} //if($v=="eng") {}else{

##### Ư���� �������� ������ ����Ʈ�� ù �������� ����Ѵ�.
if(!$page) {
	$page = 1;
}
##### HTML ��� ������ ������ �ҷ��´�.
require_once("winko/system/html_header.php");

##### ������ �������� ����� ����ϴ� ������ �ҷ��´�.
if($body=="view") {
	include "winko/include/include_view.php";
}
elseif($body=="write") {
	include "winko/include/include_write.php";
}
elseif($body=="modify") {
	include "winko/include/include_modify.php";
}
elseif($body=="reply") {
	include "winko/include/include_reply.php";
}
elseif($body=="delete") {
	include "winko/include/include_delete.php";
}
elseif($body=="short_del") {
	include "winko/include/include_short_del.php";
}
elseif($body=="secret") {
	include "winko/include/include_secret.php";
}
elseif($body=="login") {
	include "winko/include/include_login.php";
}
else {
	if($admin[ok_visit]==1){
		include "winko/include/include_thread.php";
	}
	elseif($admin[ok_visit]==2){
		include "winko/include/include_gallery.php";
	}
	else{
		include "winko/include/include_list.php";
	}
}

##### HTML �ϴ� ������ ������ �ҷ��´�.
require_once("winko/system/html_footer.php");
?>
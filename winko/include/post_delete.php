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

$save_dir = "../data/".$code;

##### �����ϰ��� �ϴ� ���� �亯���� �ϳ��� �ް� ������ ������ �� ������ �Ѵ�.
if(!$allow_delete_thread) {   
	$query = "SELECT thread FROM {$top}_board_{$code} WHERE fid = $fid AND length(thread) = length('$thread')+1 AND locate('$thread',thread) = 1 ORDER BY thread DESC LIMIT 1";
	$result = mysql_query($query);
	if(!$result) {
		error("QUERY_ERROR");
		exit;
	}

	$rows = mysql_num_rows($result);         
	if($rows) {
		error("NO_ACCESS_DELETE_THREAD");
		exit;
	}
}

##### ���丮���� ������ ���ϸ��� ������ �´�.
$a = mysql_query("SELECT uid,ismember,userfile,userfile2 FROM {$top}_board_{$code} WHERE fid = $fid AND thread = '$thread'");
if(!$a) {
	error("QUERY_ERROR");
	exit;
}

$uid = mysql_result($a,0,uid);
$ismember = mysql_result($a,0,ismember);
$filename = mysql_result($a,0,userfile);
$filename=urldecode($filename);
$filename2 = mysql_result($a,0,userfile2);
$filename2=urldecode($filename2);
$file = $save_dir . "/" . $filename;
$file2 = $save_dir . "/" . $filename2;

##### �����ڷ� ������ ��� ��� ���� ������ �� �ִ�.
if($MEMBER_ID&&($admin[grant_admin] >= $member[level] || $mem == 1 || $ismember == $member[no])) {

	##### ���丮���� ������ ���ڵ��� ������ �����Ѵ�.
	if($filename){ 
		if(!@unlink($file)) {
			echo "<script> window.alert('ù��° ������ �������� �ʾҽ��ϴ�.')</script>";
		}
	}
	if($filename2){ 
		if(!@unlink($file2)) {
			echo "<script> window.alert('�ι�° ������ �������� �ʾҽ��ϴ�.')</script>";
		}
	}

	##### ���̺��� �ش� ������ ���ڵ带 �����Ѵ�.
	$query = "DELETE FROM {$top}_board_{$code} WHERE fid = $fid AND thread = '$thread'";
	$result = mysql_query($query);
	if (!$result) {
		error("QUERY_ERROR");
		exit;
	}

	##### ª���� parent ���Ѱ� ������ ����
	$query2 = "DELETE FROM {$top}_short_{$code} WHERE parent = '$uid'";
	$result2 = mysql_query($query2);
	if (!$result2) {
		error("QUERY_ERROR");
		exit;
	}

	// ȸ���� ��� ���� ����
	if($MEMBER_ID) @mysql_query("update {$top}_member set point1=point1-1 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());
	echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&category=$category&page=$page&keyfield=$keyfield&key=$encoded_key'>");

} else {

	###### �ش�Խù��� ��ȣ���� �̾Ƴ���.
	$result = mysql_query("SELECT passwd FROM {$top}_board_{$code} WHERE fid = $fid AND thread = '$thread'");

	if(!$result) {
		error("QUERY_ERROR");
		exit;
	}

	$real_pass = mysql_result($result,0,0);
	mysql_free_result($result);

	##### ����ڰ� ��й�ȣ���� �Է��� ���ڿ��� crypt() �Լ��� ��ȣȭ�Ѵ�.
	$user_pass = crypt($passwd,$real_pass);

	##### �Խù��� ��ȣ�� ����ڰ� �Է��� ��ȣ�� ������ �Խù��� �����Ѵ�.
	if (!strcmp($real_pass,$user_pass)) {      
		##### ���丮���� ������ ���ڵ��� ������ �����Ѵ�.
		if($filename){ 
			if(!@unlink($file)) {
				echo "<script> window.alert('ù��° ������ �������� �ʾҽ��ϴ�.')</script>";
			}
		}
		if($filename2){ 
			if(!@unlink($file2)) {
				echo "<script> window.alert('�ι�° ������ �������� �ʾҽ��ϴ�.')</script>";
			}
		}

		###### ---------------------------------------------------######
		$query = "DELETE FROM {$top}_board_{$code} WHERE fid = $fid AND thread = '$thread'";
		$result = mysql_query($query);

		if (!$result) {
			error("QUERY_ERROR");
			exit;
		}

		// ȸ���� ��� ���� ����
		if($MEMBER_ID) @mysql_query("update {$top}_member set point1=point1-1 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());      

		##### ����Ʈ ���ȭ������ �̵��Ѵ�.
		$encoded_key = urlencode($key);
		echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&category=$category&page=$page&keyfield=$keyfield&key=$encoded_key'>");   
	} else {
		error("NO_ACCESS_DELETE");
		exit;
	}
}
?>

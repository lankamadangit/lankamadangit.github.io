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
function grant_member()
{
 global $admin, $mem_id;
$one_mem=explode("/",$admin[grant_member]);
return $one_mem;
}
$one_mem=grant_member();
	for($i=0;$i<count($one_mem);$i++) {
	if($MEMBER_ID == $one_mem[$i]) {$mem=1; break;}
	$mem=0;
	}
}
##### �н����� �ʼ� �Է�
//if(($member[level] == 1 || $member[board_admin] == $code) && !$passwd){
//	error("NOT_ALLOWED_PASSWD2");
//	exit;
//}

// �������� ������
  $s_data=mysql_fetch_array(mysql_query("select * from {$top}_short_{$code} where uid='$c_uid'"));

  //////// MySQL �ݱ� ///////////////////////////////////////////////
  if($connect) mysql_close($connect);
##### �����ڷ� ������ ��� ��� ���� ������ �� �ִ�.
if($MEMBER_ID&&($admin[grant_admin] >= $member[level] || $mem == 1 || $s_data[ismember] == $MEMBER_ID)) {
  
   ##### ���̺��� �ش� ������ ���ڵ带 �����Ѵ�.
   $query = "DELETE FROM {$top}_short_{$code} WHERE uid='$c_uid'";
   $result = mysql_query($query);
   if (!$result) {
      error("QUERY_ERROR");
      exit;
   }
// ȸ���� ��� �ش� �ؿ��� ���� ����
if($MEMBER_ID) @mysql_query("update {$top}_member set point2=point2-2 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());
   echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&body=view&category=$category&page=$page&number=$number'>");   
   
} else {

   ###### �ش�Խù��� ��ȣ���� �̾Ƴ���.
   $result = mysql_query("SELECT passwd FROM {$top}_short_{$code} WHERE uid='$c_uid'");
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

      $query = "DELETE FROM {$top}_short_{$code} WHERE uid='$c_uid'";
      $result = mysql_query($query);
      if (!$result) {
         error("QUERY_ERROR");
         exit;
      }
      
// ȸ���� ��� �ش� �ؿ��� ���� ����
if($MEMBER_ID) @mysql_query("update {$top}_member set point2=point2-2 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());

   ##### ����Ʈ ���ȭ������ �̵��Ѵ�.
   echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&body=view&category=$category&page=$page&number=$number'>");   
   } else {
	  error("NO_ACCESS_DELETE");
      exit;
   }
}   
?>

<?
session_start();

##### DB ���� ���� #####
require_once("../system/config.php");

//$member=member();

//if(headers_sent()) {
//   echo "�̹� ����� ���۵Ǿ� ��Ű�� ������ �� �����ϴ�.";
//   exit;
//}
//else{
    // �α����̺��� ���� (���� ������);
    mysql_query("delete from {$top}_connect_member where mem_id='$MEMBER_ID'");

//	setcookie("MEM_ID","",time()-3600);
//    setcookie("MEM_PW","",time()-3600);

  // �α׾ƿ� ���ϰ� ���� ȸ�� ���������� ����(2�ð�)
  mysql_query("delete from {$top}_connect_member where (".time()." - logtime) >= 7200");
//}

//if($code) movepage("winko.php?code=$code");
//if($page) movepage("sunny.php?page=$page&sub=$sub");

@session_unregister("MEMBER_ID") or die("session_unregister err");
@session_unregister("MEMBER_NAME") or die("session_unregister err");
@session_unregister("MEMBER_LEVEL") or die("session_unregister err");	
@session_unregister("MEMBER_PART") or die("session_unregister err");	

if($admin) movepage("../../admin.php");
movepage("../../{$go_index}");
?>
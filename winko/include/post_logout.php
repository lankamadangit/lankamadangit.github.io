<?
session_start();

##### DB 접속 정보 #####
require_once("../system/config.php");

//$member=member();

//if(headers_sent()) {
//   echo "이미 헤더가 전송되어 쿠키를 생성할 수 없습니다.";
//   exit;
//}
//else{
    // 로그테이블에서 삭제 (현재 접속자);
    mysql_query("delete from {$top}_connect_member where mem_id='$MEMBER_ID'");

//	setcookie("MEM_ID","",time()-3600);
//    setcookie("MEM_PW","",time()-3600);

  // 로그아웃 안하고 나간 회원 현재접속자 삭제(2시간)
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
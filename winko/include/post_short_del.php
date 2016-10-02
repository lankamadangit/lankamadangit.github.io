<?
session_start();

##### DB 접속 정보 #####
require_once("../system/config.php");

##### Code 지정 안되어 있으면 경고 #####
if(!$code) error2("Error - Code 지정");

##### 환경설정파일
$cfg_file = "../system/option/option." . $code . ".php";
if(file_exists($cfg_file)) {
   require($cfg_file);
} 
else {
   require("../system/option/option.winko.php");
}

$member=member();
//if($member[level]!="1" && ($code=="intranet"||$code=="qna")) {$MEMBER_ID="";}
##### adminboard 접속 #######
$query2 = "SELECT * FROM {$top}_boardadmin where code='$code'";
$result2 = mysql_query($query2);
if (!$result2) {
   error("QUERY_ERROR");
   exit;
}
$admin=mysql_fetch_array($result2);

##### 관리자 회원 검색 #######
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
##### 패스워드 필수 입력
//if(($member[level] == 1 || $member[board_admin] == $code) && !$passwd){
//	error("NOT_ALLOWED_PASSWD2");
//	exit;
//}

// 원본글을 가져옴
  $s_data=mysql_fetch_array(mysql_query("select * from {$top}_short_{$code} where uid='$c_uid'"));

  //////// MySQL 닫기 ///////////////////////////////////////////////
  if($connect) mysql_close($connect);
##### 관리자로 인증된 경우 모든 글을 삭제할 수 있다.
if($MEMBER_ID&&($admin[grant_admin] >= $member[level] || $mem == 1 || $s_data[ismember] == $MEMBER_ID)) {
  
   ##### 테이블에서 해당 파일의 레코드를 삭제한다.
   $query = "DELETE FROM {$top}_short_{$code} WHERE uid='$c_uid'";
   $result = mysql_query($query);
   if (!$result) {
      error("QUERY_ERROR");
      exit;
   }
// 회원일 경우 해당 해원의 점수 빼기
if($MEMBER_ID) @mysql_query("update {$top}_member set point2=point2-2 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());
   echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&body=view&category=$category&page=$page&number=$number'>");   
   
} else {

   ###### 해당게시물의 암호값을 뽑아낸다.
   $result = mysql_query("SELECT passwd FROM {$top}_short_{$code} WHERE uid='$c_uid'");
   if(!$result) {
      error("QUERY_ERROR");
      exit;
   }
   $real_pass = mysql_result($result,0,0);
   mysql_free_result($result);

   ##### 사용자가 비밀번호란에 입력한 문자열을 crypt() 함수로 암호화한다.
   $user_pass = crypt($passwd,$real_pass);
   
   ##### 게시물의 암호와 사용자가 입력한 암호가 같으면 게시물을 삭제한다.
   if (!strcmp($real_pass,$user_pass)) {      

      $query = "DELETE FROM {$top}_short_{$code} WHERE uid='$c_uid'";
      $result = mysql_query($query);
      if (!$result) {
         error("QUERY_ERROR");
         exit;
      }
      
// 회원일 경우 해당 해원의 점수 빼기
if($MEMBER_ID) @mysql_query("update {$top}_member set point2=point2-2 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());

   ##### 리스트 출력화면으로 이동한다.
   echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&body=view&category=$category&page=$page&number=$number'>");   
   } else {
	  error("NO_ACCESS_DELETE");
      exit;
   }
}   
?>

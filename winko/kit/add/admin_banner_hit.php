<?
##### 사용자 정의 함수 파일을 가져온다.
require_once("../system/function.user.php");

##### DB 접속 정보
require_once("../system/config.php");

##### 작업대상 데이터베이스를 선택한다.
$db = mysql_select_db($dbName);
if(!$db) {
   error("FAILED_TO_SELECT_DB");
   exit;
}

  $sql = " select url from $winko_banner where no = $id ";
  $row = mysql_fetch_array(mysql_query($sql));
  $url = $row[url];

  $sql = " update $winko_banner set hit=hit+1 where no=$id ";
  mysql_query($sql);

  movepage("$url");
?>

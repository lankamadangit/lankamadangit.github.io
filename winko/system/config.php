<?
@ini_set("session.use_trans_sid", 0);    // PHPSESSID를 자동으로 넘기지 않음
@ini_set("url_rewriter.tags",""); // 링크에 PHPSESSID가 따라다니는것을 무력화함

if($_SERVER['PHP_SELF'] != "/admin.php") {
	header("X-UA-Compatible: IE=Edge");
}

require_once("function.php");
define("__CASTLE_PHP_VERSION_BASE_DIR__", "".$_SERVER['DOCUMENT_ROOT']."/castle-php");
include_once(__CASTLE_PHP_VERSION_BASE_DIR__ . "/castle_referee.php");
##########################################################################################
//// 데이터베이스 연결///////////////////////////////////////////////////////////////////////////////////
##########################################################################################
$hostName = "localhost"; $userName = "winko_bluew"; $userPassword = "blue0109@^"; $dbName = "winko_bluew";
##########################################################################################
$conn = @mysql_connect($hostName,$userName,$userPassword);
if(!$conn) {
   error("ACCESS_DENIED_DB_CONNECTION");
   exit;
}
$db = mysql_select_db($dbName);
if(!$db) {
   error("FAILED_TO_SELECT_DB");
   exit;
}

	if(!empty($HTTP_GET_VARS)) $_GET = $HTTP_GET_VARS;
	if(!empty($HTTP_POST_VARS)) $_POST = $HTTP_POST_VARS;
	if(!empty($HTTP_COOKIE_VARS)) $_COOKIE = $HTTP_COOKIE_VARS;
	if(!empty($HTTP_SESSION_VARS)) $_SESSION= $HTTP_SESSION_VARS;
	if(!empty($HTTP_POST_FILES)) $_FILES = $HTTP_POST_FILES;
	if(!empty($HTTP_SERVER_VARS)) $_SERVER = $HTTP_SERVER_VARS;
	if(!empty($HTTP_ENV_VARS)) $_ENV = $HTTP_ENV_VARS;

	if(count($_GET)) extract($_GET);
	if(count($_POST)) extract($_POST);
	if(count($_SERVER)) extract($_SERVER);
	if(count($_SESSION)) extract($_SESSION);
	if(count($_COOKIE)) extract($_COOKIE);
	if(count($_FILES))
	{
		while(list($key,$value)=each($_FILES))
		{
			$$key = $_FILES[$key][tmp_name];
			$str = "$key"."_name";
			$$str = $_FILES[$key][name];
			$str = "$key"."_size";
			$$str = $_FILES[$key][size];
		}
	}


	// SENDMAIL 설정
	$SENDMAIL_PATH = ""; // 수동설정시 입력
	if(empty($SENDMAIL_PATH)) {
		$sendmail_arr = array(
			"/usr/lib/sendmail", // ASADAL
			"/home/bin/sendmail", // CAFE24
			"/usr/bin/sendmail",
			"/usr/sbin/sendmail",
			"/var/qmail/bin/sendmail",
			"/usr/local/bin/sendmail"
		);
		// sendmail 실행경로 자동 체크
		for($i=0; $i<sizeof($sendmail_arr); $i++){
			if(@is_file($sendmail_arr[$i]) == TRUE){
				$SENDMAIL_PATH = $sendmail_arr[$i];
				break;
			}
		}
	}

##########################################################################################
//// 운영정보 ///////////////////////////////////////////////////////////////////////////////////////////
##########################################################################################
$admin_id = "admin"; //관리자로 지정할 ID
$top = "bluwash"; //새로 생성될 게시판 앞의 글자.
$go_index="index.html";

?>
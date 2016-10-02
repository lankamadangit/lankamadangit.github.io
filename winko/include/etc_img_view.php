<?
##### DB 접속 정보
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

##### 회원정보 호출 #####
$member=member();

##### adminboard 접속 #####
$query_ab = "SELECT * FROM {$top}_boardadmin where code='$code'";
$result_ab = mysql_query($query_ab);
if (!$result_ab) {
   error("QUERY_ERROR");
   exit;
}
$num_ab = mysql_num_rows($result_ab);
if($num_ab==0) error2("Error - 잘못된 Code");
$admin=mysql_fetch_array($result_ab);

##### 관리자 회원 검색 #######
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

##### 글읽기 허용 하지 않으면 빽 #####
if($v=="eng") {
	if($mem!=1 && ($admin[grant_view] < $member[level])){
	error3("Please sign in to read.");
	}
}
else {
	if($mem!=1 && ($admin[grant_view] < $member[level])){
	error3("로그인 후 이용해 주세요.");
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

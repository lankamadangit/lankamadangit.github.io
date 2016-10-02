<?
session_start();

##### DB 접속 정보 #####
require_once("winko/system/config.php");

##### Code 지정 안되어 있으면 경고 #####
if(!$code) error2("Error - Code 지정");

##### 환경설정파일
$cfg_file = "winko/system/option/option." . $code . ".php";
if(file_exists($cfg_file)) {
	require($cfg_file);
} else {
	require("winko/system/option/option.winko.php");
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
if($admin[table_width] <= 100){
	$table_width = $admin[table_width]."%";
}else{
	$table_width = $admin[table_width];
}

$skin_folder= "winko/skin/$admin[skin]";

##### 관리자 회원 검색 #######
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

##### 글읽기 허용 하지 않으면 빽 #####
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
	//로그인페이지 (2005-03-09 편집)
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
		error2("로그인 후 이용해 주세요.");
		}
	}
	elseif($body=="write"){
		if($mem!=1 && ($admin[grant_write] < $member[level])){
		error2("글쓰기 권한이 없습니다.");
		}
	}
	elseif($body=="modify"){
		if($mem!=1 && ($admin[grant_write] < $member[level])){
		error2("글수정 권한이 없습니다.");
		}
	}
	elseif($body=="reply"){
		if($mem!=1 && ($admin[grant_reply] < $member[level])){
		error2("답글쓰기 권한이 없습니다.");
		}
	}
	//로그인페이지 (2005-03-09 편집)
	elseif($body=="login"){
	}
	else {
		if($mem!=1 && ($admin[grant_list] < $member[level])){
		error2("리스트 보기 권한이 없습니다.");
		}
	}
} //if($v=="eng") {}else{

##### 특별히 지정하지 않으면 리스트의 첫 페이지를 출력한다.
if(!$page) {
	$page = 1;
}
##### HTML 상단 페이지 파일을 불러온다.
require_once("winko/system/html_header.php");

##### 지정한 페이지의 목록을 출력하는 파일을 불러온다.
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

##### HTML 하단 페이지 파일을 불러온다.
require_once("winko/system/html_footer.php");
?>
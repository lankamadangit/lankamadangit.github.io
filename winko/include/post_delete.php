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
}  else {
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

##### 삭제하고자 하는 글이 답변글을 하나라도 달고 있으면 삭제할 수 없도록 한다.
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

##### 디렉토리에서 삭제할 파일명을 가지고 온다.
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

##### 관리자로 인증된 경우 모든 글을 삭제할 수 있다.
if($MEMBER_ID&&($admin[grant_admin] >= $member[level] || $mem == 1 || $ismember == $member[no])) {

	##### 디렉토리에서 선택한 레코드의 파일을 삭제한다.
	if($filename){ 
		if(!@unlink($file)) {
			echo "<script> window.alert('첫번째 파일이 삭제되지 않았습니다.')</script>";
		}
	}
	if($filename2){ 
		if(!@unlink($file2)) {
			echo "<script> window.alert('두번째 파일이 삭제되지 않았습니다.')</script>";
		}
	}

	##### 테이블에서 해당 파일의 레코드를 삭제한다.
	$query = "DELETE FROM {$top}_board_{$code} WHERE fid = $fid AND thread = '$thread'";
	$result = mysql_query($query);
	if (!$result) {
		error("QUERY_ERROR");
		exit;
	}

	##### 짧은글 parent 속한것 있으면 삭제
	$query2 = "DELETE FROM {$top}_short_{$code} WHERE parent = '$uid'";
	$result2 = mysql_query($query2);
	if (!$result2) {
		error("QUERY_ERROR");
		exit;
	}

	// 회원일 경우 점수 빼기
	if($MEMBER_ID) @mysql_query("update {$top}_member set point1=point1-1 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());
	echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&category=$category&page=$page&keyfield=$keyfield&key=$encoded_key'>");

} else {

	###### 해당게시물의 암호값을 뽑아낸다.
	$result = mysql_query("SELECT passwd FROM {$top}_board_{$code} WHERE fid = $fid AND thread = '$thread'");

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
		##### 디렉토리에서 선택한 레코드의 파일을 삭제한다.
		if($filename){ 
			if(!@unlink($file)) {
				echo "<script> window.alert('첫번째 파일이 삭제되지 않았습니다.')</script>";
			}
		}
		if($filename2){ 
			if(!@unlink($file2)) {
				echo "<script> window.alert('두번째 파일이 삭제되지 않았습니다.')</script>";
			}
		}

		###### ---------------------------------------------------######
		$query = "DELETE FROM {$top}_board_{$code} WHERE fid = $fid AND thread = '$thread'";
		$result = mysql_query($query);

		if (!$result) {
			error("QUERY_ERROR");
			exit;
		}

		// 회원일 경우 점수 빼기
		if($MEMBER_ID) @mysql_query("update {$top}_member set point1=point1-1 where mem_id='$MEMBER_ID'",$conn) or error(mysql_error());      

		##### 리스트 출력화면으로 이동한다.
		$encoded_key = urlencode($key);
		echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&v=$v&category=$category&page=$page&keyfield=$keyfield&key=$encoded_key'>");   
	} else {
		error("NO_ACCESS_DELETE");
		exit;
	}
}
?>

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
			$mem=1; break;
		}
		$mem=0;
	}
}
##### 글쓰기 허용 하지 않으면 빽 #####
if($mem!=1 && ($admin[grant_write] < $member[level])){
	error2("글수정 권한이 없습니다.");
}

##### 사용자가 아무값도 입력하지 않았거나 입력한 값이 허용되지 않는 값일 경우 에러메시지를 출력하고 스크립트를 종료한다.
if(!ereg("([^[:space:]]+)", $name) && !$MEMBER_ID) {
	error("NOT_ALLOWED_NAME");
	exit;
}

if(ereg("([^[:space:]]+)", $email) && (!ereg("(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$)", $email))) {
	error("NOT_ALLOWED_EMAIL");   
	exit;
}

if(!ereg("([^[:space:]]+)", $subject)) {
	error("NOT_ALLOWED_SUBJECT");
	exit;
}

if(!ereg("(^[0-9a-zA-Z]{4,}$)", $passwd) && !$MEMBER_ID) {
	error("NOT_ALLOWED_PASSWD");
	exit;
}

if(!ereg("([^[:space:]]+)", $comment)) {
	error("NOT_ALLOWED_COMMENT");
	exit;
}

##### 등록일 변경
if($C_year&&$C_month&&$C_day) {
	$signdate = mktime(23,15,23,$C_month,$C_day,$C_year);
} else {
	$signdate = $my_signdate;
}

##### 제목과 본문의 문자열에 포함된 특수문자를 escape시킨다.
if($admin[grant_admin] >= $member[level]) $subject=addslashes($subject);
else $subject=addslashes(del_html($subject));
$comment = addslashes($comment);

$add_a = addslashes($add_a);
$add_b = addslashes($add_b);

#### 홈페이지 주소의 경우 http:// 가 없으면 붙임
if((!eregi("http://",$homepage))&&$homepage) $homepage="http://".$homepage;

#### 링크 주소의 경우 http:// 가 없으면 붙임
//if((!eregi("http://",$sitelink))&&$sitelink) $sitelink="http://".$sitelink;

##### 디렉토리에서 삭제할 파일명을 가지고 온다.
$a = mysql_query("SELECT ismember,userfile,userfile2 FROM {$top}_board_{$code} WHERE uid = $number");

if(!$a) {
	error("QUERY_ERROR");
	exit;
}

$ismember = mysql_result($a,0,ismember);
$filename = mysql_result($a,0,userfile);
$filename=urldecode($filename);
$filename2 = mysql_result($a,0,userfile2);
$filename2=urldecode($filename2);
$file = "../data/".$code."/".$filename;
$file2 = "../data/".$code."/".$filename2;

##### 관리자로 인증된 경우 모든 글을 수정할 수 있다.
if($MEMBER_ID &&($admin[grant_admin] >= $member[level] || $mem == 1 || $ismember == $member[no])) {

	##### 업로드 one #######
	if($userfile && $userfile_size>0) { // 파일 첨부를 허용했을 경우
//		if($filename){ 
//			if(!@unlink($file)) {
//				error2("첫번째 파일이 삭제되지 않았습니다.");
//				exit;
//			}
//		}

		$upload = "../data/".$code;
		$userfile_name=str_replace(" ","_",$userfile_name);
		$userfile_name=str_replace("-","_",$userfile_name);

		if(file_exists("$upload/$userfile_name")) {
			//error2("동일한 이름의 파일이 존재합니다.");
			$userfile_name = time()."_".$userfile_name;
		}

		if($admin[upload_size1]<$userfile_size) error2(GetFileSize($admin[upload_size1])." 이상은 업로드 할 수 없습니다.");
		$file_name = substr( strrchr($userfile_name,"."),1);
		
		if($file_name==inc or $file_name==phtm or $file_name==htm or $file_name==shtm or $file_name==php3 or $file_name==html or $file_name==php or $file_name==asp or $file_name==pl or $file_name==cgi) {
			error2("Html, PHP 관련파일은 업로드할수 없습니다");
		} // 보안을 위해 확장자를 확인 하는 루틴

		$userfile_name_ecd=urlencode($userfile_name);    

		if(!is_dir($upload)) { // 파일을 저장할 디렉토리가 있는지 검사
			error2("디렉토리가 생성되지 않아 파일 업로드를 할 수 없습니다.");
		}

		copy($userfile, "$upload/$userfile_name");
		unlink($userfile);// 작업후 임시 디렉토리에 저장된 파일을 삭제한다.
		$n_filename = $userfile_name_ecd;
		$n_filesize = $userfile_size;
	}

	###### 업로드 two ######
	if($userfile2 && $userfile2_size>0) { // 파일 첨부를 허용했을 경우
//		if($filename2){ 
//			if(!@unlink($file2)) {
//				error2("두번째 파일이 삭제되지 않았습니다.");
//				exit;
//			}
//		}

		$upload = "../data/".$code;
		$userfile2_name=str_replace(" ","_",$userfile2_name);
		$userfile2_name=str_replace("-","_",$userfile2_name);

		if(file_exists("$upload/$userfile2_name")) {
			//error2("동일한 이름의 파일이 존재합니다.");
			$userfile2_name = time()."_".$userfile2_name;
		}
		if($admin[upload_size2]<$userfile2_size) error2(GetFileSize($admin[upload_size2])." 이상은 업로드 할 수 없습니다.");

		$file_name2 = substr( strrchr($userfile2_name,"."),1);

		if($file_name2==inc or $file_name2==phtm or $file_name2==htm or $file_name2==shtm or $file_name2==php3 or $file_name2==html or $file_name2==php or $file_name2==asp or $file_name2==pl or $file_name2==cgi) {
			error2("Html, PHP 관련파일은 업로드할수 없습니다");
		} // 보안을 위해 확장자를 확인 하는 루틴

		//한글파일 엔코드
		$userfile2_name_ecd=urlencode($userfile2_name);    

		if(!is_dir($upload)) { // 파일을 저장할 디렉토리가 있는지 검사
			error2("디렉토리가 생성되지 않아 파일 업로드를 할 수 없습니다.");
		}
		copy($userfile2, "$upload/$userfile2_name");
		unlink($userfile2);// 작업후 임시 디렉토리에 저장된 파일을 삭제한다.
		$n_filename2 = $userfile2_name_ecd;
		$n_filesize2 = $userfile2_size;
		$n_filetype2 = $userfile2_type;
	}
	
	##### 디렉토리에서 선택한 레코드의 파일을 삭제한다.
	if($filename && $filecheck1){ 
		if(!@unlink($file)) {
			error2("첫번째 파일이 삭제되지 않았습니다.");
			exit;
		}
	}

	if($filename2  && $filecheck2){ 
		if(!@unlink($file2)) {
			error2("두번째 파일이 삭제되지 않았습니다.");
			exit;
		}
	}

	if(($userfile && $userfile_size>0)&&($userfile2 && $userfile2_size>0)){
		$query = "UPDATE {$top}_board_{$code} SET subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '$n_filename', filesize = '$n_filesize', userfile2 = '$n_filename2', filesize2 = '$n_filesize2', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
	} elseif($userfile&&$userfile_size>0){
		if($filecheck2){
			$query = "UPDATE {$top}_board_{$code} SET subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '$n_filename', filesize = '$n_filesize', userfile2 = '', filesize2 = '', ok_html = '$ok_html', category = '$category', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
		} else {
			$query = "UPDATE {$top}_board_{$code} SET subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '$n_filename', filesize = '$n_filesize', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
		}
	} elseif($userfile2&&$userfile2_size>0){
		if($filecheck1){
			$query = "UPDATE {$top}_board_{$code} SET subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '', filesize = '', userfile2 = '$n_filename2', filesize2 = '$n_filesize2', ok_html = '$ok_html', category = '$category', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
		} else {
			$query = "UPDATE {$top}_board_{$code} SET subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile2 = '$n_filename2', filesize2 = '$n_filesize2', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
		}			
	} elseif($filecheck1 && $filecheck2){
		$query = "UPDATE {$top}_board_{$code} SET subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '', filesize = '', userfile2 = '', filesize2 = '', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";   
	} elseif($filecheck1){
		$query = "UPDATE {$top}_board_{$code} SET subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '', filesize = '', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";   
	} elseif($filecheck2){
		$query = "UPDATE {$top}_board_{$code} SET subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile2 = '', filesize2 = '', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";   
	} else{
		$query = "UPDATE {$top}_board_{$code} SET subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number"; 
	}

	$result = mysql_query($query);
	if (!$result) {
		error("QUERY_ERROR");
		exit;
	}
	echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&body=view&v=$v&category=$v_category&page=$page&number=$number&keyfield=$keyfield&key=$encoded_key'>");         
} 

else {

	##### 해당게시물의 암호값을 뽑아낸다.
	$result = mysql_query("SELECT passwd FROM {$top}_board_{$code} WHERE uid = $number");	

	if(!$result) {
		error("QUERY_ERROR");
		exit;
	}

	$real_pass = mysql_result($result,0,0);
	mysql_free_result($result);

	##### 사용자가 비밀번호란에 입력한 문자열을 crypt() 함수로 암호화한다.
	$user_pass = crypt($passwd,$real_pass);

	##### 게시물의 암호와 사용자가 입력한 암호가 같으면 게시물을 수정한다. 
	if (!strcmp($real_pass,$user_pass)) {

		##### 업로드 one #######
		if($userfile_size>0 && $userfile) { // 파일 첨부를 허용했을 경우
			if($filename){ 
				if(!@unlink($file)) {
					error2("첫번째 파일이 삭제되지 않았습니다.");
					echo "$file";
					exit;
				}
			}

			$upload = "../data/".$code;
			if(file_exists("$upload/$userfile_name")) {
				//error2("동일한 이름의 파일이 존재합니다.");
				$userfile_name = time()."_".$userfile_name;
			}

			if($admin[upload_size1]<$userfile_size) error2(GetFileSize($admin[upload_size1])." 이상은 업로드 할 수 없습니다.");

			$file_name = substr( strrchr($userfile_name,"."),1);

			if($file_name==php3 or $file_name==html or $file_name==php or $file_name==htm) {
				error2("확장자가 php3 php html htm인 화일은 올릴수 없습니다.");
			} // 보안을 위해 확장자를 확인 하는 루틴

			//한글파일 엔코드
			$userfile_name_ecd=urlencode($userfile_name);       
			if(!is_dir($upload)) { // 파일을 저장할 디렉토리가 있는지 검사
				error2("디렉토리가 생성되지 않아 파일 업로드를 할 수 없습니다.");
			}

			copy($userfile, "$upload/$userfile_name");
			unlink($userfile);// 작업후 임시 디렉토리에 저장된 파일을 삭제한다.
			$n_filename = $userfile_name_ecd;
			$n_filesize = $userfile_size;
		}

		###### 업로드 two ######
		if($userfile2 && $userfile2_size>0) { // 파일 첨부를 허용했을 경우
			if($filename2){ 
				if(!@unlink($file2)) {
					error2("두번째 파일이 삭제되지 않았습니다.");
					exit;
				}
			}

			$upload = "../data/".$code;
			if(file_exists("$upload/$userfile2_name")) {
				//error2("동일한 이름의 파일이 존재합니다.");
				$userfile2_name = time()."_".$userfile2_name;
			}
			if($setup[upload_size2]<$userfile2_size) error2(GetFileSize($admin[upload_size2])." 이상은 업로드 할 수 없습니다.");

			$file_name2 = substr( strrchr($userfile2_name,"."),1);

			if($file_name==inc or $file_name==phtm or $file_name==htm or $file_name==shtm or $file_name==php3 or $file_name==html or $file_name==php or $file_name==asp or $file_name==pl or $file_name==cgi) {
				error2("Html, PHP 관련파일은 업로드할수 없습니다");
			} // 보안을 위해 확장자를 확인 하는 루틴

			//한글파일 엔코드
			$userfile2_name_ecd=urlencode($userfile2_name);       
			if(!is_dir($upload)) { // 파일을 저장할 디렉토리가 있는지 검사
				error2("디렉토리가 생성되지 않아 파일 업로드를 할 수 없습니다.");
			}
			copy($userfile2, "$upload/$userfile2_name");
			unlink($userfile2);// 작업후 임시 디렉토리에 저장된 파일을 삭제한다.
			$n_filename2 = $userfile2_name_ecd;
			$n_filesize2 = $userfile2_size;
			$n_filetype2 = $userfile2_type;
		}
	
		##### 디렉토리에서 선택한 레코드의 파일을 삭제한다.
		if(!$userfile && $filename && $filecheck1){ 
			if(!@unlink($file)) {
				error2("첫번째 파일이 삭제되지 않았습니다.");
				echo "$file";
				exit;
			}
		}

		if(!$userfile2 && $filename2  && $filecheck2){ 
			if(!@unlink($file2)) {
				error2("두번째 파일이 삭제되지 않았습니다.");
				exit;
			}
		}

		if(($userfile_size>0)&&($userfile2_size>0)){
			$query = "UPDATE {$top}_board_{$code} SET name = '$name', subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '$n_filename', filesize = '$n_filesize', userfile2 = '$n_filename2', filesize2 = '$n_filesize2', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
		} elseif($userfile_size>0){
			if($filecheck2){
				$query = "UPDATE {$top}_board_{$code} SET name = '$name', subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '$n_filename', filesize = '$n_filesize', userfile2 = '', filesize2 = '', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
			} else {
				$query = "UPDATE {$top}_board_{$code} SET name = '$name', subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '$n_filename', filesize = '$n_filesize', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
			}
		} elseif($userfile2_size>0){
			if($filecheck1){
				$query = "UPDATE {$top}_board_{$code} SET name = '$name', subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '', filesize = '', userfile2 = '$n_filename2', filesize2 = '$n_filesize2', ok_html = '$ok_html', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
			} else {
				$query = "UPDATE {$top}_board_{$code} SET name = '$name', subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile2 = '$n_filename2', filesize2 = '$n_filesize2', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";
			}
		} elseif($filecheck1 && $filecheck2){
			$query = "UPDATE {$top}_board_{$code} SET name = '$name', subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '', filesize = '', userfile2 = '', filesize2 = '', ok_html = '$ok_html', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";   
		} elseif($filecheck1){
			$query = "UPDATE {$top}_board_{$code} SET name = '$name', subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile = '', filesize = '', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";   
		} elseif($filecheck2){
			$query = "UPDATE {$top}_board_{$code} SET name = '$name', subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', userfile2 = '', filesize2 = '', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number";   
		} else{
			$query = "UPDATE {$top}_board_{$code} SET name = '$name', subject = '$subject', email = '$email', homepage = '$homepage', comment = '$comment', sitelink = '$sitelink', notice = '$notice', ok_html = '$ok_html', ok_secret = '$ok_secret', category = '$category', signdate = '$signdate', add_a = '$add_a', add_b = '$add_b', add_c = '$add_c', add_d = '$add_d' WHERE uid  = $number"; 
		}

		$result = mysql_query($query);
		if (!$result) {
			error("QUERY_ERROR");
			exit;
	}

	##### 리스트 출력화면으로 이동한다.
	$encoded_key = urlencode($key);
		echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&body=view&v=$v&category=$v_category&page=$page&number=$number&keyfield=$keyfield&key=$encoded_key'>");   
	} else {
		error("NO_ACCESS_MODIFY");
		exit;
	}
} 
?>
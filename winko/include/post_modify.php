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
}  else {
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
##### �۾��� ��� ���� ������ �� #####
if($mem!=1 && ($admin[grant_write] < $member[level])){
	error2("�ۼ��� ������ �����ϴ�.");
}

##### ����ڰ� �ƹ����� �Է����� �ʾҰų� �Է��� ���� ������ �ʴ� ���� ��� �����޽����� ����ϰ� ��ũ��Ʈ�� �����Ѵ�.
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

##### ����� ����
if($C_year&&$C_month&&$C_day) {
	$signdate = mktime(23,15,23,$C_month,$C_day,$C_year);
} else {
	$signdate = $my_signdate;
}

##### ����� ������ ���ڿ��� ���Ե� Ư�����ڸ� escape��Ų��.
if($admin[grant_admin] >= $member[level]) $subject=addslashes($subject);
else $subject=addslashes(del_html($subject));
$comment = addslashes($comment);

$add_a = addslashes($add_a);
$add_b = addslashes($add_b);

#### Ȩ������ �ּ��� ��� http:// �� ������ ����
if((!eregi("http://",$homepage))&&$homepage) $homepage="http://".$homepage;

#### ��ũ �ּ��� ��� http:// �� ������ ����
//if((!eregi("http://",$sitelink))&&$sitelink) $sitelink="http://".$sitelink;

##### ���丮���� ������ ���ϸ��� ������ �´�.
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

##### �����ڷ� ������ ��� ��� ���� ������ �� �ִ�.
if($MEMBER_ID &&($admin[grant_admin] >= $member[level] || $mem == 1 || $ismember == $member[no])) {

	##### ���ε� one #######
	if($userfile && $userfile_size>0) { // ���� ÷�θ� ������� ���
//		if($filename){ 
//			if(!@unlink($file)) {
//				error2("ù��° ������ �������� �ʾҽ��ϴ�.");
//				exit;
//			}
//		}

		$upload = "../data/".$code;
		$userfile_name=str_replace(" ","_",$userfile_name);
		$userfile_name=str_replace("-","_",$userfile_name);

		if(file_exists("$upload/$userfile_name")) {
			//error2("������ �̸��� ������ �����մϴ�.");
			$userfile_name = time()."_".$userfile_name;
		}

		if($admin[upload_size1]<$userfile_size) error2(GetFileSize($admin[upload_size1])." �̻��� ���ε� �� �� �����ϴ�.");
		$file_name = substr( strrchr($userfile_name,"."),1);
		
		if($file_name==inc or $file_name==phtm or $file_name==htm or $file_name==shtm or $file_name==php3 or $file_name==html or $file_name==php or $file_name==asp or $file_name==pl or $file_name==cgi) {
			error2("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");
		} // ������ ���� Ȯ���ڸ� Ȯ�� �ϴ� ��ƾ

		$userfile_name_ecd=urlencode($userfile_name);    

		if(!is_dir($upload)) { // ������ ������ ���丮�� �ִ��� �˻�
			error2("���丮�� �������� �ʾ� ���� ���ε带 �� �� �����ϴ�.");
		}

		copy($userfile, "$upload/$userfile_name");
		unlink($userfile);// �۾��� �ӽ� ���丮�� ����� ������ �����Ѵ�.
		$n_filename = $userfile_name_ecd;
		$n_filesize = $userfile_size;
	}

	###### ���ε� two ######
	if($userfile2 && $userfile2_size>0) { // ���� ÷�θ� ������� ���
//		if($filename2){ 
//			if(!@unlink($file2)) {
//				error2("�ι�° ������ �������� �ʾҽ��ϴ�.");
//				exit;
//			}
//		}

		$upload = "../data/".$code;
		$userfile2_name=str_replace(" ","_",$userfile2_name);
		$userfile2_name=str_replace("-","_",$userfile2_name);

		if(file_exists("$upload/$userfile2_name")) {
			//error2("������ �̸��� ������ �����մϴ�.");
			$userfile2_name = time()."_".$userfile2_name;
		}
		if($admin[upload_size2]<$userfile2_size) error2(GetFileSize($admin[upload_size2])." �̻��� ���ε� �� �� �����ϴ�.");

		$file_name2 = substr( strrchr($userfile2_name,"."),1);

		if($file_name2==inc or $file_name2==phtm or $file_name2==htm or $file_name2==shtm or $file_name2==php3 or $file_name2==html or $file_name2==php or $file_name2==asp or $file_name2==pl or $file_name2==cgi) {
			error2("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");
		} // ������ ���� Ȯ���ڸ� Ȯ�� �ϴ� ��ƾ

		//�ѱ����� ���ڵ�
		$userfile2_name_ecd=urlencode($userfile2_name);    

		if(!is_dir($upload)) { // ������ ������ ���丮�� �ִ��� �˻�
			error2("���丮�� �������� �ʾ� ���� ���ε带 �� �� �����ϴ�.");
		}
		copy($userfile2, "$upload/$userfile2_name");
		unlink($userfile2);// �۾��� �ӽ� ���丮�� ����� ������ �����Ѵ�.
		$n_filename2 = $userfile2_name_ecd;
		$n_filesize2 = $userfile2_size;
		$n_filetype2 = $userfile2_type;
	}
	
	##### ���丮���� ������ ���ڵ��� ������ �����Ѵ�.
	if($filename && $filecheck1){ 
		if(!@unlink($file)) {
			error2("ù��° ������ �������� �ʾҽ��ϴ�.");
			exit;
		}
	}

	if($filename2  && $filecheck2){ 
		if(!@unlink($file2)) {
			error2("�ι�° ������ �������� �ʾҽ��ϴ�.");
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

	##### �ش�Խù��� ��ȣ���� �̾Ƴ���.
	$result = mysql_query("SELECT passwd FROM {$top}_board_{$code} WHERE uid = $number");	

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

		##### ���ε� one #######
		if($userfile_size>0 && $userfile) { // ���� ÷�θ� ������� ���
			if($filename){ 
				if(!@unlink($file)) {
					error2("ù��° ������ �������� �ʾҽ��ϴ�.");
					echo "$file";
					exit;
				}
			}

			$upload = "../data/".$code;
			if(file_exists("$upload/$userfile_name")) {
				//error2("������ �̸��� ������ �����մϴ�.");
				$userfile_name = time()."_".$userfile_name;
			}

			if($admin[upload_size1]<$userfile_size) error2(GetFileSize($admin[upload_size1])." �̻��� ���ε� �� �� �����ϴ�.");

			$file_name = substr( strrchr($userfile_name,"."),1);

			if($file_name==php3 or $file_name==html or $file_name==php or $file_name==htm) {
				error2("Ȯ���ڰ� php3 php html htm�� ȭ���� �ø��� �����ϴ�.");
			} // ������ ���� Ȯ���ڸ� Ȯ�� �ϴ� ��ƾ

			//�ѱ����� ���ڵ�
			$userfile_name_ecd=urlencode($userfile_name);       
			if(!is_dir($upload)) { // ������ ������ ���丮�� �ִ��� �˻�
				error2("���丮�� �������� �ʾ� ���� ���ε带 �� �� �����ϴ�.");
			}

			copy($userfile, "$upload/$userfile_name");
			unlink($userfile);// �۾��� �ӽ� ���丮�� ����� ������ �����Ѵ�.
			$n_filename = $userfile_name_ecd;
			$n_filesize = $userfile_size;
		}

		###### ���ε� two ######
		if($userfile2 && $userfile2_size>0) { // ���� ÷�θ� ������� ���
			if($filename2){ 
				if(!@unlink($file2)) {
					error2("�ι�° ������ �������� �ʾҽ��ϴ�.");
					exit;
				}
			}

			$upload = "../data/".$code;
			if(file_exists("$upload/$userfile2_name")) {
				//error2("������ �̸��� ������ �����մϴ�.");
				$userfile2_name = time()."_".$userfile2_name;
			}
			if($setup[upload_size2]<$userfile2_size) error2(GetFileSize($admin[upload_size2])." �̻��� ���ε� �� �� �����ϴ�.");

			$file_name2 = substr( strrchr($userfile2_name,"."),1);

			if($file_name==inc or $file_name==phtm or $file_name==htm or $file_name==shtm or $file_name==php3 or $file_name==html or $file_name==php or $file_name==asp or $file_name==pl or $file_name==cgi) {
				error2("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");
			} // ������ ���� Ȯ���ڸ� Ȯ�� �ϴ� ��ƾ

			//�ѱ����� ���ڵ�
			$userfile2_name_ecd=urlencode($userfile2_name);       
			if(!is_dir($upload)) { // ������ ������ ���丮�� �ִ��� �˻�
				error2("���丮�� �������� �ʾ� ���� ���ε带 �� �� �����ϴ�.");
			}
			copy($userfile2, "$upload/$userfile2_name");
			unlink($userfile2);// �۾��� �ӽ� ���丮�� ����� ������ �����Ѵ�.
			$n_filename2 = $userfile2_name_ecd;
			$n_filesize2 = $userfile2_size;
			$n_filetype2 = $userfile2_type;
		}
	
		##### ���丮���� ������ ���ڵ��� ������ �����Ѵ�.
		if(!$userfile && $filename && $filecheck1){ 
			if(!@unlink($file)) {
				error2("ù��° ������ �������� �ʾҽ��ϴ�.");
				echo "$file";
				exit;
			}
		}

		if(!$userfile2 && $filename2  && $filecheck2){ 
			if(!@unlink($file2)) {
				error2("�ι�° ������ �������� �ʾҽ��ϴ�.");
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

	##### ����Ʈ ���ȭ������ �̵��Ѵ�.
	$encoded_key = urlencode($key);
		echo("<meta http-equiv='Refresh' content='0; URL=../../winko.php?code=$code&body=view&v=$v&category=$v_category&page=$page&number=$number&keyfield=$keyfield&key=$encoded_key'>");   
	} else {
		error("NO_ACCESS_MODIFY");
		exit;
	}
} 
?>
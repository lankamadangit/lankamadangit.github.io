<?
##### ������ �Խù��� �Է°��� �̾Ƴ���.
$query = "SELECT name,ismember,subject,email,homepage,signdate,ref,comment,fid,ip,sitelink,userfile,filesize,userfile2,filesize2,ok_html,ok_secret,category,add_a,add_b,add_c,add_d,thread FROM {$top}_board_{$code} WHERE uid = $number";
$result = mysql_query($query);
if(!$result) {
	error("QUERY_ERROR");
	exit;
}
$row = mysql_fetch_row($result);

$my_name = $row[0];
$ismember = $row[1];
$my_subject = $row[2];
$my_email = $row[3];	
$my_homepage = $row[4];
$my_signdate = date("Y-m-d [H:i]",$row[5]);	
$my_signdate2 = date("Y.m.d (D) H:i",$row[5]);	
$my_ref = $row[6];
$my_comment = $row[7];
$my_fid = $row[8];
$my_ip = $row[9];
$my_sitelink = $row[10];
$my_userfile = $row[11];
$my_filesize = GetFileSize($row[12]);
$my_userfile2 = $row[13];
$my_filesize2 = GetFileSize($row[14]);
$my_ok_html = $row[15];
$my_ok_secret = $row[16];
$my_category = $row[17];
$my_add_a = $row[18];
$my_add_b = $row[19];
$my_add_c = $row[20];
$my_add_d = $row[21];
$my_thread = $row[22];

##### ��б� �б� ���� ������ �� #####
if($my_thread!="A") {
	$check_secret=mysql_fetch_array(mysql_query("select passwd, ok_secret from {$top}_board_{$code} where fid='$my_fid' and thread='A'",$conn));
	if($check_secret[ok_secret]==1) {
		$real_pass = $check_secret[passwd];
		
		##### ����ڰ� ��й�ȣ���� �Է��� ���ڿ��� crypt() �Լ��� ��ȣȭ�Ѵ�.
		$user_pass = crypt($passwd,$real_pass);

		if ((($member[level]!="1")&&($mem!=1)&&($ismember != $member[no])) && strcmp($real_pass,$user_pass)) {
			movepage("winko.php?code=$code&body=secret&page=$page&number=$number&category=$category&fid=$my_fid");      
		} 
	}
} elseif($my_ok_secret=="1") { 
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
	if ((($member[level]!="1")&&($mem!=1)&&($ismember != $member[no])) && strcmp($real_pass,$user_pass)) {
		movepage("winko.php?code=$code&body=secret&page=$page&number=$number&category=$category");      
	} 
}

##### ����� ������ ���Ͽ� ���̺� ������ ��(post.php) addslashes() �Լ��� escape��Ų ���ڿ��� ������� �ǵ��� ���´�.
$my_subject = stripslashes($my_subject);
$my_comment = stripslashes($my_comment);
$my_add_b = stripslashes($my_add_b);
$my_add_b = nl2br($my_add_b);

if(eregi("\.jpg",$my_userfile)||eregi("\.gif",$my_userfile)||eregi("\.png",$my_userfile)) {
	$my_userfile_ecd=urldecode($my_userfile);
	$photo1 = "winko/data/$code/$my_userfile_ecd";
	$s_photo1=GetImageSize($photo1);
	$w_photo1 = $s_photo1[0];
	$h_photo1 = $s_photo1[1];
	$real_file = "{$save_dir}/{$my_userfile}";
	if($w_photo1>550) $image1="<a href='#' onclick=\"window.open('winko/include/etc_img_view.php?file=$my_userfile_ecd&code=$code&w_photo=700&h_photo=500','img_win','left=0,top=0,width=$w_photo1,height=$h_photo1, resizable=yes, scrollbars=yes,status=no');\"><img src=\"winko/data/$code/$my_userfile\" width=550 border=0></a>";
	else	$image1="<img src=\"winko/data/$code/$my_userfile\" width=$w_photo1 height=$h_photo1 border=0>";
}

if(eregi("\.jpg",$my_userfile2)||eregi("\.gif",$my_userfile2)||eregi("\.png",$my_userfile2)) {
	$my_userfile2_ecd=urldecode($my_userfile2);
	$photo2 = "winko/data/$code/$my_userfile2_ecd";
	$s_photo2=GetImageSize($photo2);
	$w_photo2 = $s_photo2[0];
	$h_photo2 = $s_photo2[1];
	$real_file2 = "{$save_dir}/{$my_userfile2}";
	if($w_photo2>550) $image2="<a href='#' onclick=\"window.open('include/image_view.php?file=$real_file2','img_win','left=0,top=0,width=$w_photo2,height=$h_photo2, resizable=yes, scrollbars=no,status=no');\"><img src=\"winko/data/$code/$my_userfile2\" width=550 border=0></a>";
	if($w_photo1>700) $image1="<a href='winko/include/etc_img_view.php?file=$my_userfile_ecd&code=$code&w_photo=$w_photo1&h_photo=$h_photo1' target='_blank'><img src=\"winko/data/$code/$my_userfile_ecd\" width=550 border=0></a>";
	else	$image2="<img src=\"winko/data/$code/$my_userfile2\" width=$w_photo2 height=$h_photo2 border=0>";
}

#### ���� �ٿ�ε� ��ũ #####
if($my_userfile){ 
	$my_userfile_ecd=urldecode($my_userfile);	
	$real_file = "{$save_dir}/{$my_userfile}";
	$down_link = "<A href='winko/include/etc_down_hit.php?code=$code&v=$v&category=$category&page=$page&number=$number&keyfield=$keyfield&key=$encoded_key&file=$my_userfile'>";
	$down_img = $down_link."<img src='winko/system/winko_img/button_download.gif' width='92' height='19' border='0' align='absmiddle'></a>";
}

#### ���Ͼ����� �Ⱥ��̰�
if(!$my_userfile || $admin[ok_file1] != 1) { $hide_file1_start="<!--"; $hide_file1_end="-->"; }
if(!$my_userfile2 || $admin[ok_file2] != 1) { $hide_file2_start="<!--"; $hide_file2_end="-->"; }
if(!$my_ip) { $hide_ip_start="<!--"; $hide_ip_end="-->"; }
if(!$my_homepage || $my_homepage == "http://") { $hide_homepage_start="<!--"; $hide_homepage_end="-->"; }
if(!$my_sitelink || $my_sitelink == "http://" || $admin[ok_sitelink] != 1) { $hide_sitelink_start="<!--"; $hide_sitelink_end="-->"; }


##### �����̳� �����߿� ������ �˻�� ���ԵǾ� ���� ��� �˻��� ���ڿ��� red color ó���Ͽ� ����Ѵ�.
if(!strcmp($keyfield,"subject") && $key) {
	$my_subject = eregi_replace("($key)", "<font color=red>\\1</font>", $my_subject);
}

if(!strcmp($keyfield,"comment") && $key) { 
	$my_comment = eregi_replace("($key)","<font color=red>\\1</font>",$my_comment);
}

##### �±׻�� �Ұ��� ������ ��� �±׹��ڿ��� �״�� ����Ѵ�.
if($my_ok_html == 0) {
	//$my_comment = htmlspecialchars($my_comment);
	$my_comment=del_html($my_comment);
	$my_comment = eregi_replace(" ","&nbsp;",$my_comment);
	$my_comment = nl2br($my_comment);
}

$my_comment=autolink($my_comment); // �ڵ���ũ (URL MAIL)

##### ������ ���ڿ��� ����ó���Ѵ�.
//$my_comment = nl2br($my_comment);

##### ������ �Խù��� ��ȸ���� ������Ų��.
$result = mysql_query("UPDATE {$top}_board_{$code} SET ref = $my_ref + 1 WHERE uid = $number");
if(!$result) {
	error("QUERY_ERROR");
	exit;
}

##### ������ ��� (�亯, ����, ����) ######

if((($mem==1) || ($admin[grant_reply] >= $member[level]))&&($admin[reply_indent]!="0")){
	$reply_icon="<A HREF=\"winko.php?code=$code&v=$v&body=reply&category=$category&page=$page&number=$number\"><img src=\"{$skin_folder}/reply.gif\" border=0></A>";
}

/// �Խ��� ������ �Ǵ� ����/���� ��� ���� ���� ȸ�� �Ǵ� �۾� ���� ����,���� ������ ���
if(($mem==1) || ($admin[grant_delete] >= $member[level]) || ($ismember == $member[no]) || ($admin[grant_write] == 10)){

	$modify_icon="<A HREF=\"winko.php?code=$code&v=$v&body=modify&category=$category&page=$page&number=$number&number=$number&keyfield=$keyfield&key=$encoded_key\"><img src=\"{$skin_folder}/modify.gif\" border=0></A>";

	$delete_icon="<A HREF=\"winko.php?code=$code&v=$v&body=delete&category=$category&page=$page&number=$number&keyfield=$keyfield&key=$encoded_key\"><img src=\"{$skin_folder}/delete.gif\" border=0></A>";
}

if($admin[list_type]=="not"){
	$list_icon="<a href='winko.php?code=$code&v=$v&category=$category&page=$page&number=$number'><img src='{$skin_folder}/list.gif' border=0></a>";
}

##### view.php ��Ŭ���
include $skin_folder."/view.php";


$time_limit_s = 60*60*24*$admin[new_time];
// ȸ���α����� �Ǿ� ������ �ڸ�Ʈ ��й�ȣ�� �� ��Ÿ����;;
if($MEMBER_ID) {$c_name="<span style=\"background-color:$light;\">$member[name]</span>"; $hide_short_password_start="<!--"; $hide_short_password_end="-->"; }
else $c_name="<input type=text name=name size=8 maxlength=10 class=input>";

// ������ ����� ����Ÿ�� �������;;
if($admin[ok_short]==1&&$number)
$short_result=mysql_query("select * from {$top}_short_{$code} where parent='$number' order by uid asc");

if($admin[ok_short]==1) {
	$a=0;
	while($short=mysql_fetch_array($short_result)) {

		###################################ª���� ����ư(�߰� 2003/09/03)
		$date_diff = time() -  $short[signdate];

		if ($date_diff < $time_limit_s) {
			$short_new_icon=$skin_folder."/new.gif";
			$short_new_icon = "<img src=$short_new_icon border='0' align=absMiddle>";
		} else {
			$short_new_icon="";
		}

		###################################
		$short_name=stripslashes($short[name]);
		$short_ismember=$short[ismember];
		
		##### ȸ���̸� �̸��� ǥ��
		if($short_ismember != 0) {
			$short_name = "<img src='winko/system/winko_img/ismember.gif' width='10' height='11' border='0' align='absmiddle'><b>$short_name</b>";
		} else {
			$short_name = "<img src='winko/system/winko_img/nomember.gif' width='10' height='11' border='0' align='absmiddle'><b>$short_name</b>";
		}

		$short_comment=stripslashes($short[comment]);
		
		##### ������ ���ڿ��� ����ó���Ѵ�.
		$short_comment = nl2br($short_comment);

		##### ���� �˻��� �˻��� ǥ��
		if(!strcmp($keyfield,"short") && $key) { 
			$short_comment = eregi_replace("($key)","<font color=red>\\1</font>",$short_comment);
		}

		$short_signdate=date("Y-m-d H:i",$short[signdate]);
		if($short[ismember]) {
			if($short[ismember]==$MEMBER_ID||$member[level]<=$admin[grant_delete])
				$a_del="<a onfocus=blur() href='winko.php?code=$code&body=short_del&v=$v&category=$category&number=$number&c_uid=$short[uid]'>";
			else 
				$a_del="&nbsp;<gilssam ";
		}
		else $a_del="<a onfocus=blur() href='winko.php?code=$code&body=short_del&v=$v&category=$category&number=$number&c_uid=$short[uid]'>";


		if($is_admin) $show_ip=" title='$short[ip]' "; else $show_ip="";    

		if($c_data[ismember]) $comment_name="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?id=$id&member_no=$c_data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\" $show_ip>$comment_name</a>";
		else $comment_name="<div $show_ip>$comment_name</div>";

		$short_memo=stripslashes($short[memo]);

		##### view_foot.php ��Ŭ���
		include $skin_folder."/view_short.php";
		$a++;
	}

	if(($admin[ok_short]==1)&&( ($admin[grant_comment] >= $member[level]) )) {
		include $skin_folder."/view_write_short.php";
	}
}

##### view_foot.php ��Ŭ���
include $skin_folder."/view_foot.php";


##### �ڹٽ�ũ��Ʈ
//include $skin_folder."/script.php";

if(!strcmp($admin[list_type],"thread")) {

	##### ��ȸ�ϰ� �ִ� �Խù��� ������ �Խù��� ��ϸ� ����Ѵ�.
	include "winko/include/include_thread.php";
} 

if(!strcmp($admin[list_type],"list")) {

	##### ������ �������� ��ü ����� ����ϴ� ������ �ҷ��´�.
	if($admin[ok_visit]==1){
		include "winko/include/include_thread.php";
	} elseif($admin[ok_visit]==2){
		include "winko/include/include_gallery.php";
	} else{
		include "winko/include/include_list.php";
	}
}
?>

<?
##### 선택한 게시물의 입력값을 뽑아낸다.
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

##### 비밀글 읽기 권한 없으면 빽 #####
if($my_thread!="A") {
	$check_secret=mysql_fetch_array(mysql_query("select passwd, ok_secret from {$top}_board_{$code} where fid='$my_fid' and thread='A'",$conn));
	if($check_secret[ok_secret]==1) {
		$real_pass = $check_secret[passwd];
		
		##### 사용자가 비밀번호란에 입력한 문자열을 crypt() 함수로 암호화한다.
		$user_pass = crypt($passwd,$real_pass);

		if ((($member[level]!="1")&&($mem!=1)&&($ismember != $member[no])) && strcmp($real_pass,$user_pass)) {
			movepage("winko.php?code=$code&body=secret&page=$page&number=$number&category=$category&fid=$my_fid");      
		} 
	}
} elseif($my_ok_secret=="1") { 
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
	if ((($member[level]!="1")&&($mem!=1)&&($ismember != $member[no])) && strcmp($real_pass,$user_pass)) {
		movepage("winko.php?code=$code&body=secret&page=$page&number=$number&category=$category");      
	} 
}

##### 제목과 본문에 대하여 테이블에 저장할 때(post.php) addslashes() 함수로 escape시킨 문자열을 원래대로 되돌려 놓는다.
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

#### 파일 다운로드 링크 #####
if($my_userfile){ 
	$my_userfile_ecd=urldecode($my_userfile);	
	$real_file = "{$save_dir}/{$my_userfile}";
	$down_link = "<A href='winko/include/etc_down_hit.php?code=$code&v=$v&category=$category&page=$page&number=$number&keyfield=$keyfield&key=$encoded_key&file=$my_userfile'>";
	$down_img = $down_link."<img src='winko/system/winko_img/button_download.gif' width='92' height='19' border='0' align='absmiddle'></a>";
}

#### 파일없을때 안보이게
if(!$my_userfile || $admin[ok_file1] != 1) { $hide_file1_start="<!--"; $hide_file1_end="-->"; }
if(!$my_userfile2 || $admin[ok_file2] != 1) { $hide_file2_start="<!--"; $hide_file2_end="-->"; }
if(!$my_ip) { $hide_ip_start="<!--"; $hide_ip_end="-->"; }
if(!$my_homepage || $my_homepage == "http://") { $hide_homepage_start="<!--"; $hide_homepage_end="-->"; }
if(!$my_sitelink || $my_sitelink == "http://" || $admin[ok_sitelink] != 1) { $hide_sitelink_start="<!--"; $hide_sitelink_end="-->"; }


##### 제목이나 본문중에 지정한 검색어가 포함되어 있을 경우 검색된 문자열을 red color 처리하여 출력한다.
if(!strcmp($keyfield,"subject") && $key) {
	$my_subject = eregi_replace("($key)", "<font color=red>\\1</font>", $my_subject);
}

if(!strcmp($keyfield,"comment") && $key) { 
	$my_comment = eregi_replace("($key)","<font color=red>\\1</font>",$my_comment);
}

##### 태그사용 불가로 지정한 경우 태그문자열을 그대로 출력한다.
if($my_ok_html == 0) {
	//$my_comment = htmlspecialchars($my_comment);
	$my_comment=del_html($my_comment);
	$my_comment = eregi_replace(" ","&nbsp;",$my_comment);
	$my_comment = nl2br($my_comment);
}

$my_comment=autolink($my_comment); // 자동링크 (URL MAIL)

##### 본문의 문자열을 개행처리한다.
//$my_comment = nl2br($my_comment);

##### 선택한 게시물의 조회수를 증가시킨다.
$result = mysql_query("UPDATE {$top}_board_{$code} SET ref = $my_ref + 1 WHERE uid = $number");
if(!$result) {
	error("QUERY_ERROR");
	exit;
}

##### 아이콘 출력 (답변, 수정, 삭제) ######

if((($mem==1) || ($admin[grant_reply] >= $member[level]))&&($admin[reply_indent]!="0")){
	$reply_icon="<A HREF=\"winko.php?code=$code&v=$v&body=reply&category=$category&page=$page&number=$number\"><img src=\"{$skin_folder}/reply.gif\" border=0></A>";
}

/// 게시판 관리자 또는 수정/삭제 허용 레벨 값인 회원 또는 글쓴 본인 수정,삭제 아이콘 출력
if(($mem==1) || ($admin[grant_delete] >= $member[level]) || ($ismember == $member[no]) || ($admin[grant_write] == 10)){

	$modify_icon="<A HREF=\"winko.php?code=$code&v=$v&body=modify&category=$category&page=$page&number=$number&number=$number&keyfield=$keyfield&key=$encoded_key\"><img src=\"{$skin_folder}/modify.gif\" border=0></A>";

	$delete_icon="<A HREF=\"winko.php?code=$code&v=$v&body=delete&category=$category&page=$page&number=$number&keyfield=$keyfield&key=$encoded_key\"><img src=\"{$skin_folder}/delete.gif\" border=0></A>";
}

if($admin[list_type]=="not"){
	$list_icon="<a href='winko.php?code=$code&v=$v&category=$category&page=$page&number=$number'><img src='{$skin_folder}/list.gif' border=0></a>";
}

##### view.php 인클루드
include $skin_folder."/view.php";


$time_limit_s = 60*60*24*$admin[new_time];
// 회원로그인이 되어 있으면 코멘트 비밀번호를 안 나타나게;;
if($MEMBER_ID) {$c_name="<span style=\"background-color:$light;\">$member[name]</span>"; $hide_short_password_start="<!--"; $hide_short_password_end="-->"; }
else $c_name="<input type=text name=name size=8 maxlength=10 class=input>";

// 간단한 답글의 데이타를 가지고옴;;
if($admin[ok_short]==1&&$number)
$short_result=mysql_query("select * from {$top}_short_{$code} where parent='$number' order by uid asc");

if($admin[ok_short]==1) {
	$a=0;
	while($short=mysql_fetch_array($short_result)) {

		###################################짧은글 뉴버튼(추가 2003/09/03)
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
		
		##### 회원이면 이름에 표시
		if($short_ismember != 0) {
			$short_name = "<img src='winko/system/winko_img/ismember.gif' width='10' height='11' border='0' align='absmiddle'><b>$short_name</b>";
		} else {
			$short_name = "<img src='winko/system/winko_img/nomember.gif' width='10' height='11' border='0' align='absmiddle'><b>$short_name</b>";
		}

		$short_comment=stripslashes($short[comment]);
		
		##### 본문의 문자열을 개행처리한다.
		$short_comment = nl2br($short_comment);

		##### 본문 검색시 검색어 표시
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

		##### view_foot.php 인클루드
		include $skin_folder."/view_short.php";
		$a++;
	}

	if(($admin[ok_short]==1)&&( ($admin[grant_comment] >= $member[level]) )) {
		include $skin_folder."/view_write_short.php";
	}
}

##### view_foot.php 인클루드
include $skin_folder."/view_foot.php";


##### 자바스크립트
//include $skin_folder."/script.php";

if(!strcmp($admin[list_type],"thread")) {

	##### 조회하고 있는 게시물과 연관된 게시물의 목록만 출력한다.
	include "winko/include/include_thread.php";
} 

if(!strcmp($admin[list_type],"list")) {

	##### 지정한 페이지의 전체 목록을 출력하는 파일을 불러온다.
	if($admin[ok_visit]==1){
		include "winko/include/include_thread.php";
	} elseif($admin[ok_visit]==2){
		include "winko/include/include_gallery.php";
	} else{
		include "winko/include/include_list.php";
	}
}
?>

<?
$order_by = "signdate";
##### ���� �Խ��� ���̺� ��ϵǾ� �ִ� �� ���ڵ��� ������ ���Ѵ�. 
if($category){
if(!eregi("[^[:space:]]+",$key)) {
   $query = "SELECT count(*) FROM {$top}_board_{$code} WHERE category=$category";
} else {
   $encoded_key = urlencode($key);
   $query = "SELECT count(*) FROM {$top}_board_{$code} WHERE $keyfield LIKE '%$key%' and category=$category";  
}
}
else{
if(!eregi("[^[:space:]]+",$key)) {
   $query = "SELECT count(*) FROM {$top}_board_{$code}";
} else {
   $encoded_key = urlencode($key);
   $query = "SELECT count(*) FROM {$top}_board_{$code} WHERE $keyfield LIKE '%$key%'";  
}
}
$result = mysql_query($query);
if (!$result) {
   error("QUERY_ERROR");
   exit;
}
$total_record = mysql_result($result,0,0);
mysql_free_result($result);

##### ��ü ���������� ����Ѵ�.
$num_per_page = $admin[num_list];
$total_page = ceil($total_record/$num_per_page);

##### ������ �������� ���Ͽ� ����� ���ڵ��ȣ�� ������ �����Ѵ�.
if($total_record == 0) {
   $first = 1;
   $last = 0;
} else {
   $first = $num_per_page*($page-1);
   $last = $num_per_page*$page;
}

##### �ڹٽ�ũ��Ʈ
include $skin_folder."/script.php";
?>
<form method=post name=list action="winko.php">
<?if(eregi("[^[:space:]]+",$key)) {?>
<input type=hidden name=page value=<?=$page?>>
<?}?>
<input type=hidden name=code value=<?=$code?>>
<input type=hidden name=category value=<?=$category?>>
<input type=hidden name=v value=<?=$v?>>
<input type=hidden name=select_arrange value=headnum>
<input type=hidden name=desc value=asc>
<input type=hidden name=page_num value=15>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="">
<input type=hidden name=sn value="off">
<input type=hidden name=ss value="on">
<input type=hidden name=sc value="on">

<?
###### �ѰԽù� ######
if(!eregi("[^[:space:]]+",$key)) {
   $setup_left = "<font class=Arial8>Total <font color=blue>$total_record</font> article, Page <font color=#ff3300>$page</font>/$total_page</font>";   
} 
else {
   $setup_left = "<font class=Arial8>Search : <b>$total_record</b> (Total <b>$total_record</b> Articles)</font>";
} 

####### login ������ ###########
if($MEMBER_ID){
$login_icon = "<a href='winko/include/post_logout.php?code=$code&v=$v&body=logout&category=$category'><font color=#ff3300 class=thm8>LOGOUT</font></a>";
}
else{
$login_icon = "<a href='winko.php?code=$code&body=login&v=$v&category=$category'><font class=thm8>LOGIN</font></a>&nbsp;&nbsp;";
}
####### ������ ��� ������ ###########
//if(($mem==1) || ($member[level]==1)){
if($member[level]==1){
$admin_mode = "&nbsp;&nbsp;&nbsp;<a href='admin.php'><font class=thm8>ADMIN</font></a>&nbsp;&nbsp;";
}
else{
$admin_mode = "";
$hide_select_start="<!--"; $hide_select_end="-->";
}
include $skin_folder."/setup.php";
//include $skin_folder."/view_list_head.php";
echo "<table cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"{$table_width}\">";
?>
<?
$time_limit = 60*60*24*$admin[new_time];

#####################################################################################
if($category) {
	$notice_query = "SELECT uid,fid,name,email,subject,comment,signdate,ref,thread,notice,userfile,filesize,ok_secret,sitelink,add_a,add_b FROM {$top}_board_{$code} where notice=1 and category=$category order by $order_by DESC";
}
else {
	$notice_query = "SELECT uid,fid,name,email,subject,comment,signdate,ref,thread,notice,userfile,filesize,ok_secret,sitelink,add_a,add_b FROM {$top}_board_{$code} where notice=1 order by $order_by DESC";
}
$notice_result = mysql_query($notice_query);
$notice_num = mysql_num_rows($notice_result);
for( $i=0; $i < $notice_num; $i++ ) {
   ##### �� �Խù� ���ڵ��� �ʵ尪�� ������ �����Ѵ�.   
   $my_uid = mysql_result($notice_result,$i,uid); 
   $my_fid = mysql_result($notice_result,$i,fid); 
   $my_name = mysql_result($notice_result,$i,name); 
   $my_email = mysql_result($notice_result,$i,email); 
   $my_subject = mysql_result($notice_result,$i,subject); 
   $my_comment = mysql_result($notice_result,$i,comment); 
   $my_signdate00 = mysql_result($notice_result,$i,signdate); 
   $my_signdate = date("m-d",$my_signdate00);
   $my_signdate2 = date("Y-m-d",$my_signdate00);
   $my_ref = mysql_result($notice_result,$i,ref); 
   $my_thread = mysql_result($notice_result,$i,thread); 
   $my_notice = mysql_result($notice_result,$i,notice); 
   $filesize = mysql_result($notice_result,$i,filesize); 
   $my_secret = mysql_result($notice_result,$i,ok_secret); 
   $my_sitelink = mysql_result($notice_result,$i,sitelink); 
   $my_add_a = mysql_result($notice_result,$i,add_a); 
   $my_add_b = mysql_result($notice_result,$i,add_b); 

   ##### ª���� ����
   $total_short=mysql_fetch_array(mysql_query("select count(*) from {$top}_short_{$code} where parent='$my_uid'"));
   $total_short=$total_short[0];
   if($total_short==0) $total_short="";
   else $total_short = "<font color=FF6633 class=thm8>$total_short</font>";

   ##### ����� ������ ���Ͽ� ���̺� ������ ��(post.php) addslashes() �Լ��� escape��Ų ���ڿ��� ������� �ǵ��� ���´�.   
   $my_subject = stripslashes($my_subject);
   $my_comment = stripslashes($my_comment);
   $my_comment = nl2br($my_comment);
   ##### ���� ������
   $my_filesize = (int)($filesize/1000);
   ##### ������ �ܰ迡 ���� ����� ������ ���ڿ��� �������� indent�� ��Ų��.
   $spacer = strlen($my_thread)-1;

   ##### ���ۿ� ���� �亯���� $reply_indent �� �̻��� �Ǹ� �亯���� ��� indent�� ������Ų��.
   if($spacer > $reply_indent) $spacer = $reply_indent;
     
   ##### �Խù��� �ۼ��ð����κ��� �Խù��� �ֱٿ� �ۼ��� �������� �Ǻ�, �׿� ���� �ٸ� ������ �̹����� ����Ѵ�.
   if ($number == $my_uid) {$head_icon=$skin_folder."/reading.gif";} 
   elseif($my_secret=="1") {$head_icon=$skin_folder."/secret.gif";}
   else {$head_icon=$skin_folder."/main.gif";}
   $article_num = "notice";
   ###### new ��ư ��� ########
   $date_diff = time() -  $row[signdate];
   if ($date_diff < $time_limit) {
     $new_icon=$skin_folder."/new.gif";
	 $new_icon = "<img src=$new_icon border='0' align=absMiddle>";
   }
   else {
     $new_icon="";
   }
   ##### ��Ģ�� ���񿡴� HTML �±׸� ������� �ʴ´�.
   $my_subject = htmlspecialchars($my_subject);
   $my_subject=STR_CUTTING($my_subject,$admin[cut_length],"..."); // ���� �ڸ��� �κ�

   ##### �˻��ÿ��� �˻�� ���������� ����Ѵ�.
   if(!strcmp($keyfield,"subject") && $key) {
      $my_subject = eregi_replace("($key)", "<font color=red>\\1</font>", $my_subject);
   }
   elseif(!strcmp($keyfield,"comment") && $key) {
      $my_comment = eregi_replace("($key)", "<font color=red>\\1</font>", $my_comment);
   }

   ##### ������ �� ���μ��� ����Ѵ�.
   $line = explode("\n",$my_comment);
   $line_of_comment = sizeof($line);

   ##### [�÷� 3 : �۾����� �̸����ּҸ� ����Ѵ�.]
   if ($my_email) {
      $my_name = "<a href=mailto:$my_email>$my_name</a>";
   } 
   ##### ȸ���̸� �̸��� ǥ��
   //$my_name = "<span style=\"font-size:12pt;\"><font color=ff3300><b>*</b></font></span>$my_name";

   ##### [�÷� 6 : ���ε�� ���Ͽ� ���� ��ũ�� ����Ѵ�.]   
   $query_string = "path=" . urlencode($save_dir) . "&filename=" . urlencode($my_filename);
   
########################################
   
if($my_filename){   
   if(eregi("\.jpg",$my_filename)||eregi("\.gif",$my_filename)||eregi("\.png",$my_filename)) {
   $my_filename=urldecode($my_filename);
   $real_file = "{$save_dir}/{$my_filename}";
   $size=GetImageSize($real_file);
   $w_photo = $size[0];
   $h_photo = $size[1];
   
   $file_icon = "&nbsp;&nbsp;<a href='#' onclick=\"window.open('winko/include/etc_img_view.php?file=$real_file','img_win','left=0,top=0,width=$w_photo,height=$h_photo, resizable=yes, scrollbar=no,status=no');\"><img src={$skin_folder}/img.gif border=0 align=absmiddle></a>";
   }
  
   else{
     $file_icon = "&nbsp;&nbsp;<a href={$save_dir}/{$my_filename}><img src={$skin_folder}/file.gif border=0></a>";
   }
}

else{
 $file_icon = "";
}
   $my_subject = $my_subject.$file_icon;

   ##### view_list_main ��Ŭ���(�������� �ٸ���) 2003/09/03
   include $skin_folder."/view_list_notice.php";      


}
#####################################################################################
#####################################################################################

##### ���� �������� ����� ������ڵ� ��Ʈ�� ��´�.
if($category) {
if(!eregi("[^[:space:]]+",$key)) {
   $query = "SELECT uid,fid,ismember,name,email,subject,comment,signdate,ref,thread,notice,userfile,filesize,ok_secret,category,sitelink,add_a,add_b FROM {$top}_board_{$code} WHERE notice=0 and category=$category ORDER BY $order_by DESC, thread ASC LIMIT $first, $num_per_page ";
} 
else {
   $query = "SELECT uid,fid,ismember,name,email,subject,comment,signdate,ref,thread,notice,userfile,filesize,ok_secret,category,sitelink,add_a,add_b FROM {$top}_board_{$code} WHERE notice=0 and $keyfield LIKE '%$key%' and category=$category ORDER BY $order_by DESC, thread ASC LIMIT $first, $num_per_page";
}
}
else{
if(!eregi("[^[:space:]]+",$key)) {
   $query = "SELECT uid,fid,ismember,name,email,subject,comment,signdate,ref,thread,notice,userfile,filesize,ok_secret,category,sitelink,add_a,add_b FROM {$top}_board_{$code} WHERE notice=0 ORDER BY $order_by DESC, thread ASC LIMIT $first, $num_per_page ";
} 
else {
   $query = "SELECT uid,fid,ismember,name,email,subject,comment,signdate,ref,thread,notice,userfile,filesize,ok_secret,category,sitelink,add_a,add_b FROM {$top}_board_{$code} WHERE notice=0 and $keyfield LIKE '%$key%' ORDER BY $order_by DESC, thread ASC LIMIT $first, $num_per_page";
}
}
$result= mysql_query($query);
if (!$result) {
   error("QUERY_ERROR");
   exit;
}

#### ���Ͼ����� �Ⱥ��̰�
if($admin[ok_add_a] != 1) { $hide_add_a_start="<!--"; $hide_add_a_end="-->"; }

##### �Խù��� �����ȣ(�Խù��� ������ ���� �Ϸù�ȣ)
$article_num = $total_record - $num_per_page*($page-1);

while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {

   ##### �� �Խù� ���ڵ��� �ʵ尪�� ������ �����Ѵ�.   
   $my_uid = $row[uid];
   $my_fid = $row[fid];
   $my_ismember = $row[ismember];
   $my_name = $row[name];
   $my_email = $row[email];
   $my_subject = $row[subject];
   $my_comment = $row[comment];
   $my_signdate = date("m-d",$row[signdate]);
   $my_signdate2 = date("Y-m-d",$row[signdate]);
   $my_ref = $row[ref];
   $my_thread = $row[thread];
   $my_notice = $row[notice];
   $my_filename = $row[userfile];
   $filesize = $row[filesize];
   $my_secret = $row[ok_secret];
   $my_category = $row[category];
   $my_sitelink = $row[sitelink];
   $my_add_a = $row[add_a];
   $my_add_b = $row[add_b];

##### ����� ������ ���Ͽ� ���̺� ������ ��(post.php) addslashes() �Լ��� escape��Ų ���ڿ��� ������� �ǵ��� ���´�.
	//$my_add_a = stripslashes($my_add_a);
	//$my_add_b = stripslashes($my_add_b);
	//$my_add_a = nl2br($my_add_a);
   
   ##### ȸ���̸� �̸��� ǥ��
   //if($my_ismember != 0) {$my_name = "<span style=\"font-size:12pt;\"><font color=#ff3300><b>*</b></font></span>$my_name";}
   //else {$my_name = "$my_name";}


   ##### ª���� ����
   $total_short=mysql_fetch_array(mysql_query("select count(*) from {$top}_short_{$code} where parent='$my_uid'"));
   $total_short=$total_short[0];
   if($total_short==0) $total_short="";
   else $total_short = "&nbsp;<font color=FF6633 class=thm8>$total_short</font>";   

   ##### ����� ������ ���Ͽ� ���̺� ������ ��(post.php) addslashes() �Լ��� escape��Ų ���ڿ��� ������� �ǵ��� ���´�.   
   $my_subject = stripslashes($my_subject);
   $my_comment = stripslashes($my_comment);
   $my_comment = nl2br($my_comment);
   ##### ���� ������
   $my_filesize = (int)($filesize/1000);
   ##### ������ �ܰ迡 ���� ����� ������ ���ڿ��� �������� indent�� ��Ų��.
   $spacer = strlen($my_thread)-1;

   ##### ���ۿ� ���� �亯���� $reply_indent �� �̻��� �Ǹ� �亯���� ��� indent�� ������Ų��.
   if($admin[reply_indent] != "0") {
	  if($spacer > $admin[reply_indent]) $spacer = $admin[reply_indent];
   }
     
   ##### �Խù��� �ۼ��ð����κ��� �Խù��� �ֱٿ� �ۼ��� �������� �Ǻ�, �׿� ���� �ٸ� ������ �̹����� ����Ѵ�.
   if ($number == $my_uid) {
      $head_icon=$skin_folder."/reading.gif";
   } 
   elseif($my_secret=="1") {$head_icon=$skin_folder."/secret.gif";}
   else {
         if(!strcmp($my_thread,"A")) {
            $head_icon=$skin_folder."/main.gif";
         } else {
            $head_icon=$skin_folder."/thread.gif";
         }
   }
   
   ###### new ��ư ��� ########
   $date_diff = time() -  $row[signdate];
   if (($admin[new_time]!="0")&&($date_diff < $time_limit)) {
     $new_icon=$skin_folder."/new.gif";
	 $new_icon = "&nbsp;<img src=$new_icon border='0' align=absMiddle>";
   }
   else {
     $new_icon="";
   }
   ##### ��Ģ�� ���񿡴� HTML �±׸� ������� �ʴ´�.
   //$my_subject = htmlspecialchars($my_subject);
   $my_subject=STR_CUTTING($my_subject,$admin[cut_length],"..."); // ���� �ڸ��� �κ�

   ##### ������ �˻��ÿ��� �˻�� ���������� ����Ѵ�.
   if(!strcmp($keyfield,"subject") && $key) {
      $my_subject = eregi_replace("($key)", "<font color=red>\\1</font>", $my_subject);
   }
   elseif(!strcmp($keyfield,"comment") && $key) {
      $my_comment = eregi_replace("($key)", "<font color=red>\\1</font>", $my_comment);
   }

   ##### ������ �� ���μ��� ����Ѵ�.
   $line = explode("\n",$my_comment);
   $line_of_comment = sizeof($line);

   ##### [�÷� 3 : �۾����� �̸����ּҸ� ����Ѵ�.]
   if ($my_email) {
      $my_name = "<a href=mailto:$my_email>$my_name</a>";
   } 
   ##### [�÷� 6 : ���ε�� ���Ͽ� ���� ��ũ�� ����Ѵ�.]   
   $query_string = "path=" . urlencode($save_dir) . "&filename=" . urlencode($my_filename);
   
########################################
   
if($my_filename){   
   if(eregi("\.jpg",$my_filename)||eregi("\.gif",$my_filename)||eregi("\.png",$my_filename)) {
   $my_filename_ecd=urldecode($my_filename);
   $real_file = "{$save_dir}/{$my_filename}";
   $real_file_ecd = "{$save_dir}/{$my_filename_ecd}";
   $size=GetImageSize($real_file_ecd);
   $w_photo = $size[0];
   $h_photo = $size[1];
   
   $file_icon = "&nbsp;<a href='#' onclick=\"window.open('winko/include/etc_img_view.php?file=$my_filename&code=$code&w_photo=$w_photo&h_photo=$h_photo','img_win','left=0,top=0,width=$w_photo,height=$h_photo, resizable=yes, scrollbar=no,status=no');\"><img src={$skin_folder}/img.gif border=0 width=16 height=16 align=absmiddle></a>";
   }
   elseif(eregi("\.zip",$my_filename)) {
   $real_file = "{$save_dir}/{$my_filename}";
   $file_icon = "&nbsp;<A href='winko/include/etc_down_hit.php?code=$code&v=$v&category=$category&page=$page&number=$my_uid&keyfield=$keyfield&key=$encoded_key&file=$my_filename'><img src='winko/system/winko_img/zip.gif' width=17 height=17 border=0></a>";
   }
   elseif(eregi("\.pdf",$my_filename)) {
   $real_file = "{$save_dir}/{$my_filename}";
   $file_icon = "&nbsp;<A href='winko/include/etc_down_hit.php?code=$code&v=$v&category=$category&page=$page&number=$my_uid&keyfield=$keyfield&key=$encoded_key&file=$my_filename'><img src='winko/system/winko_img/pdf.gif' width=16 height=16 border=0></a>";
   }
   elseif(eregi("\.hwp",$my_filename)) {
   $real_file = "{$save_dir}/{$my_filename}";
   $file_icon = "&nbsp;<A href='winko/include/etc_down_hit.php?code=$code&v=$v&category=$category&page=$page&number=$my_uid&keyfield=$keyfield&key=$encoded_key&file=$my_filename'><img src='winko/system/winko_img/hwp.gif' width=13 height=14 border=0></a>";
   }
   elseif(eregi("\.doc",$my_filename)) {
   $real_file = "{$save_dir}/{$my_filename}";
   $file_icon = "&nbsp;<A href='winko/include/etc_down_hit.php?code=$code&v=$v&category=$category&page=$page&number=$my_uid&keyfield=$keyfield&key=$encoded_key&file=$my_filename'><img src='winko/system/winko_img/doc.gif' width=16 height=16 border=0></a>";
   }
   elseif(eregi("\.ppt",$my_filename)) {
   $real_file = "{$save_dir}/{$my_filename}";
   $file_icon = "&nbsp;<A href='winko/include/etc_down_hit.php?code=$code&v=$v&category=$category&page=$page&number=$my_uid&keyfield=$keyfield&key=$encoded_key&file=$my_filename'><img src='winko/system/winko_img/ppt.gif' width=16 height=16 border=0></a>";
   }
   elseif(eregi("\.xls",$my_filename)) {
   $real_file = "{$save_dir}/{$my_filename}";
   $file_icon = "&nbsp;<A href='winko/include/etc_down_hit.php?code=$code&v=$v&category=$category&page=$page&number=$my_uid&keyfield=$keyfield&key=$encoded_key&file=$my_filename'><img src='winko/system/winko_img/xls.gif' width=16 height=16 border=0></a>";
   }
  
   else{
     $real_file = "{$save_dir}/{$my_filename}";
     $file_icon = "&nbsp;<A href='winko/include/etc_down_hit.php?code=$code&v=$v&category=$category&page=$page&number=$my_uid&keyfield=$keyfield&key=$encoded_key&file=$my_filename'><img src={$skin_folder}/file.gif width=16 height=16 border=0></a>";
   }
}

else{
 $file_icon = "";
}

##### ������ ��� (����, ����) ######

/// �Խ��� ������ �Ǵ� ����/���� ��� ���� ���� ȸ�� �Ǵ� �۾� ���� ����,���� ������ ���
//if(($mem==1) || ($admin[grant_delete] >= $member[level]) || ($ismember == $member[no]) || ($admin[grant_write] == 10)){
if($member[level]==1){

$modify_icon="<A HREF=\"winko.php?code=$code&v=$v&body=modify&category=$category&page=$page&number=$my_uid&keyfield=$keyfield&key=$encoded_key\"><img src=\"{$skin_folder}/modify.gif\" border=0></A>";

$delete_icon="<A HREF=\"winko.php?code=$code&v=$v&body=delete&category=$category&page=$page&number=$my_uid&keyfield=$keyfield&key=$encoded_key\"><img src=\"{$skin_folder}/delete.gif\" border=0></A>";
}

if($admin[list_type]=="not"){
$list_icon="<a href='winko.php?code=$code&v=$v&category=$category&page=$page&number=$number'><img src='{$skin_folder}/list.gif' border=0></a>";
}   
   ##### view_list_main ��Ŭ���
   include $skin_folder."/view_list_thread.php";      

   $article_num--;
}

echo"</table>";
?>


<?
##### �Խù� ��� �ϴ��� �� �������� ���� �̵��� �� �ִ� ������ ��ũ�� ���� ������ �Ѵ�.
$total_block = ceil($total_page/$page_per_block);
$block = ceil($page/$page_per_block);

$first_page = ($block-1)*$page_per_block;
$last_page = $block*$page_per_block;

if($total_block <= $block) {
   $last_page = $total_page;
}

// ���б� ȭ�鿡���� ��� ��ư ���
if($number){
$list_icon="<a href='winko.php?code=$code&v=$v&category=$category'><img src='{$skin_folder}/list.gif' border=0 hspace=3></a>";
}
// �Խ��� ������ �Ǵ� �۾��� ��� ���� �̻��̸� �۾��� ��ư ���
if(($mem==1) || ($admin[grant_write] >= $member[level])){
$write_icon="<a href='winko.php?code=$code&body=write&v=$v&category=$category'><img src='{$skin_folder}/write.gif' border=0 hspace=3></a>";
}
//���õ� �� ����/����/�̵�
//if(($mem==1) || ($member[level]==1)){
if($member[level]==1){
$select_icon="<a onfocus=blur() href='javascript:select()'><img src='{$skin_folder}/select.gif' hspace=3 border=0></a>";
}
?>

<table width="<?=$table_width?>" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
   <td align=center>
<?
##### ������������Ͽ� ���� ������ ��ũ
if($block > 1) {
   $my_page = $first_page;
   echo("<a href=\"winko.php?code=$code&v=$v&category=$category&page=$my_page&keyfield=$keyfield&key=$encoded_key\"><font class=thm8>[prev ${page_per_block}]</font></a>&nbsp;");
}

##### ������ ������ ��Ϲ��������� �� �������� �ٷ� �̵��� �� �ִ� �����۸�ũ�� ����Ѵ�.
for($direct_page = $first_page+1; $direct_page <= $last_page; $direct_page++) {
   if($page == $direct_page) {
      echo("<font color=#ff3300><b>$direct_page</b></font>&nbsp;");
   } else {
      echo("<a href=\"winko.php?code=$code&v=$v&category=$category&page=$direct_page&keyfield=$keyfield&key=$encoded_key\">[$direct_page]</a>&nbsp;");
   }
}

##### ������������Ͽ� ���� ������ ��ũ
if($block < $total_block) {
   $my_page = $last_page+1;
   echo("<a href=\"winko.php?code=$code&v=$v&category=$category&page=$my_page&keyfield=$keyfield&key=$encoded_key\"><font class=thm8>[next ${page_per_block}]</font></a>");
}
?>
   </td>
</tr>
<tr>
<tr><td colspan='3' align=center>
<?
##### view_list_main ��Ŭ���
include $skin_folder."/view_list_search.php";      
?>
</td>
</tr>
</form>
</table>

<?
// ȸ���϶��� �⺻ �Է»��� �Ⱥ��̰�;;
if($MEMBER_PART=="member") { $hide_start="<!--"; $hide_end="-->"; }

##### �ڹٽ�ũ��Ʈ
include $skin_folder."/script.php";

##### �����ϰ��� �ϴ� ���� ������ ������ ������ ������ �����Ѵ�.
$query = "SELECT name,subject,email,homepage,comment,sitelink,notice,userfile,filesize,userfile2,filesize2,ok_html,ok_secret,category,signdate,add_a,add_b,add_c,add_d FROM {$top}_board_{$code} WHERE uid = $number";
$result = mysql_query($query);
if(!$result) {
	error("QUERY_ERROR");
	exit;
}

$row = mysql_fetch_object($result);

$check[1]="checked";

$my_name = $row->name;
$my_subject = $row->subject;
$my_email = $row->email;
$my_homepage = $row->homepage;
$my_comment = $row->comment;
$my_sitelink = $row->sitelink;
$my_notice = $row->notice;
$my_userfile = $row->userfile;
$my_userfile=urldecode($my_userfile);
$my_filesize = $row->filesize;
$my_userfile2 = $row->userfile2;
$my_userfile2=urldecode($my_userfile2);
$my_filesize2 = $row->filesize2;
$my_ok_html = $row->ok_html;
$my_ok_secret = $row->ok_secret;
$my_category = $row->category;
$my_signdate = $row->signdate;
$my_add_a = $row->add_a;
$my_add_b = $row->add_b;
$my_add_c = $row->add_c;
$my_add_d = $row->add_d;

##### ����� ������ ���Ͽ� ���̺� ������ ��(post.php) addslashes() �Լ��� escape��Ų ���ڿ��� ������� �ǵ��� ���´�.
$my_subject = stripslashes($my_subject);
$my_comment = stripslashes($my_comment);
$my_comment = eregi_replace("&nbsp;","&#38;&#110;&#98;&#115;&#112;&#59;",$my_comment);
$my_add_a = stripslashes($my_add_a);

##### �˻����ڿ��� ���ڵ��Ѵ�.
$encoded_key = urlencode($key);

#### ���Ͼ����� �Ⱥ��̰�
if(!$my_userfile) { $hide_file1_start="<!--"; $hide_file1_end="-->"; }
if(!$my_userfile2) { $hide_file2_start="<!--"; $hide_file2_end="-->"; }
if($admin[ok_add_a] != 1) { $hide_add_a_start="<!--"; $hide_add_a_end="-->"; }
if($admin[ok_add_b] != 1) { $hide_add_b_start="<!--"; $hide_add_b_end="-->"; }
if($admin[ok_sitelink] != 1) { $hide_sitelink_start="<!--"; $hide_sitelink_end="-->"; }
if((($mem!=1)&&($admin[grant_notice] < $member[level]))||($admin[ok_notice] != 1)) {$hide_notice_start="<!--"; $hide_notice_end="-->"; }
if($admin[ok_secret] != 1) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }
if($admin[ok_file1] != 1) { $hide_ok_file1_start="<!--"; $hide_ok_file1_end="-->"; }
if($admin[ok_file2] != 1) { $hide_ok_file2_start="<!--"; $hide_ok_file2_end="-->"; }
if($admin[ok_category] != 1) { $hide_category_start="<!--"; $hide_category_end="-->"; }
if($admin[ok_html] != 1) { $hide_html_start="<!--"; $hide_html_end="-->"; }
if($my_ok_html==1) $ok_html=" checked ";

#### ���� ���ε� �뷮 ����
$upload_size1 = GetFileSize($admin[upload_size1]);
$upload_size2 = GetFileSize($admin[upload_size2]);
?>

<form name="writeform" method="post" ENCTYPE="multipart/form-data"  action="winko/include/post_modify.php?code=<?echo("$code")?>&v=<?=$v?>&v_category=<?=$category?>&page=<?echo("$page")?>&number=<?echo("$number")?>&keyfield=<?echo("$keyfield")?>&key=<?echo("$encoded_key ")?>">
<?if($admin[ok_category] != 1) {?>
<input type=hidden name=category value=<?=$my_category?>>
<input type=hidden name=my_signdate value=<?=$my_signdate?>>
<input type="hidden" name="ok_html" value="1">
<?
}
else {?>
<input type=hidden name=my_signdate value=<?=$my_signdate?>>
<input type="hidden" name="ok_html" value="1">
<?
}
##### ��Ų 
include $skin_folder."/modify.php";
?>
</form>
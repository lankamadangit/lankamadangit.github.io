<?
$spam_block = $top.date("dm",time());
$upload_size1 = GetFileSize($admin[upload_size1]);
$upload_size2 = GetFileSize($admin[upload_size2]);

// 회원일때는 기본 입력사항 안보이게;;
if($MEMBER_PART=="member") { $hide_start="<!--"; $hide_end="-->"; }
if($admin[ok_sitelink] != 1) { $hide_sitelink_start="<!--"; $hide_sitelink_end="-->"; }
if((($mem!=1)&&($admin[grant_notice] < $member[level]))||($admin[ok_notice] != 1)) {$hide_notice_start="<!--"; $hide_notice_end="-->"; }
if($admin[ok_secret] != 1) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }
if($admin[ok_file1] != 1) { $hide_file1_start="<!--"; $hide_file1_end="-->"; }
if($admin[ok_file2] != 1) { $hide_file2_start="<!--"; $hide_file2_end="-->"; }
if($admin[ok_html] != 1) { $hide_html_start="<!--"; $hide_html_end="-->"; }
if($admin[ok_category] != 1) { $hide_category_start="<!--"; $hide_category_end="-->"; }
if($admin[ok_add_a] != 1) { $hide_add_a_start="<!--"; $hide_add_a_end="-->"; }
if($admin[ok_add_b] != 1) { $hide_add_b_start="<!--"; $hide_add_b_end="-->"; }

##### 자바스크립트
include $skin_folder."/script.php";
?>
<form name="writeform" method="post" ENCTYPE="multipart/form-data" action="winko/include/post_write.php?code=<?echo("$code")?>&v=<?=$v?>&category=<?=$category?>">
<input type="hidden" name="ok_html" value="1">
<?
##### 스킨 
include $skin_folder."/write.php";
?>
</form>
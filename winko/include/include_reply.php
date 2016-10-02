<?
// 회원일때는 기본 입력사항 안보이게;;
if($MEMBER_ID) { $hide_start="<!--"; $hide_end="-->"; }
if($admin[ok_html] != 1) { $hide_html_start="<!--"; $hide_html_end="-->"; }
if($admin[ok_secret] != 1) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

##### 자바스크립트
include $skin_folder."/script.php";

##### 원글의 입력값을 뽑아낸다.
$query = "SELECT fid,name,subject,comment,thread,category FROM {$top}_board_{$code} WHERE uid = $number";
$result = mysql_query($query);
if(!$result) {
   error("QUERY_ERROR");
   exit;
}
$row = mysql_fetch_row($result);

$my_fid = $row[0];
$my_name = $row[1];
$my_subject = $row[2];
$my_comment = $row[3];
$my_thread = $row[4];
$my_category = $row[5];

##### 제목과 본문에 대하여 테이블에 저장할 때(post.php) addslashes() 함수로 escape시킨 문자열을 원래대로 되돌려 놓는다.
$my_subject = stripslashes($my_subject);
$my_comment = stripslashes($my_comment);

##### 원글자체가 다른 글의 응답글일 경우 문자열의 중복을 피하기 위해 "[RE]"를 없앤다.
//$my_subject = eregi_replace("^\[RE\] ", "",$my_subject);

##### 원글과 답변글을 구분하기 위해 원글의 각 줄앞에 콜론(:)을 추가하여 출력한다.
//$my_comment = ">" . $my_comment;
//$my_comment = eregi_replace("\n", "\n>", $my_comment);

$my_comment=str_replace("<p>","<br /> ",$my_comment);
$my_comment=str_replace("<br />","<br />> ",$my_comment);
$my_comment="<br />> ".$my_comment."<br /><br />";
if($v == "eng") {
	$reply_str = "-----------------------------------------  Answer -----------------------------------------";
} else {
	$reply_str = "-----------------------------------------  답변 내용 -----------------------------------------";
}
$my_comment = $my_comment.$reply_str."<br /><br />";

//$reply_comment = $my_name . "님의 글입니다.\n\n" . $my_comment;
$reply_comment = $my_comment;
?>

<form name="writeform" method="post" action="winko/include/post_reply.php?code=<?echo("$code")?>&v=<?=$v?>&category=<?=$category?>&page=<?echo("$page")?>&fid=<?echo("$my_fid")?>&thread=<?echo("$my_thread")?>">
<input type="hidden" name="ok_html" value="1">
<?
##### 스킨 
include $skin_folder."/reply.php";
?>
</form>


<?
##### 원본글을 가져옴
  $s_data=mysql_fetch_array(mysql_query("select * from {$top}_short_{$code} where uid='$c_uid'"));

  //////// MySQL 닫기 ///////////////////////////////////////////////
  if($connect) mysql_close($connect);

 
##### 관리자로 인증된 경우 모든 글을 삭제할 수 있다.
if($MEMBER_ID&&($admin[grant_admin] >= $member[level] || $mem == 1 || $s_data[ismember] == $MEMBER_ID)) {
   $ment="글을 삭제합니다.";
  }
else{
   if($v=="eng"){$ment="<font color=#ff3300>$my_subject</font> delete<br>Please enter your Password.";}
   else{$ment="<font color=#ff3300>$my_subject</font>을 삭제합니다.<br>비밀번호를 입력하여 주십시요";}
   $input_password="<input type=password name=passwd size=20 maxlength=20 class=input>";
}

  $target="winko/include/post_short_del.php";

  $a_list="<a href=winko.php?code=$code&v=$v&page=$page&number=$number>";
  
  $a_view="<a href=view.php?$href$sort&no=$no&v=$v>";

include $skin_folder."/password_form.php";
?>

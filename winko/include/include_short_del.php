<?
##### �������� ������
  $s_data=mysql_fetch_array(mysql_query("select * from {$top}_short_{$code} where uid='$c_uid'"));

  //////// MySQL �ݱ� ///////////////////////////////////////////////
  if($connect) mysql_close($connect);

 
##### �����ڷ� ������ ��� ��� ���� ������ �� �ִ�.
if($MEMBER_ID&&($admin[grant_admin] >= $member[level] || $mem == 1 || $s_data[ismember] == $MEMBER_ID)) {
   $ment="���� �����մϴ�.";
  }
else{
   if($v=="eng"){$ment="<font color=#ff3300>$my_subject</font> delete<br>Please enter your Password.";}
   else{$ment="<font color=#ff3300>$my_subject</font>�� �����մϴ�.<br>��й�ȣ�� �Է��Ͽ� �ֽʽÿ�";}
   $input_password="<input type=password name=passwd size=20 maxlength=20 class=input>";
}

  $target="winko/include/post_short_del.php";

  $a_list="<a href=winko.php?code=$code&v=$v&page=$page&number=$number>";
  
  $a_view="<a href=view.php?$href$sort&no=$no&v=$v>";

include $skin_folder."/password_form.php";
?>

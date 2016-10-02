<?
##### DB 접속 정보 #####
require_once("../../system/config.php");
 
$check=mysql_fetch_array(mysql_query("select count(*) from {$top}_member where mem_id ='$user_id'"));
mysql_close($conn);
?>
<html>

<head>
<title><?=$title?></title>
<link rel=StyleSheet HREF="../../system/css/winko.css" type=text/css title=style>
<body bgcolor="#f2f2f2" text="black" link="blue" vlink="purple" alink="red" leftmargin="10" marginwidth="0" topmargin="15" marginheight="0">
<table border=0 width=100% height=100%>
<tr>
  <td align=center>
<?
  if($check[0]) echo "$user_id 는 이미 등록된<br> 아이디입니다";
  else echo"$user_id 는 사용하실 수 있습니다";
?>

</td>
</tr>
<form>
<tr>
  <td align=center><input style="CURSOR: hand;" type=button value='Close' onclick=window.close(); class=submit></td>
</tr>
</form>
</table>
</body>
</table>
<?
##### DB 접속 정보 #####
require_once("../system/config.php");

##### Code 지정 안되어 있으면 경고 #####
if(!$code) error2("Error - Code 지정");

$result=mysql_query("select code,name from {$top}_boardadmin order by name");
?>
<html>

<head>
<title><?=$title?></title>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<link rel=StyleSheet HREF="../system/css/winko.css" type=text/css title=style>
</head>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red">

<script>
function change_board_name()
{
 select.board_name.value=select.select_board_name.value;
}

function board_delete()
{
 var check;
 select.exec.value="delete_all";
 check=confirm("삭제하시겠습니까?");
 if(check==true) {document.select.submit();}
}

function board_copy()
{
 var check;
 select.exec.value="copy_all";
 if(!select.select_board_name.value) {alert("복사할 게시판을 선택해주세요."); return false;}
 check=confirm(select.board_name.value+"게시판으로 복사 하시겠습니까?");
 if(check==true) {document.select.submit();}
}

function board_move()
{
 var check;
 select.exec.value="move_all";
 if(!select.select_board_name.value) {alert("이동할 게시판을 선택해주세요."); return false;}
 check=confirm(select.board_name.value+"게시판으로 이동하시겠습니까?");
 if(check==true) {document.select.submit();}
}


</script>

<div align=center>
<Table border=0 cellspacing=0 cellpadding=0>
<form name=select action="etc_select_post.php" method=post>
<input type=hidden name=code value="<?=$code?>">
<input type=hidden name=board_name value="">
<input type=hidden name=exec value="">
<input type=hidden name=selected value="<?=$selected?>">
<tr>
  <td>
  &nbsp; <a href=javascript:void(board_delete()) onfocus=blur()>선택된게시물삭제</a><br>
  &nbsp; <a href=javascript:void(board_copy()) onfocus=blur()>게시물복사</a><br>
  &nbsp; <a href=javascript:void(board_move()) onfocus=blur()>게시물이동</a><br>

  <img src=images/t.gif border=0 height=4></a><br>

  &nbsp; <select name=select_board_name onchange=change_board_name() class=input>
  <option value="">============</option>
<?
  while($data=mysql_fetch_array($result))
  {
?>
  <option value="<?=$data[code]?>"><?=$data[name]?></option>
<?
  }
?>
  </selected>
  </td>
</tr>
</form>
</table>
</body>
</html>
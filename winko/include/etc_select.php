<?
##### DB ���� ���� #####
require_once("../system/config.php");

##### Code ���� �ȵǾ� ������ ��� #####
if(!$code) error2("Error - Code ����");

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
 check=confirm("�����Ͻðڽ��ϱ�?");
 if(check==true) {document.select.submit();}
}

function board_copy()
{
 var check;
 select.exec.value="copy_all";
 if(!select.select_board_name.value) {alert("������ �Խ����� �������ּ���."); return false;}
 check=confirm(select.board_name.value+"�Խ������� ���� �Ͻðڽ��ϱ�?");
 if(check==true) {document.select.submit();}
}

function board_move()
{
 var check;
 select.exec.value="move_all";
 if(!select.select_board_name.value) {alert("�̵��� �Խ����� �������ּ���."); return false;}
 check=confirm(select.board_name.value+"�Խ������� �̵��Ͻðڽ��ϱ�?");
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
  &nbsp; <a href=javascript:void(board_delete()) onfocus=blur()>���õȰԽù�����</a><br>
  &nbsp; <a href=javascript:void(board_copy()) onfocus=blur()>�Խù�����</a><br>
  &nbsp; <a href=javascript:void(board_move()) onfocus=blur()>�Խù��̵�</a><br>

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
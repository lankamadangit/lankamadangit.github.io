<?
  if($mode=="modify") {
    $sql = " select * from $winko_banner where no = $id ";
    $row = mysql_fetch_array(mysql_query($sql));
    $rank = $row[rank];
    $alt  = $row[alt];
    $url  = $row[url];
    $hit  = $row[hit];
    $banner_view   = $row[view];
    $caption  = "배너수정";
  } else {
    $caption = "배너입력";
  }
?>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
  <tr height=20><td colspan=10></td></tr>
  <tr height=30><td colspan=10>
<table align="center" cellpadding="0" cellspacing="0" width="95%">
    <tr>
        <td>
            <p><img src="winko_img/banner_title.gif" width="112" height="32" border="0"></p>
        </td>
    </tr>
</table>  
  </td></tr>
<tr><td colspan=10><img src='winko_img/blank.gif' height=5></td></tr>
<tr><td colspan=10 background="winko_img/member_14.gif"><img src='winko_img/blank.gif' height=1></td></tr>
<tr><td colspan=10>
<!-- new start-->
<form name=frm1 method=post action="./admin_mode/banner_add_ok.php" enctype=multipart/form-data onsubmit="return check_submit();">
<input type=hidden name=mode value='<? echo $mode?>'>
<input type=hidden name=id value='<? echo $id?>'>
<input type=hidden name=page value='<? echo $page?>'>
<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#E0E0E0">
            <table cellpadding="0" cellspacing="8" width="100%">
                <tr>
                    <td>
    <table border=0 cellspacing=1 cellpadding=0 width=100%>
    <tr height=50>
	  <td align=right bgcolor="#F4F4F4"><img src='winko_img/newsdot.gif' align='absmiddle'>&nbsp;사이트이름&nbsp;&nbsp;</td>
      <td bgcolor="#ffffff">&nbsp;&nbsp;<input type=text name=alt size=50 value='<? echo $alt?>' class=input style=border-color:#666666></td>
    </tr>
    <tr height=50>
	  <td align=right bgcolor="#F4F4F4"><img src='winko_img/newsdot.gif' align='absmiddle'>&nbsp;링크&nbsp;</td>
      <td bgcolor="#ffffff">&nbsp;&nbsp;<input type=text name=url size=50 value='<? echo $url?>' class=input style=border-color:#666666><br>&nbsp;&nbsp;(클릭시 이동하는 URL)</td>
    </tr>
	<tr height=30>
	  <td align=right bgcolor="#F4F4F4"><img src='winko_img/newsdot.gif' align='absmiddle'>&nbsp;조회수&nbsp;</td>
      <td bgcolor="#ffffff">&nbsp;&nbsp;<input type=text name=hit size=7 value='<? echo $hit?>' class=input style=border-color:#666666></td>
    </tr>
	<tr height=30>
	  <td align=right bgcolor="#F4F4F4"><img src='winko_img/newsdot.gif' align='absmiddle'>&nbsp;위에출력&nbsp;</th>
      <td bgcolor="#ffffff">&nbsp;&nbsp;<input type=checkbox name=banner_view value='1' <? echo ($banner_view==1) ? "checked" : ""?>>출력함</td>
    </tr>
    </table>
</td></tr></table>
</td></tr>
<tr><td colspan=10 background="winko_img/member_14.gif"><img src='winko_img/blank.gif' height=1></td></tr>
<tr height=40 bgcolor=#ffffff>
<td colspan=2 align=center><img src=winko_img/blank.gif height=5><br>
<input type=image border=0 src=winko_img/confirm.gif>&nbsp;&nbsp;<IMG border=0 onclick=history.back() src="winko_img/back.gif" 
style="CURSOR: hand">
</td>
</tr>
    </form>
</table></td></tr></table>
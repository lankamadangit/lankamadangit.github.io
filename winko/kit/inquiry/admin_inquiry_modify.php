<?
if(!$select) $select="inquiry";
if($select=="inquiry") $consult_title="Korean";
elseif($select=="inquiry_eng") $consult_title="English";
elseif($select=="inquiry_cn") $consult_title="Chinese";

$result=mysql_query("select * from {$top}_{$select} where no='$no'",$conn) or die(mysql_error());
$data=mysql_fetch_array($result);
$left_w = "100";
?>

<form onsubmit='return FrmUserInfo_Form();' name="FrmUserInfo" method="post"  action="<?=$PHP_SELF?>?option=inquiry">
<INPUT TYPE="hidden" name=no value="<?=$no?>">
<INPUT TYPE="hidden" name=select value="<?=$select?>">
<INPUT TYPE="hidden" name=mode value="modify">

<table border=0 cellspacing=0 cellpadding=0 width=100%>
  <tr height=20><td colspan=10></td></tr>
  <tr height=30><td colspan=10>
<table align="center" cellpadding="0" cellspacing="0" width="95%">
    <tr>
		<td>
            <p><img src='winko/system/winko_img/consult_03.gif' width='67' height='32' border='0'></p>
        </td>
		<td valign="bottom" align="right">
            <p>(<?=$consult_title?>)</p>
		</td>
    </tr>
</table>  
  </td></tr>
<tr><td colspan=10><img src='winko/system/winko_img/blank.gif' height=5></td></tr>
<tr><td colspan=10 background="winko/system/winko_img/member_14.gif"><img src='winko/system/winko_img/blank.gif' height=1></td></tr>
<tr><td colspan=10>
<!-- new start-->
<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#E0E0E0">
            <table cellpadding="0" cellspacing="8" width="100%">
                <tr>
                    <td>
<table border=0 cellspacing=1 cellpadding=0 width=100%>

<!-- 처리상태 -->
<? unset($check);$check[$data[state]]="checked";?>
<tr height=30>
  <td align=right bgcolor="#F4F4F4" width=<?=$left_w?>><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;처리상태&nbsp;</td>
  <td bgcolor="#ffffff">&nbsp;&nbsp;     <input type=radio name=state value='0' <?echo $check[0];?>> 처리중 &nbsp;
     <input type=radio name=state value='1' <?echo $check[1];?>> 처리완료</td>
</tr>

<!-- 처리결과 -->
<tr height=70>
  <td align=right bgcolor="#F4F4F4" width=<?=$left_w?>><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;처리결과&nbsp;</td>
  <td bgcolor="#ffffff">&nbsp;&nbsp;<textarea name="result" rows="4" cols="55"><?=$data[result]?></textarea></td>
</tr>
</table>
</td></tr></table>
</td></tr>
<tr><td colspan=10 background="winko/system/winko_img/member_14.gif"><img src='winko/system/winko_img/blank.gif' height=1></td></tr>
</table>
</td></tr>
</td></tr>
<tr height=40 bgcolor=#ffffff>
<td colspan="2" align="center">
<INPUT TYPE="image" src="winko/system/winko_img/confirm.gif">&nbsp;&nbsp;<IMG border=0 
onclick=history.back(-2) src="winko/system/winko_img/back.gif" style="CURSOR: hand"></td>
</tr>
</table>
</form>
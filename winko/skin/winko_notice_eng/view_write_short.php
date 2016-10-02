<tr><td background="<?=$skin_folder?>/dot_w.gif" colspan='2'><img src="<?=$skin_folder?>/blank.gif" border='0'></td></tr>
<!-- 간단한 답변글 쓰기 -->
<form method=post name=write action="winko/include/post_short_write.php">
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=code value=<?=$code?>>
<input type=hidden name=category value=<?=$category?>>
<input type=hidden name=v value=<?=$v?>>
<input type=hidden name=number value=<?=$number?>>
<tr align=center height=60>
<td align=center background="<?=$skin_folder?>/view_td.gif">
 <table align=center border=0 cellpadding=0 cellspacing=0 width='96%'>
 <tr height="28">
  <td style=color:#333333 valign="bottom">Name</td>
  <td style=color:#333333 valign="bottom">Comment</td>
<?=$hide_short_password_start?>
  <td style=color:#333333 valign="bottom">Password</td>
<?=$hide_short_password_end?>
  <td>&nbsp;</td>
 </tr>
 <tr>
  <td width=70 valign=top><?=$c_name?>&nbsp;&nbsp;</td>
  <td><TEXTAREA name=comment rows=6 style="WIDTH: 97%" size="40"></TEXTAREA></td>
<?=$hide_short_password_start?>
  <td width=90 valign=top><input type=password name=passwd maxlength=20 class=input2 style="WIDTH: 85%"></td>
<?=$hide_short_password_end?>
  <td width=50 align='center' valign=top><input type=submit class=submit class=height:18px value=' Write '></td>
  </tr>
  <tr height=1><td colspan=6><img src='<?=$skin_folder?>blank.gif' height='10' border='0'></td></td></tr>
  </table>
 </td>
</tr>
</form>



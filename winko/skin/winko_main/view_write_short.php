<tr>
	<td background="<?=$skin_folder?>/dot_w.gif" colspan='2'><img src="<?=$skin_folder?>/blank.gif" border='0'></td>
</tr>
<!-- ������ �亯�� ���� -->
<form method=post name=write action="winko/include/post_short_write.php">
<input type="hidden" name="mode" value="write"/>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=code value=<?=$code?>>
<input type=hidden name=category value=<?=$category?>>
<input type=hidden name=v value=<?=$v?>>
<input type=hidden name=number value=<?=$number?>>
<tr align=center height=60>
	<td align=center background="<?=$skin_folder?>/view_td.gif">
		<table align=center border=0 cellpadding=0 cellspacing=0 width='96%'>
			<tr height="28">
				<td style=color:#333333 valign="bottom">�̸�</td>
				<td style=color:#333333 valign="bottom">����</td>
				<?=$hide_short_password_start?>
				<td style=color:#333333 valign="bottom">��й�ȣ</td>
				<?=$hide_short_password_end?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td width=70 valign=top><?=$c_name?>&nbsp;&nbsp;</td>
				<td><TEXTAREA name=comment rows=6 style="WIDTH: 97%" size="40"></TEXTAREA></td>
				<?=$hide_short_password_start?>
				<td width=90 valign=top><input type=password name=passwd maxlength=20 class=input2 style="WIDTH: 85%"></td>
				<?=$hide_short_password_end?>
				<td width=50 align='center' valign=top><input type=submit class=submit class=height:18px value=' �� �� '></td>
			</tr>
			<tr height=1>
				<td colspan=6 height='10'></td>
			</tr>
		</table>
	</td>
</tr>
</form>



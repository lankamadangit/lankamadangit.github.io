<table width="<?=$table_width?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td bgcolor="<?=$dark?>" height="1" colspan="2"><img src="<?=$skin_folder?>/blank.gif" height="1" /></td>
	</tr>
	<?=$hide_start?>
	<tr height="28">
		<td width="18%" align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;Name&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="name" size="20" maxlength="10"  /></td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle /'>&nbsp;����&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="email" size="40" /></td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;Ȩ������&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="homepage" size="40"  /></td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;��й�ȣ&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="password" name="passwd" size="10" maxlength="10"  />&nbsp;(�ּ� 4���̻��� ���� �Ǵ� ����)</td>
	</tr>
	<?=$hide_end?>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;Option&nbsp;&nbsp;</td>
		<td><?=$hide_html_start?>&nbsp;<input type="checkbox" name="ok_html" value="1" />(HTML)<?=$hide_html_end?><?=$hide_notice_start?>&nbsp;&nbsp;<INPUT type="checkbox" value="1" name="notice" />(������ ���)<?=$hide_notice_end?><?=$hide_secret_start?><?if($member[no]){?>&nbsp;&nbsp;<INPUT type="checkbox" value="1" name="ok_secret" />(��б�)<?}?><?=$hide_secret_end?></td>
	</tr>
	<tr height="28">
		<td width="18%" align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;Title&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="subject" size="70"  /></td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;Image1&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="file" name="userfile" size="20"  /> (150 X 150 pixel)</td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;Image2&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="file" name="userfile2" size="20"  /> (Max 400 pixel)</td>
	</tr>
	<tr>
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;Contents&nbsp;&nbsp;</td>
		<td style="padding-left:7px;"><!--textarea name="comment" cols="80" rows="15"></textarea-->
		<?
		$oFCKeditor = new FCKeditor('comment'); 
		$oFCKeditor->BasePath = 'fckeditor/'; 
		$oFCKeditor->Value =""; 
		$oFCKeditor->Width = 520;
		$oFCKeditor->Height = 400;
		$oFCKeditor->ToolbarSet	= 'Basic' ;
		$oFCKeditor->Config['AutoDetectLanguage']	= false ;
		$oFCKeditor->Config['DefaultLanguage']	= 'en' ;
		$oFCKeditor->Create();
		?>
		</td>
	</tr>
	<tr>
		<td bgcolor="<?=$dark?>" height="1" colspan="2"><img src="<?=$skin_folder?>blank.gif" height="1" /></td>
	</tr>
	<tr>
		<td align="center" colspan="2" style="padding-top:10px;"><a href="javascript:send(writeform)"><img align="absMiddle" border="0" src="<?=$skin_folder?>/confirm.gif" /></a><img align="absMiddle" border="0" onclick="history.back()" src="<?=$skin_folder?>/back.gif" style="CURSOR: hand" /></td>
	</tr>
</table>
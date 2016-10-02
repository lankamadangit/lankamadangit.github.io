<table width="<?=$table_width?>" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor=<?=$light?> >
	<tr>
		<td bgcolor="<?=$dark?>" height="1" colspan="2"><img src="<?=$skin_folder?>/blank.gif" height="1" /></td>
	</tr>
	<?=$hide_start?>
	<tr height='28'>
		<td width="18%" align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/newsdot.gif" align='absmiddle' />&nbsp;Name&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="name" size="20" maxlength="10" /></td>
	</tr>
	<tr height='28'>
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/newsdot.gif" align='absmiddle' />&nbsp;E-mail&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="email" size="40" /></td>
	</tr> 
	<tr height='28'>
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/newsdot.gif" align='absmiddle' />&nbsp;Homepage&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="homepage" size="40" /></td>
	</tr>         
	<tr height='28'>
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/newsdot.gif" align='absmiddle' />&nbsp;Password&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="password" name="passwd" size="10" maxlength="10" />&nbsp;(Password must be at least 4 characters)</td>
	</tr>
	<?=$hide_end?>
	<?=$hide_html_start?>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/newsdot.gif" align='absmiddle' />&nbsp;HTML&nbsp;&nbsp;</td>
		<td>&nbsp;<input type="checkbox" name="ok_html" value="1">&nbsp;(HTML)<?=$hide_secret_start?>&nbsp;&nbsp;<INPUT type="checkbox" value="1" name="ok_secret" />(Secret)<?=$hide_secret_end?></td>
	</tr>
	<?=$hide_html_end?>
	<tr height='28'>
		<td width="18%" align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/newsdot.gif" align='absmiddle' />&nbsp;Subject&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="subject" size="70"  value='<?echo("$my_subject")?>' /></td>
	</tr>
	<tr>
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/newsdot.gif" align='absmiddle'>&nbsp;Comment&nbsp;&nbsp;</td>
		<td style="padding-left:7px;"><!--textarea name="comment" cols="70" rows="15"><?echo("$reply_comment")?></textarea-->
		<?
		$oFCKeditor = new FCKeditor('comment'); 
		$oFCKeditor->BasePath = '/fckeditor/'; 
		$oFCKeditor->Value =$reply_comment; 
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
		<td bgcolor="<?=$dark?>" height="1" colspan="2"><img src="<?=$skin_folder?>/blank.gif" height="1" /></td>
	</tr>
	<tr>
		<td align="center" colspan="2" bgcolor='#ffffff' style="padding-top:10px;"><a href="javascript:send(writeform)"><img align="absMiddle" border="0" src="<?=$skin_folder?>/confirm.gif" /></a><img align="absMiddle" border="0" onclick="history.back()" src="<?=$skin_folder?>/back.gif" style="CURSOR: hand" /></td>
	</tr>
</table>
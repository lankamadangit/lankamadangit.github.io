<table width="<?=$table_width?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td bgcolor="<?=$dark?>" height="1" colspan="2"><img src="<?=$skin_folder?>/blank.gif" height="1" /></td>
	</tr>
	<?=$hide_start?>
	<tr height="28">
		<td width="18%" align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;Name&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="name" size="20" maxlength="10" value="<?echo ("$my_name")?>"  /></td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;Password&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="password" name="passwd" size="10" maxlength="10" />&nbsp;(Password must be at least 4 characters)</td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;E-mail&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="email" size="40" value="<?echo ("$my_email")?>"  /></td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;Homepage&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="homepage" size="40" value="<?echo ("$my_homepage")?>"  /></td>
	</tr>  
	<?=$hide_end?>
	<tr height="28">
		<td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;Option&nbsp;&nbsp;</td>
		<td><?=$hide_notice_start?>&nbsp;&nbsp;<INPUT type="checkbox" value="1" name="notice" <?=$check[$my_notice]?> />(Notice)<?=$hide_notice_end?><?=$hide_secret_start?>&nbsp;&nbsp;<INPUT type="checkbox" value="1" name="ok_secret" <?=$check[$my_ok_secret]?> />(Secret)<?=$hide_secret_end?></td>
	</tr>
	<tr height="28">
		<td width="18%" align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;Subject&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="subject" size="70" value="<?echo ("$my_subject")?>"  /></td>
	</tr>   
	<?=$hide_file1_start?>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;File&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<?=$my_userfile?>&nbsp;<span style="font-size:8pt;"><font face="Tahoma">(<b><?=$my_filesize?></b>byte)</font></span>&nbsp;&nbsp;Delete : <input type="checkbox" name="filecheck1" /></td>
	</tr>
	<?=$hide_file1_end?>
	<?=$hide_ok_file1_start?>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;File&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="file" name="userfile" size="20" style="height:20px;" /></td>
	</tr>
	<?=$hide_ok_file1_end?>
	<tr>
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;Comment&nbsp;&nbsp;</td>
		<td style="padding-left:7px;"><!--textarea name="comment" style="width:100%;" rows="20"><?echo("$my_comment")?></textarea-->
		<?
		$oFCKeditor = new FCKeditor('comment'); 
		$oFCKeditor->BasePath = 'fckeditor/'; 
		$oFCKeditor->Value =$my_comment; 
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
		<td align="center" colspan="2" style="padding-top:10px;"><a href="javascript:send(writeform)"><img align="absMiddle" border="0" src="<?=$skin_folder?>/confirm.gif" /></a><img align="absMiddle" border="0" onclick="history.back()" src="<?=$skin_folder?>/back.gif" style="CURSOR: hand" /></td>
	</tr>
</table>
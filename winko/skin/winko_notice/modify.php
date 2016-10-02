<table width="<?=$table_width?>" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td bgcolor="<?=$dark?>" height="1" colspan="2"><img src="<?=$skin_folder?>/blank.gif" height="1" /></td>
	</tr>
	<?=$hide_start?>
	<tr height="28">
		<td width="18%" align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;이름&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="name" size="20" maxlength="10" value="<?echo ("$my_name")?>" /></td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;비밀번호&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="password" name="passwd" size="10" maxlength="10" />&nbsp;(최소 4자이상의 영문 또는 숫자)</td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;메일&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="email" size="40" value="<?echo ("$my_email")?>" /></td>
	</tr>
	<tr height="28">
		<td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;홈페이지&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="homepage" size="40" value="<?echo ("$my_homepage")?>" /></td>
	</tr>  
	<?=$hide_end?>
	<tr height="28">
		<td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;Option&nbsp;&nbsp;</td>
		<td><?=$hide_notice_start?>&nbsp;&nbsp;<INPUT type="checkbox" value="1" name="notice" <?=$check[$my_notice]?> />(공지글 등록)<?=$hide_notice_end?><?=$hide_secret_start?>&nbsp;&nbsp;<INPUT type="checkbox" value="1" name="ok_secret" <?=$check[$my_ok_secret]?> />(비밀글)<?=$hide_secret_end?></td>
	</tr>
	<tr height="28">
		<td width="18%" align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;제목&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="text" name="subject" size="70" value="<?echo ("$my_subject")?>" /></td>
	</tr>   
	<?=$hide_file1_start?>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;첨부파일&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<?=$my_userfile?>&nbsp;<span style="font-size:8pt;"><font face="Tahoma">(<b><?=$my_filesize?></b>byte)</font></span>&nbsp;&nbsp;삭제 : <input type="checkbox" name="filecheck1" /></td>
	</tr>
	<?=$hide_file1_end?>
	<?=$hide_ok_file1_start?>
	<tr height="28">
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;첨부파일&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;<input type="file" name="userfile" size="20" style="height:20px;"/> (최대 <?=GetFileSize($admin[upload_size2])?>)</td>
	</tr>
	<?=$hide_ok_file1_end?>
	<tr>
		<td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle" />&nbsp;메시지본문&nbsp;&nbsp;</td>
		<td style="padding-left:7px;"><!--textarea name="comment" style="width:100%;" rows="20"><?echo("$my_comment")?></textarea-->
		<?
		$oFCKeditor = new FCKeditor('comment'); 
		$oFCKeditor->BasePath = 'fckeditor/'; 
		$oFCKeditor->Value =$my_comment; 
		$oFCKeditor->Width = 520;
		$oFCKeditor->Height = 400;
		$oFCKeditor->ToolbarSet	= 'Basic' ;
		$oFCKeditor->Create();
		?>
		</td>
	</tr>
	<tr>
		<td bgcolor="<?=$dark?>" height="1" colspan="2"><img src="<?=$skin_folder?>/blank.gif" height="1" /></td>
	</tr>
	<tr>
		<td align="center" colspan="2" style="padding-top:10px;"><a href="javascript:send(writeform)"><img align="absMiddle" border="0" src="<?=$skin_folder?>/confirm.gif" /></a><IMG align="absMiddle" border="0" onclick="history.back()" src="<?=$skin_folder?>/back.gif" style="CURSOR: hand" /></td>
	</tr>
</table>
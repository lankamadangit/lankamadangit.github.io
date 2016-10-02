<table border="0" cellspacing="0" cellpadding="0" width="<?=$table_width?>" bgcolor="<?=$bbs_color2?>" align='center'>
	<tr>
		<td bgcolor="<?=$bbs_color?>" height="1" colspan="2"><img src="<?=$skin_folder?>/blank.gif" height="1" /></td>
	</tr>
	<tr>
		<td height="3" colspan="2"><img src="<?=$skin_folder?>/blank.gif" height="1"></td>
	</tr>
	<tr height="26">
		<td align="right" width="100" style="color:#333333"><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;제목&nbsp;&nbsp;|</td>
		<td style="color:#333333">
			<table align="center" cellpadding="0" cellspacing="0" width="98%">
				<tr>
					<td style="color:#333333"><b><?=$my_subject?></b></td>
					<td width="50"><font class=thm8>Hit : <?=$my_ref?></font></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr height="26">
		<td align="right" width="100" style="color:#333333"><img src="<?=$skin_folder?>/main.gif" align='absmiddle' />&nbsp;작성일&nbsp;&nbsp;|</td>
		<td style="color:#333333">&nbsp;&nbsp;<font class=thm8><?=$my_signdate?></font></td>
	</tr>
	<?=$hide_file1_start?>
	<tr height="26">
		<td align="right" width="100" style="color:#333333"><img src='<?=$skin_folder?>/main.gif' align='absmiddle' />&nbsp;첨부&nbsp;&nbsp;|</td>
		<td style="color:#333333">&nbsp;&nbsp;<font class=thm8><?=$my_userfile_ecd?>&nbsp;<span style="font-size:8pt;"><font face="Tahoma">(<b><?=$my_filesize?></b>)</font></span></font>&nbsp;&nbsp;<?=$down_img?></td>
	</tr>
	<?=$hide_file1_end?>
	<tr>
		<td background="<?=$skin_folder?>/dot_w.gif" height="1" colspan="2"><img src="<?=$skin_folder?>/blank.gif" height="1" /></td>
	</tr>
</table>
<!-- 내용 시작 -->
<table border="0" cellspacing="0" cellpadding="0" width="<?=$table_width?>" align="center">
	<? if($image1){echo"<tr><td><img src={$skin_folder}/blank.gif height=10></td></tr><tr><td><p align=center>$image1<p></td></tr>";}?>
	<tr>
		<td style='word-break:break-all;padding:10px;' height="150" valign="top"><span style="line-height:180%"><p><?=$my_comment?></p><br /></span></td>
	</tr>
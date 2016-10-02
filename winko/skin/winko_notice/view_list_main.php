	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" height="27">
				<tr>
					<td width="41" class=thm8 align="center"><img src="<?=$skin_folder?>/blank.gif" height="3" /><br /><?=$article_num?></td>
					<?=$hide_select_start?>
					<td width="21" align="center"><input type="checkbox" name="select" value="<?=$my_uid?>" /></td>
					<?=$hide_select_end?>
					<td><img src="<?=$skin_folder?>/blank.gif" height="3" /><br /.><?
					##### 원글에 대한 답변글이 $reply_indent 값 이상이 되면 답변글의 출력 indent를 고정시킨다.
					for($j = 0; $j < $spacer; $j++) {
						echo("&nbsp;");
					}
					?>&nbsp;&nbsp;<img src="<?=$head_icon?>" border="0" align="absMiddle" />&nbsp;<a href="winko.php?code=<?=$code?>&body=view&page=<?=$page?>&number=<?=$my_uid?>&category=<?=$category?>&keyfield=<?=$keyfield?>&key=<?=$encoded_key?>"><?=$my_subject?></a><?=$file_icon?><?=$total_short?><?=$new_icon?></a>
					</td>
					<td width="79" align="center"><img src="<?=$skin_folder?>/blank.gif" height="3" /><br /><?=$my_signdate2?></td>
					<td width="40" align="center"><img src="<?=$skin_folder?>/blank.gif" height="3" /><br /><?=$my_ref?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td background="<?=$skin_folder?>/dot_w.gif" height="1"><img src="image/etc/blank.gif" width="1" height="1" border="0" /></td>
	</tr>

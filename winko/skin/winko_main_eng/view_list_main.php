	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%" height="27">
				<tr>
					<td width="41">
						<p class=thm8 align="center"><img src="<?=$skin_folder?>/blank.gif" height="3" /><br /><?=$article_num?></p>
					</td>
					<?=$hide_select_start?>
					<td width="21">
						<p align="center"><input type="checkbox" name="select" value="<?=$my_uid?>" /></p>
					</td>
					<?=$hide_select_end?>
					<td>
						<p><img src="<?=$skin_folder?>/blank.gif" height="3" /><br /><?
						##### 원글에 대한 답변글이 $reply_indent 값 이상이 되면 답변글의 출력 indent를 고정시킨다.
						for($j = 0; $j < $spacer; $j++) {
							echo("&nbsp;");
						}
						?>&nbsp;&nbsp;<img src="<?=$head_icon?>" border="0" align="absMiddle" />&nbsp;<a href="winko.php?code=<?=$code?>&body=view&v=<?=$v?>&page=<?=$page?>&number=<?=$my_uid?>&category=<?=$category?>&keyfield=<?=$keyfield?>&key=<?=$encoded_key?>"><?=$my_subject?></a><?=$file_icon?><?=$total_short?><?=$new_icon?></a></p>
						</td>
						<td width="71">
							<p align="center"><img src="<?=$skin_folder?>/blank.gif" height="3" /><br /><?=$my_name?></p>
						</td>
						<td width="79">
							<p align="center"><img src="<?=$skin_folder?>/blank.gif" height="3" /><br /><?=$my_signdate2?></p>
						</td>
						<td width="40">
							<p align="center"><img src="<?=$skin_folder?>/blank.gif" height="3" /><br /><?=$my_ref?></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td background="<?=$skin_folder?>/dot_w.gif">
				<p><img src="image/etc/blank.gif" width="1" height="1" border="0" /></p>
			</td>
		</tr>

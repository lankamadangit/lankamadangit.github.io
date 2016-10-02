<table align="center" cellpadding="0" cellspacing="0" width="95%">
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
					<td>
						<select name="keyfield" style="color:#333333; background-color:#f3f3f3;" class=input>
							<option value="subject"<?=$check[subject];?>>Subject</option><option value="name"<?=$check[name];?>>Name</option>
							<option value="comment"<?=$check[comment];?>>Contents</option>
						</select>
					</td>
					<td width="140" align="center"><input type="text" style="WIDTH: 95%" maxlength="30" name="key" class="input" value="<?=$key?>" /></td>
					<td><input align="absMiddle" border="0" src="<?=$skin_folder?>/search.gif" width="55" height="27" type="image" /></td>
				</tr>
			</tbody>
			</table>
		</td>
		<td>
			<p align=right><?=$list_icon?><?=$select_icon?><?=$write_icon?></p>
		</td>
	</tr>
</table>
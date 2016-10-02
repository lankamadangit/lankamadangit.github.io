<table align="center" cellpadding="0" cellspacing="0" width="95%">
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
					<td>
						<select name="keyfield" style="color:#333333; background-color:#f3f3f3;" class=input>
							<option value="subject"<?=$check[subject];?>>제목</option>
							<option value="name"<?=$check[name];?>>이름</option>
							<option value="comment"<?=$check[comment];?>>내용</option>
						</select>
					</td>
					<td width="140" align="center"><input type="text" style="WIDTH: 95%" maxlength="30" name="key" class="input" value="<?=$key?>" /></td>
					<td><INPUT align="absMiddle" border="0" src="<?=$skin_folder?>/search.gif" width="55" height="27" type="image" /></td>
				</tr>
				</tbody>
			</table>
		</td>
		<td align="right"><?=$list_icon?><?=$select_icon?><?=$write_icon?></td>
	</tr>
</table>
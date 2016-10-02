<SCRIPT LANGUAGE="JavaScript">
<!--
function edit(Obj) {
	Obj.submit();
}

function categoryDel(cateName, part_idx, cate_index)
{
	var choose = confirm(cateName+"\n\n분류의 모든 상품이 삭제됩니다.\n\n삭제 하시겠습니까?");
	if(choose) {
		location.href="admin.php?option=category&option2=edit&mode=del&idx=" + part_idx + "&hidden_part_index="+ cate_index;
	}
	else return;
}
//-->
</SCRIPT>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="21">
						<p><img src="winko/system/winko_img/manager/subtitle_head.gif" width="21" height="28" border="0"></p>
					</td>
					<td background="winko/system/winko_img/manager/subtitle_bg.gif" style="padding-top:3px; padding-left:10px;">
						<p><b>카테고리 관리</b></p>
					</td>
					<td width="8">
						<p><img src="winko/system/winko_img/manager/subtitle_foot.gif" width="8" height="28" border="0"></p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="15"></td>
	</tr>
	<tr>
		<td>
			<!-- List {{ -->
			<?
			$result = mysql_query("SELECT * FROM {$top}_category WHERE part_index = 1 ORDER BY part_ranking  ASC, menu_idx ASC");
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<tr>
								<td height="1" bgcolor="#85ACCF" colspan="5"></td>
							</tr>
							<tr>
								<td height="25" align="center" bgcolor="#E9F5F9"><font color="#009BC0"><b>카테고리명</b></font></td>
								<td width="35%" align="center" bgcolor="#E9F5F9"><font color="#009BC0"><b>링크</b></font></td>
								<td width="15%" height="25" align="center" bgcolor="#E9F5F9"><font color="#009BC0"><b>하위등록</b></font></td>
								<td width="5%" align="center" bgcolor="#E9F5F9"><font color="#009BC0"><b>수정</b></font></td>
								<td width="5%" align="center" bgcolor="#E9F5F9"><font color="#009BC0"><b>삭제</b></font></td>
							</tr><?
							$cnt=0;
							while ($row = mysql_fetch_array($result)) {
								$cnt++;
							?>
							<input type="hidden" name="part1_code" value="<?=$row[part1_code]?>">
							<tr height="35">
								<td align="left" bgcolor="#ffffff" style="padding-left:7px;"><img src="img/admin/category/part1.gif" alt='1차 카테고리' align="absmiddle"> &nbsp;<?=$row[part_name]?></td>
								<td align="center" bgcolor="#ffffff">product.php?menu_idx=<?=$row[menu_idx]?></td>
								<?
								if($row[part_low_check] == "1")  {
									$part2_register_images = "<img src='img/admin/category/bt_category_add2.gif' border='0' alt='2차카테고리등록' align='absmiddle'>"; 
								} else { 
									$part2_register_images = ""; 
								}?>
								<td align="center" bgcolor="#ffffff"><a href="admin.php?option=category&option2=write&idx=<?=$row[idx]?>&hidden_part_index=2"><?=$part2_register_images?></a></td>
								<td align="center" bgcolor="#ffffff"><a href="admin.php?option=category&option2=edit&idx=<?=$row[idx]?>&hidden_part_index=1"><img src='winko/system/winko_img/manager/btn_modify_small.gif' width='14' height='14' border='0'></a></td>
								<td align="center" bgcolor="#ffffff"><a href="javascript:categoryDel('<?=htmlspecialchars($row[part_name])?>', <?=$row[idx]?>, 1);"><img src='winko/system/winko_img/manager/btn_delete_small.gif' width='14' height='14' border='0'></a></td>
							</tr>
							<?
							$query2 = "SELECT * FROM {$top}_category WHERE part_index='2' AND part1_code='$row[part1_code]' ORDER BY part_ranking ASC";
							$result2 = mysql_query($query2);
							
							while($row2 = mysql_fetch_array($result2)) {
							?>
							<tr height="35">
								<td align="left" bgcolor="#ffffff" style="padding-left:20px;"><img src="img/admin/category/part2.gif" alt='2차 카테고리' align="absmiddle"> &nbsp;<?=$row2[part_name]?></td>
								<td align="center" bgcolor="#ffffff">product.php?menu_idx=<?=$row2[menu_idx]?>&part_idx=<?=$row2[idx]?></td>
								<?
								if($row2[part_low_check] == "1")  {	
									$part3_register_images = "<img src='img/admin/category/bt_category_add3.gif' border='0' alt='3차카테고리등록' align='absmiddle'>"; 
								} else { 
									$part3_register_images = ""; 
								}?>
								<td align="center" bgcolor="#ffffff"><a href="admin.php?option=category&option2=write&idx=<?=$row2[idx]?>&hidden_part_index=3"><?=$part3_register_images?></a></td>
								<td align="center" bgcolor="#ffffff"><a href="admin.php?option=category&option2=edit&idx=<?=$row2[idx]?>&hidden_part_index=2"><img src='winko/system/winko_img/manager/btn_modify_small.gif' width='14' height='14' border='0'></a></td>
								<td align="center" bgcolor="#ffffff"><a href="javascript:categoryDel('<?=htmlspecialchars($row2[part_name])?>', <?=$row2[idx]?>, 2);"><img src='winko/system/winko_img/manager/btn_delete_small.gif' width='14' height='14' border='0'></a></td>
							</tr>
							<?
							$query3 = "SELECT * FROM {$top}_category WHERE part_index='3' AND part1_code='$row[part1_code]' AND part2_code='$row2[part2_code]'ORDER BY part_ranking ASC";
							$result3 = mysql_query($query3);
							
							while($row3 = mysql_fetch_array($result3)) {
							?>
							<tr height="35">
								<td align="left" bgcolor="#ffffff" style="padding-left:37px;"><img src="img/admin/category/part3.gif" alt='3차 카테고리' align="absmiddle"> &nbsp;<?=$row3[part_name]?></td>
								<td align="center" bgcolor="#ffffff">product.php?menu_idx=<?=$row3[menu_idx]?>&part_idx=<?=$row3[idx]?></td>
								<td align="center" bgcolor="#ffffff"></td>
								<td align="center" bgcolor="#ffffff"><a href="admin.php?option=category&option2=edit&idx=<?=$row3[idx]?>&hidden_part_index=3"><img src='winko/system/winko_img/manager/btn_modify_small.gif' width='14' height='14' border='0'></a></td>
								<td align="center" bgcolor="#ffffff"><a href="javascript:categoryDel('<?=htmlspecialchars($row3[part_name])?>', <?=$row3[idx]?>, 3);"><img src='winko/system/winko_img/manager/btn_delete_small.gif' width='14' height='14' border='0'></a></td>
							</tr>
							<?
									}
								}
							}
							?>
						</table>
					</td>
				</tr>
			</table>
			<!-- List }} -->
		</td>
	</tr>
	<tr>
		<td height="15"></td>
	</tr>
</table>

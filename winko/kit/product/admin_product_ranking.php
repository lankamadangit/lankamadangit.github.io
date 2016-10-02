<?
$_GET=&$HTTP_GET_VARS;

$cnt_sql= "select count(*) from {$top}_product";
$cnt_result = mysql_query($cnt_sql);
$cnt_row = mysql_fetch_array($cnt_result);
$total_cnt = $cnt_row[0];
?>

<script language="javascript">
<!--
function goodsRanking(part_idx){
	var winleft = (screen.width - 400) / 2;
	var wintop = (screen.height - 500) / 2;
	window.open("product_ranking.php?part_idx="+part_idx,"","scrollbars=no, width=400, height=400, top="+wintop+", left="+winleft+"");
}
//-->
</script>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td height="150" align="center" valign="top" bgcolor="#FFFFFF" class="menu">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="21">
						<p><img src="winko/system/winko_img/manager/subtitle_head.gif" width="21" height="28" border="0"></p>
					</td>
					<td background="winko/system/winko_img/manager/subtitle_bg.gif" style="padding-top:3px; padding-left:10px;">
						<p><b>상품 순위</b></p>
					</td>
					<td width="8">
						<p><img src="winko/system/winko_img/manager/subtitle_foot.gif" width="8" height="28" border="0"></p>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<tr>
					<td>
						<!---------내용출력----------->
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td align="center" valign="top" bgcolor="#FFFFFF" class="menu">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="25"></td>
											<td align="right" class="menu">총 <font color="#FF0000"><b><?=$total_cnt?></b></font>개의 상품이 등록되어 있습니다.</td>
										</tr>
									</table>
									<?
									$result = mysql_query("SELECT * FROM {$top}_category WHERE part_index = 1 ORDER BY menu_idx ASC, part_ranking  ASC");	
									?>
									<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
										<tr>
											<td height="1" bgcolor="#85ACCF" colspan="2"></td>
										</tr>
										<tr>
											<td height="25" align="center" bgcolor="#E9F5F9"><font color="#009BC0"><b>카테고리명</b></font></td>
											<td width="18%" align="center" bgcolor="#E9F5F9"><font color="#009BC0"><b>순위</b></font></td>
										</tr>
										<?
										while ($row = mysql_fetch_array($result)) {
											// 등록된 상품수
											$part1_total_goods = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM {$top}_product WHERE part_idx = $row[idx]"));
										?>
										<tr height="35" >
											<td bgcolor="#ffffff" style="padding-left:7px;" <?=($part1_total_goods[0] > 0 ? "" : "colspan='2'")?>><img src="img/admin/category/part1.gif" alt='1차 카테고리' align="absmiddle"> &nbsp;<?=$row[part_name]?> <?=($part1_total_goods[0] > 0 ? "(".$part1_total_goods[0].")" : "")?></td>
											<? if(!empty($part1_total_goods[0])) {?><td bgcolor="#ffffff"><a href="javascript:goodsRanking(<?=$row[idx]?>)"><img src="img/admin/category/bt_pd_rank.gif" alt="상품순위" border="0" align="absmiddle"></a>&nbsp;&nbsp;</td><?}?>
										</tr>
										<?
										$query2 = "SELECT * FROM {$top}_category WHERE part_index='2' AND part1_code='$row[part1_code]' ORDER BY part_ranking  ASC";
										$result2 = mysql_query($query2);
										
										while($row2 = mysql_fetch_array($result2)) {
											// 등록된 상품수
											$part2_total_goods = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM {$top}_product WHERE part_idx = $row2[idx]"));
										?>
										<tr height="35" >
											<td bgcolor="#ffffff" <?=($part2_total_goods[0] > 0 ? "" : "colspan='2'")?> style="padding-left:20px;" ><img src="img/admin/category/part2.gif" alt='2차 카테고리' align="absmiddle"> &nbsp;<?=$row2[part_name]?> <?=($part2_total_goods[0] > 0 ? "(".$part2_total_goods[0].")" : "")?></td>
											<? if(!empty($part2_total_goods[0])) {?><td bgcolor="#ffffff" align="center"><a href="javascript:goodsRanking(<?=$row2[idx]?>)"><img src="img/admin/category/bt_pd_rank.gif" alt="상품순위" border="0" align="absmiddle"></a>&nbsp;&nbsp;</td><?}?>
										</tr>
										</tr>
										<?
										$query3 = "SELECT * FROM {$top}_category WHERE part_index='3' AND part1_code='$row[part1_code]' AND part2_code='$row2[part2_code]'ORDER BY part_ranking  ASC";
										$result3 = mysql_query($query3);
										
										while($row3 = mysql_fetch_array($result3)) {
											// 등록된 상품수
											$part3_total_goods = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM {$top}_product WHERE part_idx = $row3[idx]"));
										?>
										<tr height="35" >
											<td bgcolor="#ffffff" <?=($part3_total_goods[0] > 0 ? "" : "colspan='2'")?> style="padding-left:37px;"><img src="img/admin/category/part3.gif" alt='3차 카테고리' align="absmiddle"> &nbsp;<?=$row3[part_name]?> <?=($part3_total_goods[0] > 0 ? "(".$part3_total_goods[0].")" : "")?></td>
											<? if(!empty($part3_total_goods[0])) {?><td bgcolor="#ffffff" align="center"><a href="javascript:goodsRanking(<?=$row3[idx]?>)"><img src="img/admin/category/bt_pd_rank.gif" alt="상품순위" border="0" align="absmiddle"></a>&nbsp;&nbsp;</td><?}?>
										</tr>
										<?
												} //3차 카테고리
											} // 2차 카테고리
										} // 1차 카테고리
										?>
									</table>
								</td>
							</tr>
						</table>
						<!---------내용출력끝----------->
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

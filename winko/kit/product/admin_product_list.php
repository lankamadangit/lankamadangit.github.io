<SCRIPT LANGUAGE="JavaScript">
<!--
function sendit() {
	var form=document.goods_form;
	form.submit();
}


/// 검색기능
function search(){
	var form=document.goods_search_form;
//	if(!form.search_order.value)	{
//		alert("검색할 내용을 입력해 주십시오.");
//		form.search_order.focus();
//	} else {
		form.submit();
//	}
}

////  카테고리 선택 폼 설정 시작 //////////////////////////////////////////////////////////////////////////
// 배열 선언
depth1 = new Array(); // 리스트1 출력용
depth2 = new Array(); // 리스트2 출력용
depth3 = new Array(); // 리스트3 출력용

depth1_value = new Array(); // 리스트1 값
depth2_value = new Array(); // 리스트2 값
depth3_value = new Array(); // 리스트3 값

var depth1_size = 3;
var depth2_size = 3;
var depth3_size = 3;
var sep = "$$";
// 배열 초기화

i = 0;
// depth1 의 배열 초기화
<?
$part1_result = mysql_query("select *from {$top}_category where part_index=1 order by part_ranking asc");
while( $part1_row = mysql_fetch_object($part1_result) ) {
?>
	depth1[i] = "<?=$part1_row->part_name;?>";
	depth1_value[i] = "<?=$part1_row->part1_code;?>";

	j = 0;

	// depth2 의 배열 초기화
	<?
	$part2_result = mysql_query("select *from {$top}_category  where part1_code='$part1_row->part1_code' and part_index=2 order by part_ranking asc");
	while( $part2_row = mysql_fetch_object($part2_result) )
	{
	?>
		if ( j == 0 )
		{
			depth2[i] = new Array();
			depth2_value[i] = new Array();
			depth3[i] = new Array();
			depth3_value[i] = new Array();
		}

		depth2[i][j] = "<?=$part2_row->part_name;?>" ;
		depth2_value[i][j] = "<?=$part2_row->part2_code;?>";

		k = 0;
		<?
		$part3_result = mysql_query("select *from {$top}_category where part2_code='$part2_row->part2_code' and part1_code='$part1_row->part1_code' and part_index=3 order by part_ranking asc");
		while( $part3_row = mysql_fetch_object($part3_result) )
		{
		?>
			if ( k == 0 )
			{
				depth3[i][j] = new Array();
				depth3_value[i][j] = new Array();
			}
			depth3[i][j][k] = '<?=$part3_row->part_name?>' ;
			depth3_value[i][j][k] = '<?=$part3_row->part3_code?>' ;
		k += 1;
		<?}?>
	j += 1;
	<?}?>
i += 1;
<? }?>

// 선택되었을때 다음 단계 카테고리 출력
function change(depth, index, target)
{
	f = document.goods_form;   // 선택된 Form;

	if ( depth == 1 && index != -1)  // 대분류 선택 시
	{
		sp_value = f.select1[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];

		for ( i = f.select2.length; i >= 0; i-- ) {
			f.select2[i] = null;
		}
		goods_form.part_code.value = "";
		if ( depth2[sp_value2] != null ){

			for ( i = 0 ; i <= depth2[sp_value2].length -1 ; i++ ){
				f.select2.options[i] = new Option(depth2[sp_value2][i],depth2_value[sp_value2][i] + sep + sp_value2 + sep + i );
			}

		}else{
			//alert("2차 카테고리는 없습니다.");
			goods_form.part_code.value = depth1_value[sp_value2];
			alert("카테고리 선택 완료");
			sendit();
		}


		// 카테고리 2를 초기화 되면 카테로기 3은 모두 삭제한다.
		//for ( i = f.select3.length; i >= 0; i-- ) {
		//	f.select3[i] = null;
		//}

	} else if ( depth == 2 && index != -1 )   // 중분류 선택 시
	{
		sp_value = f.select2[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];
		sp_value3 = sp_value[2];

		//for ( i = f.select3.length; i >= 0; i-- ) {
		//	f.select3[i] = null;
		//}
		goods_form.part_code.value = "";
		if ( depth3[sp_value2][sp_value3] != null ){

			for ( i = 0 ; i <= depth3[sp_value2][sp_value3].length -1 ; i++ ){
				f.select3.options[i] = new Option(depth3[sp_value2][sp_value3][i],depth3_value[sp_value2][sp_value3][i]);
			}
		} else {
			//alert("3차 카테고리는 없습니다.");
			goods_form.part_code.value = depth2_value[sp_value2][sp_value3];
			alert("카테고리 선택 완료");
			sendit();
		}
	} else if ( depth == 3 && index != -1 ) {
		goods_form.part_code.value = f.select3[index].value;
		alert("카테고리 선택 완료");
		sendit();
	}
}
////  카테고리 선택 폼 설정 종료 //////////////////////////////////////////////////////////////////////////


function goodsDel(goodsName, goods_idx, menu_idx) {
	var choose = confirm(goodsName+"상품을 삭제 하시겠습니까?");
	if(choose) {
		location.href="admin.php?option=product&option2=edit&mode=del&idx=" + goods_idx + "&menu_idx="+ menu_idx;
	}
	else return;
}
//-->
</script>
<?
if($_POST[part_code]) {
	$part_row=mysql_fetch_array(mysql_query("select * from {$top}_category where part1_code='$_POST[part_code]' or part2_code='$_POST[part_code]' or part3_code='$_POST[part_code]'"));
	$part_idx=$part_row[idx];
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="790" valign="top" style="padding:10px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top">
						<table width="100%" height="25" border="0" cellpadding="3" cellspacing="0" class="menu" style='border-collapse: collapse'>
							<form action="admin.php?option=product" method="post" name="goods_form">
							<input type="hidden" name="part_code" value="<?=$_POST[part_code];?>">
							<tr>
								<td align="center">
									<table width="650" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="300" height="30" align="center" valign="middle"><img src="img/admin/category/category1.gif" alt="1차카테고리"></td>
											<td width="300" height="30" align="center" valign="middle"><img src="img/admin/category/category2.gif" alt="2차카테고리"></td>
											<!--td width="210" height="30" align="center" valign="middle"><img src="img/admin/category/category3.gif" alt="3차카테고리"></td-->
										</tr>
										<tr>
											<td height="22" align="center" valign="middle">
												<select name="select1" size="10" style="background-color:EFEFEF; width:300;height:250;" onClick='change(1, this.form.select1.selectedIndex, this.form)' class="input">
													<script language = "javascript">
													for ( i = 0 ; i <= depth1.length -1 ; i++ ){
														document.write ("<option value='"+ depth1_value[i] + sep + i + "' >" + depth1[i] + "</option>");
													}
													</script>
												</select>
											</td>
											<td align="center" valign="middle">
												<select name="select2" size="10" style="background-color:EFEFEF; width:300;height:250;"  onclick='change(2, this.form.select2.selectedIndex, this.form)' class="input"></select>
											</td>
											<td align="center" valign="middle">
												<!--select name="select3" size="10" style="background-color:EFEFEF; width:200;height:200;" onclick='change(3, this.form.select3.selectedIndex, this.form)' class="input"></select-->
											</td>
										</tr>
									</table>
								</td>
							</tr>
							</form>
						</table>
					</td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="1" cellspacing="0" cellpadding="0">
						<? if($part_idx) { ?>
							<?
							if($part_idx) {
								$part_stat_row = mysql_fetch_array(mysql_query("select * from {$top}_category where idx=$part_idx"));
								if( $part_stat_row[part_index] == "1" ) {
									$part_result = mysql_query("select * from {$top}_category where part1_code='$part_stat_row[part1_code]' && part_index=1 order by idx asc");
								} else if( $part_stat_row[part_index] == "2" ) {
									$part_result = mysql_query("select * from {$top}_category where (part1_code='$part_stat_row[part1_code]' && part_index=1) || (part2_code ='$part_stat_row[part2_code]' && part_index=2) order by idx asc");
								} else if( $part_stat_row[part_index] == 3 ) {
									$part_result = mysql_query("select * from {$top}_category where (part1_code='$part_stat_row[part1_code]' && part_index=1) || (part2_code ='$part_stat_row[part2_code]' && part_index=2) || (part3_code='$part_stat_row[part3_code]' && part_index=3) order by idx asc");
								}
								$i=0;
								while($part_stat_row2 = mysql_fetch_array($part_result)) {
									$i++;
									$part_name.=$i."차 카테고리 : <font color='#FF0000'>".$part_stat_row2[part_name]."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								}
							}
							?>
						<table width="100%" border="0" cellspacing="0" cellpadding="3" class="menu" style='border-collapse: collapse'>
							<tr>
								<td><?=$part_name;?></td>
							</tr>
						</table>
						<table width="100%" border="1" cellspacing="0" cellpadding="3" bordercolor='#BDBEBD' class="menu" style='border-collapse: collapse'>
							<colgroup><col width="8%"><col width="15%"><col width="15%"><col width="*"><col width="12%"><col width="5%"><col width="5%"></colgroup>
							<tr align="center" bgcolor="F5F5F5">
								<td height="25">No</td>
								<td height="25">Prodct Image</td>
								<td height="25">Product Code</td>
								<td height="25" bgcolor="F5F5F5">Product Name</td>
								<td height="25">등록일</td>
								<td height="25">수정</td>
								<td height="25">삭제</td>
							</tr>
							<?
							$listScale			=	15; 		// 리스트 수
							$pageScale		=	15;		// 페이지 수
							if( !$startPage ) { $startPage = 0; }		// 스타트 페이지
							$totalPage = floor($startPage / ($listScale * $pageScale));		// 토탈페이지
							if( $search_item == 1 ) {
								$arr_totalList	= mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM {$top}_product WHERE part_idx=$part_idx AND product_name like '%$search_order%'"));
								$result		= mysql_query("SELECT * FROM {$top}_product WHERE part_idx=$part_idx AND product_name like '%$search_order%' ORDER BY rank ASC LIMIT $startPage, $listScale" );
							} else if( $search_item == 2 ) {
								$arr_totalList	= mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM {$top}_product WHERE part_idx=$part_idx AND product_code like '%$search_order%'" ));
								$result		=mysql_query("SELECT * FROM {$top}_product WHERE part_idx=$part_idx AND product_code like '%$search_order%' ORDER BY rank ASC LIMIT $startPage, $listScale" );
							} else {
								$arr_totalList	= mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM {$top}_product WHERE part_idx=$part_idx" ));
								$result		= mysql_query("SELECT * FROM {$top}_product WHERE part_idx=$part_idx ORDER BY rank ASC LIMIT $startPage, $listScale" );
							}
							$totalList = $arr_totalList[0];
							$form_name=0; // 폼리스트 변수
							if( $startPage ) { 
								$listNo = $totalList - $startPage; 
							} else { 
								$listNo = $totalList; 
							}		// 페이지넘버

							while( $row = mysql_fetch_array($result)) {
									$form_name++; // 폼네임변경 숫자증가
									$goods_data ="idx=".$row[idx]."&startPage=".$startPage."&listNo=".$listNo."&table=".$table."&part_idx=".$part_idx."&search_item=".$search_item."&search_order=".$search_order;
							?>
							<form name="form_<?=$form_name?>" method="post" action="admin.php?option=product">
							<input type="hidden" name="hidden_goods_idx" value="<?=$row[idx]?>">
							<tr align="center">
								<td height="60"><?=$listNo?></td>
								<td><a href="admin.php?option=product&option2=edit&idx=<?=$row[idx]?>&menu_idx=<?=$row[menu_idx]?>"><img align="absmiddle" src="winko/data/product/<?=($row[product_img1] ? $row[product_img1] : "no_image_list.gif")?>" width="50" height="70" border="0"></a></td>
								<td><?=$row[product_code]?></td>
								<td align="left">&nbsp;<a href="admin.php?option=product&option2=edit&idx=<?=$row[idx]?>&menu_idx=<?=$row[menu_idx]?>"><?=$row[product_name]?></a></td>
								<td><?=date("Y-m-d",$row[Reg_date])?></td>
								<td><a href="admin.php?option=product&option2=edit&idx=<?=$row[idx]?>&menu_idx=<?=$row[menu_idx]?>"><img src="winko/system/winko_img/manager/btn_modify_small.gif" alt="수정" align="absmiddle" border="0"></a></td>
								<td><a href="javascript:goodsDel('<?=$row[product_name]?>', <?=$row[idx]?>, <?=$row[menu_idx]?>);"><img src="winko/system/winko_img/manager/btn_delete_small.gif" alt="삭제" align="absmiddle" border="0"></a></td>
							</tr>
							</form>
							<?
								$listNo--;
							}
							?>
							<? if( !$totalList ) { ?>
							<tr align="center">
								<td height="70" colspan="7" align="center"> 등록된 제품이 없습니다.</td>
							</tr>
							<?}?>
						</table>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="submenu">
							<tr>
								<td height="40" align="center" valign="middle"><?=goods( $part_idx, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, "<img src='/img/prev.gif' border='0'>", "<img src='/img/next.gif' border='0'>", $search_item, $search_order );?></td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<?
							$check[$search_item]=" selected";
							?>
							<form method="post" name="goods_search_form" action="/admin.php?option=product">
							<input type="hidden" name="part_code" value="<?=$part_code?>">
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td height="25">
									<select name="search_item" class="input">
										<option value="1" <?=$check[1]?>>제품명</option>
										<option value="2"  <?=$check[2]?>>제품코드</option>
									</select>
									<input name="search_order" type="text" class="input"> <a href="javascript:search();"><img src="winko/system/winko_img/manager/icon_search.gif" align="absmiddle" border="0"></a>
								</td>
							</tr>
							</form>
						</table>
						<?} else {?>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="menu">
							<tr>
								<td height="30" align="center"><font color="#FF0000">! 카테고리를 선택해 주세요</font></td>
							</tr>
						</table>
						<?}?><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


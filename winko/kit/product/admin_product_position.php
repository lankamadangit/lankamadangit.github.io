<?
$position_table = "korps_position";

$check=mysql_fetch_array(mysql_query("select * from {$top}_category"));
$subtitle = "HOT PRODUCT";

if ($rank_edit) ////////// 순서수정 
{
	$rank_query = "UPDATE $position_table SET rank='$rank' WHERE menu_idx='$menu_idx' AND idx='$position_idx'";
	$rank_result = mysql_query($rank_query);
	if (!$rank_result) {
		OnlyMsgView("저장시 에러가 발생하였습니다.");
	} else {
		OnlyMsgView("수정하였습니다.");
	}
}

// 검색어에 대해서 처리
$s_que="where idx is not null";

$temp=mysql_fetch_array(mysql_query("select count(*) from $position_table $s_que"));
$total=$temp[0];

$positionLimit = 3;
$presentLimit = 3 - $total;


//페이지 구하는 부분
if(!$page_num)$page_num=10;
$href.="&page_num=$page_num&menu_idx=$menu_idx";
if(!$page) $page=1;
$start_num=($page-1)*$page_num;
$total_page=(int)(($total-1)/$page_num)+1;

$que="select * from $position_table $s_que order by idx desc limit $start_num,$page_num";
$result=mysql_query($que) or Error(mysql_error());


//  앞에 붙는 가상번호
$number=$total-($page-1)*$page_num;
?>
<script>
function addPosition(pL,pP) {
	var form=document.positionForm;
	<? if($total_shopping >= $positionLimit){?>
	var bAdd = false;
	<?}else{?>
	var bAdd = true;
	<?}?>
	if(bAdd) {
		Action="/product_total.php?menu_idx=<?=$menu_idx?>&pL="+pL+"&pP="+pP;
		window.open(Action,"","scrollbars=yes,width=600,height=670,top=10,left=150");
	} else {
		alert("총 등록가능수 : <?=$positionLimit?>\n\n현재 등록수 : <?=$total?>\n\n더이상 등록이 불가능합니다.");
	}
}

//특정위치 삭제
function positionDel(idx) {
	Action="/change_position.php?del=1&menu_idx=<?=$menu_idx?>&idx="+idx;
	location.href=Action;
}

function select() {
	var i, chked=0;
	for(i=0;i<document.UserInfo.length;i++) {
		if(document.UserInfo[i].type=='checkbox') { 
			if(document.UserInfo[i].checked) { document.UserInfo[i].checked=false; }
			else { document.UserInfo[i].checked=true; }
		}
	}
	return false;
}

//-----------------엑셀 저장-----------------------
function make_excel() {
	var i, chked=0, cart="";
	for(i=0;i<document.UserInfo.length;i++)  {
		if(document.UserInfo[i].type=='checkbox')  {
			if(document.UserInfo[i].checked) { 
				cart = cart + "||" + document.UserInfo[i].value; 
				chked=1; 
			}
		}
	}
	if(chked) {
		cart_list.action="./make_excel.php";
		cart_list.cart.value=cart;
		cart_list.submit();
	} else { 
		cart_list.cart.value=""; 
	}
	cart_list.action="./make_excel.php";
	cart_list.submit();
	return true;
}

//-----------------중복 삭제-----------------------
function all_delete() {
	var i, chked=0, cart="";
	for(i=0;i<document.UserInfo.length;i++)  {
		if(document.UserInfo[i].type=='checkbox')  {
			if(document.UserInfo[i].checked) { 
				cart = cart + "||" + document.UserInfo[i].value; 
				chked=1; 
			}
		}
	}
	if(chked) {
		cart_list.cart.value=cart;
	} else { 
		cart_list.cart.value="";
	}
	cart_list.option3.value="deleteall";
	cart_list.submit();
	return true;
}
</script>
<style>
table.position td{background-color:#fff;}
table.position td a{color:#555;}
table.position td a.on{font-weight:bold;color:#1f4399;}
</style>

<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="21">
						<p><img src="winko/system/winko_img/manager/subtitle_head.gif" width="21" height="28" border="0"></p>
					</td>
					<td background="winko/system/winko_img/manager/subtitle_bg.gif" style="padding-top:3px; padding-left:10px;">
						<p><b><?=$subtitle?></b></p>
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
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td>
						<!-- Search {{ -->
						<table cellpadding="0" cellspacing="0" width="100%">
							<form method="post" action="<?=$PHP_SELF?>" name="search">
							<input type="hidden" name="option" value="<?=$option?>">
							<input type="hidden" name="option2" value="<?=$option2?>">
							<input type="hidden" name="s_que" value="<?=$s_que?>">
							<input type="hidden" name="page" value="1">
							<input type="hidden" name="cart" value=''>
							<?
							  $check[$keyfield]=" selected";
							?>
							<tr>
								<td>
									<table width="100%" cellpadding="3" cellspacing="1" border="0" bgcolor="#E1E1E1" align="center" class="position">
										<colgroup><col width="33%"/><col width="33%"/><col width="*"/></colgroup>
										<tr align="center" height="25" >
											<td><a href="#" onclick="location.href('/admin.php?option=product&option2=position&menu_idx=1');" <?=($menu_idx == "4" ? "class='on'" : "" )?>>HOT PRODUCT</a></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height="10"></td>
							</tr>
							</form>
						</table>
						<!-- Search }} -->
					</td>
				</tr>
				<tr>
					<td style="padding:13px 0 5px 0;">
						<table border="0" width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td width="450"><span style="font-size:12px;font-weight:bold;"><?=$subtitle?></span><span style="padding-left:10px;">현재 등록된 상품수 <b><font  color="#6600FF"><?=number_format($total)?></font></b> / <font color="#990000"><b><?=$presentLimit?></b></font>  등록 가능 상품수</span></td>
								<td><a href="javascript:addPosition(<?=$total?>,<?=$presentLimit?>);"><img src="/winko/system/winko_img/manager/entry_btn.gif" border="0"></a></td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<colgroup>
								<col width="5%" />
								<col width="15%" />
								<col width="25%"  />
								<col width="*"  />
								<col width="15%" />
								<col width="5%" />
							</colgroup>
							<tr>
								<td height="30" bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>no</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>카테고리</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>제품 사진</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>제품 이름</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>진열순위</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>삭제</b></font></p>
								</td>
							</tr>
							<?
							while($data=mysql_fetch_array($result)) {
								$shopping_qry = "SELECT * FROM korps_product WHERE menu_idx='$data[menu_idx]' and idx='$data[pro_idx]' ";
								$shopping_row = mysql_fetch_array(mysql_query($shopping_qry));

								$check_cate=mysql_fetch_array(mysql_query("select * from {$top}_category where menu_idx='$data[menu_idx]' and part_index ='1' "));
								$cate_name = $check_cate[part_name];

							?>
							<form name="posForm<?=$number?>" method="post">
							<input type="hidden" name="menu_idx" value="<?=$data[menu_idx]?>">
							<input type="hidden" name="rank_edit" value="1">
							<input type="hidden" name="position_idx" value="<?=$data[idx]?>">
							<tr>
								<td bgcolor="white">
									<p align="center"><?=$number?></p>
								</td>
								<td bgcolor="#ffffff">
									<p align="center"><strong><?=$cate_name?></strong></p>
								</td>
								<td bgcolor="#ffffff">
									<p align="center"><img align="absmiddle" src="/winko/data/product/<?=$shopping_row[product_img1]?>" border="0" width="100" height="113"></p>
								</td>
								<td bgcolor="#ffffff">
									<p align="center"><span style="font-weight:bold;"><?=$shopping_row[product_name]?></span></p>
								</td>
								<td bgcolor="#ffffff">
									<p align="center"><input value="<?=$data[rank]?>" name="rank" type="text" size="3" class="input"><br><input type="image" src="/winko/system/winko_img/manager/edit_btn.gif" border="0"></p>
								</td>
								<td bgcolor="white">
									<p align="center"><a href="javascript:positionDel('<?=$data[idx]?>');"><img src='/winko/system/winko_img/manager/btn_delete_small.gif' width='14' height='14' border='0'></a></p>
								</td>
							</tr>
							</form>
							<?
								$number--;
							}
							?>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="0" width="100%" height="30">
							<tr>
								<td>
									<b><?
									//페이지 나타내는 부분
									$show_page_num=10;
									$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
									$i=1;
									if($page>$show_page_num){
										$prev_page=$start_page-1;
										echo"<a href=$PHP_SELF?option=$option&page=$prev_page$href>[Prev]</a>";
									}
									while($i+$start_page<=$total_page&&$i<=$show_page_num) {
										$move_page=$i+$start_page;
										if($page==$move_page)echo"<b>$move_page</b>";
										else echo"<a href=$PHP_SELF?option=$option&page=$move_page$href>[$move_page]</a>";
										$i++;
									}
									if($total_page>$move_page){
										$next_page=$move_page+1;
										echo"<a href=$PHP_SELF?option=$option&page=$next_page$href>[Next]</a>";
									}
									//페이지 나타내는 부분 끝
									?></b>
								</td>
							</tr>
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

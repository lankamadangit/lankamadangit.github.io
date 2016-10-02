<?
$goods_result = mysql_query("SELECT * FROM  {$top}_product WHERE idx = $idx AND menu_idx=$menu_idx");
$goods_row= mysql_fetch_array($goods_result);

$product_size=explode("X",$goods_row[product_size]);
if ($goods_row[product_img1]) {	// 해당 이미지가 존재하면
	$info = @getimagesize("winko/data/product/$goods_row[product_img1]");
	$wSize = $info[0];
	$hSize = $info[1];
	$image_rate = $hSize / $wSize;

	if($wSize > 150) {
		$wSize = "150";
		$hSize= round(150*$image_rate);
	}
} 

?>
<SCRIPT LANGUAGE="JavaScript">
<!--
//상품 등록
function goodsSendit() {
	var form=document.goodsForm;
//	var oEditor = FCKeditorAPI.GetInstance('content1');
//	var oEditor2 = FCKeditorAPI.GetInstance('content2');

	if(!form.product_name.value) {
		alert("Product Name를 입력해 주십시오.");
		form.product_name.focus(); 
		return false;
	}else if(form.del_check.checked == true) {
		if(!form.img1.value) {
			alert("Image를 등록하여 주십시오.")
			form.img1.focus();
			return false;
		}
	}
	form.submit();//전송
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
while($part1_row = mysql_fetch_object($part1_result) ) {
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
	f = document.goodsForm;   // 선택된 Form;

	if ( depth == 1 && index != -1)  // 대분류 선택 시
	{
		sp_value = f.select1[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];

		for ( i = f.select2.length; i >= 0; i-- ) {
			f.select2[i] = null;
		}
		goodsForm.part_code.value = "카테고리를 선택하세요";
		if ( depth2[sp_value2] != null )
		{

			for ( i = 0 ; i <= depth2[sp_value2].length -1 ; i++ )
			{
				f.select2.options[i] = new Option(depth2[sp_value2][i],depth2_value[sp_value2][i] + sep + sp_value2 + sep + i );
			}
		}
		else
		{
//			alert("2차 카테고리는 없습니다.");
			goodsForm.part_code.value = depth1_value[sp_value2];
			alert("카테고리 수정 완료 \n\n 제품을 등록 하세요 ");
			goodsForm.product_name.focus();
		}


		// 카테고리 2를 초기화 되면 카테로기 3은 모두 삭제한다.
		//for ( i = f.select3.length; i >= 0; i-- ) {
		//	f.select3[i] = null;
		//}
	}
	else if ( depth == 2 && index != -1 )   // 중분류 선택 시
	{
		sp_value = f.select2[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];
		sp_value3 = sp_value[2];

		//for ( i = f.select3.length; i >= 0; i-- ) {
		//	f.select3[i] = null;
		//}
		goodsForm.part_code.value = "카테고리를 선택하세요";
		if ( depth3[sp_value2][sp_value3] != null )
		{

			for ( i = 0 ; i <= depth3[sp_value2][sp_value3].length -1 ; i++ )
			{
				f.select3.options[i] = new Option(depth3[sp_value2][sp_value3][i],depth3_value[sp_value2][sp_value3][i]);
			}
		}
		else
		{
//			alert("3차 카테고리는 없습니다.");
			goodsForm.part_code.value = depth2_value[sp_value2][sp_value3];
			alert(" 카테고리 수정 완료 \n\n 제품을 등록 하세요");
			goodsForm.product_name.focus();
		}
	}
	else if ( depth == 3 && index != -1 )
	{
		goodsForm.part_code.value = f.select3[index].value;
		alert(" 카테고리 수정 완료 \n\n 제품을 등록 하세요");
		goodsForm.product_name.focus();
	}
}
////  카테고리 선택 폼 설정 종료 //////////////////////////////////////////////////////////////////////////


//-->
</script>
<script>  
	var rowIndex = 2;
	function addFile(form,k){
		if(rowIndex > (10-k)) return false;  
		var oCurrentRow,oCurrentCell;  
		var sAddingHtml;  
		oCurrentRow = insertTable.insertRow();  
		rowIndex = oCurrentRow.rowIndex;  
		oCurrentCell = oCurrentRow.insertCell();  
		rowIndex++;  
		var strHTML =  "<tr>";  
		//strHTML += "<td>"+ rowIndex +"</td>";  
		strHTML += "<td><input class=box type=text name='oem" +rowIndex + "' size=60></td>";  
		strHTML += "</tr>";         
		
		oCurrentCell.innerHTML = strHTML;
		form.rowCount.value = rowIndex;
	}

	//첨부파일 삭제  
	function deleteFile(form){  
		if(rowIndex<2){
			return false;  
		}else{
			form.rowCount.value = form.rowCount.value - 1;  
			rowIndex--;  
			insertTable.deleteRow(rowIndex);  
		}
	}
</script>  
<? include "fckeditor/fckeditor.php";?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
			<form name="goodsForm" method="post" action="admin.php?option=product&mode=edit" enctype="multipart/form-data" >
			<input type="hidden" name="option" value="product">
			<input type="hidden" name="mode" value="edit">
			<input type="hidden" name="idx" value="<?=$idx?>">
			<input type="hidden" name="menu_idx" value="<?=$menu_idx?>">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif" bgcolor="#F5F5F5"></td>
				</tr>
				<tr valign="middle">
					<td width="160" height="35" bgcolor="#F2F2F2"> <div align="left">&nbsp;&nbsp;<img src="winko/system/winko_img/manager/icon.gif" width="11" height="11"> <FONT  COLOR="#627DBC"><b>Category</b></font></div></td>
					<td colspan="3">
						<table width="100%" border="0" cellpadding="3" cellspacing="0" bordercolor='#BDBEBD' class="menu" style='border-collapse: collapse'>
							<tr>
								<td height="140" style="padding-top:10px;">
									<table width="610" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td width="290" height="30" align="center" valign="top"><img src="img/admin/category/category1.gif" alt="1차카테고리"></td>
											<td width="290" height="30" align="center" valign="top"><img src="img/admin/category/category2.gif" alt="2차카테고리"></td>
											<td width="210" height="30" align="center" valign="top"><!--img src="img/admin/category/category3.gif" alt="3차카테고리"--></td>
										</tr>
										<tr>
											<td height="22" align="center" valign="middle">
												<select name="select1" size="10" style="background-color:EFEFEF; width:290;height:200;" onClick='change(1, this.form.select1.selectedIndex, this.form)' class="input">
													<script language = "javascript">
													for ( i = 0 ; i <= depth1.length -1 ; i++ ){	document.write ("<option value='"+ depth1_value[i] + sep + i + "' >" + depth1[i] + "</option>");}
													</script>
												</select>
											</td>
											<td align="center" valign="middle">
												<select name="select2" size="10" style="background-color:EFEFEF; width:290;height:200;"  onclick='change(2, this.form.select2.selectedIndex, this.form)' class="input"></select>
											</td>
											<td align="center" valign="middle">
												<!--select name="select3" size="10" onclick='change(3, this.form.select3.selectedIndex, this.form)' style="background-color:EFEFEF; width:200;height:200;" class="input"></select-->
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif"></td>
				</tr>
				<tr>
					<td width="160" height="35" bgcolor="#F2F2F2">&nbsp;&nbsp;<img src="winko/system/winko_img/manager/icon.gif" width="11" height="11"><FONT  COLOR="#627DBC"><b>Category Code</b></font></td>
					<td height="25" colspan="3">&nbsp;&nbsp;<input name="part_code" type="text" maxlength="20" size="30" class="box" style='text-align: center; color: #FF0000 ;'  readOnly  value="<?=$goods_row[category_code]?>">&nbsp;&nbsp;( <font color="#FF0000">! 주의</font> : 카테고리 수정시에만 카테고리를 선택하여 주십시오.)</td>
				</tr>
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif"></td>
				</tr>
				<tr>
					<td colspan="4" height="10">&nbsp;</td>
				</tr>
				<tr>
					<td  colspan="4" height="30" align="center"  bgcolor="#000000"><font color="white"><b>기 본 정 보</b></font></td>
				<tr>
					<td height="10" colspan="4"></td>
				</tr>
				<tr>
					<td height="1" bgcolor="#85ACCF" colspan="4"></td>
				</tr>
				<tr valign="middle">
					<td width="160" height="35" bgcolor="#F2F2F2"> <div align="left">&nbsp;&nbsp;<img src="winko/system/winko_img/manager/icon.gif" width="11" height="11"> <FONT  COLOR="#627DBC"><b>Product Code</b></FONT></div></td>
					<td height="35" colspan="3" style="padding-left:5px;"><b><?=$goods_row[product_code]?></b>&nbsp;&nbsp;<span style="padding-left:30px;">* 상품코드는 수정할 수 없습니다.</span></td>
				</tr>
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif"></td>
				</tr>
				<tr>
					<td width="160" height="35" bgcolor="#F2F2F2">&nbsp;&nbsp;<img src="winko/system/winko_img/manager/icon.gif" width="11" height="11"> <FONT  COLOR="#FF0000"><b>Product Name</b></FONT></td>
					<td height="35" colspan="3" style="padding-left:5px;"><input class="box" name="product_name" type="text" size="60" value="<?=$goods_row[product_name]?>"></td>
				</tr>
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif"></td>
				</tr>
				<tr valign="middle">
					<td width="160" height="35" bgcolor="#F2F2F2"> &nbsp;&nbsp;<img src="winko/system/winko_img/manager/icon.gif" width="11" height="11"><font color="627DBC"><b>Product Image</b></font></td>
					<td height="35" colspan="3" style="padding:0 0 5px 13px;"><? if ($goods_row[product_img1]) { ?><img align="absmiddle" style="border-width:1px;border-color:#eeeeee;border-style:solid;" src="/winko/data/product/<?=$goods_row[product_img1]?>" width="<?=$wSize ?>" height="<?=$hSize?>">&nbsp;&nbsp;&nbsp;<br/><u><?=$goods_row[product_img1]?></u>&nbsp;&nbsp;&nbsp;/ &nbsp;<font color="#ff0000">Delete</font> : <input type="checkbox" name="del_check" value="1"><br /><br /><? } ?> <input class="box" type="file" size="20" name="img1">&nbsp;&nbsp;* 이미지명은 영문으로 입력하여 주십시오.(133X116 pixels)</td>
				</tr>
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif"></td>
				</tr>
				<tr valign="middle">
					<td width="160" height="35" bgcolor="#F2F2F2"> &nbsp;&nbsp;<img src="winko/system/winko_img/manager/icon.gif" width="11" height="11"><font color="627DBC"><b>Product PDF</b></font></td>
					<td height="35" colspan="3" style="padding:0 0 5px 13px;"><? if ($goods_row[userfile]) { ?><u><?=$goods_row[userfile]?></u>&nbsp;&nbsp;&nbsp;/ &nbsp;<font color="#ff0000">Delete</font> : <input type="checkbox" name="del_check1" value="1"><br /><br /><? } ?> <input class="box" type="file" size="20" name="userfile">&nbsp;&nbsp;* PDF명은 영문으로 입력하여 주십시오.</td>
				</tr>
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif"></td>
				</tr>
				<tr>
					<td width="160" height="35" bgcolor="#F2F2F2">&nbsp;&nbsp;<img src="winko/system/winko_img/manager/icon.gif" width="11" height="11"> <FONT  COLOR="#627DBC"><b>Summary</b></FONT></td>
					<td height="35" colspan="3" style="padding-left:5px;">
					<textarea name="summary" rows='5' cols='80'><?=$goods_row[summary]?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif"></td>
				</tr>
				<tr>
					<td width="160" height="35" bgcolor="#F2F2F2">&nbsp;&nbsp;<img src="winko/system/winko_img/manager/icon.gif" width="11" height="11"> <FONT  COLOR="#627DBC"><b>Content</b></FONT></td>
					<td colspan="3" align="center" style="padding-left:5px;">
					<?
					$oFCKeditor = new FCKeditor( 'content1' ); 
					$oFCKeditor->BasePath = 'fckeditor/'; 
					$oFCKeditor->Value = stripslashes($goods_row[content1]); 
					$oFCKeditor->Width = 615;
					$oFCKeditor->Height = 300;
					$oFCKeditor->Create();
					?>
					</td>
				</tr>
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif"></td>
				</tr>
				<tr>
					<td width="160" height="35" bgcolor="#F2F2F2">&nbsp;&nbsp;<img src="winko/system/winko_img/manager/icon.gif" width="11" height="11"> <FONT  COLOR="#627DBC"><b>Specification</b></FONT></td>
					<td colspan="3" align="center" style="padding-left:5px;">
					<?
					$oFCKeditor = new FCKeditor( 'content2' ); 
					$oFCKeditor->BasePath = 'fckeditor/'; 
					$oFCKeditor->Value = stripslashes($goods_row[content2]); 
					$oFCKeditor->Width = 615;
					$oFCKeditor->Height = 300;
					$oFCKeditor->Create();
					?>
					</td>
				</tr>
				<tr>
					<td colspan="4" height="1" background="winko/system/winko_img/manager/line_bg1.gif"></td>
				</tr>
				<tr valign="middle">
					<td colspan="4" height="50"> 
						<table border="0" align="center">
							<tr>
								<td><a href="#" onclick="javascript:goodsSendit();"><img src="winko/system/winko_img/manager/entry_btn1.gif" width="40" height="17" border="0" hspace="2"></a></td>
								<td><a href="admin.php?option=product&part_idx=<?=$goods_row[part_idx]?>"><img src="winko/system/winko_img/manager/cancel_btn.gif" width="40" height="17" border="0" hspace="2"></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form><!-- goodsForm -->
		</td>
	</tr>
</table>
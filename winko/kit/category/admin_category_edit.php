<SCRIPT LANGUAGE="JavaScript">
<!--
function inputCheckSpecial(obj) {
	var ft = "true";
	obj = obj.elements; 
	for (var i = 0; i < obj.length; i++)
	{
		if( obj[i].type == "text" ||obj[i].type == "password")
		{
			var strobj = obj[i].value;
			re = /[/]/gi;
			if(re.test(strobj))
			{
				obj[i].focus();
				return false;
			}
		}
	}
	return true;
}

//대분류 수정
function cateSendit() {
	var form=document.cateForm;
	if(form.name.value =="")
	{
		alert("카테고리명을 입력해 주십시오.");
		form.name.focus();
		return false;
	}
//	else if(!inputCheckSpecial(form))
//	{
//		alert('슬래쉬(/)는 시스템에 영향이 있을수 있어 사용하실 수 없습니다');
//		form.name.focus();
//		return false;
//	}
	else
	{
		return true;
	}
}

//중분류 입력
function mincateSendit() {
	var form=document.minForm;
	if(form.name.value =="")
	{
		alert("카테고리명을 입력해 주십시오.");
		form.name.focus();
		return false;
	}
	else
	{
		return true;
	}
}

//중분류 삭제
function categoryDel(cateName) {
	var choose = confirm(cateName+"\n\n분류의 모든 상품이 삭제됩니다.\n\n삭제 하시겠습니까?");
	if(choose)
	{
		location.href="admin.php?option=category&option2=edit&mode=del&category=<?=$parentcode?>";
	}
	else return;
}

function code_change(code) {
	var form = document.cateForm;
	var str = form.good_code.value;
	location.href="category_edit.php?parentcode="+code+"&new_good_code="+str;
}
//-->
</SCRIPT>
<?
$cate_result = mysql_query("SELECT * FROM {$top}_category WHERE idx = $idx AND part_index=$hidden_part_index");
$cate_row= mysql_fetch_array($cate_result);

?>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="21">
						<p><img src="winko/system/winko_img/manager/subtitle_head.gif" width="21" height="28" border="0"></p>
					</td>
					<td background="winko/system/winko_img/manager/subtitle_bg.gif" style="padding-top:3px; padding-left:10px;">
						<p><b><?=$hidden_part_index ?>차카테고리 수정</b></p>
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
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC" align="center">
							<tr>
								<td bgcolor="#FFFFFF">
									<form name="cateForm" method="post" action="<?=$PHP_SELF?>" enctype="multipart/form-data" onSubmit="return cateSendit();">
									<input type="hidden" name="option" value="category">
									<input type="hidden" name="mode" value="edit">
									<input type="hidden" name="hidden_part_index" value="<?=$hidden_part_index ?>">
									<input type="hidden" name="idx" value="<?=$idx ?>">
									<input type="hidden" name="part1_code" value="<?=$cate_row[part1_code]?>">
									<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td colspan="2" height="50" class="cate_title"><span style="color:#ff0000">* </span><?=$hidden_part_index ?>차 카테고리</td>
										</tr>
										<tr>
											<td colspan="2">
												<table width="100%" border="0" cellspacing="1" cellpadding="3" align="center" style="padding-left:5px;"  bgcolor="#E1E1E1">
													<colgroup>
														<col width="30%" />
														<col width="70%"  />
													</colgroup>
													<tr>
														<td colspan="2" height="1" bgcolor="#85ACCF"></td>
													</tr>
													<tr>
														<td height="35" bgcolor="#F5F5F5">&nbsp;<b><?=$hidden_part_index?>차 코드</b></td>
														<td bgcolor="#FFFFFF"> &nbsp;&nbsp;<b><?=$cate_row[part.$hidden_part_index._code]?></b> <span style="padding-left:30px;color:#ff0000;">* 카테고리 코드는 수정할 수 없습니다.</span></td>
													</tr>
													<tr>
														<td height="35" bgcolor="#F5F5F5">&nbsp;<b>카테고리명</b></td>
														<td bgcolor="#FFFFFF"> &nbsp;&nbsp; <input type="text" name="name" size="40" value="<?=$cate_row[part_name]?>">
													</tr>
													<?if($hidden_part_index < "2") {?>
													<tr>
														<td height="35" bgcolor="#F5F5F5">&nbsp;<b><?=$hidden_part_index+1?>차 카테고리설정</b></td>
														<td bgcolor="#FFFFFF"> &nbsp;&nbsp; <input type="radio" name="part_low_check" value="0" <?=($cate_row[part_low_check] == "0" ? "checked" : "")?>>&nbsp;미사용&nbsp;&nbsp;<input type="radio" name="part_low_check" value="1" <?=($cate_row[part_low_check] == "1" ? "checked" : "")?>>사용</td>
													</tr>
													<? }?>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2" height="45">
												<table border="0" align="center">
													<tr>
														<td><div align="center"><input type="image" src="winko/system/winko_img/manager/icon_register2.gif" width="45" height="19" border="0"></div></td>
														<td><div align="center"><a href="javascript:history.back() "><img src="winko/system/winko_img/manager/icon_cancel.gif" width="45" height="19" border="0"></a></div></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									</form><!-- cateForm -->
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
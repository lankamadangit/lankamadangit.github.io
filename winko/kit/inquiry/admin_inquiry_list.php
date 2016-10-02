<?
if(!$select) $select = "inquiry";

$total_inquiry=mysql_fetch_array(mysql_query("select count(*) from {$top}_{$select}"));
$total_inquiry=$total_inquiry[0];

// 검색어에 대해서 처리
$s_que="where Company != 'Null'";
if($Startdate || $Enddate){

	if(!$Startdate) $Startdate = "1980-01-01";
	if(!$Enddate) {
		$today=date("Y-m-d");
		$Enddate = $today;
	}

	$Startdate_ex=explode("-",$Startdate);
	$Enddate_ex=explode("-",$Enddate);
	$Startdate_mk = mktime(0,0,1,$Startdate_ex[1],$Startdate_ex[2],$Startdate_ex[0]);
	$Enddate_mk = mktime(23,59,59,$Enddate_ex[1],$Enddate_ex[2],$Enddate_ex[0]);
	
	if($keyword) {
		$s_que.=" and (Reg_date>=$Startdate_mk and Reg_date<=$Enddate_mk) and ($keyfield like '%$keyword%')";
		$href.="&keyfield=$keyfield&keyword=$keyword&Startdate=$Startdate&Enddate=$Enddate&State=$State&sort_company=$sort_company&sort_company2=$sort_company2";
	} else {
		$s_que.=" and (Reg_date>=$Startdate_mk and Reg_date<=$Enddate_mk)";
		$href.="&Startdate=$Startdate&Enddate=$Enddate&State=$State&sort_company=$sort_company&sort_company2=$sort_company2";
	}
} else {  
	if($keyword) {
		$s_que.=" and ($keyfield like '%$keyword%')";
		$href.="&keyfield=$keyfield&keyword=$keyword&State=$State&sort_company=$sort_company&sort_company2=$sort_company2";
	}
}

if($Catalog_s) $s_que.=" and ($Catalog_s='1')";  
if($State) $s_que.=" and (State='$State')";  
$href.="&keyfield=$keyfield&keyword=$keyword&Startdate=$Startdate&Enddate=$Enddate&State=$State";

$temp=mysql_fetch_array(mysql_query("select count(*) from {$top}_{$select} $s_que"));
$search_data=$temp[0];

//페이지 구하는 부분
if(!$page_num)$page_num=15;
$href.="&page_num=$page_num";
if(!$page) $page=1;
$start_num=($page-1)*$page_num;
$search_data_page=(int)(($search_data-1)/$page_num)+1;

// 멤버정보를 구해옴
if($sort_company) $que="select * from {$top}_{$select} $s_que order by Company limit $start_num,$page_num";
elseif($sort_company2) $que="select * from {$top}_{$select} $s_que order by Company desc limit $start_num,$page_num";
else $que="select * from {$top}_{$select} $s_que order by no desc limit $start_num,$page_num";
$result=mysql_query($que) or Error(mysql_error());

//  앞에 붙는 가상번호
$number=$search_data-($page-1)*$page_num;
?>
<script>
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

function sendmail() {
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
		search.cart.value=cart;
	} else { 
		search.cart.value=""; 
	}
	search.option2.value="sendmail";
	search.submit();
	return true;
}

//-----------------달력선택 입력-----------------------
var old='';
function view(name,flag){

	if(flag == 'Startdate') {
		calStr.style.pixelTop = img1.offsetTop + 200;
		calStr.style.pixelLeft = img1.offsetLeft + 370;
		show_cal('',calStr,'Startdate');
	} else {
		calStr.style.pixelTop = img2.offsetTop + 200;
		calStr.style.pixelLeft = img2.offsetLeft + 370;
		show_cal('',calStr,'Enddate');
	}

	submenu=eval(name+".style");

	if(old!=submenu) {
		if(old!='') {
			old.visibility='hidden';
		}
		submenu.visibility='visible';
		old=submenu;
	} else {
		submenu.visibility='hidden';
		old='';
	}
}

function insert(str1,str2){
	if(str2 == 'Startdate'){
		document.search.Startdate.value = str1;
		calStr.style.visibility='hidden';
		old='';
	} else {
		document.search.Enddate.value = str1;
		calStr.style.visibility='hidden';
		old='';
	}
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
		cart_list.cart.value=cart;
	} else { 
		cart_list.cart.value=""; 
	}
	cart_list.mode.value="make_excel";
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
	cart_list.mode.value="deleteall";
	cart_list.submit();
	return true;
}
</script>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="21">
						<p><img src="winko/system/winko_img/manager/subtitle_head.gif" width="21" height="28" border="0"></p>
					</td>
					<td background="winko/system/winko_img/manager/subtitle_bg.gif" style="padding-top:3px; padding-left:10px;">
						<p><b>상담관리</b></p>
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
							<input type="hidden" name="option" value="<?=$option?>" />
							<input type="hidden" name="select" value="<?=$select?>" />
							<input type="hidden" name="option2" value="<?=$option2?>" />
							<input type="hidden" name="s_que" value="<?=$s_que?>" />
							<input type="hidden" name="page" value="1" />
							<input type="hidden" name="cart" value='' />
							<?
							  $check[$keyfield]=" selected";
							?>
							<tr>
								<td>
									<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#CCCCCC">
										<tr>
											<td width="150" bgcolor="#F6F6F6" style="padding-right:8px;">
												<p align="right">
													<select name="keyfield" class="input"> 
														<option value="Subject"<?=$check[Subject]?>>Subject</option>
														<option value="Company"<?=$check[Company]?>>Company</option> 
														<option value="Name"<?=$check[Name]?>>Name</option>
													</select>
												</p>
											</td>
											<td width="250" bgcolor="white" style="padding-left:8px;"><input type="text" name="keyword" value="<?=$keyword?>" class="input"></td>
											<?
											  unset($check);
											  $check[$State]=" selected";
											?>
											<td width="100" bgcolor="#F6F6F6" style="padding-right:8px;"><p align="right"><b>상태</b></td>
											<td bgcolor="white" style="padding-left:8px;">
												<select name="State" class="input">
													<option value="">-선택-</option>
													<option value="2" <?=$check[2]?>>완료</option>
													<option value="1" <?=$check[1]?>>처리중</option>
												</select>
											</td>
										</tr>
										<tr>
											<td width="150" bgcolor="#F6F6F6" style="padding-right:8px;">
												<p align="right"><b>등록일</b></td>
											<td width="250" bgcolor="white" style="padding-left:8px;"><INPUT onclick="javascript:view('calStr','Startdate')" maxLength=10 size=12 name=Startdate class=input value="<?=$Startdate?>"> <a href="javascript:view('calStr','Startdate')" name=img1><img src="winko/system/winko_img/manager/icon_calendar.gif" width="13" height="14" border="0" align="absmiddle"></a> ~ <INPUT onclick="javascript:view('calStr','Enddate')" maxLength=10 size=12 name=Enddate class=input value="<?=$Enddate?>"> <a href="javascript:view('calStr','Enddate')" name=img2><img src="winko/system/winko_img/manager/icon_calendar.gif" width="13" height="14" border="0" align="absmiddle"></a><div id=calStr style='position:absolute; top:178; left:790; visibility:hidden; width:; z-index:1 ;'></div></td>
											<?
											  unset($check);
											  $check[$page_num]=" selected";
											?>
											<td width="100" bgcolor="#F6F6F6" style="padding-right:8px;"><p align="right"><b>줄수</b></td>
											<td bgcolor="white" style="padding-left:8px;">
												<select name="page_num" class="input">
													<option value="10" <?=$check[10]?>>10줄</option> 
													<option value="15" <?=$check[15]?>>15줄</option> 
													<option value="30" <?=$check[30]?>>30줄</option> 
													<option value="50" <?=$check[50]?>>50줄</option> 
													<option value="100" <?=$check[100]?>>100줄</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td width="50%">
												<p><a href="admin.php?option=inquiry&select=<?=$select?>"><img src="winko/system/winko_img/manager/btn_renew.gif" width="60" height="19" border="0" vspace="5" hspace="10"></a></p>
											</td>
											<td width="50%">
												<p align="right"><input type="image" src="winko/system/winko_img/manager/icon_search.gif" width="47" height="19" border="0" vspace="5" hspace="10"></p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							</form>
						</table>
						<!-- Search }} -->
					</td>
				</tr>
				<tr>
					<td style="padding-top:13px;">
						<p align="right">총 : <?=$search_data?>건</p>
					</td>
				</tr>
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<colgroup><col width="6%" /><col width="6%" /><col width="*" /><col width="15%" /><col width="15%" /><col width="12%" /><col width="7%" /><col width="7%" /></colgroup>
							<tr>
								<td bgcolor="#E9F5F9">
									<p align="center"><a href=javascript: onclick="return select();"><font color="#009BC0"><b><u>선택</u></b></font></a></td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>No</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>Subject</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><?if($sort_company){echo "<a href=$PHP_SELF?option=inquiry&select=$select&sort_company2=1$href><font color=\"#009BC0\"><u><b>Company</b></u></font></a>";}  else{echo "<a href=$PHP_SELF?option=inquiry&select=$select&sort_company=1$href><font color=\"#009BC0\"><u><b>Company</b></u></font></a>";}?></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>Name</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>등록일</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>상태</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>삭제</b></font></p>
								</td>
							</tr>
							<form method="post" action="<?=$PHP_SELF?>" name="UserInfo">
							<input type="hidden" name="page" value="<?=$page?>" />
							<input type="hidden" name="option" value="<?=$option?>" />
							<input type="hidden" name="select" value="<?=$select?>" />
							<input type="hidden" name="page_num" value="<?=$page_num?>" />
							<input type="hidden" name="option2" value="<?=$option2?>" />
							<input type="hidden" name="cart" value="">
							<?
							while($data=@mysql_fetch_array($result)) {
								if($k_no==$data['no']) $k_color="yellow";
								else $k_color="#ffffff";

								if(!$data['Subject']) $data['Subject']="제목없음";

								if($data['Reg_date']){
									$Reg_date = date("Y-m-d",$data['Reg_date']);
								} else{
									$Reg_date = "-";
								}

								// 오늘 가입자 NEW 버튼 출력		  
								$today_MD=date("Y-m-d",time());
								if($today_MD==$Reg_date){	
									$new_member="<FONT color=#ff3300><B>*</B></FONT>";
								} else {
									$new_member="";
								}

								if($data['State']==2) $State = "<font color=\"#DF5614\">완료</font>";
								else $State = "처리중";

								$icon_delete = "<a href=$PHP_SELF?option=$option&select=$select&mode=delete&page=$page&no=$data[no]$href onclick=\"return confirm('삭제하시겠습니까?')\"><img src='winko/system/winko_img/manager/btn_delete_small.gif' width='14' height='14' border='0'></a>";
							?>
							<tr>
								<td bgcolor="white">
									<p align="center"><input type="checkbox" name="cart[]" value="<?=$data['no']?>" /></td>
								<td bgcolor="white">
									<p align="center"><?=$number?></p>
								</td>
								<td bgcolor="<?=$k_color?>">
									<p><a href="<?=$PHP_SELF?>?option=<?=$option?>&select=<?=$select?>&option2=view&page=<?=$page?>&no=<?=$data['no']?><?=$href?>"><?=$data['Subject']?></a><?=$new_member?></p>
								</td>
								<td bgcolor="white">
									<p align="center"><?=$data['Company']?></p>
								</td>
								<td bgcolor="white">
									<p align="center"><?=$data['Name']?></p>
								</td>
								<td bgcolor="white">
									<p align="center"><?=$Reg_date?></p>
								</td>
								<td bgcolor="white">
									<p align="center"><?=$State?></p>
								</td>
								<td bgcolor="white">
									<p align="center"><?=$icon_delete?></p>
								</td>
							</tr>
							<?
								$number--;
							}
							?>
							</form>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="0" width="100%" height="30">
							<tr>
								<td>
									<p>
									<?
									//페이지 나타내는 부분
									$show_page_num=10;
									$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
									$i=1;
									if($page>$show_page_num){
										$prev_page=$start_page-1;
										echo"<a href=$PHP_SELF?option=inquiry&select=$select&page=$prev_page$href>[Prev]</a>";
									}
									while($i+$start_page<=$search_data_page&&$i<=$show_page_num) {
										$move_page=$i+$start_page;
										if($page==$move_page)echo"<b>$move_page</b>";
										else echo"<a href=$PHP_SELF?option=inquiry&select=$select&page=$move_page$href>[$move_page]</a>";
										$i++;
									}

									if($search_data_page>$move_page){
										$next_page=$move_page+1;
										echo"<a href=$PHP_SELF?option=inquiry&select=$select&page=$next_page$href>[Next]</a>";
									}
									//페이지 나타내는 부분 끝
									?>
									</p>
								</td>
								<form method="post" action="<?=$PHP_SELF?>" name="cart_list">
								<input type="hidden" name="option" value="inquiry">
								<input type="hidden" name="select" value="<?=$select?>">
								<input type="hidden" name="s_que" value="<?=$s_que?>">
								<input type="hidden" name="page" value=<?=$page?>>
								<input type="hidden" name="cart" value="">
								<input type="hidden" name="mode" value="">
								<td width="387"><p align="right"><a href="javascript:make_excel();"><img src="winko/system/winko_img/manager/icon_excel.gif" width="45" height="19" border="0" hspace="2"></a><a href="javascript:all_delete();" onclick="return confirm('삭제하시겠습니까?')"><img style="CURSOR: hand;" src="winko/system/winko_img/manager/icon_del.gif" width="45" height="19" border="0" hspace="2"></a></p></td>
								</form>
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
<script language="JavaScript" src="winko/kit/member/carenda.js"></script>

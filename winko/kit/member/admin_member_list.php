<?
  $total_member=$total_member[0];

// 검색어에 대해서 처리
$s_que="where no is not null and mem_id <> 'winko'";

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
		if($level_search>0) $s_que.=" and (signdate>=$Startdate_mk and signdate<=$Enddate_mk) and ($keyfield like '%$keyword%') and (level='$level_search')";
		else $s_que.=" and (signdate>=$Startdate_mk and signdate<=$Enddate_mk) and ($keyfield like '%$keyword%')"; 		$href.="&keyfield=$keyfield&keyword=$keyword&Startdate=$Startdate&Enddate=$Enddate&sort_nick=$sort_nick&sort_name=$sort_name&sort_sex=$sort_sex&sort_birth=$sort_birth&sort_point=$sort_point&sort_connectdate=$sort_connectdate&sort_online=$sort_online";
	}
	else {
		if($level_search>0) $s_que.=" and (signdate>=$Startdate_mk and signdate<=$Enddate_mk) and (level='$level_search')";
		else $s_que.=" and (signdate>=$Startdate_mk and signdate<=$Enddate_mk)"; 			$href.="&Startdate=$Startdate&Enddate=$Enddate&sort_nick=$sort_nick&sort_name=$sort_name&sort_sex=$sort_sex&sort_birth=$sort_birth&sort_point=$sort_point&sort_connectdate=$sort_connectdate&sort_online=$sort_online";
	}
} else {  
	if($keyword) {
		if($level_search>0) $s_que.=" and ($keyfield like '%$keyword%') and (level='$level_search')"; 
		else $s_que.=" and ($keyfield like '%$keyword%')";		$href.="&keyfield=$keyfield&keyword=$keyword&sort_nick=$sort_nick&sort_name=$sort_name&sort_sex=$sort_sex&sort_birth=$sort_birth&sort_point=$sort_point&sort_connectdate=$sort_connectdate&sort_online=$sort_online";
	} else {
		if($level_search>0) $s_que.=" and (level='$level_search')";
		else $s_que.="";
		$href.="&sort_nick=$sort_nick&sort_name=$sort_name&sort_sex=$sort_sex&sort_birth=$sort_birth&sort_point=$sort_point&sort_connectdate=$sort_connectdate&sort_online=$sort_online";
	}
} // if($Startdate || $Enddate){ } else {}

if($sort_online==1) {
	$temp=mysql_fetch_array(mysql_query("select count(*) from {$top}_connect_member"));
	$total=$temp[0];
} else {
	$temp=mysql_fetch_array(mysql_query("select count(*) from {$top}_member $s_que"));
	$total=$temp[0];
}

//페이지 구하는 부분
if(!$page_num)$page_num=10;
$href.="&page_num=$page_num&sort_nick=$sort_nick&sort_name=$sort_name&sort_sex=$sort_sex&sort_birth=$sort_birth&sort_point=$sort_point&sort_connectdate=$sort_connectdate&sort_online=$sort_online";
if(!$page) $page=1;
$start_num=($page-1)*$page_num;
$total_page=(int)(($total-1)/$page_num)+1;

  // 멤버정보를 구해옴
//  if($sort_id) $que="select * from {$top}_member $s_que order by mem_id limit $start_num,$page_num";
  if($sort_nick) $que="select * from {$top}_member $s_que order by nickname limit $start_num,$page_num";
//elseif($sort_level2) $que="select * from {$top}_member $s_que order by mem_id desc limit $start_num,$page_num";
  elseif($sort_name) $que="select * from {$top}_member $s_que order by name limit $start_num,$page_num";
  elseif($sort_name2) $que="select * from {$top}_member $s_que order by name desc limit $start_num,$page_num";
  elseif($sort_sex) $que="select * from {$top}_member $s_que order by sex limit $start_num,$page_num";
  elseif($sort_sex2) $que="select * from {$top}_member $s_que order by sex desc limit $start_num,$page_num";
  elseif($sort_birth) $que="select * from {$top}_member $s_que order by birth limit $start_num,$page_num";
  elseif($sort_birth2) $que="select * from {$top}_member $s_que order by birth desc limit $start_num,$page_num";
  elseif($sort_point) $que="select * from {$top}_member $s_que order by point1+point2 desc limit $start_num,$page_num";
  elseif($sort_point2) $que="select * from {$top}_member $s_que order by point1+point2 limit $start_num,$page_num";
  elseif($sort_connectdate) $que="select * from {$top}_member $s_que order by connectdate desc limit $start_num,$page_num";
  elseif($sort_connectdate2) $que="select * from {$top}_member $s_que order by connectdate limit $start_num,$page_num";
  
  elseif($sort_online) $que="select a.no as no, a.level as level, a.mem_id as mem_id, a.name as name, a.signdate as signdate, a.connectdate as connectdate from {$top}_member a, {$top}_connect_member b where a.mem_id=b.mem_id order by a.no desc limit $start_num,$page_num";
  elseif($sort_online==1) $que="select * from {$top}_member a, {$top}_connect_member b where a.mem_id=b.mem_id order by a.no desc";
//elseif($sort_level) $que="select * from {$top}_member $s_que order by level limit $start_num,$page_num";
//elseif($sort_level2) $que="select * from {$top}_member $s_que order by level desc limit $start_num,$page_num";
  else $que="select * from {$top}_member $s_que order by no desc limit $start_num,$page_num";
  $result=mysql_query($que) or Error(mysql_error());

  //  앞에 붙는 가상번호
  $number=$total-($page-1)*$page_num;
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


<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="21">
						<p><img src="winko/system/winko_img/manager/subtitle_head.gif" width="21" height="28" border="0"></p>
					</td>
					<td background="winko/system/winko_img/manager/subtitle_bg.gif" style="padding-top:3px; padding-left:10px;">
						<p><b>회원관리(목록)</b></p>
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
									<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#CCCCCC">
										<tr>
											<td width="150" bgcolor="#F6F6F6" style="padding-right:8px;">
												<p align="right">
													<select name="keyfield" class="input"> 
														<option value="mem_id"<?=$check[mem_id]?>>아이디</option> 
														<option value="name"<?=$check[name]?>>이름</option>
													</select>
												</td>
											<td width="250" bgcolor="white" style="padding-left:8px;"><input type="text" name="keyword" value="<?=$keyword?>" class="input"></td>
											<?
											unset($check);
											$check[$level_search]=" selected";
											?>
											<td width="100" bgcolor="#F6F6F6" style="padding-right:8px;">
												<p align="right"><b>회원등급</b></td>
											<td bgcolor="white" style="padding-left:8px;">
												<select name="level_search" class="input">
													<option>전체</option>
													<option value="1" <?=$check[1]?>>전체관리자</option>
													<option value="8" <?=$check[8]?>>정회원</option>
													<option value="9" <?=$check[9]?>>예비회원</option>
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
											<td width="100" bgcolor="#F6F6F6" style="padding-right:8px;">
												<p align="right"><b>줄수</b></td>
											<td bgcolor="white" style="padding-left:8px;">
												<select name="page_num" class="input"> 
													<option value="10"<?=$check[10]?>>10줄</option> 
													<option value="15"<?=$check[15]?>>15줄</option> 
													<option value="30" <?=$check[30]?>>30줄</option> 
													<option value="50" <?=$check[50]?>>50줄</option> 
													<option value="100"<?=$check[100]?>>100줄</option>
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
												<p><a href="admin.php?option=member&option2=voice&category=<?=$category?>"><img src="winko/system/winko_img/manager/btn_renew.gif" width="60" height="19" border="0" vspace="5" hspace="10"></a></p>
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
						<p align="right">전체 : <b><?=number_format($total_member)?></b> / 검색 : <b><?=number_format($total)?></b></p>
					</td>
				</tr>
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<tr>
								<td width="40" bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>no</b></font></p>
								</td>
								<td width="120" bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>회원등급</b></font></p>
								</td>
								<td bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>아이디</b></font></p>
								</td>
								<td width="90" bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>이름</b></font></p>
								</td>
								<td width="100" bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>등록일</b></font></p>
								</td>
								<td width="120" bgcolor="#E9F5F9">
									<p align="center"><?if($sort_connectdate){echo "<a href=$PHP_SELF?option=member&sort_connectdate2=1><font color=\"#009BC0\"><b><u>방문날자</u></b></font></a>";}else{echo "<a href=$PHP_SELF?option=member&sort_connectdate=1><font color=\"#009BC0\"><b><u>방문날자</u></b></font></a>";}?></p>
								</td>
								<td width="40" bgcolor="#E9F5F9">
									<p align="center"><?if($sort_online){echo "<a href=$PHP_SELF?option=member&sort_online=><font color=\"#009BC0\"><b><u>접속</u></b></font></a>";}else{echo "<a href=$PHP_SELF?option=member&sort_online=1><font color=\"#009BC0\"><b><u>접속</u></b></font></a>";}?></p>
								</td>
								<td width="30" bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>수정</b></font></p>
								</td>
								<td width="30" bgcolor="#E9F5F9">
									<p align="center"><font color="#009BC0"><b>삭제</b></font></p>
								</td>
							</tr>
							<form method="post" action="<?=$PHP_SELF?>" name="write">
							<input type="hidden" name="page" value="<?=$page?>">
							<input type="hidden" name="option" value="<?=$option?>">
							<input type="hidden" name="page_num" value="<?=$page_num?>">
							<input type="hidden" name="option2" value="">
							<input type="hidden" name="cart" value=''>
							<?
							while($data=mysql_fetch_array($result)) {
								if($k_no==$data[no]) $k_color="yellow";
								else $k_color="#ffffff";

								if($data[level]==1) $member_level="<font color=red>전체관리자</font>";
								elseif($data[level]==8) $member_level="<font color=blue>정회원</font>";
								elseif($data[level]==9) $member_level="예비회원";
								else $member_level=$data[level];
								//#########################접속여부##############################################
								$check=mysql_fetch_array(mysql_query("select count(*) from {$top}_connect_member where mem_id='$data[mem_id]'"));
								if($check[0]) $stat="<font color=#f20179>on</font>";
								else $stat="-";
								//##############################################################################
								if($data[signdate]){
									$signdate = date("Y-m-d",$data[signdate]);
								} else{
									$signdate = "-";
								}
								if($data[connectdate]=="0"){
									$data[connectdate] = "-";
								} else{
									$data[connectdate] = date("Y-m-d[H:i]",$data[connectdate]);
								}
								// 오늘 가입자 NEW 버튼 출력		  
								$today_MD=date("Y-m-d",time());
								if($today_MD==$signdate){	
									$new_member="<FONT color=#ff3300><B>*</B></FONT>";
								} else {
									$new_member="";
								}

								$pont_A=$data[point1]*10+$data[point2];
							?>
							<tr>
								<td width="40" bgcolor="white">
									<p align="center"><?=$number?></p>
								</td>
								<td width="120" bgcolor=#ffffff>
									<p align="center"><?=$member_level?></p>
								</td>
								<td bgcolor="<?=$k_color?>">
									<p align="center"><a  href="<?=$PHP_SELF?>?option=member&option2=view&page=<?=$page?>&no=<?=$data[no]?><?=$href?>"><u><?=$data[mem_id]?></u></a><?=$new_member?></p>
								</td>
								<td width="90" bgcolor=#ffffff>
									<p align="center"><?=$data[name]?></p>
								</td>
								<td width="100" bgcolor="white">
									<p align="center"><?=$signdate?></p>
								</td>
								<td width="120" bgcolor="white">
									<p align="center"><?=$data[connectdate]?></p>
								</td>
								<td width="40" bgcolor="white">
									<p align="center"><?=$stat?></p>
								</td>
								<td width="30" bgcolor="white">
									<p align="center"><a href="admin.php?option=member&option2=modify&page=<?=$page?>&no=<?=$data[no]?>&keyword=<?=$keyword?>"><img src='winko/system/winko_img/manager/btn_modify_small.gif' width='14' height='14' border='0'></a></p>
								</td>
								<td width="30" bgcolor="white">
									<? if($data[no]>1) {?>
									<p align="center"><a href="admin.php?option=member&option2=del&keyword=<?=$keyword?>&page=<?=$page?>&no=<?=$data[no]?><?=$href?>" onclick="return confirm('삭제하시겠습니까?')"><img src='winko/system/winko_img/manager/btn_delete_small.gif' width='14' height='14' border='0'></a></p>
									<?}?>
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
								<td width="387">
									<p align="right"><a href="admin.php?option=member&option2=add"><img src="winko/system/winko_img/manager/icon_register.gif" width="64" height="19" border="0" hspace="2"></a></p>
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
<script language="JavaScript" src="winko/kit/member/carenda.js"></script>
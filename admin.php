<?
session_start();
##### DB 접속 정보 #####
require_once("winko/system/config.php");

$members=member();

if($MEMBER_PART=="member"){
if($MEMBER_LEVEL!=1) {
	echo"<script>alert(\"관리자페이지를 사용할수 있는 권한이 없습니다.\");</script>";
	movepage("winko/include/post_logout.php?admin=1");
}
if($option == "logout") movepage("winko/include/post_logout.php?admin=1");
if($option == "info") {include "winko/kit/info/admin_info_post.php";}
if($option == "member") {include "winko/kit/member/admin_member_post.php";}
if($option == "board") {include "winko/kit/board/admin_board_post.php";}
if($option == "inquiry") {include "winko/kit/inquiry/admin_inquiry_post.php";}

###### DB 접속 데이타 받아오기 ##############
$c_today=mktime(0,0,0,date("m"),date("d"),date("Y"));
$c_yesterday=mktime(0,0,0,date("m"),date("d"),date("Y"))-3600*24;
// 회원수
$total_member=mysql_fetch_array(mysql_query("select count(*) from {$top}_member where mem_id <> 'winko'"));
$today = date("U", time());
//24시간 이전부터의 회원수
//$today_member=mysql_fetch_array(mysql_query("select count(*) from {$top}_member where $today-signdate <= 60*60*24"));
//$today_member=mysql_fetch_array(mysql_query("select count(*) from {$top}_member where signdate >= $c_today"));
//$yesterday_member=mysql_fetch_array(mysql_query("select count(*) from {$top}_member where signdate >= $c_yesterday"));

// 게시판수
$total_board=mysql_fetch_array(mysql_query("select count(*) from {$top}_boardadmin"));

// 주문의뢰
$total_inquiry=mysql_fetch_array(mysql_query("select count(*) from {$top}_inquiry"));
$today_inquiry=mysql_fetch_array(mysql_query("select count(*) from {$top}_inquiry where Reg_date >= $c_today"));
$total_inquiry_eng=mysql_fetch_array(mysql_query("select count(*) from {$top}_inquiry_eng"));
$today_inquiry_eng=mysql_fetch_array(mysql_query("select count(*) from {$top}_inquiry_eng where Reg_date >= $c_today"));

// 배너수
//  $total_banner=mysql_fetch_array(mysql_query("select count(*) from {$top}_banner"));

// 팝업공지
//  $total_popup=mysql_fetch_array(mysql_query("select count(*) from {$top}_popup"));

// 카운터
$total=mysql_fetch_array(mysql_query("select unique_counter, pageview from {$top}_counter_main where no=1"));
$count[total_hit]=$total[0];
$count[total_view]=$total[1];

// 오늘 카운터 읽어오는 부분
$detail=mysql_fetch_Array(mysql_query("select unique_counter, pageview from {$top}_counter_main where date='$c_today'"));
$count[today_hit]=$detail[0];
$count[today_view]=$detail[1];

// 어제 카운터 읽어오는 부분
$yesterday=mktime(0,0,0,date("m"),date("d"),date("Y"))-3600*24;
$detail=mysql_fetch_Array(mysql_query("select unique_counter, pageview from {$top}_counter_main where date='$yesterday'"));
$count[yesterday_hit]=$detail[0];
$count[yesterday_view]=$detail[1];

// 색 지정
if($option=="member") $base_color = "#4785FF";
elseif($option=="board") $base_color = "#D98B14";
elseif($option=="inquiry") $base_color = "#F20179";
elseif($option=="design") $base_color = "#B445F5";
elseif($option=="add") $base_color = "#8AC403";
elseif($option=="counter") $base_color = "#F23901";
else $base_color = "#FBA455";

if($MEMBER_ID=="winko"){
	$menuWidth ="16%";
} else {
	$menuWidth ="20%";
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>DYNE GLOBAL SiteManager</title>
<link rel=StyleSheet HREF="winko/system/css/winko_admin_utf.css" type=text/css title=style>
<?if($option=="add") {
	include "fckeditor/fckeditor.php";
}?>
</head>
<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td background="winko/system/winko_img/manager/menu_bg.gif">
			<table cellpadding="0" cellspacing="0" width="950" height="89" border="0">
				<tr>
					<td width="16">
						<p>&nbsp;</p>
					</td>
					<td width="184" valign="middle" style="padding-top:10px" bgcolor="white">
						<p align="center"><a href="admin.php"><img src="/img/common/admin_logo.gif" border="0" alt="DYNE GLOBAL"/></a></p>
					</td>
					<td valign="top">
						<table cellpadding="0" cellspacing="0" width="100%" bordercolordark="black" bordercolorlight="black">
							<tr>
								<td height="31">
									<p align="right"><a href="<?=$go_index?>"><img src="winko/system/winko_img/manager/btn_gohome.gif" width="102" height="19" border="0" hspace="2"></a><a href="<?=$PHP_SELF?>?option=logout"><img src="winko/system/winko_img/manager/btn_logout.gif" width="80" height="19" border="0" hspace="2"></a></p>
								</td>
							</tr>
							<tr>
								<td height="38">
									<div align="right">
										<table cellpadding="0" cellspacing="0" width="97%">
											<tr>
												<td width="<?=$menuWidth?>">
													<p align="center"><a href="admin.php?option=info"><b><font color="white">기본정보</font></b></a></p>
												</td>
												<td width="1">
													<p><b><font color="white"><img src="winko/system/winko_img/manager/menu_div.gif" width="1" height="38" border="0"></font></b></p>
												</td>
												<td width="<?=$menuWidth?>">
													<p align="center"><a href="admin.php?option=member"><b><font color="white">회원관리</font></b></a></p>
												</td>
												<td width="1">
													<p><img src="winko/system/winko_img/manager/menu_div.gif" width="1" height="38" border="0"></p>
												</td>
												<? if($MEMBER_ID=="winko"){ ?>
												<td width="<?=$menuWidth?>">
													<p align="center"><a href="admin.php?option=board"><b><font color="white">게시판관리</font></b></a></p>
												</td>
												<td width="1">
													<p><b><font color="white"><img src="winko/system/winko_img/manager/menu_div.gif" width="1" height="38" border="0"></font></b></p>
												</td>
												<? }?>
												<td width="<?=$menuWidth?>">
													<p align="center"><a href="admin.php?option=inquiry&select=inquiry_eng"><b><font color="white">상담관리</font></b></a></p>
												</td>
												<td width="1">
													<p><b><font color="white"><img src="winko/system/winko_img/manager/menu_div.gif" width="1" height="38" border="0"></font></b></p>
												</td>
												<td width="<?=$menuWidth?>">
													<p align="center"><a href="admin.php?option=add"><b><font color="white">부가기능</font></b></a></p>
												</td>
												<td width="1">
													<p><b><font color="white"><img src="winko/system/winko_img/manager/menu_div.gif" width="1" height="38" border="0"></font></b></p>
												</td>
												<td>
													<p align="center"><a href="admin.php?option=counter"><b><font color="white">로그분석</font></b></a></p>
												</td>
											</tr>
										</table>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10">
			<p><img src="winko/system/winko_img/manager/blank.gif" width="1" height="1" border="0"></p>
		</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="950">
				<tr>
					<td width="200" valign="top">
					<?
					if($MEMBER_ID=="winko"){
						if($option == "info") include "winko/kit/info/admin_info_left.php";
						elseif($option == "member") include "winko/kit/member/admin_member_left.php";
						elseif($option == "board") include "winko/kit/board/admin_board_left.php";
						elseif($option == "inquiry") include "winko/kit/inquiry/admin_inquiry_left.php";
						elseif($option == "add") include "winko/kit/add/admin_add_left.php";
						elseif($option == "counter") include "winko/kit/counter/admin_counter_left.php";
						else include "winko/admin/left_index.php";
					}
					//elseif($MEMBER_ID=="$admin_id") {
					elseif($MEMBER_LEVEL == "1") {
						if($option == "info") include "winko/kit/info/admin_info_left.php";
						elseif($option == "member") include "winko/kit/member/admin_member_left.php";
						elseif($option == "board") include "winko/kit/board/admin_board_left.php";
						elseif($option == "inquiry") include "winko/kit/inquiry/admin_inquiry_left.php";
						elseif($option == "add") include "winko/kit/add/admin_add_left.php";
						elseif($option == "counter") include "winko/kit/counter/admin_counter_left.php";
						else include "winko/admin/left_index.php";
					}
					?>
					</td>
					<td valign="top">
						<!-- 오른쪽 본문 시작 -->
						<?
						if($MEMBER_ID=="winko") {
							if($option=="info")  {
								include "winko/kit/info/admin_info.php";

							} elseif($option=="member")  { 
								if($option2=="view") {include "winko/kit/member/admin_member_view.php";}
								elseif($option2=="add") {include "winko/kit/member/admin_member_add.php";}
								elseif($option2=="modify") {include "winko/kit/member/admin_member_add.php";}
								elseif($option2=="sendmail") {include "winko/kit/member/sendmail.php";}
								else {include "winko/kit/member/admin_member_list.php";} 

							} elseif($option=="board") {
								if($option2=="add") {include "winko/kit/board/admin_board_add.php";}
								elseif($option2=="modify") {include "winko/kit/board/admin_board_add.php";}
								elseif($option2=="grant") {include "winko/kit/board/admin_board_grant.php";}
								else {include "winko/kit/board/admin_board_list.php";}

							} elseif($option=="inquiry")  { 
								if($option2=="view") {include "winko/kit/inquiry/admin_inquiry_view.php";}
								elseif($option2=="modify") {include "winko/kit/inquiry/admin_inquiry_modify.php";}
								else {include "winko/kit/inquiry/admin_inquiry_list.php";}
							
							} elseif($option=="design") { 
								include "winko/admin/error.php"; 
							
							} elseif($option=="add")  { 
								if($option2=="banner_list") { include "winko/kit/add/admin_banner_list.php"; }
								elseif($option2=="banner_add") { include "winko/kit/add/admin_banner_add.php"; }
								elseif($option2=="popup_list") { include "winko/kit/add/admin_popup_list.php"; }
								elseif($option2=="popup_add") { include "winko/kit/add/admin_popup_add.php"; }
								else {include "winko/kit/add/admin_popup_list.php"; }

							} elseif($option=="counter") { 
								include "winko/kit/counter/admin_counter.php"; 

							} else {
								include "winko/admin/index.php";
							}
						}

						//elseif($MEMBER_ID=="$admin_id")
						else {
							if($option=="info")  { 
								include "winko/kit/info/admin_info.php";

							} elseif($option=="member")  { 
								if($option2=="view") {include "winko/kit/member/admin_member_view.php";}
								elseif($option2=="add") {include "winko/kit/member/admin_member_add.php";}
								elseif($option2=="modify") {include "winko/kit/member/admin_member_add.php";}
								elseif($option2=="sendmail") {include "winko/kit/member/sendmail.php";}
								else {include "winko/kit/member/admin_member_list.php";} 

							} elseif($option=="board") {
								if($option2=="add") {include "winko/kit/board/admin_board_add.php";}
								elseif($option2=="modify") {include "winko/kit/board/admin_board_add.php";}
								elseif($option2=="grant") {include "winko/kit/board/admin_board_grant.php";}
								else {include "winko/kit/board/admin_board_list.php";}

							} elseif($option=="inquiry")  { 
								if($option2=="view") {include "winko/kit/inquiry/admin_inquiry_view.php";}
								elseif($option2=="modify") {include "winko/kit/inquiry/admin_inquiry_modify.php";}
								else {include "winko/kit/inquiry/admin_inquiry_list.php";}

							} elseif($option=="design") { 
								include "winko/admin/error.php"; 
							
							} elseif($option=="add")  { 
								if($option2=="banner_list") { include "winko/kit/add/admin_banner_list.php"; }
								elseif($option2=="banner_add") { include "winko/kit/add/admin_banner_add.php"; }
								elseif($option2=="popup_list") { include "winko/kit/add/admin_popup_list.php"; }
								elseif($option2=="popup_add") { include "winko/kit/add/admin_popup_add.php"; }
								else {include "winko/kit/add/admin_popup_list.php"; }

							} elseif($option=="counter") { 
								include "winko/kit/counter/admin_counter.php"; 
							
							} else {
								include "winko/admin/index.php";
							}
						}

						//else {include "winko/admin/index.php";}
						?>
						<!-- 오른쪽 본문 끝 -->
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<p>&nbsp;</p>
		</td>
	</tr>
	<tr>
		<td bgcolor="#F6F6F6">
			<table cellpadding="0" cellspacing="0" width="950" height="28">
				<tr>
					<td><P align=center><SPAN class=Arial8>COPYRIGHT (C) DYNE GLOBAL CO LTD. ALL RIGHTS RESERVED</SPAN></P></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<p>&nbsp;</p>
		</td>
	</tr>
</table>
</body>
</html>

<?
}
else {
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>관리자모드</title>
<link rel=StyleSheet HREF="winko/system/css/winko_admin.css" type=text/css title=style>
<script>
function check_submit() {
	if(!login.PHP_AUTH_USER.value) {
		alert("아이디를 입력하여 주십시오.");
		login.PHP_AUTH_USER.focus();
		return false;
	}
	if(!login.PHP_AUTH_PW.value) {
		alert("비밀번호를 입력하여 주십시오.");
		login.PHP_AUTH_PW.focus();
		return false;
	}
	return true;
	}
function MoveFocus() {
	document.login.PHP_AUTH_USER.focus();
	return;
}
</script>
</head>
<body bgcolor="#f2f2f2" text="black" link="blue" vlink="purple" alink="red" onload="MoveFocus();">
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td>
			<table align="center" cellpadding="0" cellspacing="0" width="515">
				<tr>
					<td>
						<table cellpadding="4" cellspacing="1" width="100%" bgcolor="#C2C2C2">
							<tr>
								<td bgcolor="white">
									<table cellpadding="0" cellspacing="1" width="100%" height="182" bgcolor="#E7E7E7">
										<tr>
											<td bgcolor="white">
												<table cellpadding="0" cellspacing="0" width="100%">
													<FORM action='winko/include/post_login.php' method='post' onsubmit='return check_submit();' name=login>
													<input type=hidden name=move value=admin>
													<tr>
														<td width="155">
															<p align="center"><img src="/img/common/admin_logo.gif" border="0" alt="DYNE GLOBAL"/></p>
														</td>
														<td width="2" bgcolor="#C1C6D0"></td>
														<td>
															<table cellpadding="0" cellspacing="0" width="100%">
																<tr>
																	<td width="114">
																		<p><img src="winko/system/winko_img/manager/login_id.gif" width="114" height="29" border="0"></p>
																	</td>
																	<td><INPUT class=input maxLength=20 name=PHP_AUTH_USER style="width:121px"></td>
																</tr>
																<tr>
																	<td width="114">
																		<p><img src="winko/system/winko_img/manager/login_pw.gif" width="114" height="29" border="0"></p>
																	</td>
																	<td><INPUT class=input maxLength=20 name=PHP_AUTH_PW style="width:121px" type=password value=""></td>
																</tr>
															</table>
														</td>
														<td>
															<p><INPUT type="image" align=absMiddle src="winko/system/winko_img/manager/login_login.gif" width="77" height="49" border="0"></p>
														</td>
													</tr>
													</form>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<p align="center"><span class="Arial8">COPYRIGHT (C) DYNE GLOBAL CO LTD. ALL RIGHTS RESERVED.</span></p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
<?
}
?>

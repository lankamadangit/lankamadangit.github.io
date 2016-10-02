<?
$data=mysql_fetch_array(mysql_query("select * from {$top}_info"));
?>
<script language=javascript>
<!--

function check_submit()
{
  if(!UserInfo.Company.value) { alert("업체명을 입력하여 주십시오."); UserInfo.Company.focus(); return false; }
  if(!UserInfo.Domain.value) { alert("도메인을 입력하여 주십시오."); UserInfo.Domain.focus(); return false; }
  if(!UserInfo.Admin_email.value) { alert("관리자 E-mail을 입력하여 주십시오."); UserInfo.Admin_email.focus(); return false; }
}

//-->
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
						<p><b>기본정보</b></p>
					</td>
					<td width="8">
						<p><img src="winko/system/winko_img/manager/subtitle_foot.gif" width="8" height="28" border="0"></p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="15">&nbsp;</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%">
				<form name="UserInfo" method="post" action="<?=$PHP_SELF?>" enctype="multipart/form-data" onsubmit="return check_submit();">
				<input type="hidden" name="option" value="info">
				<input type="hidden" name="option2" value="modify_ok">
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>					
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">업체명</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><INPUT maxLength="30" size="30" name="Company" class=input value="<?=stripslashes($data[Company])?>"></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">도메인</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><INPUT maxLength="30" size="30" name="Domain" class=input value="<?=stripslashes($data[Domain])?>"></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">관리자 E-mail</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><INPUT maxLength="30" size="30" name="Admin_email" class=input value="<?=stripslashes($data[Admin_email])?>"></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">타이틀</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><INPUT maxLength="80" size="80" name="Title" class=input value="<?=stripslashes($data[Title])?>"></p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<p align=right><INPUT type=image height=19 hspace="5" width="45" src="winko/system/winko_img/manager/icon_confirm.gif" vspace=5 border=0></p>
					</td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
	<tr>
		<td height="15"></td>
	</tr>
</table>
<?
$left_w = "100";
if($option2=="modify") {
	$member_data=mysql_fetch_array(mysql_query("select * from {$top}_member where no='$no'"));
	$zip=explode("-",$member_data[zip]);
	$sub_title = "수정";
}
else {
	$sub_title = "등록";
}
?>

<script language=javascript>
<!--
function OpenZipcode(){
	window.open("winko/system/zipcode/zipcode.php?form=write&zip1=zip1&zip2=zip2&address=address&target=address2&target=address2","ZipWin","width=400,height=250,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no");
}

function check_submit() {
	 if(!write.user_id.value) { alert("아이디를 입력하세요."); write.user_id.focus(); return false; }
	if(!write.name.value) { alert("이름을 입력하세요."); write.name.focus(); return false; }
}

function check_id(id) {
	if(!id) { alert('아이디를 입력하여 주세요.');write.user_id.focus(); }
	else { window.open('winko/kit/member/check_id.php?user_id='+id,'check_user_id','width=250,height=140,toolbar=no,status=no,resizable=no'); }
}

function check_nickname(id) {
	if(!id) { alert('아이디를 입력하여 주세요.');write.nickname.focus(); }
	else { window.open('winko/kit/member/check_nick.php?nickname='+id,'check_user_id','width=250,height=140,toolbar=no,status=no,resizable=no'); }
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
						<p><b>회원관리(<?=$sub_title?>)</b></p>
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
				<form name="write" method="post" action="<?=$PHP_SELF?>" enctype="multipart/form-data"  onsubmit="return check_submit();">
				<input type="hidden" name="option" value="member">
				<input type="hidden" name="option2" value=<?if($option2=="add") echo"add_ok"; else echo"modify_ok";?>>
				<input type="hidden" name="member_no" value="<?=$no?>">
				<input type="hidden" name="page" value="<?=$page?>">
				<input type="hidden" name="keyword" value="<?=$keyword?>">
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">회원등급</font></b></p>
								</td>
								<?
								if($member_data[level]==1) $member_level1=" selected";
								elseif($member_data[level]==8) $member_level8=" selected";
								elseif($member_data[level]==9) $member_level9=" selected";
								else $member_level8=" selected";
								?>
								<td colspan="3" bgcolor="white">
									<p>
										<select name="level" class="input">
											<option value="1"<?=$member_level1?>>전체관리자</option>
											<option value="8"<?=$member_level8?>>정회원</option>
											<option value="9"<?=$member_level9?>>예비회원</option>
										</select>
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">아이디</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><input type=text name=user_id size=20 maxlength=20 value="<?=$member_data[mem_id]?>" class=input>&nbsp;<IMG style="CURSOR: hand;" onclick="check_id(write.user_id.value)" src="winko/system/winko_img/manager/icon_overlap.gif" width="60" height="19" border="0" align="absmiddle"></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">비밀번호</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><input type=password name=passwd size=20 maxlength=20 class=input><?if($option2=="modify"){?> <font color="#DF5614">(비밀번호를 변경할 경우에만 입력하여 주십시오.)</font><?}?></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">비밀번호 확인</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><input type=password name=passwd1 size=20 maxlength=20 class=input></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>이름</b></font></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><input type=text name=name size=20 maxlength=20 value="<?=$member_data[name]?>" class=input></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">닉네임</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><input type=text name=nickname size=20 maxlength=20 value="<?=$member_data[nickname]?>" class=input>&nbsp;<IMG style="CURSOR: hand;" onclick="check_nickname(write.nickname.value)" src="winko/system/winko_img/manager/icon_overlap.gif" width="60" height="19" border="0" align="absmiddle"></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>생년월일</b></font></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><input type=text name=birth size=20 maxlength=6 value="<?=$member_data[birth]?>" class=input></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>성별</b></font></p>
								</td>
								<?unset($check);$check[$member_data[sex]]=" checked";?>
								<td colspan="3" bgcolor="white">
									<p><input type="radio" name="sex" value="1"<?echo $check[1];?>>
										  남자 <input type="radio" name="sex" value="2"<?echo $check[2];?>>
										  여자</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>E-mail</b></font></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><input type=text name=email size=50 maxlength=255 value="<?=$member_data[email]?>" class=input></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>주소</b></font></p>
								</td>
								<td colspan="3" bgcolor="white">
									<table cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td height="25">
												<table cellspacing="0" cellpadding="0" width="300" border="0">
													<tbody>
													<tr>
														<td width="150"><input class="input" maxLength="3" size="7" name="zip1" value="<?=$zip[0]?>">&nbsp;- <input class="input" maxLength="3" size="7" name="zip2" value="<?=$zip[1]?>"></td>
														<td align=middle><p align="left"><img style="CURSOR: hand" onclick="javascript: OpenZipcode()" height="19" src="winko/system/winko_img/manager/icon_zipcode.gif" width="80" border="0"></p></td>
													</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td height="25"><INPUT class="input" maxLength="255" size="50" name="address" value="<?=stripslashes($member_data[address])?>"></td>
										</tr>
										<tr>
											<td height="25"><INPUT class="input" maxLength="255" size="50" name="address2" value="<?=stripslashes($member_data[address2])?>"> 나머지 주소</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>휴대폰번호</b></font></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><input type=text name=handphone size=20 maxlength=50 value="<?=$member_data[handphone]?>" class=input></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>메일수신여부</b></font></p>
								</td>
								<?unset($check);$check[$member_data[mailing]]=" checked";?>
								<td colspan="3" bgcolor="white">
									<p><input type="radio" name="mailing" value="1"<?echo $check[1];?>>
										  받음 <input type="radio" name="mailing" value="0"<?echo $check[0];?>>
										  받지않음</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>비고사항</b></font></p>
								</td>
								<td colspan="3" bgcolor="white"><TEXTAREA name="memo" rows="5" style="WIDTH: 95%"><?=stripslashes($member_data[memo])?></TEXTAREA></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><p align=right><INPUT type="image" height="19" hspace="5" width="45" src="winko/system/winko_img/manager/icon_confirm.gif" vspace="5" border="0"><img border="0" onclick="history.back()" src="winko/system/winko_img/manager/icon_cancel.gif" style="CURSOR: hand" vspace=5 hspace="5"></p></td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
	<tr>
		<td height="15"></td>
	</tr>
</table>
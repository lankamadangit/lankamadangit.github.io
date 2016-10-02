<?
$left_w = "100";
$data=mysql_fetch_array(mysql_query("select * from {$top}_member where no='$no'"));
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
						<p><b>회원관리(상세정보)</b></p>
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
				<form name="write" method="post" action=<?=$PHP_SELF?> enctype="multipart/form-data" >
				<input type="hidden" name="option" value="member">
				<input type="hidden" name="option2" value="modify2_ok">
				<input type="hidden" name="member_no" value="<?=$no?>">
				<input type="hidden" name="page" value="<?=$page?>">
				<input type="hidden" name="keyword" value="<?=$keyword?>">
				<?
				if($data[signdate]!=0) $signdate = date("Y-m-d [H:i]",$data[signdate]);	
				if($data[modifydate]!=0) $modifydate = date("Y-m-d [H:i]",$data[modifydate]);	
				if($data[connectdate]!=0) $connectdate = date("Y-m-d [H:i]",$data[connectdate]);
				?>
				<tr>
					<td>
						<P align=right><INPUT type=image hspace="5" src="winko/system/winko_img/manager/icon_save.gif" width="94" height="19" vspace="5"border=0><IMG border=0 onclick=history.back() src="winko/system/winko_img/manager/icon_list.gif" style="CURSOR: hand" width="94" height="19" vspace="5" hspace="5"></P>
					</td>
				</tr>
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">등록일</font></b></p>
								</td>
								<td width="250" bgcolor="white">
									<p><?=$signdate?></p>
								</td>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>수정일</b></font></p>
								</td>
								<td bgcolor="white">
									<p><?=$modifydate?></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">최근방문일</font></b></p>
								</td>
								<td width="250" bgcolor="white">
									<p><?=$connectdate?></p>
								</td>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">참여도</font></b></p>
								</td>
								<td bgcolor="white">
									<p><b><?=($data[point1]*10+$data[point2])?></b> 점 ( 작성글수 : <?=$data[point1]?>, 짧은글수 : <?=$data[point2]?>  )</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>메모</b></font></p>
								</td>
								<td colspan="3" bgcolor="white"><TEXTAREA name="memo" rows=5 style="WIDTH: 95%"><?=stripslashes($data[memo])?></TEXTAREA></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="15"></td>
				</tr>
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
									if($data[level]==1) $member_level="<font color=red>전체관리자</font>";
									elseif($data[level]==8) $member_level="<font color=blue>정회원</font>";
									elseif($data[level]==9) $member_level="예비회원";
									else $member_level=$data[level];
								?>
								<td colspan="3" bgcolor="white">
									<p><?=$member_level?></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">아이디</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><?=$data[mem_id]?></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>이름</b></font></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><?=stripslashes($data[name])?></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">닉네임</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><?=stripslashes($data[nickname])?></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>생년월일</b></font></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><?=stripslashes($data[birth])?></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>성별</b></font></p>
								</td>
								<?
								if($data[sex]==1) $sex = "남";
								elseif($data[sex]==2) $sex = "여";
								?>
								<td colspan="3" bgcolor="white">
									<p><?=$sex?></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>E-mail</b></font></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><a href="mailto:<?=$data[email]?>"><?=stripslashes($data[email])?></a></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>주소</b></font></p>
								</td>
								<td colspan="3" bgcolor="white"><?=$data[zipcode]?> <?=stripslashes($data[address])?> <?=stripslashes($data[address2])?></td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>휴대폰번호</b></font></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><?=$data[handphone]?></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>메일수신여부</b></font></p>
								</td>
								<?unset($check);$check[$data[mailing]]=" checked";?>
								<td colspan="3" bgcolor="white">
									<p><input type="radio" name="mailing" value="1"<?echo $check[1];?>>
										  받음 <input type="radio" name="mailing" value="0"<?echo $check[0];?>>
										  받지않음</p>
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
		<td height="15"></td>
	</tr>
</table>
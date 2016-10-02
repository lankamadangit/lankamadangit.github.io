<?
if(!$select) $select = "inquiry";

$data=@mysql_fetch_array(mysql_query("select * from {$top}_{$select} where no='$no'"));
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
						<p><b>Inquiry 관리</b></p>
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
			<table cellpadding="0" cellspacing="0" width="100%">
				<form name="UserInfo" method="post" action=<?=$PHP_SELF?> enctype=multipart/form-data >
				<input type="hidden" name="option" value="inquiry">
				<input type="hidden" name="select" value="<?=$select?>">
				<input type="hidden" name="mode" value="modify">
				<input type="hidden" name="member_no" value="<?=$no?>">
				<input type="hidden" name="page" value="<?=$page?>">
				<input type="hidden" name="keyword" value="<?=$keyword?>">
				<?
				$Reg_date = date("Y-m-d [H:i]",$data[Reg_date]);	
				?>
				<tr>
					<td>
						<p align="right"><input type="image" hspace="5" src="winko/system/winko_img/manager/icon_save.gif" width="94" height="19" vspace="5"border=0><IMG border=0 onclick=history.back() src="winko/system/winko_img/manager/icon_list.gif" style="CURSOR: hand" width="94" height="19" vspace="5" hspace="5"></P>
					</td>
				</tr>
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<colgroup>
								<col width="20%" />
								<col width="35%"  />
								<col width="20%"  />
								<col width="25%" />
							</colgroup>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">등록일</font></b></p>
								</td>
								<td bgcolor="white">
									<p><?=$Reg_date?>&nbsp;&nbsp;<?=$data[ip]?></p>
								</td>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>상태</b></font></p>
								</td>
								<?
								  unset($check);
								  $check[$data[State]]=" selected";
								?>
								<td bgcolor="white">
									<p><SELECT name=State class=input><OPTION value=2<?=$check[2]?>>완료<OPTION value=1<?=$check[1]?>>처리중</OPTION></SELECT></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>비고사항</b></font></p>
								</td>
								<td colspan="3" bgcolor="white"><TEXTAREA name="Result" rows=5 style="WIDTH: 95%"><?=stripslashes($data[Result])?></TEXTAREA></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="20"></td>
				</tr>
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<colgroup>
								<col width="21%" />
								<col width="34%"  />
								<col width="21%"  />
								<col width="24%" />
							</colgroup>
							<?if($select=="inquiry"){?>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">제목</font></b> 
									</p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><?=stripslashes($data[Subject])?></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>회사명</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><?=stripslashes($data[Company])?></p>
								</td>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>부서</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><?=stripslashes($data[Post])?></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>성명</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><?=stripslashes($data[Name])?></p>
								</td>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>직위</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><?=stripslashes($data[Position])?></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>TEL</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><?=stripslashes($data[Phone])?></p>
								</td>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>휴대폰</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><?=stripslashes($data[Handphone])?></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>E-mail</b></font> 
									</p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><a href="mailto:<?=$data[Email]?>"><u><?=$data[Email]?></u></a></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>문의내용</b></font></p>
								</td>
								<td colspan="3" bgcolor="white"><TEXTAREA name="Comment" rows="10" style="WIDTH: 95%" readonly><?=stripslashes($data[Comment])?></TEXTAREA></td>
							</tr>
							<?}else{?>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">Subject</font></b> 
									</p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><?=stripslashes($data[Subject])?></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>Your Name</b></font> 
									</p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><?=stripslashes($data[Name])?></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>Your E-mail</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><a href="mailto:<?=$data[Email]?>"><u><?=$data[Email]?></u></a></p>
								</td>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>Your telephone Number</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><?=stripslashes($data[Phone])?></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>Your Company</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><?=stripslashes($data[Company])?></p>
								</td>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>Your Country</b></font> 
									</p>
								</td>
								<td bgcolor="white">
									<p><?=stripslashes($data[Country])?></p>
								</td>
							</tr>
							<tr>
								<td bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><font color="#627DBC"><b>Message</b></font></p>
								</td>
								<td colspan="3" bgcolor="white"><TEXTAREA name="Comment" rows="10" style="WIDTH: 95%" readonly><?=stripslashes($data[Comment])?></TEXTAREA></td>
							</tr>
							<?}?>
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
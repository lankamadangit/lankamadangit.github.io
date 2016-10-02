<?
$data=mysql_fetch_array(mysql_query("select * from {$top}_info"));
?>
<table align="center" cellpadding="0" cellspacing="0" width="518">
	<tr>
		<td>
			<p>&nbsp;</p>
		</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="251">
						<table align="center" cellpadding="0" cellspacing="0" width="243" height="118">
							<tr>
								<td valign="top" background="winko/system/winko_img/box_td.gif">
									<table align="center" cellpadding="0" cellspacing="0" width="85%">
										<tr>
											<td>
												<p><img src="winko/system/winko_img/blank.gif" width="1" height="3" border="0"></p>
											</td>
										</tr>
										<tr>
											<td>
												<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;운영정보</p>
											</td>
										</tr>
										<tr>
											<td>
												<p><img src="winko/system/winko_img/blank.gif" width="1" height="10" border="0"></p>
											</td>
										</tr>
										<tr height=25>
											<td>
												<p><img src="winko/system/winko_img/dot-yellow.gif" width="5" height="5" border="0" align=absmiddle> 
												회사명 
												:&nbsp;&nbsp;<?=stripslashes($data[Company])?> 
												<br></p>
											</td>
										</tr>
										<tr height=25>
											<td>
												<p><img src="winko/system/winko_img/dot-yellow.gif" width="5" height="5" border="0" align=absmiddle> 
												도메인 
												:&nbsp;&nbsp;<font class=thm8><?=stripslashes($data[Domain])?></font> </p>
											</td>
										</tr>
										<tr height=25>
											<td>
												<p><img src="winko/system/winko_img/dot-yellow.gif" width="5" height="5" border="0" align=absmiddle> 
												E-mail 
												:&nbsp;&nbsp;<font class=thm8><?=stripslashes($data[Admin_email])?></font> </p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td width="251">
						<table align="center" cellpadding="0" cellspacing="0" width="243" height="118">
							<tr>
								<td valign="top" background="winko/system/winko_img/box_td.gif">
									<table align="center" cellpadding="0" cellspacing="0" width="85%">
										<tr>
											<td>
												<p><img src="winko/system/winko_img/blank.gif" width="1" height="3" border="0"></p>
											</td>
										</tr>
										<tr>
											<td>
												<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;회원관리</p>
											</td>
										</tr>
										<tr>
											<td>
												<p><img src="winko/system/winko_img/blank.gif" width="1" height="10" border="0"></p>
											</td>
										</tr>
										<tr height=25>
											<td>
												<p><img src="winko/system/winko_img/dot-yellow.gif" width="5" height="5" border="0" align=absmiddle> 
												총회원 
												:&nbsp;&nbsp;<?=$total_member[0]?></p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="518" colspan="2">
						<p>&nbsp;</p>
					</td>
				</tr>
				<tr>
					<td width="251">
						<table align="center" cellpadding="0" cellspacing="0" width="243" height="118">
							<tr>
								<td valign="top" background="winko/system/winko_img/box_td.gif">
									<table align="center" cellpadding="0" cellspacing="0" width="85%">
										<tr>
											<td>
												<p><img src="winko/system/winko_img/blank.gif" width="1" height="3" border="0"></p>
											</td>
										</tr>
										<tr>
											<td>
												<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;상담관리</p>
											</td>
										</tr>
										<tr>
											<td>
												<p><img src="image/etc/blank.gif" width="1" height="10" border="0"></p>
											</td>
										</tr>
										<!--tr height=25>
											<td>
												<p><img src="winko/system/winko_img/dot-yellow.gif" width="5" height="5" border="0" align=absmiddle>
												<a href="admin.php?option=inquiry">Korean&nbsp;:&nbsp;<?if($today_inquiry[0]!=0){echo"<font color=ff6600>$today_inquiry[0]</font>";}else{echo "$today_inquiry[0]";}?> / <?=$total_inquiry[0]?></a></p>
											</td>
										</tr-->
										<tr height=25>
											<td>
												<p><img src="winko/system/winko_img/dot-yellow.gif" width="5" height="5" border="0" align=absmiddle>
												<a href="admin.php?option=inquiry&select=inquiry_eng">English&nbsp;:&nbsp;<?if($today_inquiry_eng[0]!=0){echo"<font color=ff6600>$today_inquiry_eng[0]</font>";}else{echo "$today_inquiry_eng[0]";}?> / <?=$total_inquiry_eng[0]?></a></p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td width="251">
						<table align="center" cellpadding="0" cellspacing="0" width="243" height="118">
							<tr>
								<td valign="top" background="winko/system/winko_img/box_td.gif">
									<table align="center" cellpadding="0" cellspacing="0" width="85%">
										<tr>
											<td>
												<p><img src="winko/system/winko_img/blank.gif" width="1" height="3" border="0"></p>
											</td>
										</tr>
										<tr>
											<td>
												<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;로그분석</p>
											</td>
										</tr>
										<tr>
											<td>
												<p><img src="winko/system/winko_img/blank.gif" width="1" height="10" border="0"></p>
											</td>
										</tr>
										<tr height=25>
											<td>
												<p><img src="winko/system/winko_img/dot-yellow.gif" width="5" height="5" border="0" align=absmiddle> 
												전체 방문수 
												:&nbsp;&nbsp;<?=$count[total_hit]?></p>
											</td>
										</tr>
										<tr height=25>
											<td>
												<p><img src="winko/system/winko_img/dot-yellow.gif" width="5" height="5" border="0" align=absmiddle> 
												어제 방문수 
												:&nbsp;&nbsp;<?=$count[yesterday_hit]?></p>
											</td>
										</tr>
										<tr height=25>
											<td>
												<p><img src="winko/system/winko_img/dot-yellow.gif" width="5" height="5" border="0" align=absmiddle> 
												오늘 방문수 
												:&nbsp;&nbsp;<font color=ff6600><span style="font-size:11pt;"><b><?=$count[today_hit]?></span></font></p>
											</td>
										</tr>
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
			<p>&nbsp;</p>
		</td>
	</tr>
</table>
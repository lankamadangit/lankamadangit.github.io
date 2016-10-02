<?
  $board_data=mysql_fetch_array(mysql_query("select * from {$top}_boardadmin where no='$no'")); 
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
				<form method="post" action="<?=$PHP_SELF?>">
				<input type="hidden" name="option" value="<?=$option?>">
				<input type="hidden" name="option2" value="modify_grant_ok">
				<input type="hidden" name="page" value="<?=$page?>">
				<input type="hidden" name="page_num" value="<?=$page_num?>">
				<input type="hidden" name="no" value="<?=$no?>">
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>					
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left" class="Arial9"><b><font color="#627DBC">Admin</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p>
										<select name=grant_admin class=input >
										<?
										 for($i=1;$i<=10;$i++)
										if($i==$board_data[grant_admin]) echo"<option value=$i selected>$i</option>";
										else echo"<option value=$i>$i</option>";
										?>
										</select> &nbsp;&nbsp;관리자 레벨 지정
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left" class="Arial9"><b><font color="#627DBC">View List</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p>
										<select name=grant_list class=input >
										<?
										  for($i=1;$i<=10;$i++)
										  if($i==$board_data[grant_list]) echo"<option value=$i selected>$i</option>";
										  else echo"<option value=$i>$i</option>";
										?>
										</select> &nbsp;&nbsp;글 목록 보기 권한을 레벨별로 지정합니다
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left" class="Arial9"><b><font color="#627DBC">View Read</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p>
										<select name=grant_view  class=input>
										<?
										  for($i=1;$i<=10;$i++)
										  if($i==$board_data[grant_view]) echo"<option value=$i selected>$i</option>";
										  else echo"<option value=$i>$i</option>";
										?>
										</select> &nbsp;&nbsp;글의 내용을 읽을수 있는 권한을 레벨별로 지정합니다
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left" class="Arial9"><b><font color="#627DBC">Write Articles</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p>
										<select name=grant_write class=input>
										<?
										  for($i=1;$i<=10;$i++)
										  if($i==$board_data[grant_write]) echo"<option value=$i selected>$i</option>";
										  else echo"<option value=$i>$i</option>";
										?>
										</select> &nbsp;&nbsp;글쓰기 권한을 레벨별로 지정합니다.
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left" class="Arial9"><b><font color="#627DBC">Write Reply</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p>
										<select name=grant_reply class=input>
										<?
										  for($i=1;$i<=10;$i++)
										  if($i==$board_data[grant_reply]) echo"<option value=$i selected>$i</option>";
										  else echo"<option value=$i>$i</option>";
										?>
										</select> &nbsp;&nbsp;답글 달기 권한을 레벨별로 지정합니다.
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left" class="Arial9"><b><font color="#627DBC">Delete</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p>
										<select name=grant_delete class=input>
										<?
										  for($i=1;$i<=10;$i++)
										  if($i==$board_data[grant_delete]) echo"<option value=$i selected>$i</option>";
										  else echo"<option value=$i>$i</option>";
										?>
										</select> &nbsp;&nbsp;글 삭제 권한을 레벨별로 지정합니다.
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left" class="Arial9"><b><font color="#627DBC">Notice</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p>
										<select name=grant_notice class=input>
										<?
										  for($i=1;$i<=10;$i++)
										  if($i==$board_data[grant_notice]) echo"<option value=$i selected>$i</option>";
										  else echo"<option value=$i>$i</option>";
										?>
										</select> &nbsp;&nbsp;공지글 쓰기 권한을 레벨별로 지정합니다.
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left" class="Arial9"><b><font color="#627DBC">Write Comment</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p>
										<select name=grant_comment class=input>
										<?
										  for($i=1;$i<=10;$i++)
										  if($i==$board_data[grant_comment]) echo"<option value=$i selected>$i</option>";
										  else echo"<option value=$i>$i</option>";
										?>
										</select> &nbsp;&nbsp;짧은글 쓰기 권한을 레벨별로 지정합니다.
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left" class="Arial9"><b><font color="#627DBC">Admin Member</font></b></p>
								</td>
								<td colspan="3" bgcolor="white">
									<p><input type=text name=grant_member size=40 maxlength=255 class=input value="<?=$board_data[grant_member]?>"> 관리자로 지정할 회원을 지정합니다. (아이디입력 "/" 로 구분)</p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><p align=right><INPUT type=image height=19 hspace="5" width="45" src="winko/system/winko_img/manager/icon_confirm.gif" vspace=5 border=0><IMG align=absMiddle border=0 onclick=history.back() src="winko/system/winko_img/manager/btn_list.gif" width="45" height="19" hspace=5 vspace=5 style="CURSOR: hand"></p></td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
	<tr>
		<td height="15"></td>
	</tr>
</table>

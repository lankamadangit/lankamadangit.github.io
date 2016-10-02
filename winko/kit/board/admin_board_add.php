<?
if($option2=="modify") {
	$data=mysql_fetch_array(mysql_query("select * from {$top}_boardadmin where no='$no'"));
	$subtitle="수정";
} else {
	$subtitle="추가";
}

  if(!$data[table_width]) $data[table_width]="95";
  if(!$data[cut_length]) $data[cut_length]="0";
  if(!$data[page_num]) $data[page_num]="10";
  if(!strlen($data[ok_visit])) $data[ok_visit]="0";
  if(!strlen($data[ok_category])) $data[ok_category]="0";
  if(!strlen($data[ok_html])) $data[ok_html]="1";
  if(!strlen($data[ok_sitelink])) $data[ok_sitelink]="0";
  if(!strlen($data[ok_file1])) $data[ok_file1]="1";
  if(!strlen($data[ok_file2])) $data[ok_file2]="0";
  if(!strlen($data[ok_short])) $data[ok_short]="0";
  if(!strlen($data[ok_notice])) $data[ok_notice]="1";
  if(!strlen($data[ok_secret])) $data[ok_secret]="0";
  if(!strlen($data[ok_add_a])) $data[ok_add_a]="0";
  if(!strlen($data[ok_add_b])) $data[ok_add_b]="0";
  if(!strlen($data[notify_admin])) $data[notify_admin]="0";
  if(!$data[num_list]) $data[num_list]="15";
  if(!$data[upload_size1]) $data[upload_size1]="10485760";
  if(!$data[upload_size2]) $data[upload_size2]="10485760";
  if(!$data[reply_indent]&&($data[reply_indent]!=0)) $data[reply_indent]="5";
  if(!$data[notify_admin]) $data[notify_admin]="0";
  if(!$data[new_time]) $data[new_time]="2";
  if(!$data[skin]) $data[skin]="winko_main";
  if(!$data[list_type]) $data[list_type]="list";
  if(!$data[allow_delete]) $data[allow_delete]="0";
?>
<script>
function check_submit() {
	if(!write.code.value) {alert("게시판 코드를 입력하여 주십시요");write.code.focus();return false;}
	if(!write.name.value) {alert("게시판 이름을 입력하여 주십시요");write.name.focus();return false;}
	if(!write.page_num.value) {alert("페이지수를 입력하여 주십시요");write.page_num.focus();return false;}
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
						<p><b>게시판관리(<?=$subtitle?>)</b></p>
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
				<form method="post" action="<?=$PHP_SELF?>" name=write onsubmit="return check_submit();">
				<input type="hidden" name="no" value="<?echo $data[no];?>">
				<input type="hidden" name="option" value="board">
				<input type="hidden" name="option2" value=<?if($option2=="add") echo"add_ok"; else echo"modify_ok";?>>
				<input type="hidden" name="page" value=<?=$page?>>
				<input type="hidden" name="top" value="<?=$top?>">
				<tr>
					<td height="1" bgcolor="#85ACCF"></td>
				</tr>					
				<tr>
					<td>
						<table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">게시판 코드</font></b></p>
								</td>
								<td bgcolor="white">
									<p><input type=text name=code value='<?echo $data[code];?>' <?if($no) echo"readonly"; ?> size=20 maxlength=40 class=input></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">스킨</font></b></p>
								</td>
								<td bgcolor="white">
									<p>
										<select name=skin class="input">
										<?
										// /skin 디렉토리에서 디렉토리를 구함
										$skin_dir="winko/skin";
										$handle=opendir($skin_dir);
										while ($skin_info = readdir($handle)) {
											if(!eregi("\.",$skin_info)) {
												if($skin_info==$data[skin]) $select="selected"; else $select="";
												echo"<option value=$skin_info $select>$skin_info</option>";
											}
										}
										closedir($handle);
										?>
										</select>
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">게시판 이름</font></b></p>
								</td>
								<td bgcolor="white">
									<p><input type=text  name=name value='<?echo $data[name];?>' size=30 maxlength=30 class=input></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">리스트 형태</font></b></p>
								</td>
								<? 
								if($data[list_type] == "thread"){$data[list_type] = 1;}
								elseif($data[list_type] == "list"){$data[list_type] = 2;}
								else{$data[list_type] = 0;}
								unset($check);$check[$data[list_type]]="selected";
								?>
								<td bgcolor="white">
									<p>
										<select name="list_type" style="font-size:9pt;">
											<option value=list <?echo $check[2];?>>리스트전체출력</option>
											<option value=thread <?echo $check[1];?>>관련글만출력</option>
											<option value=not <?echo $check[0];?>>출력안함</option>
										</select>
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">게시판 형식</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_visit]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_visit value='0' <?echo $check[0];?>> 게시판 &nbsp; <input type=radio name=ok_visit value='1' <?echo $check[1];?>> 방명록 &nbsp; <input type=radio name=ok_visit value='2' <?echo $check[2];?>> 갤러리</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">관련글 삭제</font></b></p>
								</td>
								<? unset($check);$check[$data[allow_delete]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=allow_delete value='0' <?echo $check[0];?>> 답변글 삭제금지 &nbsp; <input type=radio name=allow_delete value='1' <?echo $check[1];?>> 답변글 삭제허용</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">NEW아이콘 출력</font></b></p>
								</td>
								<?unset($check);$check[$data[new_time]]="selected";?>
								<td bgcolor="white">
									<p>
										<select name='new_time' class="input">
											<option value='0' <?echo $check[0];?>>출력안함</option>
											<option value='1' <?echo $check[1];?>>1일</option>
											<option value='2' <?echo $check[2];?>>2일</option>
											<option value='3' <?echo $check[3];?>>3일</option>
											<option value='4' <?echo $check[4];?>>4일</option>
											<option value='5' <?echo $check[5];?>>5일</option>
											<option value='6' <?echo $check[6];?>>6일</option>
											<option value='7' <?echo $check[7];?>>7일</option>
											<option value='8' <?echo $check[8];?>>8일</option>
											<option value='9' <?echo $check[9];?>>9일</option>
											<option value='10' <?echo $check[10];?>>10일</option>
										</select>
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">테이블 폭 Size</font></b></p>
								</td>
								<td bgcolor="white">
									<p><input type=text  name=table_width value='<?echo $data[table_width];?>' size=4 maxlength=4 class=input> &nbsp;&nbsp; 게시판 가로크기 (100이하이면 %로 설정)</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">리스트 목록 갯수</font></b></p>
								</td>
								<td bgcolor="white">
									<p><input type=text  name=num_list value='<?echo $data[num_list];?>' size=3 maxlength=3 class=input> &nbsp;&nbsp;한페이지당 출력될 목록의 수 (1~999)</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">제목 글 수 자르기</font></b></p>
								</td>
								<td bgcolor="white">
									<p><input type=text  name=cut_length value='<?echo $data[cut_length];?>' size=11 maxlength=11 class=input> &nbsp;&nbsp;지정된 길이 이상의 제목글은 ... 표시 (0:사용안함)</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">파일1 업로드제한</font></b></p>
								</td>
								<td bgcolor="white">
									<p><input type=text  name=upload_size1 value='<?echo $data[upload_size1];?>' size=11 maxlength=11 class=input>&nbsp;byte&nbsp;&nbsp;&nbsp;<font class=thm8><b><?=GetFileSize($data[upload_size1])?></b></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">파일2 업로드제한</font></b></p>
								</td>
								<td bgcolor="white">
									<p><input type=text  name=upload_size2 value='<?echo $data[upload_size2];?>' size=11 maxlength=11 class=input>&nbsp;byte&nbsp;&nbsp;&nbsp;<font class=thm8><b><?=GetFileSize($data[upload_size2])?></b></font></p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">관리자메일 발송</font></b></p>
								</td>
								<? unset($check);$check[$data[notify_admin]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=notify_admin value='0' <?echo $check[0];?>> 메일발송안함 &nbsp; <input type=radio name=notify_admin value='1' <?echo $check[1];?>> 메일발송</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">답글갯수</font></b></p>
								</td>
								<?unset($check);$check[$data[reply_indent]]="selected";?>
								<td bgcolor="white">
									<p>
										<select name=reply_indent style="font-size:9pt;">
											<option value=0 <?echo $check[0];?>>금지</option>
											<option value=1 <?echo $check[1];?>>1단</option>
											<option value=2 <?echo $check[2];?>>2단</option>
											<option value=3 <?echo $check[3];?>>3단</option>
											<option value=4 <?echo $check[4];?>>4단</option>
											<option value=5 <?echo $check[5];?>>5단</option>
											<option value=6 <?echo $check[6];?>>6단</option>
											<option value=7 <?echo $check[7];?>>7단</option>
										</SELECT>
									</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">카테고리</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_category]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_category value='0' <?echo $check[0];?>> 금지 &nbsp; <input type=radio name=ok_category value='1' <?echo $check[1];?>> 허용</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">HTML</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_html]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_html value='0' <?echo $check[0];?>> 금지 &nbsp;<input type=radio name=ok_html value='1' <?echo $check[1];?>> 허용 &nbsp;</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">사이트링크</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_sitelink]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_sitelink value='0' <?echo $check[0];?>> 금지 &nbsp;<input type=radio name=ok_sitelink value='1' <?echo $check[1];?>> 허용 &nbsp; </p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">파일업로드#1</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_file1]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_file1 value='0' <?echo $check[0];?>> 금지 &nbsp;<input type=radio name=ok_file1 value='1' <?echo $check[1];?>> 허용 &nbsp; </p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">파일업로드#2</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_file2]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_file2 value='0' <?echo $check[0];?>> 금지 &nbsp;<input type=radio name=ok_file2 value='1' <?echo $check[1];?>> 허용 &nbsp;</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">짧은글</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_short]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_short value='0' <?echo $check[0];?>> 금지 &nbsp;<input type=radio name=ok_short value='1' <?echo $check[1];?>> 허용 &nbsp;</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">공지글</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_notice]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_notice value='0' <?echo $check[0];?>> 금지 &nbsp;<input type=radio name=ok_notice value='1' <?echo $check[1];?>> 허용 &nbsp;</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">비밀글</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_secret]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_secret value='0' <?echo $check[0];?>> 금지 &nbsp;<input type=radio name=ok_secret value='1' <?echo $check[1];?>> 허용 &nbsp;</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">추가A</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_add_a]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_add_a value='0' <?echo $check[0];?>> 금지 &nbsp;<input type=radio name=ok_add_a value='1' <?echo $check[1];?>> 허용 &nbsp;</p>
								</td>
							</tr>
							<tr>
								<td width="125" bgcolor="#F2F2F2" style="padding-left:12px;">
									<p align="left"><b><font color="#627DBC">추가B</font></b></p>
								</td>
								<? unset($check);$check[$data[ok_add_b]]="checked";?>
								<td bgcolor="white">
									<p><input type=radio name=ok_add_b value='0' <?echo $check[0];?>> 금지 &nbsp;<input type=radio name=ok_add_b value='1' <?echo $check[1];?>> 허용 &nbsp;</p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<p align=right><INPUT type=image height=19 hspace="5" width="45" src="winko/system/winko_img/manager/icon_confirm.gif" vspace=5 border=0><IMG align=absMiddle border=0 onclick=history.back() src="winko/system/winko_img/manager/btn_list.gif" width="45" height="19" hspace=5 vspace=5 style="CURSOR: hand"></p>
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

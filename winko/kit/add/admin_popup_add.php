<?
if($mode=="modify") {
	$sql = " select * from {$top}_popup where no = $id ";
	$row = mysql_fetch_array(mysql_query($sql));
	$width = $row[width];
	$height = $row[height];
	$popup_title = $row[title];
	$comment=stripslashes($row[comment]);
	$link  = $row[link];
	$link2  = $row[link2];
	$link3  = $row[link3];
	$popup_view   = $row[view];
	$popup_view_kr   = $row[view_kr];
	$popup_view_eng   = $row[view_eng];
	$scrollbar  = $row[scrollbar];
	$start_year = date("Y",$row[start_date]);
	$start_month = date("n",$row[start_date]);
	$start_day = date("d",$row[start_date]);
	$start_hour = date("H",$row[start_date]);
	$start_minute = date("i",$row[start_date]);
	$end_year = date("Y",$row[end_date]);
	$end_month = date("n",$row[end_date]);
	$end_day = date("d",$row[end_date]);
	$end_hour = date("H",$row[end_date]);
	$end_minute = date("i",$row[end_date]);
	$caption  = "메인팝업수정";
} else {
	$caption = "팝업 입력";
	$width = 300;
	$height = 400;
	$popup_title = $title;
	$start_year = date("Y");
	$start_month = date("n");
	$start_day = date("d");
	$start_hour = date("H");
	$start_minute = date("i");
	$end_year = date("Y");
	$end_month = date("n");
	$end_day = date("d");
	$end_hour = date("H");
	$end_minute = date("i");
}
?>
<? include "fckeditor/fckeditor.php";?>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
	<tr height=20>
		<td colspan=10></td>
	</tr>
	<tr height=30>
		<td colspan=10>
			<table align="center" cellpadding="0" cellspacing="0" width="95%">
				<tr>
					<td>
						<p><img src="winko/system/winko_img/popup_title.gif" width="112" height="32" border="0"></p>
					</td>
				</tr>
			</table>  
		</td>
	</tr>
	<tr>
		<td colspan=10><img src='winko/system/winko_img/blank.gif' height=5></td>
	</tr>
	<tr>
		<td colspan=10 background="winko/system/winko_img/member_14.gif"><img src='winko/system/winko_img/blank.gif' height=1></td>
	</tr>
	<tr>
		<td colspan=10>
			<!-- new start-->
			<form name="frm1" method="post" action="winko/kit/add/admin_popup_add_ok.php" enctype="multipart/form-data" onsubmit="return check_submit();">
			<input type="hidden" name="mode" value="<?=$mode?>" />
			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="hidden" name="popup_view_eng" value="1" />
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td bgcolor="#E0E0E0">
						<table cellpadding="0" cellspacing="8" width="100%">
							<tr>
								<td>
									<table border=0 cellspacing=1 cellpadding=0 width=100%>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;창크기&nbsp;&nbsp;</td>
											<td bgcolor="#ffffff">&nbsp;&nbsp;<input type=text name=width maxLength=3 size=3 value='<? echo $width?>' class=input style=border-color:#666666> &nbsp;X&nbsp;&nbsp;<input type=text name=height maxLength=3 size=3 value='<? echo $height?>' class=input style=border-color:#666666></td>
										</tr>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;제목(브라우저 title)&nbsp;&nbsp;</td>
											<td bgcolor="#ffffff">&nbsp;&nbsp;<input type=text name=popup_title size=50 value='<? echo $popup_title?>' class=input style=border-color:#666666></td>
										</tr>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;링크 #1&nbsp;</td>
											<td bgcolor="#ffffff">&nbsp;&nbsp;<input type=text name=link size=50 value='<? echo $link?>' class=input style=border-color:#666666></td>
										</tr>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;링크 #2&nbsp;</td>
											<td bgcolor="#ffffff">&nbsp;&nbsp;<input type=text name=link2 size=50 value='<? echo $link2?>' class=input style=border-color:#666666></td>
										</tr>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;링크 #3&nbsp;</td>
											<td bgcolor="#ffffff">&nbsp;&nbsp;<input type=text name=link3 size=50 value='<? echo $link3?>' class=input style=border-color:#666666></td>
										</tr>
										<? unset($check);$check[$scrollbar]="selected"; ?>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;스크롤바&nbsp;</td>
											<td bgcolor="#ffffff">&nbsp;&nbsp;
												<SELECT name=scrollbar style="font-size:9pt;">
													<OPTION value=no <?echo $check[no];?>>no</OPTION>
													<OPTION value=yes <?echo $check[yes];?>>yes</OPTION>
												</SELECT>
											 </td>
										</tr>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;활성여부&nbsp;</th>
											<td bgcolor="#ffffff">&nbsp;&nbsp;<input type="checkbox" name="popup_view" value="1" <?=($popup_view==1 ? "checked" : "")?> />활성함&nbsp;&nbsp;&nbsp;&nbsp;<!--input type=checkbox name=popup_view_eng value='1' <?=($popup_view_eng==1 ? "checked" : "")?> />영문&nbsp;&nbsp;<input type=checkbox name=popup_view_kr value='1' <? echo ($popup_view_kr==1) ? "checked" : ""?>>한글&nbsp;&nbsp;<input type=checkbox name=popup_view_jp value='1' <? echo ($popup_view_jp==1) ? "checked" : ""?>>일문&nbsp;&nbsp;<input type=checkbox name=popup_view_ch value='1' <? echo ($popup_view_ch==1) ? "checked" : ""?>>중문</td-->
										</tr>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;활성시작&nbsp;</th>
											<?
											unset($check); $check[$start_month]="selected";
											unset($check2); $check2[$start_day]="selected";
											?>
											<td bgcolor="#ffffff">&nbsp;&nbsp;
											<INPUT class=input style=border-color:#666666 maxLength="4" size="4" name=start_year value='<? echo $start_year?>'>년&nbsp;<SELECT size=1 name=start_month class=input><OPTION value=1 <?=$check[1]?>>1<OPTION value=2 <?=$check[2]?>>2<OPTION value=3 <?=$check[3]?>>3<OPTION value=4 <?=$check[4]?>>4<OPTION value=5 <?=$check[5]?>>5<OPTION value=6 <?=$check[6]?>>6<OPTION value=7 <?=$check[7]?>>7<OPTION value=8 <?=$check[8]?>>8<OPTION value=9 <?=$check[9]?>>9<OPTION value=10 <?=$check[10]?>>10<OPTION value=11 <?=$check[11]?>>11<OPTION value=12 <?=$check[12]?>>12</option></SELECT>월&nbsp;<SELECT size=1 name=start_day class=input><OPTION value=1 <?=$check2[1]?>>1<OPTION value=2 <?=$check2[2]?>>2<OPTION value=3 <?=$check2[3]?>>3<OPTION value=4 <?=$check2[4]?>>4<OPTION value=5 <?=$check2[5]?>>5<OPTION value=6 <?=$check2[6]?>>6<OPTION value=7 <?=$check2[7]?>>7<OPTION value=8 <?=$check2[8]?>>8<OPTION value=9 <?=$check2[9]?>>9<OPTION value=10 <?=$check2[10]?>>10<OPTION value=11 <?=$check2[11]?>>11<OPTION value=12 <?=$check2[12]?>>12<OPTION value=13 <?=$check2[13]?>>13<OPTION value=14 <?=$check2[14]?>>14<OPTION value=15 <?=$check2[15]?>>15<OPTION value=16 <?=$check2[16]?>>16<OPTION value=17 <?=$check2[17]?>>17<OPTION value=18 <?=$check2[18]?>>18<OPTION value=19 <?=$check2[19]?>>19<OPTION value=20 <?=$check2[20]?>>20<OPTION value=21 <?=$check2[21]?>>21<OPTION value=22 <?=$check2[22]?>>22<OPTION value=23 <?=$check2[23]?>>23<OPTION value=24 <?=$check2[24]?>>24<OPTION value=25 <?=$check2[25]?>>25<OPTION value=26 <?=$check2[26]?>>26<OPTION value=27 <?=$check2[27]?>>27<OPTION value=28 <?=$check2[28]?>>28<OPTION value=29 <?=$check2[29]?>>29<OPTION value=30 <?=$check2[30]?>>30<OPTION value=31 <?=$check2[31]?>>31</option></SELECT>일&nbsp;<INPUT class=input style=border-color:#666666 maxLength="2" size="2" name=start_hour value='<? echo $start_hour?>'>시&nbsp;<INPUT class=input style=border-color:#666666 maxLength="2" size="2" name=start_minute value='<? echo $start_minute?>'>분&nbsp;&nbsp;(2002년 3월 12일 23시 24분)</td>
										</tr>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;활성끝&nbsp;</th>
											<?
											unset($check); $check[$end_month]="selected";
											unset($check2); $check2[$end_day]="selected";
											?>
										  <td bgcolor="#ffffff">&nbsp;&nbsp;
										  <INPUT class=input style=border-color:#666666 maxLength="4" size="4" name=end_year value='<? echo $end_year?>'>년&nbsp;<SELECT size=1 name=end_month class=input><OPTION value=1 <?=$check[1]?>>1<OPTION value=2 <?=$check[2]?>>2<OPTION value=3 <?=$check[3]?>>3<OPTION value=4 <?=$check[4]?>>4<OPTION value=5 <?=$check[5]?>>5<OPTION value=6 <?=$check[6]?>>6<OPTION value=7 <?=$check[7]?>>7<OPTION value=8 <?=$check[8]?>>8<OPTION value=9 <?=$check[9]?>>9<OPTION value=10 <?=$check[10]?>>10<OPTION value=11 <?=$check[11]?>>11<OPTION value=12 <?=$check[12]?>>12</option></SELECT>월&nbsp;<SELECT size=1 name=end_day class=input><OPTION value=1 <?=$check2[1]?>>1<OPTION value=2 <?=$check2[2]?>>2<OPTION value=3 <?=$check2[3]?>>3<OPTION value=4 <?=$check2[4]?>>4<OPTION value=5 <?=$check2[5]?>>5<OPTION value=6 <?=$check2[6]?>>6<OPTION value=7 <?=$check2[7]?>>7<OPTION value=8 <?=$check2[8]?>>8<OPTION value=9 <?=$check2[9]?>>9<OPTION value=10 <?=$check2[10]?>>10<OPTION value=11 <?=$check2[11]?>>11<OPTION value=12 <?=$check2[12]?>>12<OPTION value=13 <?=$check2[13]?>>13<OPTION value=14 <?=$check2[14]?>>14<OPTION value=15 <?=$check2[15]?>>15<OPTION value=16 <?=$check2[16]?>>16<OPTION value=17 <?=$check2[17]?>>17<OPTION value=18 <?=$check2[18]?>>18<OPTION value=19 <?=$check2[19]?>>19<OPTION value=20 <?=$check2[20]?>>20<OPTION value=21 <?=$check2[21]?>>21<OPTION value=22 <?=$check2[22]?>>22<OPTION value=23 <?=$check2[23]?>>23<OPTION value=24 <?=$check2[24]?>>24<OPTION value=25 <?=$check2[25]?>>25<OPTION value=26 <?=$check2[26]?>>26<OPTION value=27 <?=$check2[27]?>>27<OPTION value=28 <?=$check2[28]?>>28<OPTION value=29 <?=$check2[29]?>>29<OPTION value=30 <?=$check2[30]?>>30<OPTION value=31 <?=$check2[31]?>>31</option></SELECT>일&nbsp;<INPUT class=input style=border-color:#666666 maxLength="2" size="2" name=end_hour value='<? echo $end_hour?>'>시&nbsp;<INPUT class=input style=border-color:#666666 maxLength="2" size="2" name=end_minute value='<? echo $end_minute?>'>분&nbsp;&nbsp;(2002년 3월 12일 23시 24분)</td>
										</tr>
										<tr height=30>
											<td align=right bgcolor="#F4F4F4"><img src='winko/system/winko_img/newsdot.gif' align='absmiddle'>&nbsp;내용(html)&nbsp;</th>
											<td bgcolor="#ffffff" style="padding-top:7px; padding-bottom:7px; padding-left:12px; padding-right:12px;"><!--textarea name="comment" rows="8" cols="55" style="WIDTH: 100%"><?=$comment?></textarea-->
											<?
											$oFCKeditor = new FCKeditor('comment'); 
											$oFCKeditor->BasePath = 'fckeditor/'; 
											$oFCKeditor->Value = $comment; 
											$oFCKeditor->Width = 580;
											$oFCKeditor->Height = 300;
											$oFCKeditor->Create();
											?>
											<br>링크#1 &lt;a href=&quot;javascript:popup_close('popup_link');&quot;&gt;<br>링크#2 &lt;a href=&quot;javascript:popup_close('popup_link2');&quot;&gt;<br>링크#3 &lt;a href=&quot;javascript:popup_close('popup_link3');&quot;&gt;</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr height=40 bgcolor=#ffffff>
					<td colspan=2 align=center><img src="winko/system/winko_img/blank.gif" height=5><br><input type=image border=0 src="winko/system/winko_img/confirm.gif">&nbsp;&nbsp;<IMG border=0 onclick=history.back() src="winko/system/winko_img/back.gif" style="CURSOR: hand"></td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>

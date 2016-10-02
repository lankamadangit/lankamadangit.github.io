<?
  // 게시물을 구해옴
  $result=@mysql_query("select * from {$top}_popup ORDER BY no DESC") 
        or error2("게시판의 정보를 DB로 부터 가져오는 부분에서 에러가 발생했습니다");
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
                                                <p><b>팝업관리</b></p>
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
                                            <td height="1" bgcolor="#85ACCF"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
                                                    <tr>
                                                        <td width="30" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>No</b></font></p>
                                                        </td>
                                                        <td bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>제목(브라우저 Title)</b></font></p>
                                                        </td>
                                                        <td width="150" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>활성기간</b></font></p>
                                                        </td>
                                                        <td width="30" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>팝업출력</b></font></p>
                                                        </td>
                                                        <td width="30" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>수정</b></font></p>
                                                        </td>
                                                        <td width="30" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>삭제</b></font></p>
                                                        </td>
                                                        <td width="30" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>미리보기</b></font></p>
                                                        </td>
                                                    </tr>
<?
$i=0;
  while($row=mysql_fetch_array($result)) {
	$today = time();
	if(($today >= $row[start_date]) and ($today <= $row[end_date]) and $row[view] == "1"){
	$popup_bgcolor= "#FFCCCC";
	}
	else{
	$popup_bgcolor= "#ffffff";
	}
	$i = $i+1;
	$popup_view = ($row[view]==1) ? "<font color=#009BC0><b>OK</b></font>" : "X";
    $modify = "<a href='admin.php?option=add&option2=popup_add&mode=modify&id=$row[no]'><img src=\"winko/system/winko_img/manager/btn_modify_small.gif\" width=\"14\" height=\"14\" border=\"0\"></a>";
    $preview = "<A onclick=\"javascript:window.open('./popup.html?popup_no=$row[no]', 'popup_$row[no]','width=$row[width],height=$row[height],statusbar=no,scrollbars=$row[scrollbar],toolbar=no')\" href=\"#\">보기</a>";
    $delete = "<a href=winko/kit/add/admin_popup_add_ok.php?mode=delete&id=$row[no] onclick=\"return confirm('삭제하시겠습니까?')\"><img src='winko/system/winko_img/manager/btn_delete_small.gif' width='14' height='14' border='0'></a>";
?>
                                                    <tr>
                                                        <td width="30" bgcolor="white">
                                                            <p align="center"><?=$i?></p>
                                                        </td>
                                                        <td bgcolor="white">
                                                            <p align="center"><? echo STR_CUTTING($row[title],50,"...")?></p>
                                                        </td>
                                                        <td width="150" bgcolor="white">
                                                            <p align="center">start : <? echo date("Y-m-d[H:i]",$row[start_date])?><br>end &nbsp;: <? echo date("Y-m-d[H:i]",$row[end_date])?></p>
                                                        </td>
                                                        <td width="30" bgcolor="white">
                                                            <p align="center"><? echo $popup_view?></p>
                                                        </td>
                                                        <td width="30" bgcolor="#ffffff">
                                                            <p align="center"><? echo $modify?></p>
                                                        </td>
                                                        <td width="30" bgcolor="white">
                                                            <p align="center"><? echo $delete?></p>
                                                        </td>
                                                        <td width="30" bgcolor="white">
                                                            <p align="center"><? echo $preview?></p>
                                                        </td>
                                                    </tr>
<?
} 
?>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="3" cellspacing="0" width="100%" height="30">
                                                    <tr>
                                                        <td>
                                                            <p align="right"><a href="admin.php?option=add&option2=popup_add"><img src="winko/system/winko_img/manager/icon_register.gif" width="64" height="19" border="0" hspace="2"></a></p>
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

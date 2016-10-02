<?
//셀넓이
$width_1="40";
$width_2="";
$width_3="100";
$width_4="60";
$width_5="70";
$width_6="70";
$width_7="65";

  //전체 갯수를 구해옴
  $temp=mysql_fetch_array(mysql_query("select count(*) from {$top}_boardadmin"));
  $total=$temp[0];
  //페이지 구하는 부분
  if($page_num==0)$page_num=10;
  if(!$page) $page=1;
  $start_num=($page-1)*$page_num;
  $total_page=(int)(($total-1)/$page_num)+1;

//  if($member[is_admin]>=3&&$member[board_name]) $ss_que=" and name='$member[board_name]'";

  // 게시물을 구해옴
  $result=@mysql_query("select * from {$top}_boardadmin order by no desc limit $start_num,$page_num") 
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
                                                <p><b>게시판관리(목록)</b></p>
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
                                                        <td width="40" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>no</b></font></p>
                                                        </td>
                                                        <td bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>아이디</b></font></p>
                                                        </td>
														<td width="200" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>게시판이름</b></font></p>
                                                        </td>
                                                        <td width="60" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>글쓰기</b></font></p>
                                                        </td>
                                                        <td width="60" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>환경설정</b></font></p>
                                                        </td>
														<td width="60" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>권한설정</b></font></p>
                                                        </td>
                                                        <td width="60" bgcolor="#E9F5F9">
                                                            <p align="center"><font color="#009BC0"><b>삭제</b></font></p>
                                                        </td>
                                                    </tr>
<?
// 앞에 붙는 가상번호
$number=$total-($page-1)*$page_num;

// 뽑아온 게시물 데이타를 화면에 출력
while($data=mysql_fetch_array($result))
{
if($k_no==$data[no]) $k_color="yellow";
else $k_color="#ffffff";

if($div_lang) $s_v="eng";
else $s_v="";
?>
                                                    <tr>
                                                        <td width="40" bgcolor="white">
                                                            <p align="center"><?=$number?></p>
                                                        </td>
                                                        <td bgcolor=<?=$k_color?>>
                                                            <p align="center"><font color='#D98B14'><b><?=$data[code]?></b></font></a></p>
                                                        </td>
                                                        <td width="200" bgcolor="white">
                                                            <p align="center"><?=$data[name]?></p>
                                                        </td>
														<td width="60" bgcolor="white">
                                                            <p align="center"><a href="winko.php?code=<?=$data[code]?>&v=<?=$s_v?>" target="_blank"><img src="winko/system/winko_img/member_22.gif" width="35" height="14" border="0"></a></p>
                                                        </td>
                                                        <td width="60" bgcolor="white">
                                                            <p align="center"><a href="<?=$PHP_SELF?>?option=board&option2=modify&no=<?=$data[no]?>&page=<?=$page?>&page_num=<?=$page_num?>"><img src="winko/system/winko_img/manager/btn_modify_small.gif" width="14" height="14" border="0"></a></p>
                                                        </td>
                                                        <td width="60" bgcolor="white">
                                                            <p align="center"><a href="<?=$PHP_SELF?>?option=board&option2=grant&no=<?=$data[no]?>&page=<?=$page?>&page_num=<?=$page_num?>"><img src="winko/system/winko_img/manager/btn_modify_small.gif" width="14" height="14" border="0"></a></p>
                                                        </td>
                                                        <td width="60" bgcolor="white">
                                                            <p align="center"><a href="<?=$PHP_SELF?>?option=board&option2=del&no=<?=$data[no]?>&page=<?=$page?>&page_num=<?=$page_num?>" onclick="return confirm('삭제하시겠습니까?')"><img src='winko/system/winko_img/manager/btn_delete_small.gif' width='14' height='14' border='0'></a></p>
                                                        </td>
                                                    </tr>
<?
$number--;
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
<?
//페이지 나타내는 부분
$show_page_num=10;
$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
$i=1;
if($page>$show_page_num){$prev_page=$start_page-1;echo"<a href=$PHP_SELF?page=$prev_page&option=board&page_num=$page_num>[이전페이지]</a>";}
while($i+$start_page<=$total_page&&$i<=$show_page_num)
{
 $move_page=$i+$start_page;
 if($page==$move_page)echo"<b>$move_page</b>";
 else echo"<a href=$PHP_SELF?page=$move_page&option=board&page_num=$page_num>[$move_page]</a>";
 $i++;
}
if($total_page>$move_page){$next_page=$move_page+1;echo"<a href=$PHP_SELF?page=$next_page&option=board&page_num=$page_num>[다음페이지]</a>";}
//페이지 나타내는 부분 끝
?>
                                                        </td>
                                                        <td width="387">
                                                            <p align="right"><a href="<?=$PHP_SELF?>?option=board&option2=add&page=<?=$page?>&page_num=<?=$page_num?>"><img src="winko/system/winko_img/manager/icon_register.gif" width="64" height="19" border="0" hspace="2"></a></p>
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



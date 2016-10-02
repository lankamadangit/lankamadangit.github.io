<?
//셀넓이
$width_1="30";
$width_2="30";
$width_3="140";
$width_4="";
$width_5="30";
$width_6="30";
$width_7="30";
$width_8="30";

// 전체게시물수
$temp=mysql_fetch_array(mysql_query("select count(*) from {$top}_banner"));
$total=$temp[0];

//페이지 구하는 부분
if(!$page_num)$page_num=10;
if(!$page) $page=1;
$start_num=($page-1)*$page_num;
$total_page=(int)(($total-1)/$page_num)+1;
  
// 게시물을 구해옴
$que="select * from {$top}_banner order by alt limit $start_num,$page_num";
$result=mysql_query($que) or Error(mysql_error());

//  앞에 붙는 가상번호
$number=$total-($page-1)*$page_num;
?>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
  <tr height=20><td colspan=10></td></tr>
  <tr height=30><td colspan=10>
<table align="center" cellpadding="0" cellspacing="0" width="95%">
    <tr>
        <td>
            <p><img src="winko/system/winko_img/banner_title.gif" width="112" height="32" border="0"></p>
        </td>
    </tr>
</table>  
  </td></tr>
<tr><td colspan=10><img src='winko/system/winko_img/blank.gif' height=5></td></tr>
<tr><td colspan=10 background="winko/system/winko_img/member_14.gif"><img src='winko/system/winko_img/blank.gif' height=1></td></tr>
<tr><td colspan=10>
<!-- new start-->
<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#E0E0E0">
            <table cellpadding="0" cellspacing="8" width="100%">
                <tr>
                    <td>
                        <table cellpadding="2" cellspacing="1" width="100%">
                            <tr align=center height=25>
                                <td width="<?=$width_1?>"bgcolor="#F4F4F4">
                                    <p>번호</p>
                                </td>
                                <td width="<?=$width_3?>" bgcolor="#F4F4F4">
                                    <p>Name</p>
                                </td>
                                <td width="<?=$width_4?>" bgcolor="#F4F4F4">
                                    <p>URL</p>
                                </td>
                                <td width="<?=$width_5?>" bgcolor="#F4F4F4">
                                    <p>hit</p>
                                </td>
                                <td width="<?=$width_6?>" bgcolor="#F4F4F4">
                                    <p>출력</p>
                                </td>
                                <td width="<?=$width_7?>" bgcolor="#F4F4F4">
                                    <p>수정</p>
                                </td>
                                <td width="<?=$width_8?>" bgcolor="#F4F4F4">
                                    <p>삭제</p>
                                </td>
                            </tr>
						</table>
					</td>
				</tr>
				<tr>
				    <td>
					    <table cellpadding="2" cellspacing="1" width="100%">
<?
  while($row=mysql_fetch_array($result)) {
    if(file_exists("./banner/$row[no]".".jpg"))
      $banner_img = "<img src='./banner/$row[no].jpg' border=0>";
    else if(file_exists("./banner/$row[no]".".gif"))
      $banner_img = "<img src='./banner/$row[no].gif' border=0>";
    else
      $banner_img = "";
    $banner_view = ($row[view]==1) ? "<font color=red>ok</font>" : "-";

    $modify = "<a href='admin2.php?option=view_add&option2=banner_add&mode=modify&id=$row[no]&page=$page'>수정</a>";
    $delete = "<a href=./admin_mode/banner_add_ok.php?mode=delete&id=$row[no] onclick=\"return confirm('삭제하시겠습니까?')\">삭제</a>";
?>
<tr align=center class=st_bgc_list>
  <td width="<?=$width_1?>" bgcolor="#ffffff"><? echo $number?></td>
  <td width="<?=$width_3?>" bgcolor="#ffffff"><? echo $row[alt]?></td>
  <td width="<?=$width_4?>" bgcolor="#ffffff"><a href="<?=$row[url]?>" target="_blank"><font color="#0066ff"><u><? echo $row[url]?></u></font></a></td>
  <td width="<?=$width_5?>" bgcolor="#ffffff"><? echo $row[hit]?></td>
  <td width="<?=$width_6?>" bgcolor="#ffffff"><? echo $banner_view?></td>
  <td width="<?=$width_7?>" bgcolor="#ffffff"><? echo $modify?></td>
  <td width="<?=$width_8?>" bgcolor="#ffffff"><? echo $delete?></td>
</tr>
<?  
$number--;	
} 
?>
			</table>
		</td>
	</tr>
</table>
</td></tr>
<tr><td colspan=10 background="winko/system/winko_img/member_14.gif"><img src='winko/system/winko_img/blank.gif' height=1></td></tr>
</table>
</td></tr>
<tr><td>
<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="50">
            <p>&nbsp;</p>
        </td>
        <td>
<p align=center>
<font class=thm8>
<?
//페이지 나타내는 부분
$show_page_num=10;
$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
$i=1;
if($page>$show_page_num){$prev_page=$start_page-1;echo"<a href=$PHP_SELF?option=$option&page=$prev_page$href>[Prev]</a>";}
while($i+$start_page<=$total_page&&$i<=$show_page_num)
{
 $move_page=$i+$start_page;
 if($page==$move_page)echo"<b>$move_page</b>";
 else echo"<a href=$PHP_SELF?option=$option&page=$move_page$href>[$move_page]</a>";
 $i++;
}
if($total_page>$move_page){$next_page=$move_page+1;echo"<a href=$PHP_SELF?option=$option&page=$next_page$href>[Next]</a>";}
//페이지 나타내는 부분 끝

?></font>
</p>
        </td>
        <td width="50">
            <p align="right"><a href="admin2.php?option=view_add&option2=banner_add"><img src="winko/system/winko_img/add.gif" width="47" height="22" border="0" hspace="5" vspace="5"></a></p>
        </td>
    </tr>
</table>
</td></tr>
</table>
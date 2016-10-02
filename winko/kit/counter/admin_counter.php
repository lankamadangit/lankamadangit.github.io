<?
  // 날자 세팅
  if(!$year) $year=date("Y");
  if(!$month) $month=date("m");
  if(!$day) $day=date("d");

  // 사용자 IP 얻어옴
  $user_ip=$REMOTE_ADDR;
  $referer=$HTTP_REFERER;

  // 오늘의 날자 구함
  $today=mktime(0,0,0,$month,$day,$year);
  $yesterday=mktime(0,0,0,$month,$day,$year)-3600*24;

  // 이번달의 첫번째 날자 구함
  $month_start=mktime(0,0,0,$month,1,$year);

  // 이번달의 마지막 날자 구함
  $lastdate=01;
  while (checkdate($month,$lastdate,$year)): 
    $lastdate++;  
  endwhile;
  $lastdate=mktime(0,0,0,$month,$lastdate,$year);

  if(!$no)$no=1;
?>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
  <tr><td colspan=10>
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td width="21">
                                                <p><img src="winko/system/winko_img/manager/subtitle_head.gif" width="21" height="28" border="0"></p>
                                            </td>
                                            <td background="winko/system/winko_img/manager/subtitle_bg.gif" style="padding-top:3px; padding-left:10px;">
                                                <p><b>로그분석</b></p>
                                            </td>
                                            <td width="8">
                                                <p><img src="winko/system/winko_img/manager/subtitle_foot.gif" width="8" height="28" border="0"></p>
                                            </td>
                                        </tr>
                                    </table>  
  </td></tr>
<tr><td colspan=10><img src='winko/system/winko_img/blank.gif' height=15></td></tr>
<tr><td colspan=10 background="winko/system/winko_img/member_14.gif"><img src='winko/system/winko_img/blank.gif' height=1></td></tr>
<tr><td colspan=10>
<!-- new start-->
<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td bgcolor="#E0E0E0">
            <table cellpadding="0" cellspacing="8" width="100%">
                <tr>
                    <td>
<table cellpadding="0" cellspacing="1" width="100%" bgcolor="#F4F4F4" height=28>
<!-- 헤더부분과 날짜 입력 부분 -->
<form method=post action=<? echo $PHP_SELF; ?>?option=counter>
<input type=hidden name=no value=<? echo $no; ?>>
<tr>
    <td align=center>
        Year : <input type=text name=year value=<? echo $year; ?> size=4 maxlength=4 style='background-color:eeeeee; border:1 solid black;height:16'> &nbsp;&nbsp;
        Month : <input type=text name=month value=<? echo $month; ?> size=2 maxlength=2 style='background-color:eeeeee; border:1 solid black;height:16'> &nbsp;&nbsp;
        Day : <input type=text name=day value=<? echo $day; ?> size=2 maxlength=2 style='background-color:eeeeee; border:1 solid black;height:16'> &nbsp;&nbsp;
        <input type=image src=winko/system/winko_img/move.gif border=0 align=absmiddle></td>
</tr>
</table>
</td></tr>
<tr><td><table align='center' cellpadding='0' cellspacing='10' width=100% bgcolor="#ffffff">
<tr>
<td><img src="winko/system/winko_img/bar<? echo $no; ?>.gif" height=20></td> 
</tr>

<!-- --------------------------- -->

<?

//-------------------------- 카운터 수 구해옴 -----------------------------//
  // 전체
  $total=mysql_fetch_array(mysql_query("select unique_counter, pageview from {$top}_counter_main where no=1", $conn));
  $count[total_hit]=$total[0];
  $count[total_view]=$total[1];

  // 오늘 카운터 읽어오는 부분
  $detail=mysql_fetch_Array(mysql_query("select unique_counter, pageview from {$top}_counter_main where date='$today'", $conn));
  $count[today_hit]=$detail[0];
  $count[today_view]=$detail[1];

  // 어제 카운터 읽어오는 부분
  $detail=mysql_fetch_Array(mysql_query("select unique_counter, pageview from {$top}_counter_main where date='$yesterday'", $conn));
  $count[yesterday_hit]=$detail[0];
  $count[yesterday_view]=$detail[1];

  // 최고 카운터 읽어오는 부분
  $detail=mysql_fetch_Array(mysql_query("select max(unique_counter), max(pageview) from {$top}_counter_main where no>1", $conn));
  $count[max_hit]=$detail[0];
  $count[max_view]=$detail[1];

  // 최저 카운터 읽어오는 부분
  $detail=mysql_fetch_Array(mysql_query("select min(unique_counter), min(pageview) from {$top}_counter_main where no>1 and date<$today", $conn));
  $count[min_hit]=$detail[0];
  $count[min_view]=$detail[1];


//-----------------------------------------------------------------------------
// 전체카운터 (1)
//-----------------------------------------------------------------------------
if($no=="1") 
{
  echo"
       <tr>
          <td height=40>
             &nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 전체 방문자수 : $count[total_hit] &nbsp;&nbsp;&nbsp;
             <br>&nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 전체 페이지뷰 : $count[total_view]
          </td>
       </tr>
       <tr> 
          <td height=40>
             &nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 오늘 방문자수 : $count[today_hit] &nbsp;&nbsp;&nbsp;
             <br>&nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 오늘 페이지뷰 : $count[today_view]
          </td>
       </tr>
       <tr>
          <td height=40>
             &nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 어제 방문자수 : $count[yesterday_hit] &nbsp;&nbsp;&nbsp;
             <br>&nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 어제 페이지뷰 : $count[yesterday_view]
          </td>
       </tr>
       <tr>
          <td height=40>
             &nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 최고 방문자수 : $count[max_hit] &nbsp;&nbsp;&nbsp;
             <br>&nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 최고 페이지뷰 : $count[max_view]
          </td>
       </tr>
       <tr>
          <td height=40>
             &nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 최저 방문자수 : $count[min_hit] &nbsp;&nbsp;&nbsp;
             <br>&nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> 최저 페이지뷰 : $count[min_view]
          </td>
       </tr>";
}

//-----------------------------------------------------------------------------
// 오늘 시간대별 카운터 (2)
//-----------------------------------------------------------------------------
elseif($no=="2")
{
  echo"
       <tr>
           <td height=25>
               &nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> $month 월 $day 일 방문자수 : $count[today_hit]
               <br>&nbsp;  <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle>  $month 월 $day 일 페이지뷰 : $count[today_view]
           </td>
       </tr>
       <tr>
           <td height=30 align=center>

           <table width=380 border=0 cellpadding=1 cellspacing=0>";
  
  $max=1;
  for($i=0;$i<24;$i++)
  {
   $time1=mktime($i,0,0,$month,$day,$year);
   $time2=mktime($i,59,59,$month,$day,$year);
   $temp=mysql_fetch_array(mysql_query("select count(*) from {$top}_counter_ip where date>='$time1' and date<='$time2'", $conn));
   $time_count[$i]=$temp[0];
   if($max<$time_count[$i]) $max=$time_count[$i];
  }
 
  for($i=0;$i<24;$i++)
  {
   $per1=(int)($time_count[$i]/$max*100);
   if($per1>100)$per1=99;
   echo"
         <tr>
            <td width=50>- $i 시 </td>
            <td align=left><img src=winko/system/winko_img/bars1.gif border=0 width=$per1% height=10 alt='$i시 방문자수 : $time_count[$i]'></td>
            <td width=80>&nbsp; <font color=blue>Unique $time_count[$i] </td>
         </tr>";
  }

  echo"
         </table>
           </td>
        </tr>
        ";
}

//-----------------------------------------------------------------------------
// 주간별 카운터 (3)
//-----------------------------------------------------------------------------
elseif($no=="3")
{
 $start_day=$day;
 while(date('l',mktime(0,0,0,$month,$start_day,$year))!='Sunday')
 {
  $start_day--;
 }
 $last_day=$day;
 while(date('l',mktime(0,0,0,$month,$last_day,$year))!='Saturday')
 {
  $last_day++;
 }

 $start_time=mktime(0,0,0,$month,$start_day,$year);
 $last_time=mktime(23,59,59,$month,$last_day,$year);
 
 $detail=mysql_fetch_Array(mysql_query("select sum(unique_counter), sum(pageview) from {$top}_counter_main where date>=$start_time and date<=$last_time", $conn));
 $count[week_hit]=$detail[0];
 $count[week_view]=$detail[1];

  echo"
       <tr>
           <td height=25>
               &nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> $month 월 $start_day ~ $last_day 일 방문자수 : $count[week_hit]
               <br>&nbsp;  <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle>  $month 월 $start_day ~ $last_day 일 페이지뷰 : $count[week_view]
           </td>
       </tr>
       <tr>
           <td height=30 align=center>

           <table width=380 border=0 cellpadding=1 cellspacing=0>";

  $max1=1;
  $max2=1;
  for($i=0;$i<7;$i++)
  {
   $time=mktime(0,0,0,$month,$start_day+$i,$year);
   $temp=mysql_fetch_array(mysql_query("select unique_counter, pageview from {$top}_counter_main where date='$time'", $conn));
   $time_count1[$i]=$temp[0];
   if($max1<$time_count1[$i]) $max1=$time_count1[$i];
   $time_count2[$i]=$temp[1];
   if($max2<$time_count2[$i]) $max2=$time_count2[$i];
  }

  $week=array("일요일","월요일","화요일","수요일","목요일","금요일","토요일");
  for($i=0;$i<7;$i++)
  {
   $per1=(int)($time_count1[$i]/$max1*100+1);
   $per2=(int)($time_count2[$i]/$max2*100+1);
   if($per1>100)$per1=99;
   if($per2>100)$per2=99;
   echo"
         <tr>
            <td width=60>- $week[$i] </td>
            <td align=left><img src=winko/system/winko_img/bars1.gif border=0 width=$per1% height=10 alt='$week[$i] 방문자수 : $time_count1[$i]'><br>
                           <img src=winko/system/winko_img/bars2.gif border=0 width=$per2% height=10 alt='$week[$i] 페이지뷰 : $time_count2[$i]'> 
            </td>
            <td width=120>&nbsp; <font color=blue>Unique : $time_count1[$i]<br>&nbsp; <font color=Red>PageView : $time_count2[$i]</td>
         </tr>";
  }

  echo"
         </table>
           </td>
        </tr>
        ";
}

//-----------------------------------------------------------------------------
// 월간카운터 (4)
//-----------------------------------------------------------------------------
elseif($no=="4")  
{
  $total_month_counter=mysql_fetch_array(mysql_query("select sum(unique_counter), sum(pageview) from {$top}_counter_main where date>='$month_start' and date<='$lastdate'", $conn));

  echo"
       <tr>
           <td height=25>
               &nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> $month 월 방문자수 : $total_month_counter[0]
               <br>&nbsp;  <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle>  $month 월 페이지뷰 : $total_month_counter[1]
           </td>
       </tr>
       <tr>
           <td height=30 align=center>
           
           <table width=380 border=0 cellpadding=1 cellspacing=0>
      ";

  // 이번달 카운터 (각각)
  $max=mysql_fetch_array(mysql_query("select max(unique_counter), max(pageview) from {$top}_counter_main where date>='$month_start' and date<='$lastdate'",$conn));
  $month_counter=mysql_query("select date, unique_counter, pageview from {$top}_counter_main where date>='$month_start' and date<='$lastdate'",$conn); 
  while($data=mysql_fetch_array($month_counter))
  {
   $per1=$data[unique_counter]/$max[0]*100;
   $per2=$data[pageview]/$max[1]*100;
   echo"
         <tr>
            <td width=50>- ".date("d 일",$data[date])." </td>
            <td width=220 align=left><img src=winko/system/winko_img/bars1.gif border=0 width=$per1% height=10 alt='Unique : $data[unique_counter]'><br>
                <img src=winko/system/winko_img/bars2.gif border=0 width=$per2% height=10 alt='PageView : $data[pageview]'></td>
            <td width=140>&nbsp; <font color=blue>Unique : $data[unique_counter]</font><br>&nbsp; <font color=red>PageView : $data[pageview]</td>
         </tr>";
  }

  echo"   
         </table>
           </td>
        </tr>
        ";
}

//-----------------------------------------------------------------------------
// 년간카운터 (5)
//-----------------------------------------------------------------------------
elseif($no=="5")
{
  $year_start=mktime(0,0,0,1,1,$year);
  $year_last=mktime(23,59,59,12,31,$year);
  $total_year_counter=mysql_fetch_array(mysql_query("select sum(unique_counter), sum(pageview) from {$top}_counter_main where date>='$year_start' and date<='$year_last'", $conn));

  echo"
       <tr>
           <td height=25>
               &nbsp; <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> $year 년 방문자수 : $total_year_counter[0]
               <br>&nbsp;  <img src=winko/system/winko_img/arrow.gif border=0 align=absmiddle> $year 년 페이지뷰 : $total_year_counter[1]
           </td>
       </tr>
       <tr>
           <td height=30 align=center>

           <table width=380 border=0 cellpadding=1 cellspacing=0>
      ";

  // 이번달 카운터 (각각)
$max1=1;
  $max2=1;
  for($i=0;$i<7;$i++)
  {
   $time=mktime(0,0,0,$month,$start_day+$i,$year);
   $temp=mysql_fetch_array(mysql_query("select unique_counter, pageview from {$top}_counter_main where date='$time'", $conn));
   $time_count1[$i]=$temp[0];
   if($max1<$time_count1[$i]) $max1=$time_count1[$i];
   $time_count2[$i]=$temp[1];
   if($max2<$time_count2[$i]) $max2=$time_count2[$i];
  }


  $mmax=array("31","28","31","30","31","30","31","31","30","31","30","31");
  $max=1;
  $max2=1;
  for($i=0;$i<12;$i++)
  {
   $sdate=mktime(0,0,0,$i+1,1,$year);
   $edate=mktime(0,0,0,$i+1,$mmax[$i],$year);
   $year_counter=mysql_query("select sum(unique_counter), sum(pageview) from {$top}_counter_main where date>='$sdate' and date<='$edate'",$conn);
   $temp=mysql_fetch_array($year_counter);
   $time_count1[$i]=$temp[0];
   if($max1<$time_count1[$i]) $max1=$time_count1[$i];
   $time_count2[$i]=$temp[1];
   if($max2<$time_count2[$i]) $max2=$time_count2[$i];
  }
  
  for($i=0;$i<12;$i++)
  {
   $per1=(int)($time_count1[$i]/$max1*100+1);
   $per2=(int)($time_count2[$i]/$max2*100+1);
   if($per1>100)$per1=99;
   if($per2>100)$per2=99;
   $j=$i+1;
   echo"
         <tr>
            <td width=60>- $j 월 </td>
            <td align=left><img src=winko/system/winko_img/bars1.gif border=0 width=$per1% height=10 alt='$week[$i] 방문자수 : $time_count1[$i]'><br>
                           <img src=winko/system/winko_img/bars2.gif border=0 width=$per2% height=10 alt='$week[$i] 페이지뷰 : $time_count2[$i]'>
            </td>
            <td width=120>&nbsp; <font color=blue>Unique : $time_count1[$i]<br>&nbsp; <font color=Red>PageView : $time_count2[$i]</td>
         </tr>"; 
  }

  echo"  
         </table>
           </td>
        </tr>
        ";
}

//-----------------------------------------------------------------------------
// 접속자 방문경로?(6)
//-----------------------------------------------------------------------------
elseif($no=="6")  
{
  echo "<tr><td>";
  $ip=mysql_query("select referer, hit from {$top}_counter_referer where date='$today' order by hit desc", $conn);
  while($data=mysql_fetch_array($ip))
  {
   if(!eregi("\$admin_domain",$data[referer])) {
   if(strlen($data[referer])>60) 
   {
    $temp=substr($data[referer],0,60);
    $text="$temp..."; 
   }
   else $text=$data[referer];
   if(!eregi("Typing or Bookmark", $data[referer])) $data[referer]="<a href=$data[referer] target=_blank>$text</a>";
   echo "&nbsp;&nbsp;&nbsp; - <font color=#ED6C52>($data[hit])</font> $data[referer]<br>";
  }
  }
  echo"</td></tr>";
}

//-----------------------------------------------------------------------------
//  하단부분
//-----------------------------------------------------------------------------
  echo"
        </form>
		</table></td></tr></table></td></td></tr></table></td></tr></table>";

?>

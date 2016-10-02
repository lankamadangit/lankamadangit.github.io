<?
  // 사용자 IP 얻어옴
  $user_ip=$REMOTE_ADDR;
  $referer=$HTTP_REFERER;
  if(!$referer) $referer="Typing or Bookmark Moving On This Site";

  // 오늘의 날자 구함
  $today=mktime(0,0,0,date("m"),date("d"),date("Y"));
  $yesterday=mktime(0,0,0,date("m"),date("d"),date("Y"))-60*60*24;
  $tomorrow=mktime(23,59,59,date("m"),date("d"),date("Y"));
  $time=time();
//------------------- 카운터 테이블에 데이타 입력 부분 -------------------------------------------------------

  // counter_main에서 오늘날짜 행이 없으면 추가.
  $check=mysql_fetch_array(mysql_query("select count(*) from {$top}_counter_main where date='$today'",$conn));
  if(!$check[0])
  {
   mysql_query("insert into {$top}_counter_main (date, unique_counter, pageview) values ('$today', '0', '0')", $conn);
  }

  // 지금 아이피로 접속한 사람이 오늘 처음 온 사람인지 검사
  $check=mysql_fetch_array(mysql_query("select count(*) from {$top}_counter_ip where date>=$today and date<$tomorrow and ip='$user_ip'",$conn));
  // 오늘 처음왔을때
  if($check[0]==0)
  {
   // 전체랑 오늘 카운터 올림
   mysql_query("update {$top}_counter_main set unique_counter=unique_counter+1, pageview=pageview+1 where no=1 or date='$today'", $conn);  

   // 오늘 시간대별 ip 입력
   mysql_query("insert into {$top}_counter_ip (date, ip) values ('$time','$user_ip')",$conn);
  }
  // 오늘 한번 이상 온 상태일때
  else
  {
   // 페이지뷰 올림
   mysql_query("update {$top}_counter_main set pageview=pageview+1 where no=1 or date='$today'", $conn);
  }

  // referer 값 저장
  $check2=mysql_fetch_array(mysql_query("select count(*) from {$top}_counter_referer where date=$today and referer='$referer'",$conn));
   if($check2[0]==0)
   {
    mysql_query("insert into {$top}_counter_referer (date, referer, hit) values ('$today','$referer','1')", $conn);
   }
   else
   {
    mysql_query("update {$top}_counter_referer set hit=hit+1 where date=$today and referer='$referer'", $conn);
   } 

//------------------- 카운터 값 읽어오는 부분 ----------------------------------------------------------------------
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

?>

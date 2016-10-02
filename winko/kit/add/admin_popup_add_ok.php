<?
##### DB 접속 정보 #####
require_once("../../system/config.php");

#### 필수입력사항
 if($mode=="" || $mode=="u") {
    if(trim($popup_title)=="") error2("title을 입력하세요.");
    if(trim($height)=="") error2("창크기를 입력해 주세요");
    if(trim($width)=="") error2("창크기를 입력해 주세요.");
	if(trim($comment)=="") error2("내용을 입력해 주세요.");
  }

$comment = addslashes($comment);
$start_date = mktime($start_hour,$start_minute,10,$start_month,$start_day,$start_year);
$end_date = mktime($end_hour,$end_minute,10,$end_month,$end_day,$end_year);


if($mode=="") {
    $sql = " insert into {$top}_popup values('','$width', '$height', '$popup_title', '$comment', '$link', '$link2', '$link3', '$popup_view', '$popup_view_kr', '$popup_view_eng', '$popup_view_jp', '$popup_view_ch', '$scrollbar', '$start_date', '$end_date') ";
    $result = mysql_query($sql);
  }
else if ($mode=="modify") {
    $sql = " update {$top}_popup set width='$width', height='$height', title='$popup_title', comment='$comment', link='$link', link2='$link2', link3='$link3', view='$popup_view', view_kr='$popup_view_kr', view_eng='$popup_view_eng', view_jp='$popup_view_jp', view_ch='$popup_view_ch', scrollbar='$scrollbar', start_date='$start_date', end_date='$end_date' where no = $id ";
    $result = mysql_query($sql);
  } 
else if ($mode=="delete") {
    $sql = " delete from {$top}_popup where no = $id ";
    $result = mysql_query($sql);
  }

movepage("../../../admin.php?option=add&option2=popup_list");
?>

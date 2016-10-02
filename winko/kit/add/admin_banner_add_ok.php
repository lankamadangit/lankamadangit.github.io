<?
##### 사용자 정의 함수 파일을 가져온다.
require_once("../system/function.user.php");

##### DB 접속 정보
require_once("../system/config.php");

##### 작업대상 데이터베이스를 선택한다.
$db = mysql_select_db($dbName);
if(!$db) {
   error("FAILED_TO_SELECT_DB");
   exit;
}

#### 이미지가 jpeg, gif 가 아니면 에러
 if($mode=="" || $mode=="u") {
    if(trim($alt)=="") error2("배너이름을 입력하세요.");
    if(trim($url)=="http://" || trim($url)=="") error2("링크를 입력하세요.");
//    if($mode=="") {
//      if(trim($banner_img)=="none") error2("배너그림을 입력하세요.");
//      if(trim($banner_img)!="none" && !eregi(".jpg|.gif", substr($banner_img_name,-4))) error2("배너그림이 jpg, gif 파일이 아닙니다. ($banner_img_name)");
//    }
  }
if(!eregi("http://",$url)&&$url) $url="http://$url";
if($mode=="") {
    $sql = " insert into $winko_banner values('', '$rank', '$alt', '$url', '$hit', '$banner_view') ";
    $result = mysql_query($sql);
    //$abn_id = mysql_insert_id(); // 그림 파일명으로 쓰기 위해서 insert된 id를 얻는다.
  }
else if ($mode=="modify") {
    $sql = " update $winko_banner set rank='$rank', alt='$alt', url='$url', hit='$hit', view='$banner_view' where no = $id ";
    $result = mysql_query($sql);
  } 
else if ($mode=="delete") {
    $sql = " delete from $winko_banner where no = $id ";
    $result = mysql_query($sql);
  }

#### 베너 이미지 업로드
//if($mode=="") {
//    if(trim($banner_img)!="none" && eregi(".jpg|.gif", substr($banner_img_name,-4))) {  // 배너그림 업로드
//      copy($banner_img, "../banner/$abn_id".substr($banner_img_name,-4));
//      chmod("../banner/$abn_id".substr($banner_img_name,-4), 0666);
//    }
//  } 
//elseif($mode=="modify") {
//    if(trim($banner_img)!="none" && eregi(".jpg|.gif", substr($banner_img_name,-4))) {  // 배너그림 업로드
//      copy($banner_img, "../banner/$id".substr($banner_img_name,-4));
//      chmod("../banner/$id".substr($banner_img_name,-4), 0666);
//    }
//  } 
//else {  // delete
//    if(file_exists("../banner/$id".".jpg")) unlink("../banner/$id".".jpg");
//    if(file_exists("../banner/$id".".gif")) unlink("../banner/$id".".gif");
//  }
movepage("../admin2.php?option=view_add&option2=banner_list&page=$page");
?>

<?
##### 방명록 테이블명을 인자로 전달받아 해당하는 이미지를 출력한다.
//function printTitleImage($code) {
//   $title_image = $code . ".gif";
//   echo "<center><img src=\"" . $title_image . "\" border=0></center><p>";
//}

##### 방명록 본문작성시 HTML 태그를 허용할 것인지를 나타내는 메시지를 출력한다.
function printAllowTagMsg($ok_html) {
   if($ok_html == 1) {
      echo "(HTML <font color=yellow>가능</font>)&nbsp;&nbsp;";
   } else {
      echo "(HTML <font color=red>불가</font>)&nbsp;&nbsp;";
   }
}
##### 에러발생시 인자로 전달받은 에러 메시지를 팝업창에 띄워 출력한다.
function popup_msg($msg) {
   echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script language=\"javascript\">
   <!--
   alert('$msg');
   history.back();
   //-->
   </script>");
}

##### 에러발생시 에러코드를 인자로 전달받아 에러상황에 해당하는 메시지와 함께 popup_msg()함수를 호출한다.
if($v=="eng"){
function error($errcode) {
   switch ($errcode) {
      case ("NOT_FOUND_CONFIG_FILE") :
         popup_msg("현재 디렉토리에 참조할 환경설정 파일이 없습니다.");
         break;

      case ("ACCESS_DENIED_DB_CONNECTION") :
         popup_msg("데이터베이스 연결에 실패하였습니다.\\n\\n연결하고자 하는 서버명과 사용자명, 비밀번호를 확인하시기 바랍니다.");
         break;

      case ("FAILED_TO_SELECT_DB") :
         popup_msg("지정한 데이터베이스를 작업대상 데이터베이스로 할 수 없습니다.\\n\\n지정한 데이터베이스를 확인하시기 바랍니다.");
         break;

      case ("QUERY_ERROR") :
         $err_no = mysql_errno();
         $err_msg = mysql_error();
         $error_msg = "ERROR CODE " . $err_no . " : " . $err_msg;
         $error_msg = addslashes($error_msg);
         popup_msg($error_msg);
         break;

      case ("NOT_ALLOWED_NAME") :
         popup_msg("Please enter your name.");
         break;

      case ("NOT_ALLOWED_EMAIL") :
         popup_msg("The format of this email address seems wrong. Please recheck and enter it again.");
         break;

      case ("NOT_ALLOWED_HOMEPAGE") :
         popup_msg("The format of this homepage address seems wrong. Please recheck and enter it again.");
         break;

      case ("NOT_ALLOWED_SUBJECT") :
         popup_msg("입력하신 제목은 허용되지 않는 값입니다.\\n\\n다시 입력하여 주십시오.");
         break;

      case ("NOT_ALLOWED_PASSWD") :
         popup_msg("You a password must be at least 4 characters.");
         break;

	  case ("NOT_ALLOWED_PASSWD2") :
         popup_msg("Please enter your password.");
         break;

      case ("NOT_ALLOWED_COMMENT") :
         popup_msg("Please enter comment.");
         break;

      case ("CANNOT_SEND_MAIL") :
         popup_msg("We can not deliver your mail.\\n\\nPlease check your dispatching mail type.");
         break;

      case ("NO_ACCESS_MODIFY") :
         popup_msg("Invalid password");
         break;

      case ("NO_ACCESS_DELETE") :
         popup_msg("Invalid password");
         break;

      case ("NO_ACCESS_DELETE_THREAD") :
         popup_msg("You can not delete the article with reply one.\\n\\nPlease, delete all the reply article first, and then delete the article.");
         break;

	  case ("NOT_ALLOWED_FILE") :
         popup_msg("This relevant file is not allowed to upload by operational guidelines of webmaster");
         break;

      case ("SAME_FILE_EXIST") :
         popup_msg("This file name has been registered  already.\\n\\nPlease upload it with another file name.");
         break;

      case ("ACCESS_DENIED_TO_COPY") :
         popup_msg("Error occurred while uploading.\\n\\n파일이 저장될 디렉토리가 없거나 디렉토리의 퍼미션 제한으로 인한 오류일 가능성이 있습니다.");
         break;

      case ("ACCESS_DENIED_TO_DELETE_TMP_FILE") :
         popup_msg("Error occurred while uploading.\\n\\nPlease contact with webmaster.");
         break;

      case ("FILE_DELETE_FAILURE") :
         popup_msg("File won't be deleted.\\n\\nPlease contact with webmaster.");
         break;

      default :
   }
}
} //if($v=="eng"){
else {
function error($errcode) {
   switch ($errcode) {
      case ("NOT_FOUND_CONFIG_FILE") :
         popup_msg("현재 디렉토리에 참조할 환경설정 파일이 없습니다.");
         break;

      case ("ACCESS_DENIED_DB_CONNECTION") :
         popup_msg("데이터베이스 연결에 실패하였습니다.\\n\\n연결하고자 하는 서버명과 사용자명, 비밀번호를 확인하시기 바랍니다.");
         break;

      case ("FAILED_TO_SELECT_DB") :
         popup_msg("지정한 데이터베이스를 작업대상 데이터베이스로 할 수 없습니다.\\n\\n지정한 데이터베이스를 확인하시기 바랍니다.");
         break;

      case ("QUERY_ERROR") :
         $err_no = mysql_errno();
         $err_msg = mysql_error();
         $error_msg = "ERROR CODE " . $err_no . " : " . $err_msg;
         $error_msg = addslashes($error_msg);
         popup_msg($error_msg);
         break;

      case ("NOT_ALLOWED_NAME") :
         popup_msg("입력하신 이름은 허용되지 않는 값입니다.\\n\\n다시 입력하여 주십시오.");
         break;

      case ("NOT_ALLOWED_EMAIL") :
         popup_msg("입력하신 전자우편주소의 형식이 올바르지 않습니다.\\n\\n다시 입력하여 주십시오.");
         break;

      case ("NOT_ALLOWED_HOMEPAGE") :
         popup_msg("입력하신 홈페이지 주소의 형식이 올바르지 않습니다.\\n\\n다시 입력하여 주십시오.");
         break;

      case ("NOT_ALLOWED_SUBJECT") :
         popup_msg("입력하신 제목은 허용되지 않는 값입니다.\\n\\n다시 입력하여 주십시오.");
         break;

      case ("NOT_ALLOWED_PASSWD") :
         popup_msg("암호는 최소 4자이상의 영문자 또는 숫자여야 합니다.\\n\\n다시입력하여 주십시오.");
         break;

	  case ("NOT_ALLOWED_PASSWD2") :
         popup_msg("암호를 입력해 주십시요.");
         break;

      case ("NOT_ALLOWED_COMMENT") :
         popup_msg("본문을 입력하지 않으셨습니다.\\n\\n다시 입력하여 주십시오.");
         break;

      case ("CANNOT_SEND_MAIL") :
         popup_msg("메일을 발송할 수 없습니다.\\n\\n발송메일의 형식을 확인하여 주십시오.");
         break;

      case ("NO_ACCESS_MODIFY") :
         popup_msg("입력하신 암호와 일치하지 않으므로 수정할 수 없습니다. \\n\\n다시 입력하여 주십시오.");
         break;

      case ("NO_ACCESS_DELETE") :
         popup_msg("입력하신 암호와 일치하지 않으므로 삭제할 수 없습니다. \\n\\n다시 입력하여 주십시오.");
         break;

      case ("NO_ACCESS_DELETE_THREAD") :
         popup_msg("답변이 있는 글은 삭제하실 수 없습니다. \\n\\n답변글을 모두 삭제하신 후 삭제하십시오.");
         break;

	  case ("NOT_ALLOWED_FILE") :
         popup_msg("해당파일은 자료실 운영지침에 따라 업로드가 허용되지 않는 파일입니다.\\n\\n가능하면 압축파일의 형태로 등록하여 주십시오.");
         break;

      case ("SAME_FILE_EXIST") :
         popup_msg("동일한 이름의 파일이 이미 등록되어 있습니다.\\n\\n다른 이름으로 업로드하여 주십시오.");
         break;

      case ("ACCESS_DENIED_TO_COPY") :
         popup_msg("업로드 과정중 오류가 발생하였습니다. \\n\\n파일이 저장될 디렉토리가 없거나 디렉토리의 퍼미션 제한으로 인한 오류일 가능성이 있습니다.");
         break;

      case ("ACCESS_DENIED_TO_DELETE_TMP_FILE") :
         popup_msg("업로드 과정중 오류가 발생하였습니다. \\n\\n관리자에게 문의하여 주십시오.");
         break;

      case ("FILE_DELETE_FAILURE") :
         popup_msg("파일이 삭제되지 않았습니다. \\n\\n관리자에게 문의하여 주십시오.");
         break;

      default :
   }
}
}

##### 인증에 필요한 이름과 암호를 입력받는 인증창을 띄우는 함수
function authenticate() {
   include "login.php";
   exit;
}
////////////////////////////////////////////////////////////////
function authenticate2() {
   Header("WWW-authenticate: basic realm=\"관리자 영역\"");
   Header("HTTP/1.0 401 Unauthorized");

   echo("
	<html>
	<body>
       	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script language=\"javascript\">
	<!--
           alert('관리자 인증에 실패하였습니다.');
           history.back();
	//-->
        </script>
	</body>
	</html>
   ");

   exit;
}

/////////////////////////////////////////////////////////////////////////
// 페이지 이동 스크립트
/////////////////////////////////////////////////////////////////////////
function movepage($url)
{
 global $db;
 echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
 if($db) @mysql_close($db);
 exit;
}

/////////////////////////////////////////////////////////////////////////
// 에러 메세지 출력
/////////////////////////////////////////////////////////////////////////
function error2($msg) { // 경고 메시지 출력
   echo ("
     <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script>
     window.alert('$msg')
     history.go(-1)
     </script>
   ");
   exit;
}

/////////////////////////////////////////////////////////////////////////
// 에러 메세지 출력
/////////////////////////////////////////////////////////////////////////
function error3($msg) { // 경고 메시지 출력
   echo ("
     <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script>
     window.alert('$msg')
	 window.close()
     </script>
   ");
   exit;
}
///////////////////////////////////////////////////////////////////////////
// 로그인이 되어 있는지를 검사하여 로그인되어있으면 해당 회원의 정보를 저장
///////////////////////////////////////////////////////////////////////////
function member()
{
 global $MEMBER_ID, $top;

 // 우선 쿠키가 존재할때;;
 if($MEMBER_ID) {
  // 접속 테이블에도 있는지를 검사;;
  $check=mysql_fetch_array(mysql_query("select count(*) from {$top}_connect_member where mem_id='$MEMBER_ID'"));
  // 접속테이블에도있으면 값을 갖고 옴;;
  if($check[0])
  {
   //다시 쿠키를 구움;;
   mysql_query("update connect_member set logtime='".time()."' where mem_id='$MEMBER_ID'");
   $member=mysql_fetch_array(mysql_query("select * from {$top}_member where mem_id='$MEMBER_ID'"));
  }
  else
  {
   @session_unregister("MEMBER_ID") or die("session_unregister err");
   @session_unregister("MEMBER_NAME") or die("session_unregister err");
   @session_unregister("MEMBER_LEVEL") or die("session_unregister err");
   @session_unregister("MEMBER_PART") or die("session_unregister err");
   $member[level]=10;
  }
 }
 else $member[level]=10;
 return $member;
}


/////////////////////////////////////////////////////////////////////////
// 로그인 시키는 부분
/////////////////////////////////////////////////////////////////////////
function check_login($PHP_AUTH_USER,$PHP_AUTH_PW,$keepid)
{
 global $db, $top, $MEMBER_ID, $MEMBER_NAME, $MEMBER_LEVEL, $MEMBER_PART;
 $check=mysql_fetch_array(mysql_query("select * from {$top}_member where mem_id='$PHP_AUTH_USER' and mem_pw=password('$PHP_AUTH_PW')"));

 if($check[no]) {
  $user_row = mysql_fetch_array(mysql_query("select * from {$top}_member where mem_id='$PHP_AUTH_USER'"));
  $MEMBER_ID	= $user_row[mem_id];
  $MEMBER_NAME	= $user_row[name];
  $MEMBER_LEVEL	= $user_row[level];
  $MEMBER_PART	= "member";

  $_SESSION['MEMBER_ID']		= "$MEMBER_ID";
  $_SESSION['MEMBER_NAME']		= "$MEMBER_NAME";
  $_SESSION['MEMBER_LEVEL']		= "$MEMBER_LEVEL";
  $_SESSION['MEMBER_PART']		= "$MEMBER_PART";

  //@session_register("MEMBER_ID") or die("session_register err");
  //@session_register("MEMBER_NAME") or die("session_register err");
  //@session_register("MEMBER_LEVEL") or die("session_register err");
  //@session_register("MEMBER_PART") or die("session_register err");

  //if($keepid=="Y") {
	//setCookie("KEEP_ID",$PHP_AUTH_USER,time()+"31536000000","/");
  //}
  //else {
//	SetCookie("KEEP_ID","",0,"/");
  //}

  $temp=mysql_fetch_array(mysql_query("select count(*) from {$top}_connect_member where mem_id='$PHP_AUTH_USER'"));
  if($temp[0]) mysql_query("update {$top}_connect_member set logtime='".time()."' where mem_id='$PHP_AUTH_USER'");
  else mysql_query("insert into {$top}_connect_member (mem_id,logtime) values ('$PHP_AUTH_USER','".time()."')");
  mysql_query("update {$top}_member set connectdate='".time()."' where mem_id='$PHP_AUTH_USER'");
  return 1;
 }
}

/////////////////////////////////////////////////////////////////////////
// 문자 자르기
/////////////////////////////////////////////////////////////////////////
function STR_CUTTING( $LONG_STR , $CUTTING_LEN ,$dot,$charset="utf-8")
{
	if($CUTTING_LEN<=0) return $LONG_STR;
	if(mb_strlen($LONG_STR, $charset) > $CUTTING_LEN) {
		$my_subject = mb_substr($LONG_STR, 0, $CUTTING_LEN, $charset ).$dot;
	}else{
		$my_subject = $LONG_STR;
	}
	return $my_subject;
}

//////////////////////////////////////////////////////////////////////////
// 빈문자열 경우 1을 리턴
//////////////////////////////////////////////////////////////////////////
function blank_check($str) {
    $temp=str_replace("　","",$str);
    $temp=str_replace("\n","",$temp);
    $temp=str_replace("&nbsp;","",$temp);
    $temp=str_replace(" ","",$temp);
    $check=0;
    for($i=0;$i<strlen($temp);$i++)
    {
     if($temp[$i]=="<") $check=1;
     if(!$check) $temp2.=$temp[$i];
     if($temp[$i]==">") $check=0;
    }
    if(eregi("[^[:space:]]",$temp2)) return 0;
    return 1;
}
//////////////////////////////////////////////////////////////////////////
// 주민등록번호 검사
//////////////////////////////////////////////////////////////////////////
function check_jumin($jumin)
{
  $weight = '234567892345'; // 자리수 weight 지정
  $len = strlen($jumin);
  $sum = 0;

  if ($len <> 13) { return false; }

  for ($i = 0; $i < 12; $i++) {
  $sum = $sum + (substr($jumin,$i,1)*substr($weight,$i,1));
  }

  $rst = $sum%11;
  $result = 11 - $rst;

  if ($result == 10) {$result = 0;}
  else if ($result == 11) {$result = 1;}

  $ju13 = substr($jumin,12,1);

  if ($result <> $ju13) {return false;}
  return true;
}
/////////////////////////////////////////////////////////////////////////
// 파일 사이즈
///////////////////////////////////////////////////////////////////////
function GetFileSize($size)
{
 if(!$size) return;
 if($size<1024) return ($size." B");
 else if($size >1024 && $size< 1024 *1024)  {
 return sprintf("%0.1f KB",$size / 1024);
 }
 else return sprintf("%0.2f MB",$size / (1024*1024));
}

////////////////////////////////////////////////////////////////////////
// URL, Mail을 자동으로 체크하여 링크만듬
////////////////////////////////////////////////////////////////////////
function autolink($str)
{
 $str=explode("\n",$str);
 $str=implode("\n ",$str);
 // URL 치환
 $str=" ".$str;
 $str = eregi_replace( ">http://([a-z0-9\_\-\.\/\~\@\?\=\;\&\#\-]+)", "><img src='winko/system/winko_img/behome.gif' width='13' height='13' border='0' align=absmiddle>&nbsp;<a href=http://\\1 target=_blank><font color=#ff6600><u>http://\\1</u></font></a>", $str);
 $str = eregi_replace( "\(http://([a-z0-9\_\-\.\/\~\@\?\=\;\&\#\-]+)\)", "(<img src='winko/system/winko_img/behome.gif' width='13' height='13' align=absmiddle>&nbsp;<a href=http://\\1 target=_blank><font color=#ff6600><u>http://\\1</u></font></a>)", $str);
 $str = eregi_replace( "&nbsp;http://([a-z0-9\_\-\.\/\~\@\?\=\;\&\#\-]+)", "&nbsp;&nbsp;<img src='winko/system/winko_img/behome.gif' width='13' height='13' align=absmiddle>&nbsp;<a href=http://\\1 target=_blank><font color=#ff6600><u>http://\\1</u></font></a>", $str);
 $str = eregi_replace( "&nbsp;&nbsp;http://([a-z0-9\_\-\.\/\~\@\?\=\;\&\#\-]+)", "&nbsp;&nbsp;<img src='winko/system/winko_img/behome.gif' width='13' height='13' align=absmiddle>&nbsp;<a href=http://\\1 target=_blank><font color=#ff6600><u>http://\\1</u></font></a>", $str);
 $str = eregi_replace( " http://([a-z0-9\_\-\.\/\~\@\?\=\;\&\#\-]+)", " <img src='winko/system/winko_img/behome.gif' width='13' height='13' align=absmiddle>&nbsp;<a href=http://\\1 target=_blank><font color=#ff6600><u>http://\\1</u></font></a>", $str);

 // 메일 치환
 $str = eregi_replace("&nbsp;([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)", "<img src='winko/system/winko_img/mailicon.gif' width='13' height='9' align=absmiddle>&nbsp;<a href=mailto:\\1@\\2><font color=#ff6600><u>\\1@\\2</u></font></a>", $str);
 $str = eregi_replace(" ([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)", "<img src='winko/system/winko_img/mailicon.gif' width='13' height='9' align=absmiddle>&nbsp;<a href=mailto:\\1@\\2><font color=#ff6600><u>\\1@\\2</u></font></a>", $str);

 return $str;
}

//////////////////////////////////////////////////////////////////////////
// HTML Tag를 제거하는 함수
//////////////////////////////////////////////////////////////////////////
function del_html( $str )
{
  $str = str_replace( ">", "&gt;",$str );
  $str = str_replace( "<", "&lt;",$str );
  $str = str_replace( "\"", "&quot;",$str );
  return $str;
}

function OnlyMsgView($Msg) {
	echo "
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script language='javascript'>
			alert(\"$Msg\");
		</script>
		";
}

function issueError($msg, $jsAction) {
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><script language=javascript>";
	if($msg) echo "alert('$msg');";
	echo $jsAction."</script>";
}

function encode_2047($subject) {
	return '=?euc-kr?b?'.base64_encode($subject).'?=';
}

function ReFresh($href) {
	echo "<meta http-equiv='Refresh' content='0; URL=$href'>";
}

function array_search2($array, $str) {

	foreach($array as $key => $value) {
		if($value==$str) $result = 1;
	}
	return $result;
}

function goods( $part_idx, $table, $totalPage, $totalList, $listScale, $pageScale, $startPage, $prexImgName, $nextImgName, $search_item=0, $search_order) {
	if( $totalList > $listScale ) {
		if( $startPage+1 > $listScale*$pageScale ) {
			$prePage = $startPage - $listScale * $pageScale;
			$mv_data="startPage=".$prePage."&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order;
			echo "&nbsp;&nbsp;<a href='$_SERVER[PHP_SELF]?option=product&$mv_data' onfocus=this.blur()>$prexImgName</a>&nbsp;&nbsp;";
		}

		for( $j=0; $j<$pageScale; $j++ ) {
			$nextPage = ($totalPage * $pageScale + $j) * $listScale;
			$pageNum = $totalPage * $pageScale + $j+1;
			if( $nextPage < $totalList ) {
				if( $nextPage!= $startPage ) {
					$mv_data="startPage=".$nextPage."&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order;
					echo "<a href='$_SERVER[PHP_SELF]?option=product&$mv_data' onfocus=this.blur()>[$pageNum]</a>";
				} else {
					echo "<b><font color='#000000'>&nbsp;$pageNum&nbsp;<b></b></font></b>";
				}
			}
		}
		if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
			$nNextPage = ($totalPage+1) * $listScale * $pageScale;
			$mv_data="startPage=".$nNextPage."&part_idx=".$part_idx."&table=".$table."&search_item=".$search_item."&search_order=".$search_order;
			echo "&nbsp;&nbsp;<a href='$_SERVER[PHP_SELF]?option=product&$mv_data' onfocus=this.blur()>$nextImgName</a>&nbsp;&nbsp;";
		}
	}

	if( $totalList <= $listScale) {
		echo "<b><font color='#000000'>1</font></b>";
	}
}

//이미지 리사이즈 최대 가로,세로 지정 2012-12-17 yun
function img_resize_limit($paath,$img,$maxwidth,$maxheight){
	if($img){
		$imgsize = getimagesize($path.$img);
		if($imgsize[0]>$maxwidth || $imgsize[1]>$maxheight){
			$sumw=(100*$maxheight)/$imgsize[1];
			$sumh =(100*$maxwidth)/$imgsize[0];
			if($sumw<$sumh){
				$img_width=ceil(($imgsize[0]*$sumw)/100);
				$img_height=$maxheight;
			}else{
				$img_height=ceil(($imgsize[1]*$sumh)/100);
				$img_width=$maxwidth;
			}
		}else{
			$img_width=$imgsize[0];
			$img_height=$imgsize[1];
		}
		$imgsize[0]=$img_width;
		$imgsize[1]=$img_height;
	}else{
		$imgsize[0]=$maxwidth;
		$imgsize[1]=$maxheight;
	}
	return $imgsize;
}
//이미지 리사이즈 최대 가로,세로 지정 2012-12-17 yun

// SQL 쿼리 문자열 생성 :: 입력/수정시 사용
	function change_query_string($arr) {
		//foreach($arr as $field => $value) $field_vals[count($field_vals)] = $value!==NULL ? is_array(unserialize($value)) ? "$field='".addslashes($value)."'" : "$field='".addslashes($value)."'" : "$field=NULL";
		$field_vals = array();
		foreach($arr as $field => $value) $field_vals[] = ($value===NULL) ? "$field=NULL" : "$field='".addslashes($value)."'";
		return @join(', ', $field_vals);
	}
// SQL 쿼리 문자열 생성 :: 입력/수정시 사용
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>DYNE GLOBAL SiteManager</title>
<link rel=StyleSheet HREF="winko/system/css/winko_admin_utf.css" type=text/css title=style>
</head>
<body>
<?
//////////////////////////////////////////////////////////////////////////
// 빈문자열 경우 1을 리턴
//////////////////////////////////////////////////////////////////////////
function isblank($str) {
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
////////////////////////////////////////////////////////////////////////
// 숫자일 경우 1을 리턴
///////////////////////////////////////////////////////////////////////
function isnum($str) {
    if(eregi("[^0-9]",$str)) return 0;
    return 1;
}

//////////////////////////////////////////////////////////////////////
// 숫자, 영문자 일경우 1을 리턴
//////////////////////////////////////////////////////////////////////
function isalNum($str) {
    if(eregi("[^0-9a-zA-Z\_]",$str)) return 0;
    return 1;
}

//////////////////////////////////////////////////////////////////////////
// HTML Tag를 제거하는 함수
//////////////////////////////////////////////////////////////////////////
//function del_html( $str )
//{
//  $str = str_replace( ">", "&gt;",$str );
//  $str = str_replace( "<", "&lt;",$str );
//  $str = str_replace( "\"", "&quot;",$str );
//  return $str;
//}

//////////////////////////////////////////////////////////////////////////
// 게시판의 생성유무 검사
/////////////////////////////////////////////////////////////////////////
function istable($str, $dbname='') 
{
 global $config_dir;
 if(!$dbname)
 {
  $f=@file($config_dir."config.php") or Error2("config.php파일이 없습니다.<br>DB설정을 먼저 하십시요","install.php");
  for($i=1;$i<=4;$i++) $f[$i]=str_replace("\n","",$f[$i]);
  $dbname=$f[4];
 }

 $result = mysql_list_tables($dbname) or Error2(mysql_Error2(),"");

 $i=0;

 while ($i < mysql_num_rows($result))
 {
  if($str==mysql_tablename ($result, $i)) return 1;
  $i++;
 }
 return 0;
}

//////////////////////////////////////////////////////////////////////////////
function del_member($no)
{
 global	$top, $member;
 if(($MEMBER_ID!="winko")&&($MEMBER_ID!=$admin_id)) error2("설정 권한이 없습니다.","admin.php");
 // 멤버 정보 삭제
 @mysql_query("delete from {$top}_member where no='$no'") or error2(mysql_error());
}

#### 회원추가 /////////////////////////////////////////////////
  if($option2=="add_ok")
  {
   if(($MEMBER_ID!="winko")&&($MEMBER_ID!=$admin_id)) error2("설정 권한이 없습니다.","admin.php");

   if(blank_check($name)) error2("이름을 입력하셔야 합니다");
   if($passwd&&$passwd1&&$passwd!=$passwd1) error2("비밀번호가 일치하지 않습니다");
   $check_id=mysql_fetch_array(mysql_query("select count(*) from {$top}_member where mem_id='$user_id'",$conn));
   if($check_id[0]>0) error2("이미 등록되어 있는 아이디입니다","");
   $check_nick=mysql_fetch_array(mysql_query("select count(*) from {$top}_member where nickname='$nickname'",$conn));
   if($check_nick[0]>0) error2("이미 등록되어 있는 닉네임입니다","");

  $name=addslashes($name);
  $nickname=addslashes($nickname);
  $zip = $zip1."-".$zip2;
  $address=addslashes($address);
  $address2=addslashes($address2);
  $memo=addslashes($memo);
  $signdate=time();

  mysql_query("insert into {$top}_member (mem_id,mem_pw,name,level,nickname,sex,birth,email,handphone,zip,address,address2,mailing,memo,signdate) values ('$user_id',password('$passwd'),'$name','$level','$nickname','$sex','$birth','$email','$handphone','$zip','$address','$address2','$mailing','$memo','$signdate')") or error2("회원 데이타 입력시 에러가 발생했습니다<br>".mysql_error());
  echo "<script> window.alert('회원이 추가되었습니다.')</script>";
  movepage("$PHP_SELF?option=member");
  }

#### 회원정보 변경 /////////////////////////////////////////////////
  if($option2=="modify_ok")
  {
   if(($MEMBER_ID!="winko")&&($MEMBER_ID!=$admin_id)) error2("설정 권한이 없습니다.","admin.php");
   if(blank_check($name)) error2("이름을 입력하셔야 합니다");
   if($passwd&&$passwd1&&$passwd!=$passwd1) error2("비밀번호가 일치하지 않습니다");

  $name=addslashes($name);
  $nickname=addslashes($nickname);
  $zip = $zip1."-".$zip2;
  $address=addslashes($address);
  $address2=addslashes($address2);
  $memo=addslashes($memo);
  $modifydate=time();

   if($passwd&&$passwd1){
	   $que="update {$top}_member set mem_id='$user_id',mem_pw=password('$passwd'), name='$name', level='$level', nickname='$nickname', sex='$sex', birth='$birth', email='$email', handphone='$handphone', zip='$zip', address='$address', address2='$address2', mailing='$mailing', memo='$memo', modifydate='$modifydate'";
   }
   else{
	   $que="update {$top}_member set mem_id='$user_id', name='$name', level='$level', nickname='$nickname', sex='$sex', birth='$birth', email='$email', handphone='$handphone', zip='$zip', address='$address', address2='$address2', mailing='$mailing', memo='$memo', modifydate='$modifydate'";
   }
   $que.=" where no='$member_no'";
   @mysql_query($que) or error2("회원정보 수정시에 에러가 발생하였습니다 ".mysql_error());
   echo "<script> window.alert('회원정보가 수정되었습니다.')</script>";

   movepage("$PHP_SELF?option=member&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&k_no=$member_no");
  }

#### 회원정보 변경 /////////////////////////////////////////////////
  if($option2=="modify2_ok")
  {
   if(($MEMBER_ID!="winko")&&($MEMBER_ID!=$admin_id)) error2("설정 권한이 없습니다.","admin.php");

  $memo=addslashes($memo);
  $modifydate=time();

   $que="update {$top}_member set mailing='$mailing', memo='$memo', modifydate='$modifydate'";
   $que.=" where no='$member_no'";
   @mysql_query($que) or error2("회원정보 수정시에 에러가 발생하였습니다 ".mysql_error());
   echo "<script> window.alert('회원정보가 수정되었습니다.')</script>";

   movepage("$PHP_SELF?option=member&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&k_no=$member_no");
  }

#### 회원삭제 ////////////////////////////////////////////////////////
  if($option2=="del")
  {
   if(($MEMBER_ID!="winko")&&($MEMBER_ID!=$admin_id)) error2("설정 권한이 없습니다.","admin.php");
   del_member($no);
   movepage("$PHP_SELF?option=member&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num");
  }

#### 회원전체 삭제하는 부분 /////////////////////////////////////////////////////
  if($option2=="deleteall")
  {
  if(($MEMBER_ID!="winko")&&($MEMBER_ID!=$admin_id)) error2("설정 권한이 없습니다.","admin.php");
   for($i=0;$i<sizeof($cart);$i++)
   {
    del_member($cart[$i]);
   }
   movepage("$PHP_SELF?option=view_member&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num");
  }

#### 회원 권한 변경하는 부분 ////////////////////////////////////////////////////
  if($option2=="moveall")
  {
   if(($MEMBER_ID!="winko")&&($MEMBER_ID!=$admin_id)) error2("설정 권한이 없습니다.","admin.php");
   for($i=0;$i<sizeof($cart);$i++)
   {
    mysql_query("update $winko_member set level='$movelevel' where no='$cart[$i]'",$connect);
   }
   movepage("$PHP_SELF?option=view_member&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num");
  }
?>
</body>
</html>
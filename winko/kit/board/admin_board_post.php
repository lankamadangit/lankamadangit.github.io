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

  
  if($member[is_admin]>=3&&$member[board_name])
  {
   $ttemp=mysql_fetch_array(mysql_query("select no from {$top}_boardadmin where name='$member[board_name]'"));
   $no=$ttemp[no];
  }

#### 게시판 추가 /////////////////////////////////////////////////////////////////////////////////
elseif($option2=="add_ok")
  {
   if($MEMBER_ID!="winko") error2("게시판 추가 권한이 없습니다. 윈코커뮤니케이션에 문의해 주세요.","admin.php");
   // 입력된 테이블 값이 빈값인지, 한글이 들어갔는지를 검사
   if(isBlank($code)) Error2("게시판 이름을 입력하셔야 합니다","");
   if(!isAlNum($code)) Error2("게시판 이름은 영문과 숫자로만 하셔야 합니다","");

   // 같은 이름의 게시판이 이미 생성되었는지를 검사
   $result=@mysql_query("select count(*) from {$top}_boardadmin where code='$code'",$conn) or Error2(mysql_Error());
   $temp=mysql_fetch_array($result);
   if($temp[0]>0) Error2("이미 등록되어 있는 게시판입니다.<br>다른 이름으로 생성하십시요","");

   $code=addslashes($code);
   $bg_color=addslashes($bg_color);
   $title=addslashes($title);

     // 관리자 테이블 생성
    @mysql_query("insert into {$top}_boardadmin 
                  (no, code, skin, name, list_type, allow_delete, new_time, table_width, num_list, notify_admin, reply_indent, cut_length, ok_category, ok_html, ok_sitelink, ok_file1, ok_file2, ok_short, ok_visit, ok_notice, ok_secret, ok_add_a, ok_add_b, filter, block_ip, upload_size1, upload_size2)
                  values
                  ('$no', '$code', '$skin', '$name', '$list_type', '$allow_delete', '$new_time', '$table_width', '$num_list', '$notify_admin', '$reply_indent', '$cut_length', '$ok_category', '$ok_html', '$ok_sitelink', '$ok_file1', '$ok_file2','$ok_short', '$ok_visit', '$ok_notice', '$ok_secret', '$ok_add_a', '$ok_add_b', '$filter', '$block_ip', '$upload_size1', '$upload_size2')")                  
    or Error2("관리자 테이블 생성 에러<br><br>".mysql_Error());

$table_name=$top."_board_".$code;
$table_name2=$top."_short_".$code;

$table_create = "CREATE TABLE {$top}_board_{$code} (
  uid mediumint(9) unsigned NOT NULL auto_increment,
  fid mediumint(9) unsigned NOT NULL,
  ismember int(20) default '0' not null,
  name varchar(20) NOT NULL,
  email varchar(40),
  homepage varchar(60),
  subject varchar(100) NOT NULL,
  comment text NOT NULL,
  passwd varchar(40) NOT NULL,
  signdate int(10) unsigned NOT NULL,
  ref smallint(5) unsigned NOT NULL,
  thread varchar(255) NOT NULL,
  ip varchar(15),
  sitelink varchar(255),
  notice char(1) DEFAULT '0' NOT NULL,
  userfile varchar(255) NOT NULL,
  filesize int(10) unsigned NOT NULL,  
  userfile2 varchar(255) NOT NULL,
  filesize2 int(10) unsigned NOT NULL,  
  ok_category char(1) default '0',
  ok_html char(1) default '0',
  ok_reply char(1) default '0',
  ok_secret char(1) NOT NULL default '0',
  category int(11) NOT NULL default '0',
  downhit1 int(11) NOT NULL default '0',
  downhit2 int(11) NOT NULL default '0',
  add_a varchar(255) NOT NULL,
  add_b varchar(255) NOT NULL,
  add_c varchar(255) NOT NULL,
  add_d varchar(255) NOT NULL,
  PRIMARY KEY (uid)
);";

$table_create2 = "CREATE TABLE {$top}_short_{$code} (
   uid int(11) NOT NULL auto_increment,
   parent int(11) DEFAULT '0' NOT NULL,
   ismember int(20) DEFAULT '0' NOT NULL,
   name varchar(20),
   passwd varchar(40),
   comment text,
   ip varchar(15),
   signdate int(13),
   PRIMARY KEY (uid),
   KEY parent (parent)
);";

   // 게시판 본체 테이블 생성
   @mysql_query($table_create) or Error2("게시판의 메인 테이블 생성 에러가 발생하였습니다");
   @mysql_query($table_create2) or Error2("게시판의 서브(짧은글) 테이블 생성 에러가 발생하였습니다");

   // 자료실 디렉토리 생성
   if(!@mkdir("winko/data/".$code, 0777)){
   Error2("자료실 디렉토리 생성 에러");
   exit;
   }
   
   movepage("$PHP_SELF?option=board$group_no&page=$page&k_no=$no");
   }

#### 게시판 수정 /////////////////////////////////////////////////////////////////////////////////
  if($option2=="modify_ok")
  {
   if($MEMBER_ID!="winko") error2("게시판 수정 권한이 없습니다. 윈코커뮤니케이션에 문의해 주세요.","admin.php");
   // 입력된 테이블 값이 빈값인지, 한글이 들어갔는지를 검사
   if(blank_check($code)) Error2("게시판 이름을 입력하셔야 합니다","");
   if(!isAlNum($code)) Error2("게시판 이름은 영문과 숫자로만 하셔야 합니다","");
   $code=addslashes($code);
   $name=addslashes($name);
   @mysql_query("update {$top}_boardadmin set              skin='$skin',name='$name',list_type='$list_type',allow_delete='$allow_delete',new_time='$new_time',table_width='$table_width',num_list='$num_list',notify_admin='$notify_admin',reply_indent='$reply_indent',cut_length='$cut_length',ok_category='$ok_category',ok_html='$ok_html',ok_sitelink='$ok_sitelink',ok_file1='$ok_file1',ok_file2='$ok_file2',ok_short='$ok_short',ok_visit='$ok_visit',ok_notice='$ok_notice',ok_secret='$ok_secret',ok_add_a='$ok_add_a',ok_add_b='$ok_add_b',upload_size1='$upload_size1',upload_size2='$upload_size2' where no='$no'") or Error2("게시판의 기능설정 변경시 에러가 발생하였습니다");
   movepage("$PHP_SELF?option=board&page=$page&k_no=$no");
  }

 #### 게시판 삭제 ///////////////////////////////////////////////////////////////////////////////////
  elseif($option2=="del")
  {
   if($MEMBER_ID!="winko") error2("게시판 삭제 권한이 없습니다. 윈코커뮤니케이션에 문의해 주세요.","admin.php");
   $data=mysql_fetch_array(mysql_query("select code from {$top}_boardadmin where no='$no'"));
   $table_name=$top."_board_".$data[code];
   $table_name2=$top."_short_".$data[code];
   mysql_query("delete from {$top}_boardadmin where no='$no'") or Error2("게시판 삭제시 관리자 테이블에서 에러가 발생하였습니다");
   mysql_query("drop table $table_name") or Error2("게시판의 메인 테이블 삭제 에러가 발생하였습니다");
   mysql_query("drop table $table_name2") or Error2("게시판의 서브 테이블(짧은글) 삭제 에러가 발생하였습니다");
   
   // 자료실 디렉토리 삭제
   if(!@rmdir("winko/data/".$data[code])){
   Error2("자료실 디렉토리 삭제 에러(디렉토리안에 파일을 먼저 삭제해 주세요)");
   exit;
   }
   movepage("$PHP_SELF?option=board&page=$page");
  }
  // 권한 설정 //////////////////////////////////////////////////////////////////////////////
  elseif($option2=="modify_grant_ok")
  {
   if($MEMBER_ID!="winko") error2("게시판 권한설정 권한이 없습니다. 윈코커뮤니케이션에 문의해 주세요.","admin.php");
   @mysql_query("update {$top}_boardadmin set grant_admin='$grant_admin', grant_list='$grant_list', grant_view='$grant_view', grant_write='$grant_write', grant_reply='$grant_reply', grant_delete='$grant_delete', grant_notice='$grant_notice', grant_comment='$grant_comment', grant_member='$grant_member' where no='$no'") or Error2("권한 설정 변경시 에러가 발생하였습니다".mysql_Error2());
  
   movepage("$PHP_SELF?option=board&page=$page&k_no=$no");
  }
?>

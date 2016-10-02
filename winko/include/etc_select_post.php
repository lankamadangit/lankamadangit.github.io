<?
##### DB 접속 정보 #####
require_once("../system/config.php");

##### Code 지정 안되어 있으면 경고 #####
if(!$code) error2("Error - Code 지정");
  
  // 라이브러리 함수 파일 인크루드
//  require "lib.php";
//  require "include/list_check.php";

  // 게시판 이름 지정이 안되어 있으면 경고;;;
//  if(!$id) Error("게시판 이름을 지정해 주셔야 합니다.<br><br>예) zboard.php?id=이름","");


  // DB 연결
//  if(!$connect) $connect=dbConn();

  // 현재 게시판 설정 읽어 오기
//  $setup=get_table_attrib($id);

//  $dir="skin/".$setup[skinname];
//  $width=$setup[table_width];

  // 설정되지 않은 게시판일때 에러 표시
//  if(!$setup[name]) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요","");

  // 현재 게시판의 그룹의 설정 읽어 오기
//  $group=group_info($setup[group_no]);

  // 멤버 정보 구해오기;;; 멤버가 있을때
//  $member=member_info();

  // 현재 로그인되어 있는 멤버가 전체, 또는 그룹관리자인지 검사
//  if($member[is_admin]==1||$member[is_admin]==2&&$member[group_no]==$setup[group_no]||$member[board_name]==$id) $is_admin=1; else $is_admin="";

  // 현재 그룹이 폐쇄그룹이고 로그인한 멤버가 비멤버일때 에러표시
//  if($group[is_open]==0&&!$is_admin) Error("공개 되어 있지 않습니다");

  // 사용권한 체크
//  if($exec=="view_all"&&$setup[grant_view]<$member[level]&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&keykind=$keykind&keyword=$keyword&no=$no&file=zboard.php");

//  if(!$is_admin&&$exec!="view_all") Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&keykind=$keykind&keyword=$keyword&no=$no&file=zboard.php");
  $select_list=$selected; 
  $selected=explode(";",$selected);


  // Delete_All 일때 ////////////////////////////////////////////////////////////////////
  if($exec=="delete_all")
  {
   for($i=0;$i<count($selected)-1;$i++)
   {
    $temp=mysql_fetch_array(mysql_query("select * from {$top}_board_{$code} where uid='$selected[$i]'"));

	 mysql_query("delete from {$top}_board_{$code} where uid='$selected[$i]'"); // 글삭제

     // 파일삭제
    $filename = $temp[userfile];
	$filename=urldecode($filename);
	$filename2 = $temp[userfile2];
	$filename2=urldecode($filename2);
	$file = "data/".$code . "/" . $filename;
	$file2 = "data/". $code ."/" . $filename2;
	 
	 @unlink($file);
     @unlink($file2);

     mysql_query("delete from {$top}_short_{$code} where parent='$selected[$i]'") or Error(mysql_error()); // 코멘트삭제
   }
   echo"
   <script>
   opener.window.history.go(0);
   window.close();
   </script>";
  }


  // Copy_All 일때 ////////////////////////////////////////////////////////////////////
  elseif($exec=="copy_all"||$exec=="move_all")
  {
   for($i=0;$i<count($selected)-1;$i++)
   {
    $s_data=mysql_fetch_array(mysql_query("select * from {$top}_board_{$code} where uid='$selected[$i]'"));
    if($code) // 답글이 없을때;;
    {
     // 원본글을 모두 구함
     $result=mysql_query("select * from {$top}_board_{$code} where uid='$selected[$i]'");

//     $temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_name",$connect));
//     $max_division=$temp[0];
//     $temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_name where num>0 and division!='$max_division'",$connect));
//     if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

     // 이동할 게시판의 최고 headnum을 구함
//     $max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$board_name where (division='$max_division' or division='$second_division') and headnum>-2000000000",$connect));
//     if(!$max_headnum[0]) $max_headnum[0]=0;
//     $headnum=$max_headnum[0]-1;

     // 이동할 게시판의 이전, 이후글을 구함
//     $next_data=mysql_fetch_array(mysql_query("select division,headnum,arrangenum from $t_board"."_$board_name where (division='$max_division' or division='$second_division') and headnum>-2000000000 order by headnum limit 1"));
//     if(!$next_data[0]) $next_data[0]="0";
//     else
//     {  
//      $next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$board_name where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='$next_data[arrangenum]'"));
//     }

//     $a_category=mysql_fetch_array(mysql_query("select min(no) from $t_category"."_$board_name",$connect));
//     $category=$a_category[0];

//     $next_no=$next_data[no];
//     $father=0;
//     $term_father=0;
//     $root_no=0;

     // looping 하면서 데이타 입력
     while($data=mysql_fetch_array($result))
     {
      // 업로드된 파일이 있을경우 처리 #1		
      if($data[userfile]) 
      {
      	//$temp_ext=time();
      	//@mkdir("data/".$temp_ext,0777);
   
   //한글파일 엔코드
   $userfile_ecd=urldecode($data[userfile]); 

	@copy("data/".$code."/".$userfile_ecd,"data/".$board_name."/".$userfile_ecd);
	$p_file="data/".$board_name."/".$userfile_ecd;
	@chmod($p_file,0706);
//	@chmod("data/".$temp_ext,0707);
      }
      // 업로드된 파일이 있을경우 처리 #2	
      if($data[userfile2]) 
      {
//      	$temp_ext=time();
//      	@mkdir("data/".$temp_ext,0777);

   //한글파일 엔코드
   $userfile_ecd2=urldecode($data[userfile2]); 

	@copy("data/".$code."/".$userfile_ecd2,"data/".$board_name."/".$userfile_ecd2);
	$p_file2="data/".$board_name."/".$userfile_ecd2;
	@chmod($p_file2,0706);
//	@chmod("data/".$temp_ext,0707);
      }

##### 새로 작성된 게시물의 fid(family id), uid(unique id)값을 결정한다.
$p_result = mysql_query("SELECT max(uid), max(fid) FROM {$top}_board_{$board_name}");

$p_row = mysql_fetch_row($p_result);
if($p_row[0]) {
   $new_uid = $p_row[0] + 1;
} else {
   $new_uid = 2;
}   
if($p_row[1]) {
   $new_fid = $p_row[1] + 1;
} else {
   $new_fid = 2;
}   

      mysql_query("insert into {$top}_board_{$board_name} (uid,fid,ismember,name,email,homepage,subject,comment,passwd,signdate,ref,thread,ip,sitelink,notice,userfile,filesize,userfile2,filesize2,ok_category,ok_html,ok_reply,ok_secret,add_a,add_b) values
             ('$new_uid','$new_fid','$data[ismember]','$data[name]','$data[email]','$data[homepage]','$data[subject]','$data[comment]','$data[passwd]','$data[signdate]','$data[ref]','$data[thread]','$data[ip]','$data[sitelink]','$data[notice]','$data[userfile]','$data[filesize]','$data[userfile2]','$data[filesize2]','$data[ok_category]','$data[ok_html]','$data[ok_reply]','$data[ok_secret]','$data[add_a]','$data[add_b]')");

//      $no=mysql_insert_id();
//      if(!$father)
//      {
//       $root_no=$no;
//       $father=$no;
//       $term_father=$data[no]-$no;
//      }

      // Comment 정리
      $comment_result=mysql_query("select * from {$top}_short_{$code} where parent='$data[uid]'");
      while($comment_data=mysql_fetch_array($comment_result))
      {
       //$comment_data[memo]=addslashes($comment_data[memo]);
       //$comment_data[name]=addslashes($comment_data[name]);
       mysql_query("insert into {$top}_short_{$board_name} (parent,ismember,name,passwd,comment,ip,signdate) values
	   ('$new_uid','$comment_data[ismember]','$comment_data[name]','$comment_data[passwd]','$comment_data[comment]','$comment_data[ip]','$comment_data[signdate]')");
      }

//      mysql_query("update $t_category"."_$board_name set num=num+1 where no='$category'",$connect);
     }
//     $prev_data=mysql_fetch_array(mysql_query("select headnum from $t_board"."_$board_name where headnum>'$headnum' order by headnum limit 1"));
//     mysql_query("update $t_board"."_$board_name set prev_no='$root_no' where headnum='$prev_data[0]'",$connect) or Error(mysql_error());
    }
   }
//   $total=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$board_name",$connect));
//   mysql_query("update $admin_table set total_article='$total[0]' where name='$board_name'");

   //MySQL 종료 /////////////////////////////////////
   if($connect) mysql_close($connect); $connect="";

   if($exec=="copy_all")
   {
    echo"
      <script>
      opener.window.history.go(0);
      window.close();
      </script>";
   }
   elseif($exec=="move_all")
   {
    echo"
      <script>
      location.href='etc_select_post.php?code=$code&exec=delete_all&selected=$select_list';
      </script>";
    exit;
   }
  }


?>

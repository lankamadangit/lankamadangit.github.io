<?
##### DB ���� ���� #####
require_once("../system/config.php");

##### Code ���� �ȵǾ� ������ ��� #####
if(!$code) error2("Error - Code ����");
  
  // ���̺귯�� �Լ� ���� ��ũ���
//  require "lib.php";
//  require "include/list_check.php";

  // �Խ��� �̸� ������ �ȵǾ� ������ ���;;;
//  if(!$id) Error("�Խ��� �̸��� ������ �ּž� �մϴ�.<br><br>��) zboard.php?id=�̸�","");


  // DB ����
//  if(!$connect) $connect=dbConn();

  // ���� �Խ��� ���� �о� ����
//  $setup=get_table_attrib($id);

//  $dir="skin/".$setup[skinname];
//  $width=$setup[table_width];

  // �������� ���� �Խ����϶� ���� ǥ��
//  if(!$setup[name]) Error("�������� ���� �Խ����Դϴ�.<br><br>�Խ����� ������ ����Ͻʽÿ�","");

  // ���� �Խ����� �׷��� ���� �о� ����
//  $group=group_info($setup[group_no]);

  // ��� ���� ���ؿ���;;; ����� ������
//  $member=member_info();

  // ���� �α��εǾ� �ִ� ����� ��ü, �Ǵ� �׷���������� �˻�
//  if($member[is_admin]==1||$member[is_admin]==2&&$member[group_no]==$setup[group_no]||$member[board_name]==$id) $is_admin=1; else $is_admin="";

  // ���� �׷��� ���׷��̰� �α����� ����� �����϶� ����ǥ��
//  if($group[is_open]==0&&!$is_admin) Error("���� �Ǿ� ���� �ʽ��ϴ�");

  // ������ üũ
//  if($exec=="view_all"&&$setup[grant_view]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&keykind=$keykind&keyword=$keyword&no=$no&file=zboard.php");

//  if(!$is_admin&&$exec!="view_all") Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&keykind=$keykind&keyword=$keyword&no=$no&file=zboard.php");
  $select_list=$selected; 
  $selected=explode(";",$selected);


  // Delete_All �϶� ////////////////////////////////////////////////////////////////////
  if($exec=="delete_all")
  {
   for($i=0;$i<count($selected)-1;$i++)
   {
    $temp=mysql_fetch_array(mysql_query("select * from {$top}_board_{$code} where uid='$selected[$i]'"));

	 mysql_query("delete from {$top}_board_{$code} where uid='$selected[$i]'"); // �ۻ���

     // ���ϻ���
    $filename = $temp[userfile];
	$filename=urldecode($filename);
	$filename2 = $temp[userfile2];
	$filename2=urldecode($filename2);
	$file = "data/".$code . "/" . $filename;
	$file2 = "data/". $code ."/" . $filename2;
	 
	 @unlink($file);
     @unlink($file2);

     mysql_query("delete from {$top}_short_{$code} where parent='$selected[$i]'") or Error(mysql_error()); // �ڸ�Ʈ����
   }
   echo"
   <script>
   opener.window.history.go(0);
   window.close();
   </script>";
  }


  // Copy_All �϶� ////////////////////////////////////////////////////////////////////
  elseif($exec=="copy_all"||$exec=="move_all")
  {
   for($i=0;$i<count($selected)-1;$i++)
   {
    $s_data=mysql_fetch_array(mysql_query("select * from {$top}_board_{$code} where uid='$selected[$i]'"));
    if($code) // ����� ������;;
    {
     // �������� ��� ����
     $result=mysql_query("select * from {$top}_board_{$code} where uid='$selected[$i]'");

//     $temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_name",$connect));
//     $max_division=$temp[0];
//     $temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_name where num>0 and division!='$max_division'",$connect));
//     if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

     // �̵��� �Խ����� �ְ� headnum�� ����
//     $max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$board_name where (division='$max_division' or division='$second_division') and headnum>-2000000000",$connect));
//     if(!$max_headnum[0]) $max_headnum[0]=0;
//     $headnum=$max_headnum[0]-1;

     // �̵��� �Խ����� ����, ���ı��� ����
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

     // looping �ϸ鼭 ����Ÿ �Է�
     while($data=mysql_fetch_array($result))
     {
      // ���ε�� ������ ������� ó�� #1		
      if($data[userfile]) 
      {
      	//$temp_ext=time();
      	//@mkdir("data/".$temp_ext,0777);
   
   //�ѱ����� ���ڵ�
   $userfile_ecd=urldecode($data[userfile]); 

	@copy("data/".$code."/".$userfile_ecd,"data/".$board_name."/".$userfile_ecd);
	$p_file="data/".$board_name."/".$userfile_ecd;
	@chmod($p_file,0706);
//	@chmod("data/".$temp_ext,0707);
      }
      // ���ε�� ������ ������� ó�� #2	
      if($data[userfile2]) 
      {
//      	$temp_ext=time();
//      	@mkdir("data/".$temp_ext,0777);

   //�ѱ����� ���ڵ�
   $userfile_ecd2=urldecode($data[userfile2]); 

	@copy("data/".$code."/".$userfile_ecd2,"data/".$board_name."/".$userfile_ecd2);
	$p_file2="data/".$board_name."/".$userfile_ecd2;
	@chmod($p_file2,0706);
//	@chmod("data/".$temp_ext,0707);
      }

##### ���� �ۼ��� �Խù��� fid(family id), uid(unique id)���� �����Ѵ�.
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

      // Comment ����
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

   //MySQL ���� /////////////////////////////////////
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

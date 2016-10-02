<?
//###############################################################################################
function open_notice($TABLE, $RECNUM)	{
	global $v;
	include ("winko/system/config.php"); 
	mysql_select_db($dbName, $conn);

	//	if ( !$connect ) {echo "mysql 데이터 베이스에 연결할 수 없습니다."; exit;}
	$QUERY = "SELECT uid,subject,name,signdate,add_a FROM {$top}_board_$TABLE order by uid desc limit 4";
	$DATA = mysql_query($QUERY, $conn);
	$DATA_NUM = mysql_num_rows($DATA);

	if( $DATA_NUM <= $RECNUM ) {
		$RECNUM = $DATA_NUM;
	}

	##### adminboard 접속 #######
	$query2 = "SELECT new_time FROM {$top}_boardadmin where code='$TABLE'";
	$result2 = mysql_query($query2);
	if (!$result2) {
		error("QUERY_ERROR");
		exit;
	}

	$admin=mysql_fetch_array($result2);
	?>
	<table cellpadding="0" cellspacing="0" width="355">
	<?
	//////////////////////////////제목 글수 제한 함수정의 끝///////////////////////////////////	
	for( $i=0; $i < $RECNUM; $i++ ) {

		$UID = mysql_result($DATA,$i,uid); 
		$SUBJECT = mysql_result($DATA,$i,subject);
		$NAME = mysql_result($DATA,$i,name);
		$DATE = mysql_result($DATA,$i,signdate);
		$ADD_A = mysql_result($DATA,$i,add_a);
		$today = date("U", time());
		$date=date("m-d",$DATE);
		$date2=date("Y-m-d",$DATE);
		$wtime = $today-$DATE;

		if($ADD_A) $datedate=$ADD_A;
		else $datedate=$date;

		$datedate="[$datedate]";

	###### new 버튼 출력 ########
	$time_limit = 60*60*24*$admin[new_time];
	$date_diff = time() -  $DATE;
	if (($admin[new_time]!="0")&&($date_diff < $time_limit)) {
		$new_icon = "&nbsp;<img src=image/etc/new.gif width=19 height=9 border=0 align=absMiddle>";
		//$SUBJECT = STR_CUTTING( stripslashes($SUBJECT), 36, "..");
		if(mb_strlen($SUBJECT, "utf-8") > 21) {
			$SUBJECT = mb_substr($SUBJECT, 0, 21, 'utf-8' )."..";
		}
	} else {
		$new_icon="";
		//$SUBJECT = STR_CUTTING( stripslashes($SUBJECT), 40, ".." );
		if(mb_strlen($SUBJECT, "utf-8") > 21) {
			$SUBJECT = mb_substr($SUBJECT, 0, 21, 'utf-8' )."..";
		}
	}
?>
	<tr>
		<td style="padding-top:3px; padding-left:5px;">
			<p><img src="image/etc/newsdot.gif" width="9" height="9" border="0" hspace="6"><A HREF='./winko.php?code=<?=$TABLE?>&body=view&v=<?=$v?>&number=<?=$UID?>'><?=$SUBJECT?></A><?=$new_icon?></p>
		</td>
		<td width="80" style="padding-top:3px;">
			<p align="center"><font face='Tahoma'><span style='font-size:8pt;'><?=$date2?></span></font></p>
		</td>
	</tr>
	<tr>
		<td colspan="2" background="image/etc/dot_w.gif">
			<p><img src="image/etc/blank.gif" width="1" height="1" border="0"></p>
		</td>
	</tr>
<?
	}
	echo "</TABLE>";
}
//###############################################################################################################
function popup_result($popup_no)	{
	include ("winko/system/config.php"); 
	mysql_select_db($dbName, $conn);
	$QUERY = "select * from {$top}_popup where no = $popup_no";
	$DATA = mysql_query($QUERY, $conn);
	$popup_result = mysql_fetch_array($DATA);
	return $popup_result;
}
?>



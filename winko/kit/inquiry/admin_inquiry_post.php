<? if($mode=="modify") {?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>DYNE GLOBAL SiteManager</title>
</head>
<body>
<?
	if($MEMBER_LEVEL > 3) error2("설정 권한이 없습니다.","admin.php");
	$Result = addslashes($Result);
	$que="update {$top}_{$select} set State='$State', Result='$Result'";
	$que.=" where no='$member_no'";
	@mysql_query($que,$conn);
	mysql_close($conn);
	echo"<script>alert(\"수정 되었습니다.\");</script>";	movepage("admin.php?option=inquiry&select=$select&page=$page&keyfield=$keyfield&keyword=$keyword&Startdate=$Startdate&Enddate=$Enddate&sort_company=$sort_company&sort_company2=$sort_company2&page_num=$page_num&k_no=$member_no");
?>
</body>
</html>
<? } elseif ($mode=="delete") {?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>DYNE GLOBAL SiteManager</title>
</head>
<body>
<?
	if($MEMBER_LEVEL!="1") error2("설정 권한이 없습니다.","admin.php");
	$sql = "delete from {$top}_{$select} where no = $no ";
	$result = @mysql_query($sql); movepage("$PHP_SELF?option=inquiry&select=$select&page=$page&keyfield=$keyfield&keyword=$keyword&Startdate=$Startdate&Enddate=$Enddate&State=$State&sort_company=$sort_company&sort_company2=$sort_company2&page_num=$page_num");
	echo"<script>alert(\"삭제 되었습니다.\");</script>";
?>
</body>
</html>
<?
}
#### 엑셀 저장 //////////////////////////////////////////////////////////////
elseif($mode=="make_excel") {
	//if(($member[mem_id]!="winko")&&($member[mem_id]!=$admin_id)) error2("설정 권한이 없습니다.","admin.php");
	if($MEMBER_LEVEL!="1") error2("설정 권한이 없습니다.","admin.php");
	$Today_date=time();
	$Today_date=date("Ymd",$Today_date);	

	if($cart) {
		$temp=explode("||",$cart);
		$count_temp = count($temp);
		$count_kk = $count_temp-1;

		header( "Content-type: application/vnd.ms-excel" ); 
		header( "Content-Disposition: attachment; filename=Inquiry_list_{$Today_date}.xls" ); 
		header( "Content-Description: PHP4 Generated Data" ); 
		?> 
		<html> 
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<body bgcolor=white> 
		<table align="center" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td height="40">
					<p align="center"><span style="font-size:14pt;"><b><u>Contact Us 내역</u></b></span></p>
				</td>
			</tr>
			<tr>
				<td>
					<table cellspacing=0 cellpadding=2 border=0 border=1>
						<tr bgcolor="#e0e0e0">
							<?if($select=="inquiry"){?>
							<td>
								<p align="center"><span style="font-size:8pt;">No</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">등록일</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">제목</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">회사명</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">부서명</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">성명</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">직위</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">TEL</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">휴대폰</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">E-mail</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">문의내용</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">등록자 IP</span></p>
							</td>
							<?}else{?>
							<td>
								<p align="center"><span style="font-size:8pt;">No</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">등록일</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Subject</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your Name </span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your E-mail</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your telephone Number </span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your Company</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your Country </span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Message</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">등록자 IP</span></p>
							</td>
							<?}?>
						</tr>
						<?
						for($i=1;$i<$count_temp;$i++) {
							$que="select * from {$top}_{$select} where no='$temp[$i]'";
							$result=mysql_query($que) or Error(mysql_error());
							$data=mysql_fetch_array($result);
							$Reg_date = date("Y-m-d [H:i]",$data[Reg_date]);	
						?>
						<tr>
							<?if($select=="inquiry"){?>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=$i?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=$Reg_date?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Subject])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Company])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Post])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Name])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Position])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Phone])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Handphone])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Email])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Comment])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[ip])?></span></p>
							</td>
							<?}else{?>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=$i?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=$Reg_date?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Subject'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Name'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Email'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Phone'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Company'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Country'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Comment'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['ip'])?></span></p>
							</td>
							<?}?>
						</tr>
						<?
						}
						?>
					</table>
				</td>
			</tr>
		</table>
		</body> 
		</html> 
<?
	}else{
		##############################################################################################
		header( "Content-type: application/vnd.ms-excel" ); 
		header( "Content-Disposition: attachment; filename=Inquiry_All_{$Today_date}.xls" ); 
		header( "Content-Description: PHP4 Generated Data" ); 

		$que="select * from {$top}_{$select} order by no asc";
		$result=@mysql_query($que) or Error(mysql_error());
		$total_member=@mysql_fetch_array($result);
		$total_member=$total_member[0];
		//  앞에 붙는 가상번호
		$number=$total_member;
		?>
		<html> 
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<body bgcolor=white> 
		<table align="center" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td height="40">
					<p align="center"><span style="font-size:14pt;"><b><u>Contact Us 내역</u></b></span></p>
				</td>
			</tr>
			<tr>
				<td>
					<table cellspacing=0 cellpadding=2 border=0 border=1>
						<tr bgcolor="#e0e0e0">
							<?if($select=="inquiry"){?>
							<td>
								<p align="center"><span style="font-size:8pt;">No</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">등록일</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">제목</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">회사명</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">부서명</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">성명</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">직위</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">TEL</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">휴대폰</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">E-mail</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">문의내용</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">등록자 IP</span></p>
							</td>
							<?}else{?>
							<td>
								<p align="center"><span style="font-size:8pt;">No</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">등록일</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Subject</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your Name </span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your E-mail</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your telephone Number </span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your Company</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Your Country </span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">Message</span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;">등록자 IP</span></p>
							</td>
							<?}?>
						</tr>
						<?
						$que="select * from {$top}_{$select} order by no asc";
						$result=@mysql_query($que) or Error(mysql_error());
						$i=1;
						while($data=@mysql_fetch_array($result)) {
							$Reg_date = date("Y-m-d [H:i]",$data[Reg_date]);	
						?>
						<tr>
							<?if($select=="inquiry"){?>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=$i?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=$Reg_date?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Subject])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Company])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Post])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Name])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Position])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Phone])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Handphone])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Email])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[Comment])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data[ip])?></span></p>
							</td>
							<?}else{?>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=$i?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=$Reg_date?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Subject'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Name'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Email'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Phone'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Company'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Country'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['Comment'])?></span></p>
							</td>
							<td>
								<p align="center"><span style="font-size:8pt;"><?=stripslashes($data['ip'])?></span></p>
							</td>
							<?}?>
						</tr>
						<?
							$i++;
						}
						?>
					</table>
				</td>
			</tr>
		</table>
		</body> 
		</html> 
	<?
	}
}
#### 회원전체 삭제하는 부분 /////////////////////////////////////////////////////
elseif($mode=="deleteall") {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>DYNE GLOBAL SiteManager</title>
</head>
<body>
<?
	//if(($member[mem_id]!="winko")&&($member[mem_id]!=$admin_id)) error2("설정 권한이 없습니다.","admin.php");
	if($MEMBER_LEVEL!="1") error2("설정 권한이 없습니다.","admin.php");

	if($cart) {
		$temp=explode("||",$cart);
		$count_temp = count($temp);
		$count_kk = $count_temp-1;

		for($i=0;$i<$count_temp;$i++) {
			@mysql_query("delete from {$top}_{$select} where no='$temp[$i]'") or error2(mysql_error());
		}
	} else{
		error2("삭제할 목록을 선택하여 주십시오.");
	}
	echo "<script> window.alert('$count_kk 건의 데이타가 삭제되었습니다.')</script>";   
	movepage("$PHP_SELF?option=inquiry&select=$select&page=$page&keyfield=$keyfield&keyword=$keyword&Startdate=$Startdate&Enddate=$Enddate&State=$State&sort_company=$sort_company&sort_company2=$sort_company2&page_num=$page_num");
?>
</body>
</html>
<?
}
?>

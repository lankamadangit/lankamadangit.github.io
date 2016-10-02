<?
##### DB 접속 정보 #####
require_once $_SERVER["DOCUMENT_ROOT"]."/winko/system/config.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/inc/head.php";
?>
<body>
<?
if(!ereg("([^[:space:]]+)", $Subject) || !ereg("([^[:space:]]+)", $Name) || !ereg("([^[:space:]]+)", $Email) || !ereg("([^[:space:]]+)", $Phone) || !ereg("([^[:space:]]+)", $Company) || !ereg("([^[:space:]]+)", $Country) ||!ereg("([^[:space:]]+)", $Comment)) {
	error2("폼내용 전달 에러");
	exit;
}

$admin_info=@mysql_fetch_array(mysql_query("select * from {$top}_info"));
$admin_company = $admin_info['Company'];
$admin_domain = $admin_info['Domain'];
$admin_email = $admin_info['Admin_email'];

$Reg_date=time();
$ip=$REMOTE_ADDR;

$Subject = addslashes($Subject);
$Name = addslashes($Name);
$Email = addslashes($Email);
$Phone = addslashes($Phone);
$Company = addslashes($Company);
//$Fax = addslashes($Fax);
//$Web = addslashes($Web);
//$Address = addslashes($Address);
$Country = addslashes($Country);
$Comment = addslashes($Comment);
$Comment2 = nl2br($Comment);

// 관리자에게 결과내용 메일로 보내기
$mail_memo = "<table align='center' width='500' border='0' cellpadding='0' cellspacing='0' bordercolor='#999999' bordercolordark='white' bordercolorlight='#999999'>
		<tr>
			<td colspan='2' align='center'><p style='font:13pt 굴림; color:#65554A;'><b><u>$admin_company Contact Us</u></b></p></td>
		</tr>
		<tr>
			<td colspan='2' height='20'></td>
		</tr>
		<tr>
			<td height='1' bgcolor='#003366' colspan='2'></td>
		</tr>
		<tr>
			<td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>Subject</b></p></td>
			<td width='300'  height='25' style='padding-left=5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Subject</p></td>
		</tr>    
		<tr>
			<td height='1' bgcolor='#003366' colspan='2'></td>
		</tr>
		<tr>
			<td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>Your Name</b></p></td>
			<td width='300'  height='25' style='padding-left=5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Name</p></td>
		</tr>
		<tr>
			<td height='1' bgcolor='#003366' colspan='2'></td>
		</tr>
		<tr>
			<td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>Your E-mail</b></p></td>
			<td width='300'  height='25' style='padding-left=5px;'><p style='font:9pt 굴림; color:#CC3333;'><a href=\"mailto:$Email\">$Email</a></p></td>
		</tr>
		<tr>
			<td height='1' bgcolor='#003366' colspan='2'></td>
		</tr>
		<tr>
			<td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>Your Telephone Number</b></p></td>
			<td width='300'  height='25' style='padding-left=5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Phone</p></td>
		</tr>
		<tr>
			<td height='1' bgcolor='#003366' colspan='2'></td>
		</tr>
		<tr>
			<td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>Your Company</b></p></td>
			<td width='300'  height='25' style='padding-left=5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Company</p></td>
		</tr>
		<tr>
			<td height='1' bgcolor='#003366' colspan='2'></td>
		</tr>
		<tr>
			<td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>Your Country</b></p></td>
			<td width='300'  height='25' style='padding-left=5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Country</p></td>
		</tr>		
		<tr>
			<td height='1' bgcolor='#003366' colspan='2'></td>
		</tr>
		<tr>
			<td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>Message</b></p></td>
			<td width='300'  height='25' style='padding-left=5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Comment2</p></td>
		</tr>  
		<tr>
			<td height='1' bgcolor='#003366' colspan='2'></td>
		</tr>
	</table>";

	$charset='UTF-8'; // 문자셋 : UTF-8
	$Name2 = encode_2047(iconv("UTF-8","EUC-KR",$Name));
	$recipient = $admin_email;												// 받는 사람의 메일주소
	$mail_subject = "$admin_company Contact Us ($Name)";
	$encoded_subject="=?".$charset."?B?".base64_encode($mail_subject)."?=\n"; // 인코딩된 제목
	$mail_body = $mail_memo; //내용

	// 보내는 사람의 주소를 설정한다.(default: 'World Wide Web Owner [www@도메인]') 
	$header = "From:$Name2 <$Email>\n";
	$header .= "Content-type:text/html;";				// 텍스트 타입 설정 (text/html 형식 사용) 
	$header .= "charset=utf-8\n\n";						// 캐릭터 설정
	$email = mail($recipient, $encoded_subject, $mail_body, $header);    // 메일보내기

	$query = "INSERT INTO {$top}_inquiry_eng (Company, Name, Phone, Email, Subject, Country, Comment, Reg_date, ip) VALUES ('$Company', '$Name', '$Phone', '$Email', '$Subject', '$Country', '$Comment', '$Reg_date', '$ip')";
	$result = @mysql_query($query);

	if (!$result) {
		issueError("저장시 에러가 발생하였습니다.", "history.go(-1);");
		exit;
	} else {
		echo"<script>alert(\"Thank you very much for your inquiry.\\n\\nWe will reply to you as soon as possible.\");</script>";
	?>
	<!--meta http-equiv='refresh' content='0; url=/<?=$go_index?>'-->
	<meta http-equiv='refresh' content='0; url=/index.html'>
	<?
	}
	mysql_close($conn);
?>
</body>
</html>
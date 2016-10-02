<?
##### DB 접속 정보 #####
require_once("../../system/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META NAME="Keywords" CONTENT="엔진 및 부품, 미션 및 하체, 유압, 필터류, 설상장비, 제설장비, 트렌스 포터">
<META NAME="Description" CONTENT="영원 ENC는 여러해동안 디트로이트 엔진과 부품을 중고와 새 제품 모두 취급하고 있습니다.">
<link href="/css/common.css" rel="stylesheet" type="text/css">
<title>엔진 및 부품, 미션 및 하체, 유압, 필터류, 설상장비, 제설장비, 트렌스 포터 ? 영원ENCE. CO.,LTD.</title>
</head>
<?

if(!ereg("([^[:space:]]+)", $Name)||!ereg("([^[:space:]]+)", $Email)||!ereg("([^[:space:]]+)", $Comment)) {
	error2("폼내용 전달 에러");
	exit;
}

$admin_info=mysql_fetch_array(mysql_query("select * from {$top}_info"));
$admin_company = $admin_info[Company];
$admin_domain = $admin_info[Domain];
$admin_email = $admin_info[Admin_email];

$Reg_date=time();
$ip=$REMOTE_ADDR;

##########################################################################################
//// 온라인상담 /////////////////////////////////////////////////////////////////////////////////////////
##########################################################################################
if($select_form=="inquiry") { 

	$Company = addslashes($Company);
	$Post = addslashes($Post);
	$Position = addslashes($Position);
	$Name = addslashes($Name);
	$Name = str_replace(" ","",$Name);
	if($Phone1 && $Phone2 && $Phone3) {
		$Phone = $Phone1."-".$Phone2."-".$Phone3;
		$Phone = addslashes($Phone);
	}
	if($Handphone1 && $Handphone2 && $Handphone3) {
		$Handphone = $Handphone1."-".$Handphone2."-".$Handphone3;
		$Handphone = addslashes($Handphone);
	}
	$Email = addslashes($Email);
	$Subject = addslashes($Subject);
	$Comment = addslashes($Comment);
	$Comment2 = nl2br($Comment);

	// 관리자에게 결과내용 메일로 보내기
	$mail_memo = "<table align='center' width='500' order='1' cellpadding='3' cellspacing='1' bordercolor='#999999' bordercolordark='white' bordercolorlight='#999999'>
    <tr>
        <td colspan='2' align='center'><p style='font:13pt 굴림; color:#65554A;'><b><u>$admin_company 제휴 문의</u></b></p></td>
    </tr>
    <tr>
        <td colspan='2' height='20'></td>
    </tr>
    <tr>
        <td height='2' bgcolor='#003366' colspan='2'></td>
    </tr>
    <tr>
        <td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><strong>회사명</strong></p></td>
        <td width='300'  height='25' style='padding-left:5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Company</p></td>
    </tr>
    <tr>
        <td height='1' bgcolor='#003366' colspan='2'></td>
    </tr>    
    <tr>
        <td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><strong>부서명</strong></p></td>
        <td width='300'  height='25' style='padding-left:5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Post</p></td>
    </tr>
    <tr>
        <td height='1' bgcolor='#003366' colspan='2'></td>
    </tr>
    <tr>
        <td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><strong>직위</strong></p></td>
        <td width='300'  height='25' style='padding-left:5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Position</p></td>
    </tr>
    <tr>
        <td height='1' bgcolor='#003366' colspan='2'></td>
    </tr>    
    <tr>
        <td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>성명</b></p></td>
        <td width='300'  height='25' style='padding-left:5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Name</p></td>
    </tr>
    <tr>
        <td height='1' bgcolor='#003366' colspan='2'></td>
    </tr>    
    <tr>
        <td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>전화번호</b></p></td>
        <td width='300'  height='25' style='padding-left:5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Phone</p></td>
    </tr>
    <tr>
        <td height='1' bgcolor='#003366' colspan='2'></td>
    </tr>
    <tr>
        <td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>휴대폰번호</b></p></td>
        <td width='300'  height='25' style='padding-left:5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Handphone</p></td>
    </tr>
    <tr>
        <td height='1' bgcolor='#003366' colspan='2'></td>
    </tr>
    <tr>
        <td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>E-mail</b></p></td>
        <td width='300'  height='25' style='padding-left:5px;'><p style='font:9pt 굴림; color:#CC3333;'><a href=\"mailto:$Email\">$Email</a></p></td>
    </tr>
    <tr>
        <td height='1' bgcolor='#003366' colspan='2'></td>
    </tr>
    <tr>
        <td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>제품명</b></p></td>
        <td width='300'  height='25' style='padding-left:5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Subject</p></td>
    </tr>
    <tr>
        <td height='1' bgcolor='#003366' colspan='2'></td>
    </tr>    
    <tr>
        <td width='200' height='35' bgcolor='#D9ECFF' align='center' style='padding-right:3px;'><p style='font:9pt 굴림; color:#65554A;'><b>문의내용</b></p></td>
        <td width='300'  height='25' style='padding-left:5px;padding-top:5px;padding-bottom:5px;'><p style='font:9pt 굴림; color:#CC3333;'>$Comment2</p></td>
    </tr>
    <tr>
        <td height='2' bgcolor='#003366' colspan='2'></td>
    </tr>
</table>";

	$Name2 = encode_2047(iconv("UTF-8","EUC-KR",$Name));
	$recipient = $admin_email;												// 받는 사람의 메일주소
	$subject = "[".$Company." 견적의뢰] ". $Subject;
	$mail_body = $mail_memo;												//내용

	// 보내는 사람의 주소를 설정한다.(default: 'World Wide Web Owner [www@도메인]') 

	$header = "From:$Name2 <$Email>\n";
	$header .= "Content-type:text/html;";				// 텍스트 타입 설정 (text/html 형식 사용)        
	$header .= "charset=utf-8\n\n";						// 캐릭터 설정

	$email = mail($recipient, $subject, $mail_body, $header);    // 메일보내기

//	$mail_subject = "[{$admin_company} 온라인상담]$Subject";
//	if($admin_email) {
//		$mime_type="text/html";
//		$mail_body=($body);
//		$date=date("D, d M Y H:i:s +0900");  
//
//		$pp=popen(escapeshellcmd("$SENDMAIL_PATH -t -f $Email"),"w");
//		fputs($pp,"Date: $date\n");
//		fputs($pp,"From: $Name <$Email>\n");
//		fputs($pp,"Subject: $mail_subject\n");
//		fputs($pp,"Sender: $Email\n");
//		fputs($pp,"To: $admin_email\n");
//		fputs($pp,"Reply-To: $Email\n");
//		fputs($pp,"MIME-Version: 1.0\n");
//		fputs($pp,"Content-Type: $mime_type; charset=euc_kr\n\n");
//		fputs($pp,$mail_memo);
//		pclose($pp);    
//	}

	mysql_query("insert into {$top}_inquiry (Company, Post, Position, Name, Phone, Handphone, Email, Subject, Comment, Reg_date, ip) values ('$Company', '$Post', '$Position', '$Name', '$Phone', '$Handphone', '$Email', '$Subject', '$Comment', '$Reg_date', '$ip')") or error("데이타 입력시 에러가 발생했습니다<br>".mysql_error());

mysql_close($conn);

echo"<script>alert(\"감사합니다. 견적의뢰 내용이 성공적으로 전송되었습니다.\");</script>";
} //if($select_form=="inquiry") { 
?>
<meta http-equiv='refresh' content='0; url=../../../<?=$go_index?>'>
<body>
</body>
</html>
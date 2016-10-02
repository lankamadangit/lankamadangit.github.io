<?
##### DB &#51217;&#49549; &#51221;&#48372; #####
require_once("../../system/config.php");

if(!ereg("([^[:space:]]+)", $name)) {
   error2("Error");
   exit;
}

$admin_info=mysql_fetch_array(mysql_query("select * from {$top}_info"));
$admin_email=$admin_info[Admin_email];

$reg_date=time();
$ip=$REMOTE_ADDR;

$name = addslashes($name);
$company = addslashes($company);
$fax = addslashes($fax);
$email = addslashes($email);
$address = addslashes($address);
$country = addslashes($country);
$comment = addslashes($comment);

   // &#44288;&#47532;&#51088;&#50640;&#44172; &#44208;&#44284;&#45236;&#50857; &#47700;&#51068;&#47196; &#48372;&#45236;&#44592;
   $mail_memo = "<table align='center' width='500' border='1' cellpadding='3' cellspacing='1' bordercolor='#999999' bordercolordark='white' bordercolorlight='#999999'><tr><td width='124' height='25'><p align='center'>Name</p></td><td width='376' height='25'><p>&nbsp;<font color='#CC3333'>$name</font></p></td></tr><tr><td width='124' height='25'><p align='center'>Company</p></td><td width='376' height='25'><p>&nbsp;<font color='#CC3333'>$company</font></p></td></tr><tr><td width='124' height='25'><p align='center'>Phone</p></td><td width='376' height='25'><p>&nbsp;<font color='#CC3333'>$phone</font></p></td></tr><tr><td width='124' height='25'><p align='center'>FAX</p></td><td width='376' height='25'><p>&nbsp;<font color='#CC3333'>$fax</font></p></td></tr><tr><td width='124' height='25'><p align='center'>Email</p></td><td width='376' height='25'><p>&nbsp;<font color='#CC3333'><a href=\"mailto:$email\">$email</a></font></font></p></td></tr><tr><td width='124' height='25'><p align='center'>Address</p></td><td width='376' height='25'><p>&nbsp;<font color='#CC3333'>$address</font></p></td></tr><tr><td width='124' height='25'><p align='center'>Country</p></td><td width='376' height='25'><p>&nbsp;<font color='#CC3333'>$country</font></p></td></tr><tr><td width='124' height='25'><p align='center'>Request</p></td><td width='376' height='100'><p><font color='#CC3333'>$comment</font></p></td></tr></table>";

   $subject = "$admin_company Inquiry-Chinese ($name)";
   if($admin_email)
   {
    $mime_type="text/html";
    $mail_body=($body);
    $date=date("D, d M Y H:i:s +0900");  
    
    $pp=popen(escapeshellcmd("$SENDMAIL_PATH -t -f $Email"),"w");
    fputs($pp,"Date: $date\n");
    fputs($pp,"From: $Name <$Email>\n");
    fputs($pp,"Subject: $mail_subject\n");
    fputs($pp,"Sender: $Email\n");
    fputs($pp,"To: $admin_email\n");
    fputs($pp,"Reply-To: $Email\n");
    fputs($pp,"MIME-Version: 1.0\n");
    fputs($pp,"Content-Type: $mime_type; charset=euc_kr\n\n");
    fputs($pp,$mail_memo);
    pclose($pp);    
   }

mysql_query("insert into {$top}_inquiry_cn (name, company, phone, fax, email, address, country, comment, reg_date, ip) values ('$name', '$company', '$phone', '$fax', '$email', '$address', '$country', '$comment', '$reg_date', '$ip')") or error("Error<br>".mysql_error());

mysql_close($conn);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
</head>
<body>
<?
echo"<script>alert(\"感谢您的垂询。\\n\\n我们会尽快回复您。\");</script>";
?>
<meta http-equiv='refresh' content='0; url=../../../main.html?v=cn'>
</body>
</table>
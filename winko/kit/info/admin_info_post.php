<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>DYNE GLOBAL SiteManager</title>
<link rel=StyleSheet HREF="winko/system/css/winko_admin_utf.css" type=text/css title=style>
</head>
<body>
<?
#### 정보 변경 /////////////////////////////////////////////////
if($option2=="modify_ok") {
	if(blank_check($Company) || blank_check($Domain) || blank_check($Admin_email)) error2("필수 입력 항목을 입력하셔야 합니다");

	$Company=addslashes($Company);
	$Domain=addslashes($Domain);

	$que="update {$top}_info set Company='$Company', Domain='$Domain', Admin_email='$Admin_email', Title='$Title'";
	@mysql_query($que) or error2("수정시에 에러가 발생하였습니다 ".mysql_error());

	OnlyMsgView("데이타가 수정되었습니다.");
	movepage("$PHP_SELF?option=info");
}
?>
</body>
</html>
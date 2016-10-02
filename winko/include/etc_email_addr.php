<HTML>
<HEAD>
<TITLE>e-메일 입력</TITLE>
<link rel=StyleSheet HREF="../../winko/system/css/winko.css" type=text/css title=style>
<script language="JavaScript">
<!--
function addr_send(val){
	
	var eChk = document.e_form.ename.value;

	if( (eChk.length < 4) || (eChk.indexOf("@") != -1) || (eChk.indexOf(".") == -1) ) {
		alert("@이후의 올바른 이메일 주소를 입력하여 주세요.");
		document.e_form.ename.focus();
		return;
	}

	top.opener.document.UserInfo.email_addr.options[0].text = document.e_form.ename.value;
	top.opener.document.UserInfo.email_addr.options[0].value = document.e_form.ename.value;
	top.opener.document.UserInfo.email_addr.options[0].selected = document.e_form.ename.value;
	top.opener.document.UserInfo.email_addr.focus();
	parent.window.close();
}

//-->
</script>
</head>

<body topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" bgcolor="#F8F5E9" onLoad="javascript:document.e_form.ename.focus();">


<form name="e_form" action="javascript:addr_send(this.document.e_form);" method="post" >  
<table border=0 width=100% height=100% cellpadding=0 cellspacing=0>
	<tr>
		<td align=center height=100%>		  	
			<!--//여기부터 각 팝업 내용-->
			<table border="0" cellpadding="0" cellspacing="0" width="90%" align=center>
				<tr>
					<td>@ 이후 e-메일 주소만 입력해 주세요</td>
				</tr>
				<tr>
					<td height=5></td>
				</tr>
				<tr>
					<td align=center height=35 bgcolor=#DACDBD>@ <input type="text" size="31" name="ename" maxlength="80"  class=input><a href="javascript:addr_send(this.document.form)"><img src="../system/winko_img/Btn_send.gif" border=0 hspace=5 align=absmiddle></a></td>
				</tr>
			</table>
			<!--//여기까지 각 팝업 내용//-->
		</td>
	</tr>
	<tr height="28">
		<td align=right><a href="javascript:self.close();"><img src="../system/winko_img/popup_btn_close.gif" hspace=9 border="0"></a></td>
	</tr>
</table>


</form>
</body>
</html>
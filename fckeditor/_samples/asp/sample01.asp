<%@  codepage="65001" language="VBScript" %>
<% Option Explicit %>
<!--
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2009 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * Sample page.
-->
<% ' You must set "Enable Parent Paths" on your web site in order this relative include to work. %>
<!-- #INCLUDE file="../../fckeditor.asp" -->
<script language="javascript">
<!--
function reWrite_Click(frm){
	var oEditor = FCKeditorAPI.GetInstance('FCKeditor1') ;

	if (oEditor){
		if(oEditor.EditorDocument==null){
			alert(frm.FCKeditor1.value);
			if(frm.FCKeditor1.value==""){
				alert("내용을 입력하세요................");
				return false;
			}
		}
		else{
			var editContents = oEditor.EditorDocument.body.innerText;
			if(editContents.split(" ").join("") == ""){
				alert("내용을 입력하세요.");
				oEditor.EditorDocument.body.focus();
				return false;
			}
		}
	}
frm.submit();
}
-->
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>FCKeditor - Sample</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex, nofollow" />
	<link href="../sample.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<h1>
		FCKeditor - ASP - Sample 1
	</h1>
	<div>
		This sample displays a normal HTML form with an FCKeditor with full features enabled.
	</div>
	<hr />
	<form action="sampleposteddata.asp" method="post"  name="fm_Edit">
		<%
		' Automatically calculates the editor base path based on the _samples directory.
		' This is usefull only for these samples. A real application should use something like this:
		' oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
		Dim sBasePath
		sBasePath = Request.ServerVariables("PATH_INFO")
		response.write(sBasePath)
		sBasePath = Left( sBasePath, InStrRev( sBasePath, "/_samples" ) )
		response.write(sBasePath)
		Dim oFCKeditor
		Set oFCKeditor = New FCKeditor
		oFCKeditor.BasePath	= sBasePath
		oFCKeditor.Value	= ""
		oFCKeditor.Create "FCKeditor1"
		%>
		<br />
		<input type="button" value="Submit"  onclick="javascript:reWrite_Click(fm_Edit)"/>
	</form>
</body>
</html>

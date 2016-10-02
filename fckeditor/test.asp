<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> new document </title>
  <meta name="generator" content="editplus" />
  <meta name="author" content="" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
 </head>
 <script language="javascript">
<!--
function reWrite_Click(frm){
	//var oEditor = FCKeditorAPI.GetInstance('FCKeditor1') ;
	alert(frm.testtest.value);
		if(frm.testtest.value==""){
			alert("내용을 입력하세요................");
			return false;
		}
//	if (oEditor){
//		if(oEditor.EditorDocument==null){
//			alert(frm.FCKeditor1.value);
//			if(frm.FCKeditor1.value==""){
//				alert("내용을 입력하세요................");
//				return false;
//			}
//		}
//		else{
//			var editContents = oEditor.EditorDocument.body.innerText;
//			if(editContents.split(" ").join("") == ""){
//				alert("내용을 입력하세요.");
//				oEditor.EditorDocument.body.focus();
//				return false;
//			}
//		}
//	}
frm.submit();
}
-->
</script>

 <body>
  <form name='fm_Edit' action='test.asp'>
	<input type='text' value='test' name="testtest">
	<input type="button" value="Submit"  onclick="javascript:reWrite_Click(fm_Edit)"/>
  </form>
 </body>
</html>

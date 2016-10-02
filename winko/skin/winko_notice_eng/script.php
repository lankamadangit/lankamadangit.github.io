<script language=javascript>
function send( form )
{
form = document.writeform;
var oEditor = FCKeditorAPI.GetInstance('comment');
<? if(!$member[no]) { ?>
	if ( form.name.value == "" )
	{
		alert( "Please enter your name." );
		document.writeform.name.focus();
		return;
	}
	if ( form.passwd.value == "" )
	{
		alert( "Please enter your password." );
		document.writeform.passwd.focus();
		return;
	}
<? } ?>
	if ( form.subject.value == "" )
	{
		alert( "Please enter subject." );
		document.writeform.subject.focus();
		return;
	}
	if(oEditor) {
		var editContents = oEditor.EditorDocument.body.innerText;
		if(editContents.split(" ").join("") == "") {
			alert("Please enter Comment!");
			oEditor.EditorDocument.body.focus();
			return;
		}
	}

//	if ( form.comment.value == "" )
//	{
//		alert( "Please enter comment." );
//		document.writeform.comment.focus();
//		return;
//	}
	form.submit();
}
  function select_all() {
    var i, chked=0;
    for(i=0;i<document.list.length;i++) {
    if(document.list[i].type=='checkbox') { 
     if(document.list[i].checked) { document.list[i].checked=false; }
     else { document.list[i].checked=true; }
     }
    }
     return false;
   }
 
 function select() {
  var i, chked=0;
  for(i=0;i<document.list.length;i++)
  {
   if(document.list[i].type=='checkbox')
   {
    if(document.list[i].checked) chked=1;
    }
   }
  if(chked)
  {
    document.list.selected.value='';
    document.list.exec.value='delete_all';
    for(i=0;i<document.list.length;i++)
    {
     if(document.list[i].type=='checkbox')
     {
      if(document.list[i].checked)
      {
       document.list.selected.value=document.list[i].value+';'+document.list.selected.value;
      }
     }
    }
    window.open("winko/include/etc_select.php?code=<?=$code?>&selected="+document.list.selected.value,"<?=$code?>_select_list","width=150,height=110,toolbars=no,resize=no,scrollbars=no");
  }
  else {alert('Please select article.');}
 }
</script>


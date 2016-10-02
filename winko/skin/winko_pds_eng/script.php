<script language=javascript>
function send( form )
{
form = document.writeform;
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
	if ( form.comment.value == "" )
	{
		alert( "Please enter comment." );
		document.writeform.comment.focus();
		return;
	}
	form.submit();
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
    window.open("select_list_all.php?code=<?=$code?>&selected="+document.list.selected.value,"<?=$code?>_select_list","width=150,height=110,toolbars=no,resize=no,scrollbars=no");
  }
  else {alert('Select!');}
 }
</script>
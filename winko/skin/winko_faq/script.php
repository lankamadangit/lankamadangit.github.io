<script language=javascript>
function send( form )
{
form = document.writeform;
<? if(!$member[no]) { ?>
	if ( form.name.value == "" )
	{
		alert( "�̸��� �Է��ϼ���!" );
		document.writeform.name.focus();
		return;
	}
	if ( form.passwd.value == "" )
	{
		alert( "��й�ȣ�� �Է��ϼ���!" );
		document.writeform.passwd.focus();
		return;
	}
<? } ?>
	if ( form.subject.value == "" )
	{
		alert( "������ �Է��ϼ���!" );
		document.writeform.subject.focus();
		return;
	}
	if ( form.comment.value == "" )
	{
		alert( "������ �Է��ϼ���!" );
		document.writeform.comment.focus();
		return;
	}
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
  else {alert('������ �Խù��� �����Ͽ� �ֽʽÿ�');}
 }
</script>
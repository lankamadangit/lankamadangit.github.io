<table width="<?=$table_width?>" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor=<?=$light?>>
<form name="writeform" method="post" ENCTYPE="multipart/form-data" action="post.php?code=<?echo("$code")?>">
   <tr><td bgcolor="<?=$dark?>" height=1 colspan=2><img src="<?=$skin_folder?>/blank.gif" height=1></td></tr>
<?=$hide_start?>
   <tr height=28>
      <td width="18%" align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;이름&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="text" name="name" size="20" maxlength="10" class='input'></td>
   </tr>

   <tr height=28>
      <td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;메일&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="text" name="email" size="30" maxlength="40" class='input'></td>
   </tr>

   <tr height=28>
      <td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;홈페이지&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="text" name="homepage" size="35" maxlength="60" class='input'></td>
   </tr>

   <tr height=28>
      <td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;비밀번호&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="password" name="passwd" size="10" maxlength="10" class='input2'>&nbsp;(최소 4자이상의 영문 또는 숫자)</td>
   </tr>

<?=$hide_end?>

   <tr height=28>
      <td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;Option&nbsp;&nbsp;</td>
      <td><?=$hide_html_start?>&nbsp;<input type=checkbox name=ok_html value=1>(HTML 사용시 체크)<?=$hide_html_end?><?=$hide_notice_start?>&nbsp;&nbsp;<INPUT type=checkbox value=1 name="notice">(공지글 등록)<?=$hide_notice_end?><?=$hide_secret_start?><?if($member[no]){?>&nbsp;&nbsp;<INPUT type=checkbox value=1 name="ok_secret">(비밀글)<?}?><?=$hide_secret_end?></td>
   </tr>

   <tr height=28>
      <td width="18%" align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;제목&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="text" name="subject" size="45" maxlength="60" class='input'></td>
   </tr>

<?=$hide_file1_start?>
   <tr height=28>
      <td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;이미지&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="file" name="userfile" size="15" class='input'></td>
   </tr>

<?=$hide_file1_end?>
   <tr>
      <td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;메시지본문&nbsp;&nbsp;</td>
      <td><img src=<?=$skin_folder?>blank.gif height=3><br>&nbsp;&nbsp;<textarea name="comment" cols="70" rows="15"></textarea><br><img src=<?=$skin_folder?>blank.gif height=3><br>
   </tr>
   <tr><td bgcolor="<?=$dark?>" height=1 colspan=2><img src=<?=$skin_folder?>blank.gif height=1></td></tr>

   <tr height="50">
      <td align="center" colspan="2" bgcolor='#ffffff'>      
	  <a href="javascript:send(writeform)"><img align=absMiddle border=0 src="<?=$skin_folder?>/confirm.gif"></a>
      <IMG align=absMiddle border=0 onclick=history.back() src="<?=$skin_folder?>/back.gif" style="CURSOR: hand">
      </td>
   </tr>
</form>
</table>
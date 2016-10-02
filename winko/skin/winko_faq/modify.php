<table width="<?=$table_width?>" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="<?=$light?>">
   <tr><td bgcolor="<?=$dark?>" height=1 colspan=2><img src="<?=$skin_folder?>/blank.gif" height=1></td></tr>
<?=$hide_start?>
   <tr height="28">
   <td width="18%" align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;이름&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="text" name="name" size="20" maxlength="10" value="<?echo ("$my_name")?>" class="input"></td>
   </tr>
  
   <tr height="28">
      <td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;비밀번호&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="password" name="passwd" size="10" maxlength="10" class="input2">&nbsp;(최소 4자이상의 영문 또는 숫자)</td>
   </tr>

   <tr height="28">
      <td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;메일&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="text" name="email" size="30" maxlength="40" value="<?echo ("$my_email")?>" class="input"></td>
   </tr>

   <tr height="28">
      <td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;홈페이지&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="text" name="homepage" size="35" maxlength="60" value="<?echo ("$my_homepage")?>" class="input"></td>
   </tr> 
<?=$hide_end?>

   <tr height="28">
      <td align="right" bgcolor="<?=$light?>"><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;Option&nbsp;&nbsp;</td>
      <td><?=$hide_html_start?>&nbsp;<input type=checkbox name=ok_html <?=$ok_html?> value=1>(HTML 사용시 체크)<?=$hide_html_end?><?=$hide_notice_start?>&nbsp;&nbsp;<INPUT type=checkbox value=1 name="notice" <?=$check[$my_notice]?>>(공지글 등록)<?=$hide_notice_end?><?=$hide_secret_start?>&nbsp;&nbsp;<INPUT type=checkbox value=1 name="ok_secret" <?=$check[$my_ok_secret]?>>(비밀글)<?=$hide_secret_end?></td>
   </tr>

   <tr height=28>
      <td align="right" bgcolor=<?=$light?>><img src='<?=$skin_folder?>/main.gif' align='absmiddle'>&nbsp;카테고리&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<SELECT class=input name="category"> 
<option value="<?=$my_category?>" selected>
<?
if($my_category==1){
	echo "입시종합반/전문연주자과정";
}
elseif($my_category==2){
	echo "드럼기초반/기타기초반";
}
elseif($my_category==3){
	echo "그외질문";
}
?>
</option>
            <option value="1">입시종합반/전문연주자과정</option>
            <option value="2">드럼기초반/기타기초반</option>
            <option value="3">그외질문</option>
</SELECT></td>
   </tr>

   <tr height=28>
      <td width="18%" align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;제목&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="text" name="subject" size="40" maxlength="60" value="<?echo ("$my_subject")?>" class="input"></td>
   </tr>   

<?=$hide_file1_start?>
   <tr height=28>
      <td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;이미지&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<?=$my_userfile?>&nbsp;<span style="font-size:8pt;"><font face="Tahoma">(<b><?=$my_filesize?></b>byte)</font></span>&nbsp;&nbsp;삭제 : <input type="checkbox" name="filecheck1"></td>
   </tr>
   
<?=$hide_file1_end?>
<?=$hide_ok_file1_start?>
   <tr height=28>
      <td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;이미지&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="file" name="userfile" size="15" class="input"></td>
   </tr>

<?=$hide_ok_file1_end?>
   <tr>
      <td align="right" bgcolor=<?=$light?>><img src="<?=$skin_folder?>/main.gif" align="absmiddle">&nbsp;메시지본문&nbsp;&nbsp;</td>
      <td><img src=<?=$skin_folder?>blank.gif height=3><br>&nbsp;&nbsp;<textarea name="comment" cols="70" rows="15"><?echo("$my_comment")?></textarea><br><img src=<?=$skin_folder?>blank.gif height=3><br>
   </tr>
   <tr><td bgcolor="<?=$dark?>" height=1 colspan=2><img src="<?=$skin_folder?>/blank.gif" height=1></td></tr>
   <tr height="50">
      <td align="center" colspan="2" bgcolor="#ffffff">    
	  <a href="javascript:send(writeform)"><img align=absMiddle border=0 src="<?=$skin_folder?>/confirm.gif"></a>
      <IMG align=absMiddle border=0 onclick=history.back() src="<?=$skin_folder?>/back.gif" style="CURSOR: hand">
      </td>
   </tr>
</table>
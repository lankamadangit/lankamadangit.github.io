<table border=0 cellspacing=0 cellpadding=0 width="<?=$table_width?>" background="<?=$skin_folder?>/view_td.gif" align='center'>
<tr><td bgcolor="<?=$bbs_color?>" height=1 colspan=2><img src="<?=$skin_folder?>/blank.gif" height="1"></td></tr>
<tr><td height=3 colspan=2><img src="<?=$skin_folder?>/blank.gif" height="1"></td></tr>
<tr height=26>
 <td align=right width=100 style=color:#333333><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;�̸�&nbsp;&nbsp;|</td>
 <td align=left>
 <table border=0 cellpadding=0 cellspacing=0><tr><td style=color:#333333>&nbsp;&nbsp;<?=$my_name?>&nbsp;<? if($my_email) { ?>(<a href=mailto:<?=$my_email?>><font color="#336633" class="thm8"><?=$my_email?></font></a>)<? } ?></td></tr></table>
</td>
</tr>

<?=$hide_homepage_start?>
<tr height=26>
 <td align=right width=100 style=color:#333333><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;Ȩ������&nbsp;&nbsp;|</td>
 <td style=color:#333333>&nbsp;&nbsp;<a href=<?=$my_homepage?> target='blank'><font class=thm8 color="#000000"><?=$my_homepage?></font></a></td>
</tr>
<?=$hide_homepage_end?>

<tr height=26>
 <td align=right width=100 style=color:#333333><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;�ۼ���&nbsp;&nbsp;|</td>
 <td style=color:#333333>&nbsp;&nbsp;<font class=thm8><?=$my_signdate?></font></td>
</tr>

<tr height=26>
 <td align=right width=100 style=color:#333333><img src="<?=$skin_folder?>/main.gif" align='absmiddle'>&nbsp;����&nbsp;&nbsp;|</td>
 <td style=color:#333333>
<table align="center" cellpadding="0" cellspacing="0" width="98%">
    <tr>
        <td style=color:#333333>
            <p><b><?=$my_subject?></b></p>
        </td>
        <td width="50">
            <p><font class=thm8>Hit : <?=$my_ref?></font>
        </td>
    </tr>
</table>
 </td>
</tr>
<tr><td background="<?=$skin_folder?>/dot_w.gif" height=1 colspan=2><img src="<?=$skin_folder?>/blank.gif" height=1></td></tr>
</table>
<!-- ���� ���� -->
<table border=0 cellspacing=0 cellpadding=0 width="<?=$table_width?>" align=center>
<? if($image1){echo"<tr><td><img src={$skin_folder}/blank.gif height=10></td></tr><tr><td><p align=center>$image1<p></td></tr>";}?>
<tr>
 <td style='word-break:break-all;padding:10px;' bgcolor=#ffffff height=150 valign=top>
     <span style=line-height:180%>
	 <p><?=$my_comment?></p>
     <br>
</span>
 </td>
</tr>
<?
$bbs_num="0";
$bbs_color="#e7dab6";
?>
			<table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="191" valign="top">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                    <p><img src="image/<?=$menu?>/title.gif" width="191" height="50" border="0"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
<?
include ("./menu/{$menu}/menu_{$menu}.php");
?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
<!-- Contents {{ -->
						<table width="624" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr> 
								<td background="image/sam/subtitle_bg.gif"><img src="image/<?=$menu?>/subtitle_<?=$code?>.gif" height="37"></td>
							</tr>
							<tr> 
								<td height="15"></td>
							</tr>
                            <tr>
                                <td>
                                    <p align="center"><img src="image/qna/ssubmenu_11.gif" width="117" height="55" border="0"><?
if($category == "1") {
echo "<a href=\"winko.php?code=a_faq&category=1\" onFocus=\"this.blur()\"><img src=\"image/qna/ssubmenu-over_12.gif\" width=\"163\" height=\"55\" border=\"0\" name=\"ssubmenu1\"></a>";
}
else {
echo"<a href=\"winko.php?code=a_faq&category=1\" onFocus=\"this.blur()\" OnMouseOut=\"na_restore_img_src('ssubmenu1', 'document')\" OnMouseOver=\"na_change_img_src('ssubmenu1', 'document', 'image/qna/ssubmenu-over_12.gif', true);\"><img src=\"image/qna/ssubmenu_12.gif\" width=\"163\" height=\"55\" border=\"0\" name=\"ssubmenu1\"></a>";
}
if($category == "2") {
echo "<a href=\"winko.php?code=a_faq&category=2\" onFocus=\"this.blur()\"><img src=\"image/qna/ssubmenu-over_13.gif\" width=\"141\" height=\"55\" border=\"0\" name=\"ssubmenu2\"></a>";
}
else {
echo"<a href=\"winko.php?code=a_faq&category=2\" onFocus=\"this.blur()\" OnMouseOut=\"na_restore_img_src('ssubmenu2', 'document')\" OnMouseOver=\"na_change_img_src('ssubmenu2', 'document', 'image/qna/ssubmenu-over_13.gif', true);\"><img src=\"image/qna/ssubmenu_13.gif\" width=\"141\" height=\"55\" border=\"0\" name=\"ssubmenu2\"></a>";
}
if($category == "3") {
echo "<a href=\"winko.php?code=a_faq&category=3\" onFocus=\"this.blur()\"><img src=\"image/qna/ssubmenu-over_14.gif\" width=\"70\" height=\"55\" border=\"0\" name=\"ssubmenu3\"></a>";
}
else {
echo"<a href=\"winko.php?code=a_faq&category=3\" onFocus=\"this.blur()\" OnMouseOut=\"na_restore_img_src('ssubmenu3', 'document')\" OnMouseOver=\"na_change_img_src('ssubmenu3', 'document', 'image/qna/ssubmenu-over_14.gif', true);\"><img src=\"image/qna/ssubmenu_14.gif\" width=\"70\" height=\"55\" border=\"0\" name=\"ssubmenu3\"></a>";
}
?><img src="image/qna/ssubmenu_15.gif" width="102" height="55" border="0"></p>
								</td>
							</tr>
							<tr height="15">
								<td></td>
							</tr>
                            <tr>
                            <tr>
                                <td height="250" valign="top">


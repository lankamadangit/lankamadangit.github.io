<?
if(!$option2 || ($option2 == "popup_list" || $option2 == "popup_add")) {$add_menu1 = "<font color=$base_color>팝업관리</font>"; }
else {$add_menu1 = "팝업관리";}
if($option2 == "banner_list" || $option2 == "banner_add") {$add_menu2 = "<font color=$base_color>배너관리</font>"; }
else {$add_menu2 = "배너관리";}
?>
                      <table align="center" cellpadding="3" cellspacing="1" width="168" bgcolor="gainsboro">
                            <tr>
                                <td bgcolor="#F6F6F6" height="30" style="padding-top:6px;">
                                    <p align="center"><b><font color="#1F4399" face="돋움"><span style="font-size:11pt;">부가기능</span></font></b></p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="white" height="25" style="padding-top:6px;">
                                    <p><img src="winko/system/winko_img/manager/icon_title.gif" align="absmiddle" width="3" height="5" border="0" hspace="5"><a href="admin.php?option=add&option2=popup_list">팝업관리</a></p>
                                </td>
                            </tr>
                        </table>
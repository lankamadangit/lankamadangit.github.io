<?
if(!$no || $no == "1") {$total_r = "<font color=#ff3300 class=thm8>Total</font>"; }
else {$total_r = "<font class=thm8>Total</font>";}
if($no == "2") {$today_r = "<font color=#ff3300 class=thm8>Taday</font>"; }
else {$today_r = "<font class=thm8>Today</font>";}
if($no == "3") {$week_r = "<font color=#ff3300 class=thm8>Week</font>"; }
else {$week_r = "<font class=thm8>Week</font>";}
if($no == "4") {$month_r = "<font color=#ff3300 class=thm8>Month</font>"; }
else {$month_r = "<font class=thm8>Month</font>";}
if($no == "5") {$year_r = "<font color=#ff3300 class=thm8>Year</font>"; }
else {$year_r = "<font class=thm8>Year</font>";}
if($no == "6") {$referer_r = "<font color=#ff3300 class=thm8>Referer</font>"; }
else {$referer_r = "<font class=thm8>Referer</font>";}
?>
                      <table align="center" cellpadding="3" cellspacing="1" width="168" bgcolor="gainsboro">
                            <tr>
                                <td bgcolor="#F6F6F6" height="30" style="padding-top:6px;">
                                    <p align="center"><b><font color="#1F4399" face="돋움"><span style="font-size:11pt;">로그분석</span></font></b></p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="white" height="25" style="padding-top:6px;">
                                    <p><img src="winko/system/winko_img/manager/icon_title.gif" align="absmiddle" width="3" height="5" border="0" hspace="5"><a href="<?=$PHP_SELF?>?option=counter&no=1&year=<?=$year?>&month=<?=$month?>&day=<?=$day?>"><?=$total_r?></a></p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="white" height="25" style="padding-top:6px;">
                                    <p><img src="winko/system/winko_img/manager/icon_title.gif" align="absmiddle" width="3" height="5" border="0" hspace="5"><a href="<?=$PHP_SELF?>?option=counter&no=2&year=<?=$year?>&month=<?=$month?>&day=<?=$day?>"><?=$today_r?></a></p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="white" height="25" style="padding-top:6px;">
                                    <p><img src="winko/system/winko_img/manager/icon_title.gif" align="absmiddle" width="3" height="5" border="0" hspace="5"><a href="<?=$PHP_SELF?>?option=counter&no=3&year=<?=$year?>&month=<?=$month?>&day=<?=$day?>"><?=$week_r?></a></p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="white" height="25" style="padding-top:6px;">
                                    <p><img src="winko/system/winko_img/manager/icon_title.gif" align="absmiddle" width="3" height="5" border="0" hspace="5"><a href="<?=$PHP_SELF?>?option=counter&no=4&year=<?=$year?>&month=<?=$month?>&day=<?=$day?>"><?=$month_r?></a></p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="white" height="25" style="padding-top:6px;">
                                    <p><img src="winko/system/winko_img/manager/icon_title.gif" align="absmiddle" width="3" height="5" border="0" hspace="5"><a href="<?=$PHP_SELF?>?option=counter&no=5&year=<?=$year?>&month=<?=$month?>&day=<?=$day?>"><?=$year_r?></a></p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="white" height="25" style="padding-top:6px;">
                                    <p><img src="winko/system/winko_img/manager/icon_title.gif" align="absmiddle" width="3" height="5" border="0" hspace="5"><a href="<?=$PHP_SELF?>?option=counter&no=6&year=<?=$year?>&month=<?=$month?>&day=<?=$day?>"><?=$referer_r?></a></p>
                                </td>
                            </tr>
                        </table>
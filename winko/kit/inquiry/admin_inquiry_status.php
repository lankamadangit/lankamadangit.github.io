<?
if(!$s_year) $s_year = date("Y",time());
if(!$s_month) $s_month = date("n",time());
?>


						<table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                    <p align="right"><img src="winko/system/winko_img/sam/icon_location.gif" width="10" height="10" border="0" align="absmiddle"><a href="admin.php"><font color="#666666">HOME</font></a> 
                                    &gt; <a href="admin.php?option=inquiry"><font color="#666666">고객문의</font></a> 
                                    &gt; <a href="admin.php?option=inquiry&option2=status"><font color="#DF5614">고객문의 현황</font></a></p>
                                </td>
                            </tr>
                            <tr>
                                <td height="30">
                                    <p><img src="winko/system/winko_img/sam/icon_title.gif" width="11" height="11" border="0" align="absmiddle" hspace="4"><font class="title_text">고객문의 현황</font></p>
                                </td>
                            </tr>
                            <tr>
                                <td height="1" bgcolor="#E0E0E0"></td>
                            </tr>
                            <tr>
                                <td height="15"></td>
                            </tr>
                            <tr>
                                <td>
<!-- List {{ -->
												<table align="center" cellpadding="0" cellspacing="0" width="95%">
<form onsubmit='return UserInfo_Form();' name="UserInfo" method="post"  action="admin.php?option=inquiry&option2=status">
<input type="hidden" name="catalog_form" value="1">
<?
  unset($check1);
  $check1[$s_year]=" selected";

  unset($check2);
  $check2[$s_month]=" selected";
?>
													<tr>
                                                        <td align="center"><SELECT class=input name=s_year> <OPTION value="2000"<?=$check1[2000]?>>2000年</OPTION><OPTION value="2001"<?=$check1[2001]?>>2001年</OPTION> <OPTION value="2002"<?=$check1[2002]?>>2002年</OPTION><OPTION value="2003"<?=$check1[2003]?>>2003年</OPTION><OPTION value="2004"<?=$check1[2004]?>>2004年</OPTION><OPTION value="2005"<?=$check1[2005]?>>2005年</OPTION><OPTION value="2006"<?=$check1[2006]?>>2006年</OPTION><OPTION value="2007"<?=$check1[2007]?>>2007年</OPTION></SELECT> <SELECT class=input name=s_month> <OPTION value="1"<?=$check2[1]?>>1月</OPTION><OPTION value="2"<?=$check2[2]?>>2月</OPTION><OPTION value="3"<?=$check2[3]?>>3月</OPTION><OPTION value="4"<?=$check2[4]?>>4月</OPTION><OPTION value="5"<?=$check2[5]?>>5月</OPTION><OPTION value="6"<?=$check2[6]?>>6月</OPTION><OPTION value="7"<?=$check2[7]?>>7月</OPTION><OPTION value="8"<?=$check2[8]?>>8月</OPTION><OPTION value="9"<?=$check2[9]?>>9月</OPTION><OPTION value="10"<?=$check2[10]?>>10月</OPTION><OPTION value="11"<?=$check2[11]?>>11月</OPTION><OPTION value="12"<?=$check2[12]?>>12月</OPTION></select> <input type="image" src="winko/system/winko_img/sam/icon_search.gif" width="47" height="19" border="0" hspace="10" align="absmiddle">
                                                        </td>
                                                    </tr>
</form>
                                                </table>
<!-- List }} -->
                                </td>
                            </tr>
<?if($s_year && $s_month && $catalog_form) {
if($s_month==4 || $s_month==6 || $s_month==9 || $s_month==11) $end_month = "30";
elseif($s_month==2) $end_month = "28";
else $end_month = "31";
?>
							<tr><td height="15"></td></tr>
							<tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" width="100%" align="center">
									
                                        <tr>
                                            <td height="30">
                                                    <p><img src="winko/system/winko_img/sam/icon_bullet.gif" width="13" height="11" border="0" align="absmiddle"><font color="#627DBC"><b><?=$s_year?>年 
                                                <?=$s_month?>月</b></font></p>
                                            </td>
                                        </tr>
										<tr>
                                            <td height="1" bgcolor="#85ACCF"></td>
                                        </tr>					
                                        <tr>
                                            <td>
                                                    <table cellpadding="3" cellspacing="1" width="100%" bgcolor="#E1E1E1">
                                                        <tr>
                                                            <td bgcolor="#F2F2F2" width="55">
																<p align="center"><b><font color="#627DBC">&#21306;&#20998;</font></b></p>
                                                            </td>
<?
for($j=1; $j<=$end_month; $j++) {
	echo "<td bgcolor=\"#F2F2F2\" width=\"15\"><p align=\"center\">$j</p></td>";
}
?>
                                                            <td bgcolor="#F2F2F2">
                                                                <p align="center"><b>合計</b></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="white" width="55">
                                                                <p align="center"><b></b></p>
                                                            </td>
<?
for($j=1; $j<=$end_month; $j++) {
	$start_date=mktime(0,0,0,$s_month,$j,$s_year);
	$end_date=mktime(24,59,59,$s_month,$j,$s_year);
	$data=mysql_fetch_array(mysql_query("select count(*) from {$top}_inquiry where (Reg_date >= $start_date) and (Reg_date < $end_date)"));
	$Total_cate = $Total_cate + $data[0];
	echo "<td bgcolor=\"#ffffff\" width=\"15\"><p align=\"center\">$data[0]</p></td>";
}
?>
                                                            <td bgcolor="white">
                                                            <p align="center"><?=$Total_cate?></p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                            </td>
                                        </tr>
                                    </table>								
								</td>
                            </tr>
							<tr><td height="35"></td></tr>
<?}?>
                        </table>
<br /><br /><br />
<div align="center">
	<table border="0" cellspacing="0" cellpadding="0" width="300">
		<tr>
			<td colspan="2">
				<table width="100%" border="1" cellspacing="0" cellpadding="0" bgcolor="<?=$light?>" bordercolorlight="<?=$dark?>" bordercolordark="#FFFFFF">
					<tr>
						<td style="font-family:Matchworks,Tahoma;font-size:8pt;color:<?=$dark?>" align="center" nowrap><img src="/images/t.gif" height="3" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<table border="0" width="300" cellpadding="0" cellspacing="0">
		<form method="post" name="signform" action="<?=$target?>">
		<input type="hidden" name="page" value="<?=$page?>" />
		<input type="hidden" name="code" value="<?=$code?>" />
		<input type="hidden" name="category" value="<?=$category?>" />
		<input type="hidden" name="number" value="<?=$number?>" />
		<input type="hidden" name="c_uid" value="<?=$c_uid?>" />
		<tr>
			<td colspan="2" height="30">&nbsp;&nbsp;<span style="font-family:Arial;font-size:8pt;font-weight:bold;"><font color="#333333">Enter</font> <span style="font-size:15px;letter-spacing:-1px;">Password</span></span></td>
		</tr>
		<tr height="1">
			<td colspan="2" bgcolor="<?=$dark?>"><img src="images/t.gif" height="1" /></td>
		</tr>
		<tr height="25" bgcolor="<?=$light?>" style="padding:5px;">
			<td align="center"><?=$ment?><br><?=$input_password?></td>
		</tr>
		<tr height="1">
			<td colspan="2" bgcolor="<?=$dark?>"><img src="images/t.gif" height="1" /></td>
		</tr>
		<tr height="40">
			<td colspan="2" align="right"><input type="image" align="absmiddle" border="0" src="<?=$skin_folder?>/confirm.gif" hspace="2" /><?=$a_list?><img src="<?=$skin_folder?>/list.gif" border="0" align="absmiddle" hspace="2" /></a><img align="absMiddle" border="0" onclick="history.back()" src="<?=$skin_folder?>/back.gif" style="CURSOR: hand" hspace="2"></td>
		</tr>
	</table>
</div>
<br /><br />

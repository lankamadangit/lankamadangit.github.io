<script language="JavaScript" type="text/JavaScript">
<!--
function check_submit() {
	if(!login.passwd.value) {
		alert("비밀번호를 입력하여 주세요");
		login.passwd.focus();
		return false;
	}

	return true;
}
//-->
</script>
<!-- Contents Start -->
<table align="center" cellpadding="0" cellspacing="0" width="94%">
	<tr>
		<td height="60"></td>
	</tr>
	<tr>
		<td align=center>
			<table align="center" cellpadding="0" cellspacing="0" width="300">
				<tr>
					<td height="130" bgcolor="#F1F1F1">
						<table align="center" cellpadding="0" cellspacing="0" width="300">
							<FORM action='winko.php?code=<?=$code?>&body=view&page=<?=$page?>&number=<?=$number?>&category=<?=$category?>' method='post' onsubmit='return check_submit();' name=login>
							<input type='hidden' name='code' value='<?=$code?>'>
							<input type='hidden' name='page' value='<?=$page?>'>
							<input type='hidden' name='number' value='<?=$number?>'>
							<input type='hidden' name='category' value='<?=$category?>'>
							<tr>
								<td width="207">
									<table align="center" cellpadding="0" cellspacing="10" width="205">
										<tr>
											<td width="97"><img src="<?=$skin_folder?>/secret_02.gif" width="97" height="24" border="0"></td>
											<td width="108"><INPUT class=input type=password maxLength=20 size="15" value="" name=passwd></td>
										</tr>
									</table>
								</td>
								<td align="center"><INPUT type=image src="<?=$skin_folder?>/secret_01.gif" align=absMiddle width="59" height="61" border=0></td>
							</tr>
						</form>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="30">
		</td>
	</tr>
</table>
<!-- Contents End -->	
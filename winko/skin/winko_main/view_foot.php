	<tr height="1">
		<td bgcolor="<?=$dark?>"><img src="<?=$skin_folder?>/blank.gif" border='0' /></td>
	</tr>
	<tr>
		<td height="1"><img src="<?=$skin_folder?>/blank.gif" height="5" /></td>
	</tr>
	<tr>
		<td align="right">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td><?=$list_icon?></td>
					<td align='right'>
					<?
					$encoded_key = urlencode($key);
					echo("{$reply_icon} {$modify_icon} {$delete_icon}");
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
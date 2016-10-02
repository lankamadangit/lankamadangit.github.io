				<?
					$tmp = 3 - $bbs_list_cnt;
						if($tmp > 0) {
							for($j=$bbs_list_cnt; $j < 3; $j++) {
						?>
							<? if($j % 3 == "0") { ?>
					<tr>
							<? } ?>
						<td align="center" class="box_padding" style="padding: 0px 0px 10px 10px;">
							<table width="160" border="0" cellspacing="1" cellpadding="2">
								<tr>
									<td colspan="3" width="160" height="185"></td>
								</tr>
							</table>
						</td>
						<? if($j % 3 == "2") { ?>
					</tr>
					<? } ?>
				<?
					}
				}
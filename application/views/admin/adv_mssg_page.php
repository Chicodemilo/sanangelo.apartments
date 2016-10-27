
	<form action="<?php echo base_url(); ?>admin/submit_mssg" method="post">
		<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<table>
			<tr>
				<th colspan="8">
					MESSAGE
				</th> 
			</tr>
			<tr>
				<td class="righter" width="20%">In Email And On Page: </td>
				<td colspan="7"><textarea name="adv_mssg_mssg" cols="90" rows="5"  id="adv_mssg_mssg" maxlength='400' placeholder="This message will be emailed out and w be put on the advertisers page. Keep it short :)" ><?php echo $adv_mssg_mssg; ?></textarea></td>
			</tr>
			<tr>
				<td class="righter" width="20%">In Email Not On Page: </td>
				<td colspan="7"><textarea name="adv_mssg_email_only" cols="90" rows="5"  id="adv_mssg_email_only" maxlength='2000' placeholder="This part of the message will only be emailed out but won't be put on the advertisers page." ></textarea></td>
			</tr>
			<tr>
				<td class="righter" width="20%">Email Subject: </td>
				<td colspan="7"><input type="text" name="email_subject" id="email_subject" style="width:50%" maxlength="60"></td>
			</tr>
			<tr>
				<td class="righter">On:</td>
				<td colspan="3">
					<select name="adv_mssg_on" id="adv_mssg_on" class="adv_mssg_on">
						<option value="Y">Y</option>
						<option value="N">N</option>
					</select>
				</td>

				<td class="righter">Email To Advertisers:</td>
				<td colspan="3">
					<select name="email_adv" id="email_adv" class="email_adv">
						<option value="Y">Y</option>
						<option value="N">N</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="righter">Start:</td>
				<td colspan="3">
					<input type="text" name="adv_mssg_start" class="date-picker" id="adv_mssg_start" value="<?php echo $adv_mssg_start; ?>">
				</td>

				<td class="righter">End:</td>
				<td colspan="3">
					<input type="text" name="adv_mssg_end" class="date-picker" id="adv_mssg_end" value="<?php echo $adv_mssg_end; ?>">
				</td>
			</tr>
			<tr>
				<td class="righter">Include Username:</td>
				<td>
					<select name="include_user" id="include_user" class="include_user">
						<option value="Y">Y</option>
						<option value="N">N</option>
					</select>
				</td>
				<td class="righter">Include Email:</td>
				<td>
					<select name="include_email" id="include_email" class="include_email">
						<option value="Y">Y</option>
						<option value="N">N</option>
					</select>
				</td>
				<td class="righter">Include Password:</td>
				<td>
					<select name="include_password" id="include_password" class="include_password">
						<option value="Y">Y</option>
						<option value="N" selected="selected">N</option>
					</select>
				</td>
				<td class="righter">Include Link To Their Page:</td>
				<td>
					<select name="include_link" id="include_link" class="include_link">
						<option value="Y">Y</option>
						<option value="N">N</option>
					</select>
				</td>
			</tr>
			<tr>
				<th colspan="8"><input type="submit" value="Submit Edits"></th>
			</tr>
		</table>
	</form>
<div class="bottom_room">
	&nbsp;
</div>
<script>

	var start_picker = new Pikaday({ field: document.getElementById('adv_mssg_start') });
	var end_picker = new Pikaday({ field: document.getElementById('adv_mssg_end') });

	jQuery(document).ready(function($) {
		$('#adv_mssg_on').val('<?php echo $adv_mssg_on ?>').change();

	});
</script>


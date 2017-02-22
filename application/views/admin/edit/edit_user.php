
	<form action="<?php echo base_url(); ?>admin/submit_user_edits/<?php echo $apt_id; ?>/<?php echo $user[0]['ID']; ?>" method="post">
	<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<input type="hidden" name="id" id="id" value="<?php echo $user[0]['ID'] ?>">
		<table id="user_edit">
			<tr>
				<th colspan="2">
					USER INFORMATION :: <?php echo $user[0]['username']; ?>
				</th> 
			</tr>
			<tr>
				<td class="righter">Userame:</td>
				<td><?php echo $user[0]['username'] ?></td>
			</tr>
			<tr>	
				<td class="righter" width="20%">Email:</td>
				<td><input type="email"  name="email" id="email" style="width:90%;"placeholder="Enter The Last Name" value="<?php echo $user[0]['email'] ?>"></td>
			</tr>
			<tr>	
				<td class="righter" width="20%">Email 2:</td>
				<td><input type="email"  name="email_2" id="email_2" style="width:90%;"placeholder="Enter The Another Email Address To Receive Notifications" value="<?php echo $user[0]['email_2'] ?>"></td>
			</tr>
			<tr>	
				<td class="righter" width="20%">Email 3:</td>
				<td><input type="email"  name="email_3" id="email_3" style="width:90%;"placeholder="Enter The Another Email Address To Receive Notifications" value="<?php echo $user[0]['email_3'] ?>"></td>
			</tr>
			<tr>	
				<td class="righter" width="20%">Email 4:</td>
				<td><input type="email"  name="email_4" style="width:90%;"placeholder="Enter The Another Email Address To Receive Notifications" value="<?php echo $user[0]['email_4'] ?>"></td>
			</tr>
			<tr><th colspan="2"></th></tr>

		</table>
		<table style="width:600px; margin:auto;">
			<tr>
				<td class="righter_light" width="20%">Receive Site Emails:</td>
				<td>
					<select name="get_messages" id="get_messages">
						<option value="Y">Yes</option>
						<option value="N">No</option>
					</select>
				</td>
			</tr>
			<tr>
				<th colspan="8"></th>
			</tr>
			<tr>
				<td colspan="8"><input type="submit" value="Submit Edits"></td>
			</tr>
		</table>
	</form>
	<br><br>
	<table style="width:600px; margin:auto;">
		<tr>
			<td><a class="not_fancy_dark" href="<?php echo base_url(); ?>admin/change_password/<?php echo $apt_id; ?>/<?php echo $user[0]['ID']; ?>">CHANGE PASSWORD</a> for <?php echo $user[0]['username']; ?></td>
		</tr>
	</table>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#get_messages option[value="<?php echo $user[0]["get_messages"]; ?>"]').prop('selected',true);
		});
	</script>
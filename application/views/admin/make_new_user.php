
	<form action="<?php echo base_url(); ?>admin/submit_new_user" method="post">
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
					MAKE NEW USER
				</th> 
			</tr>
			<tr>
				<td class="righter" width="20%">Username:</td>
				<td colspan="1"><input type="text" style="width:90%" name="username" id="username" placeholder="User Name" maxlength="35" required></td>

				<td class="righter">Password:</td>
				<td colspan="1"><input type="text" style="width:90%" name="password" id="password" placeholder="Enter A Seven Character Password" required></td>

				<td class="righter">Verified:</td>
				<td colspan="1">
					<select name="verified" id="verified">
						<option value="Y">Yes</option>
						<option value="N">No</option>
					</select>
				</td>

				<td class="righter">Role:</td>
				<td colspan="1">
					<select name="role" id="role">
						<option value="User">User</option>
						<option value="Master">Master</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="righter">Email Address:</td>
				<td colspan="1"><input type="email" style="width:90%" name="email" id="email" placeholder="Enter An Email Address" required></td>
				<td class="righter">Email Address:</td>
				<td colspan="1"><input type="email" style="width:90%" name="email_2" id="email_2" placeholder="Enter An Email Address"></td>
				<td class="righter">Email Address:</td>
				<td colspan="1"><input type="email" style="width:90%" name="email_3" id="email_3" placeholder="Enter An Email Address"></td>
				<td class="righter">Email Address:</td>
				<td colspan="1"><input type="email" style="width:90%" name="email_4" id="email_4" placeholder="Enter An Email Address"></td>
			</tr>


			<tr>
				<th colspan="8"><input type="submit" value="Submit User"></th>
			</tr>
		</table>
	</form>
<div class="bottom_room">
	&nbsp;
</div>
<script>

</script>


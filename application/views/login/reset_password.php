
	<h1>RESET PASSWORD</h1>
	<form action="<?php echo base_url(); ?>login/reset_this_password" method="POST">
		<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<label for="username">Username:</label>
		<input type="text" value="<?php echo set_value('username'); ?>" name="username" id="username" maxlength="50">
		<br>
		<input type="submit" name="submit" value="RESET">
	</form>	
	<?php 
		echo validation_errors('<p class="errors">'); 
		if(isset($no_user)){
			echo '<p class="errors">'.$no_user.'</p>';
		}

	?>
	<p class="little">Enter the username for your account and we'll email you instructions.</p>

</body>

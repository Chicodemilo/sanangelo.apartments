
	<h1>LOGIN</h1>
	<form action="<?php echo base_url(); ?>login/login_user" method="POST">
		<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<label for="username">Username</label>
		<input type="text" value="<?php echo set_value('username'); ?>" name="username" id="username" maxlength="50">
		<br>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" maxlength="18">
		<br>
		<input type="submit" name="submit" value="LOGIN">
	</form>	
	<?php 
		echo validation_errors('<p class="errors">'); 
		if(isset($no_user)){
			echo '<p class="errors">'.$no_user.'</p>';
		}

	?>
	<a href="<?php echo base_url(); ?>login/reset_password" class="little">I Forgot My Password</a>

</body>

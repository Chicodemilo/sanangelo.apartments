
	<h1>REGISTER</h1>
	<form action="<?php echo base_url(); ?>login/register_user" method="POST" onsubmit="return validate_resistration()">
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
		<label for="email">Email</label>
		<input type="email" value="<?php echo set_value('email'); ?>" name="email" id="email" maxlength="50">
		<br>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" maxlength="18">
		<br>
		<label for="conf_password">Re-Type Password</label>
		<input type="password" name="conf_password" id="conf_password" maxlength="18">
		<br>
		What Is <span id="first_num"></span> Plus <span id="second_num"></span> :
		<br>
		<input type="text" maxlength="2" name="num_ans" id="num_ans" >
		<br>
		<input type="submit" name="submit" value="REGISTER">
	</form>	
	<?php echo validation_errors('<p class="errors">') ?>
	<p class="errors" id="not_correct">You didn't answer the math question correctly.<br>Are you a real person?</p>
</body>
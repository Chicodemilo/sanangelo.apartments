<div class="sign_up_screen">
	<div class="inner_sign_up_screen">
	<?php 
		$csrf = array(
	    'name' => $this->security->get_csrf_token_name(),
	    'hash' => $this->security->get_csrf_hash()
		); 
	?>
							
		<span class="sign_up_title">Sign Up! </span>
		<span class="sign_up_text">&amp; We'll Send San Angelo Apartment Specials Right To You!</span>
		
		<form action=" <?php echo base_url(); ?>texas/sign_up" method="POST">
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			<input type="text" name="name" id="sign_up_name">
			<input type="email" required name="sign_up_email" id="sign_up_email" placeholder="Enter Your Email Address"><span class="full_hide"><br></span>
			<input type="submit" id="sign_up_submit" value="Sign Me Up!">
		</form>
		<span class="no_thanks"><a href=" <?php echo base_url(); ?>texas/no_sign_up">No Thanks!</a></span>
	</div>

</div>
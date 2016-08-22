<form action="<?php echo base_url(); ?>main/add_amenities" method="POST">
	<?php 
		$csrf = array(
	    'name' => $this->security->get_csrf_token_name(),
	    'hash' => $this->security->get_csrf_hash()
		); 
	?>
	<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	Apt ID<input type="text" name="apt_id"><br>
	<input type="submit" value="SUBMIT TO ME">
</form>
<!-- end wrapper div -->
</div>
<div class="above_footer">
	
</div>
<footer>
		<div id="footer_info_left">
			
			<?php 
				$phpdate = strtotime($this->session->userdata('current_login'));
				$current_login = date( 'n/j/y, g:i a', $phpdate );
				echo "Current Login: ";
				echo $current_login; 
				echo "<br>";
				echo "Previous Login: ";
				$phpdate = strtotime($this->session->userdata('last_login'));
				$last_login = date( 'n/j/y, g:i a', $phpdate );
				echo $last_login;
			?>
			<br>
			Your IP Address: <?php echo $this->session->userdata('current_ip'); ?>
			<br>
			Total Logins: <?php echo $this->session->userdata('login_count'); ?>
		</div>
		<div class="footer_logo">
			<img src="<?php echo base_url(); ?>images/logo_lil.svg" alt="<?php echo WEBSITELOWER; ?>">
		</div>
        <div id="footer_info">
        	<?php echo $this->session->userdata('apt_name'); ?>
        	<br>
	        &COPY; <?php echo date('Y') ?> Bay Rum Media
	        <br>
	        For Help Call 1-866-800-4727
	        
        </div>
        
</footer>

</body>
</html>
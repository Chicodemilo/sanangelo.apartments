
	<form action="<?php echo base_url(); ?>edit/submit_change_password/<?php echo $id; ?>" method="post">
	<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<table id="user_edit">
			<tr>
				<th colspan="2">
					NEW PASSWORD FOR <?php echo $this->session->userdata('username'); ?>
				</th> 
			</tr>
			<tr>
				<td class="righter">Enter New Password:</td>
				<td><input type="password"  name="password" id="password" style="width:90%;" placeholder="Enter A New Password"></td>
			</tr>
			<tr>
				<td class="righter" width="20%">Confirm Password:</td>
				<td><input type="password"  name="c_password" id="c_password" style="width:90%;"placeholder="Retype The New Password"></td>
			</tr>
			<tr><th colspan="2"><input type="submit" id="submit"></th></tr>
		</table>

	<script type="text/javascript">
		$(document).ready(function() {
			
			jQuery(function(){
		        $("#submit").click(function(){
				        $(".error").hide();
				        var hasError = false;
				        var passwordVal = $("#password").val();
				        var count = passwordVal.length;
				        var checkVal = $("#c_password").val();
				        if (passwordVal == '') {
				            $("#password").after('<span class="error">Please enter a password.</span>');
				            hasError = true;
				        } else if (count < 6 ){
				        	$("#password").after('<span class="error">Your password needs at least 6 characters.</span>');
				            hasError = true;
				        }else if (passwordVal == '123456' || passwordVal == 'password' || passwordVal == '111111'){
				        	$("#password").after('<span class="error">That is a really weak password. Try something else.</span>');
				            hasError = true;
				        }else if (checkVal == '') {
				            $("#c_password").after('<span class="error">Please re-enter your password.</span>');
				            hasError = true;
				        } else if (passwordVal != checkVal ) {
				            $("#c_password").after('<span class="error">Passwords do not match.</span>');
				            hasError = true;
				        }
				        if(hasError == true) {return false;}
				    });
			});
		});
	</script>
<div class="wrapper">
	 <table class="ad_table">
	 	<tr>
	 		<th colspan="5">ENTER ITEM</th>

	 	</tr>
	 	<td>
	 		** PLEASE READ **<br><br>
	 		The site will auto-make items for the ads that have run on the site, like Site Take Overs or Premium Level subscriptions.<br>You don't neeed to enter those things here.<br><br>Items made here are for anything else you need to charge a customer for. Like ad design or photography, for example.<br><br>The date entered should be for the month you want the bill to be sent out. Meaning, if you want to the bill to go out this month but the work was created last month... then enter a date for this month. Then use the Item Name to explain the date when the work was done... 'Photography March 20th' for example.
	 	</td>
	 </table>
	
	 <table class="ad_table">
	 	<form action="<?php echo base_url(); ?>admin/enter_this_item" method="POST">
	 		<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	 		<tr>
	 			<th colspan="7">Enter Item For Advertiser</th>
	 		</tr>
		 	<tr>
		 		<td>
			 			<select name="apt_id">
			 				<?php 
			 					foreach ($result as $key => $value) {
			 						echo "<option name='".$value['property_name']."' value='".$value['ID']."'>";
			 						echo $value['ID']." : ".$value['property_name']." : ".$value['property_phone'];
			 						echo "</option>";
			 					}
			 					foreach ($suspended as $key => $value) {
			 						echo "<option name='".$value['property_name']."' value='".$value['ID']."'>Suspended : ";
			 						echo $value['ID']." : ".$value['property_name']." : ".$value['property_phone'];
			 						echo "</option>";
			 					}
			 				 ?>
			 			</select>

		 		</td>
		 		<td>
		 			Charge Date:<input type="text" name="start_date"  class="date-picker" id="start_date" value="
						<?php 
							$today = date('Y-m-d');
							echo $today;
						 ?>
		 			" required>
		 			
		 		</td>
		 		<td>
		 			Item Name:<input type="text" name="item" id="item" class="edit_inv_input">
		 		</td>
		 		<td>
		 			Charge To Customer: $<input type="text" name="cost" id="cost" value="0.00">
		 			<input type="hidden" name="custom_item" value="Y">
		 		</td>
		 		<td>
		 			<input type="submit" value="ENTER ITEM">
		 		</td>
	 		</tr>
	 	</form>
	 </table>
 </div>

 <script>
	
	var start_date = new Pikaday({ field: document.getElementById('start_date') });

</script>
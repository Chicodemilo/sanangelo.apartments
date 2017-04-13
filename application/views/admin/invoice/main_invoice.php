<div class="wrapper">
	 <table class="ad_table">
	 	<tr>
	 		<th colspan="5">INVOICING</th>

	 	</tr>
	 </table>
	 <div class="lil_padder"></div>
	 <table class="ad_table">
	 	<form action="<?php echo base_url(); ?>admin/make_invoices/" method="POST">
			<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<tr>
			<th colspan="5">
		 		<span>Make Invoices For Date Range</span> 
	 		</th>
		</tr>
		 <tr>
		 	<td>
		 		Start Date:<input type="text" name="start_date"  class="date-picker" id="adv_start_date" value="
					<?php 
						$start_of_month = date('Y-m-'.'01');
						$start_of_last_month = date('Y-m-d', strtotime('-1 month', strtotime($start_of_month)));
						echo $start_of_last_month;

					 ?>
		 		" 
		 		required>
		 	</td>
		 	<td>
		 		End Date:<input type="text" name="end_date" class="date-picker" id="adv_end_date" value="
					<?php 
						$start_of_month = date('Y-m-'.'01');
						$start_of_last_month = date('Y-m-t', strtotime('-1 month', strtotime($start_of_month)));
						echo $start_of_last_month;
					 ?>
		 		" 

		 		required>
		 	</td>
		 	<td>
		 		<input type="submit" value="MAKE INVOICES">
		 	</td>
		 </tr>
		 </form>
	 </table>
	 <div class="lil_padder"></div>
	 <table>
	 	<tr>
	 		<td style="border-right:1px solid #9B9B9B;"> <a href="<?php echo base_url(); ?>admin/enter_payments" title="ENTER PAYMENTS">ENTER<br>PAYMENTS</a> </td>
	 		<td style="border-right:1px solid #9B9B9B;"> <a href="<?php echo base_url(); ?>admin/see_past_due_inv" title="SEE PAST DUE INVOICES">SEE PAST<br>DUE INVOICES</a> </td>
	 		<td> <a href="<?php echo base_url(); ?>admin/enter_item" title="ENTER ITEM">ENTER<br>A CUSTOM ITEM</a> </td>
	 	</tr>
	 </table>
	 <div class="lil_padder"></div>
	 <table class="ad_table">
	 	
	 		<tr>
	 			<th colspan="2" style="border-right:1px solid #9B9B9B;">See Invoices For Advertiser</th>
	 			<th colspan="2" style="border-right:1px solid #9B9B9B;">See Payments For Advertiser</th>
	 			<th colspan="2">See Custom Items For Advertiser</th>
	 		</tr>
		 	<tr>

		 	<form action="<?php echo base_url(); ?>admin/inv_by_advertiser" method="POST">
	 		<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
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
		 		<td style="border-right:1px solid #9B9B9B;">
		 			<input type="submit" value="SEE INVOICES">
		 		</td>
		 	</form>

		 	<form action="<?php echo base_url(); ?>admin/pay_by_advertiser" method="POST">
		 		<?php 
					$csrf = array(
			        'name' => $this->security->get_csrf_token_name(),
			        'hash' => $this->security->get_csrf_hash()
					); 
				?>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
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
		 		<td style="border-right:1px solid #9B9B9B;">
		 			<input type="submit" value="SEE PAYMENTS">
		 		</td>
		 	</form>


		 	<form action="<?php echo base_url(); ?>admin/see_these_cust_items" method="POST">
	 		<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
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
		 			<input type="submit" value="SEE ITEMS">
		 		</td>
		 	</form>


	 		</tr>
	 	
	 </table>
	 <div class="lil_padder"></div>
	 <table class="ad_table">
	 	<form action="<?php echo base_url(); ?>admin/inv_by_date" method="POST">
	 		<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	 		<tr>
	 			<th colspan="5">See Invoices For Date Range</th>
	 		</tr>
		 	<tr>
		 		
		 		<td>
		 			Start Date:<input type="text" name="see_inv_start_date"  class="date-picker" id="see_inv_start_date" value="
						<?php 
							$start_of_month = date('Y-m-'.'01');
							$start_of_last_month = date('Y-m-d', strtotime('-1 month', strtotime($start_of_month)));
							echo $start_of_last_month;
						 ?>
		 			" required>
		 		</td>
		 		<td>
		 			End Date:<input type="text" name="see_inv_end_date"  class="date-picker" id="see_inv_end_date" value="
						<?php 
							$today = date('Y-m-d');
							echo $today;
						 ?>
		 			" required>
		 		</td>
		 		<td>
		 			<input type="submit" value="SEE INVOICES">
		 		</td>
	 		</tr>
	 	</form>
	 </table>
	 <div class="lil_padder"></div>
	 <table class="ad_table">
	 	<form action="<?php echo base_url(); ?>admin/enter_master_payment" method="POST">
	 		<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	 		<tr>
	 			<th colspan="7">Enter Master Payment For Advertiser</th>
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
		 			Payment Date:<input type="text" name="master_payment_date"  class="date-picker" id="master_payment_date" value="
						<?php 
							$today = date('Y-m-d');
							echo $today;
						 ?>
		 			" required>
		 			
		 		</td>
		 		<td>
		 			Payment Type:
		 			<select name="master_payment_type" id="master_payment_type">
		 				<option value="Check" selected="selected">Check</option>
		 				<option value="Credit Card">Credit Card</option>
		 				<option value="Cash">Cash</option>
		 				<option value="Existing Credit">Exsisting Credit</option>
		 				<option value="Internal Adjustment">Internal Adjustment</option>
		 				<option value="Other">Other</option>
		 			</select>
		 		</td>
		 		<td>
		 			Check Number:<input type="text" name="check_number" id="master_payment_check_number">
		 		</td>
		 		<td>
		 			Amount: $<input type="text" name="amount" id="master_payment_amount" value="0.00">
		 		</td>
		 		<td>
		 			Notes: <textarea name="notes" id="master_payment_note" rows="3" cols="40"></textarea>
		 		</td>
		 		<td>
		 			<input type="submit" value="ENTER PAYMENT">
		 		</td>
	 		</tr>
	 	</form>
	 </table>
 </div>

 <script>
	
	var start_picker = new Pikaday({ field: document.getElementById('adv_start_date') });
	var end_picker = new Pikaday({ field: document.getElementById('adv_end_date') });
	var see_inv_start_picker = new Pikaday({ field: document.getElementById('see_inv_start_date') });
	var see_inv_end_picker = new Pikaday({ field: document.getElementById('see_inv_end_date') });
	var master_payment_picker = new Pikaday({ field: document.getElementById('master_payment_date') });

</script>
<div class="wrapper">
	<table>
		<tr>
			<th>ENTER PAYMENTS</th>
		</tr>
	</table>
	<table class="inv_table">
		<tr>
			<th>INVOICE</th>
			<th>DATE ENTERED</th>
			<th>PAYMENT TYPE</th>
			<th>CHECK NUMBER</th>
			<th>AMOUNT</th>
		</tr>
		<form action="<?php echo base_url(); ?>admin/submit_these_payments" method="POST">
		<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
		?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
		<tr>
			<td colspan="7">
				<input type="submit" value="SUBMIT PAYMENTS">
			</td>
		</tr>
		<?php 
			$row_flipper = 'A';
			$today = date('Y-m-d');
			for ($i=0; $i < 50 ; $i++) { 

				echo "<input type='hidden' name='payment_entry_number_".$i."' value='".$i."'>";
				echo "<tr>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "<select name='inv_number_".$i."' autofocus>";
							foreach ($invoices as $key => $value) {
								echo "<option value='".$value['inv_number']."'>".$value['property_name']." : ".$value['inv_number']." : ".$value['inv_creation_date']." : ".$value['inv_status']." : $".$value['invoice_balance']."</option>";
							}
						echo "</select>";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo '<input type="text" name="pay_date_entered_'.$i.'"  class="date-picker" id="pay_date_entered_'.$i.'" value="'.$today.'" required>';
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "<select name='payment_".$i."_type_payment'>";
								echo "<option value='CHECK'>CHECK</option>";
								echo "<option value='CREDIT CARD'>CREDIT CARD</option>";
								echo "<option value='CASH'>CASH</option>";
								echo "<option value='TRADE'>TRADE</option>";
								echo "<option value='OTHER'>OTHER</option>";
						echo "</select>";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "<input type='text' maxlength='25' name='payment_check_num_".$i."' class='edit_inv_input'>";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "$<input type='number' step='0.01' name='payment_amount_".$i."' class='edit_inv_input'>";
					echo "</td>";
					echo "</tr>";

				if($row_flipper == 'A'){
					$row_flipper = 'B';
				}else{
					$row_flipper = 'A';
				}
			}
		 ?>
	</form>
	</table>
	


 <script>

 	for (var i = 0; i < 50; i++) {
 		var pay_date_entered = new Pikaday({ field: document.getElementById('pay_date_entered_'+i) });
 	}
	

</script>







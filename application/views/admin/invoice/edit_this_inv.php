<div class="wrapper">
	<table>
		<tr>
			<th>EDIT THIS INVOICE</th>
		</tr>
		<tr>
			<td class="bold_red">*Please note, any changes made here affect only this invoice. This form does not change the advertiser's information. This advertisers main information can be changed here: 
			<a class='not_fancy_dark' href="<?php echo base_url(); ?>admin/edit_this_apt/<?php echo $this_inv[0]['apt_id']; ?>/<?php echo $this_inv[0]['property_name'] ?>" title="">EDIT</a>

			</td>
		</tr>
	</table>

	<form action="<?php echo base_url() ?>admin/submit_this_invoice/
	<?php 
	
		echo $this_inv[0]['inv_number'].'/'.$creation_date.'/'.$sets;
		if($param_4){
			echo "/".$param_4;
		}

	?>" method="POST">
	<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
	<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	<input type="hidden" name='id' value='<?php echo $this_inv[0]['id']; ?>'>




	<table class="inv_table">
		<tr>
			<th>INV NUMBER</th>
			<th>ADV ID</th>
			<th>ADV NAME</th>
			<th>CONTACT</th>
			<th>EMAIL</th>
			<th>INVOICE<br>DATE</th>
			<th>DUE DATE</th>
			<th>STATUS</th>
			<th>TOTAL<br>DUE</th>
			<th></th>
			<th></th>
		</tr>
		
		<?php 
			$row_flipper = 'A';
			foreach ($this_inv as $key => $value) {
				echo "<tr>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['inv_number'];
						echo "<input type='hidden' name='inv_number' value='".$value['inv_number']."'>";
						echo "<input type='hidden' name='inv_creation_date' value='".$value['inv_creation_date']."'>";
						echo "<input type='hidden' name='inv_sets_today' value='".$value['inv_sets_today']."'>";

					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['apt_id'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "<input class='edit_inv_input' type='text' value='".$value['property_name']."' name='property_name'>";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "PHONE: <input class='edit_inv_input' type='text' value='".$value['property_phone']."' name='property_phone'><br>".
						"ADDRESS: <input class='edit_inv_input' type='text' value='".$value['property_address']."' name='property_address'><br>".
						"CITY: <input class='edit_inv_input' type='text' value='".$value['property_city']."' name='property_city'><br>".
						"STATE: <input class='edit_inv_input' type='text' value='".$value['property_state']."' name='property_state'><br>".
						"ZIP: <input class='edit_inv_input' type='text' value='".$value['property_zip']."' name='property_zip'>";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "EMAIL: <input class='edit_inv_input' type='text' value='".$value['apt_contact_email_1']."' name='apt_contact_email_1'><br>".
						"EMAIL: <input class='edit_inv_input' type='text' value='".$value['apt_contact_email_2']."' name='apt_contact_email_2'><br>".
						"EMAIL: <input class='edit_inv_input' type='text' value='".$value['apt_contact_email_3']."' name='apt_contact_email_3'><br>".
						"EMAIL: <input class='edit_inv_input' type='text' value='".$value['apt_contact_email_4']."' name='apt_contact_email_4'>";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo 'Start Date:<input type="text" name="inv_creation_date"  class="date-picker" id="inv_creation_date" value="';
						echo $value['inv_creation_date'];
						echo '">';
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo 'Start Date:<input type="text" name="inv_due_date"  class="date-picker" id="inv_due_date" value="';
						echo $value['inv_due_date'];
						echo '">';
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "<select name='inv_status' id='inv_status_edit'>";
						echo "<option value='DUE'>DUE</option>";
						echo "<option value='PAST DUE'>PAST DUE</option>";
						echo "<option value='PAID'>PAID</option>";
						echo "</select>";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "$<input type='number' step='0.01' min='0' value='".$value['invoice_balance']."' name='invoice_balance'>";
					echo "</td>";
					echo "<td colspan='2' class='inv_bg_".$row_flipper."'>";
						echo "<input type='submit' value='SUBMIT CHANGES'>";
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='inv_bg_".$row_flipper." righter'>";
						echo "Notes:";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."' colspan='15'>";
						echo "<textarea rows='3' cols='60' maxlength='500' name='inv_notes'>".$value["inv_notes"]."</textarea>";
					echo "</td>";
				echo "</tr>";

				for($i=1; $i <= 13 ; $i++) { 
					if($value['item_'.$i] != ''){
						echo "<tr>";
							echo "<td class='inv_bg_".$row_flipper." righter'>";
								echo "Item ".$i.":";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "<input type='text' name='item_".$i."' value='".$value['item_'.$i]."'>";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo 'Start Date:<input type="text" name="start_date_'.$i.'"  class="date-picker" id="start_date_'.$i.'" value="';
								echo $value['start_date_'.$i];
								echo '">';
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo 'End Date:<input type="text" name="end_date_'.$i.'"  class="date-picker" id="end_date_'.$i.'" value="';
								echo $value['end_date_'.$i];
								echo '">';
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Deduction: $ <input type='number' step='0.01' name='deduction_".$i."' value='".$value['deduction_'.$i]."'>";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Base Cost: $ <input type='number' step='0.01' name='base_cost_".$i."' value='".$value['base_cost_'.$i]."'>";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Item Cost: $ <input type='number' step='0.01' name='cost_".$i."' value='".$value['cost_'.$i]."'>";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."' colspan='7'></td>";
						echo "</tr>";
					}
				}

				for($i=1; $i <= 13 ; $i++) { 
					if($value['payment_'.$i] != '' && $value['payment_'.$i] != 0 ){
						echo "<tr>";
							echo "<td class='inv_bg_".$row_flipper." righter'>";
								echo "Payment ".$i.":";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "<input type='text' name='payment_".$i."_type' value='".$value['payment_'.$i.'_type']."'>";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo 'Start Date:<input type="text" name="payment_'.$i.'_date"  class="date-picker" id="payment_'.$i.'_date" value="';
								echo $value['payment_'.$i.'_date'];
								echo '">';
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Check Number: ";
								echo "<input type='text' name='payment_".$i."_check_num' value='".$value['payment_'.$i.'_check_num']."'>";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Payment Amount: $ -<input type='number' step='0.01' name='payment_".$i."' value='".$value['payment_'.$i]."'>";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."' colspan='7'></td>";
						echo "</tr>";
					}
				}
				echo "<tr><td class='inv_bg_c' colspan='17'></td></tr>";

				if($row_flipper == 'A'){
					$row_flipper = 'B';
				}else{
					$row_flipper = 'A';
				}
			}


		 ?>
	</table>
	</form>
 <script>
	
	var inv_creation_date = new Pikaday({ field: document.getElementById('inv_creation_date') });
	var inv_due_date = new Pikaday({ field: document.getElementById('inv_due_date') });
    
	jQuery(document).ready(function($) {

		var this_inv_status = "<?php echo  $this_inv[0]['inv_status']; ?>";
		console.log(this_inv_status);
		$("#inv_status_edit > option").each(function(){
	        if((this).value==this_inv_status){
	            $(this).attr("selected","selected");  
	        }
	    });
	});

</script>
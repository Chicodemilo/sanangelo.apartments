<div class="wrapper">
	<table>
		<tr>
			<th>INVOICES</th>
		</tr>
	</table>
	<table class="inv_table">
		<tr>
			<th colspan="15">INVOICES FROM <?php echo $see_inv_start_date." to ".$see_inv_end_date ?></th>
		</tr>
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
			<th>EDIT</th>
			<th>DELETE</th>
			<th>SEND</th>
		</tr>
		<?php 
			
			$row_flipper = 'A';
			foreach ($dates_inv as $key => $value) {
				echo "<tr>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['inv_number'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['apt_id'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['property_name'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['property_phone']."<br>".$value['property_address']."<br>".$value['property_city'].", ".$value['property_state']." ".$value['property_zip'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['apt_contact_email_1']."<br>".$value['apt_contact_email_2']."<br>".$value['apt_contact_email_3']."<br>".$value['apt_contact_email_4'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['inv_creation_date'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['inv_due_date'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo $value['inv_status'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "$".$value['invoice_balance'];
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "<a href='".base_url()."admin/this_inv_edit/".$value['inv_number']."/"."these_dates"."/".$see_inv_start_date."/".$see_inv_end_date."'>EDIT</a>";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "<a href='".base_url()."admin/delete_this_invoice/".$value['inv_number']."/"."these_dates"."/".$see_inv_start_date."/".$see_inv_end_date."'>DELETE</a>";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."'>";
						echo "<a href='".base_url()."admin/send_this_invoice/".$value['inv_number']."/"."these_dates"."/".$see_inv_start_date."/".$see_inv_end_date."'>SEND</a>";
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='inv_bg_".$row_flipper." righter'>";
						echo "Notes:";
					echo "</td>";
					echo "<td class='inv_bg_".$row_flipper."' colspan='15'>";
						echo $value["inv_notes"];
					echo "</td>";
				echo "</tr>";

				for($i=1; $i <= 13 ; $i++) { 
					if($value['item_'.$i] != ''){
						echo "<tr>";
							echo "<td class='inv_bg_".$row_flipper." righter'>";
								echo "Item ".$i.":";
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo $value['item_'.$i];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Start Date: ".$value['start_date_'.$i];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "End Date: ".$value['end_date_'.$i];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Deduction: $".$value['deduction_'.$i];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Base Cost: $".$value['base_cost_'.$i];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Item Cost: $".$value['cost_'.$i];
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
								echo $value['payment_'.$i.'_type'];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Payment Date: ".$value['payment_'.$i.'_date'];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Check Number: ".$value['payment_'.$i.'_check_num'];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								// echo "Deduction: ".$value['deduction_'.$i];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								// echo "Base Cost $: ".$value['base_cost_'.$i];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Payment Amount: -$".$value['payment_'.$i];
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











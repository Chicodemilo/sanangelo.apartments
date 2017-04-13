<div class="wrapper">
	<table>
		<tr>
			<th>PAYMENTS</th>
		</tr>
	</table>
	<table class="inv_table">
		<tr>
			<th colspan="15">PAYMENTS FOR <?php echo $advertiser_inv[0]['property_name'] ?></th>
		</tr>
		<tr>
			<th>INV NUMBER</th>
			<th>PAYMENT<br>PER INVOICE</th>
			<th>PAYMENT<br>TYPE</th>
			<th>DATE<br>ENTERED</th>
			<th>CHECK<br>NUMBER</th>
			<th>PAYMENT<br>AMOUNT</th>
			<th>DELETE</th>
		</tr>
		<?php 
			
			$row_flipper = 'A';
			foreach ($advertiser_inv as $key => $value) {

				for($i=1; $i <= 13 ; $i++) { 
					if($value['payment_'.$i] != '' && $value['payment_'.$i] != 0 ){
						echo "<tr>";

							echo "<td class='inv_bg_".$row_flipper."'>";
								echo $value['inv_number'];
							echo "</td>";
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
								echo "Payment Amount: $".$value['payment_'.$i];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "<a href='".base_url()."admin/delete_this_payment/".$value['inv_number']."/".$i."/".$value['apt_id']."'>DELETE</a>";
							echo "</td>";
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











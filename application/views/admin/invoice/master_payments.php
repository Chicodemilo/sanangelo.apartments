<div class="wrapper">
	<table>
		<tr>
			<th colspan="5">
				Master Payments For <?php echo $main_data[0]['property_name']; ?>
				<br>
				Overall Account Balance: $<?php echo $main_data[0]['balance']; ?>
			</th>
		</tr>
		<tr>
			<td colspan="5">
				&bull;&nbsp;Master Payments are payments or account adjustments not tied to a specific invoice number.
				<br>&bull;&nbsp;Therefore, the account balance may not be the total of the Master Payments.
				<br>&bull;&nbsp;Invoice items or invoice payments can affect the advertiser's overall balance and will not be reflected here.
				<br>&bull;&nbsp;If you need to enter a payment for an invoice DON'T DO IT HERE.

			</td>
		</tr>
		<?php 

			if($master_payments == 'N'){
				echo "<tr><td>This advertiser has no Master Payments or adjustments.";
			}else{
					echo "<tr><td>DATE</td><td>TYPE</td><td>CHECK NUMBER</td><td>AMOUNT</td><td>NOTES</td>";
				foreach ($master_payments as $key => $value) {
					echo "<tr>";
						echo "<td>".$value['payment_date']."</td>";
						echo "<td>".$value['payment_type']."</td>";
						echo "<td>".$value['check_number']."</td>";
						echo "<td>$".$value['amount']."</td>";
						echo "<td>".$value['notes']."</td>";
					echo "</tr>";
				}
			}


		 ?>

	<tr>
		<td colspan="5">
			<a href="<?php echo base_url(); ?>admin/main_invoice" title="Main Invoicing">BACK TO MAIN INVOICING</a>
		</td>
	</tr>
	</table>
</div>

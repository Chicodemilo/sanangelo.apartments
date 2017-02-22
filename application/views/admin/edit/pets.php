<div class="hours_box">
		<div class="hours_head">
			PET POLICY <?php echo $apt_name ?>
		</div>
		<form action="<?php echo base_url() ?>admin/submit_pets/<?php echo $apt_id; ?>" method="post">
		<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			<div class="hours_table">
			<table>
				<tr>
					<th>Pet Policy</th>
					<th>Pet Deposit</th>
					<th>Refund</th>
					<th>Restrictions</th>
				</tr>
				<tr>
					<td><select name="type" id="type">
						<option value="No Pets Allowed">No Pets Allowed</option>
						<option value="Pets Allowed">Pets Allowed</option>
						<option value="Pets Allowed - Restrictions Apply">Pets Allowed - Restrictions Apply</option>
						<option value="Pets Allowed - With Fees">Pets Allowed - With Fees</option>
					</select></td>
					<td>
						$ <input type="number" name="pet_deposit" id="pet_deposit" maxlength="5">
					</td>
					<td>
						$ <input type="number" name="pet_deposit_refundable" id="pet_deposit_refundable" maxlength="5">
					</td>
					<td>
						<textarea name="restrictions" id="restrictions" cols="40" rows="4" placeholder="Enter Any Restrictions, Fees, Or Special Requirements" maxlength="300"></textarea>
					</td>
			</table>
			</div>
			<div class="pet_submit">
				<input type="submit"> <span class="smaller"> &#8226; Submiting a new policy will over-write the current one.</span>
			</div>
		</form>
		<div class="hours_table_b_div">
			<table class="hours_table_b">
			
			<?php 
			if(count($pets) >= 1){
				echo "<th colspan='5'>YOUR CURRENT PET POLICY</th>";
				echo "<tr><th>Pet Policy</th><th>Pet Deposit</th><th>Refund</th><th style='width:50%;'>Restrictions</th></tr>";
			}
			foreach ($pets as $key => $value) {
				

				echo "<tr>";
				echo "<td>".$value['type']."</td>";
				echo "<td>$".$value['pet_deposit']."</td>";
				echo "<td>$".$value['pet_deposit_refundable']."</td>";
				echo "<td>".$value['restrictions']."</td>";
				echo "</tr>";
				echo "<tr><td colspan='4'><a href='".base_url()."admin/delete_pets/".$apt_id."/".$value['id']."' id='noblock'>delete pet policy</a></td></tr>";
			}
			?>
			</table>
		</div>

	</div>



	</div>
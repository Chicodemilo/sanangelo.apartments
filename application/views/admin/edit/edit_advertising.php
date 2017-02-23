<div class='message_head'>
	<table>
		<tr>
			<th colspan='7'>ADVERTISING <?php echo $apt_name; ?></th>
		</tr>
		</table>

		<table>
		<tr>
			<th colspan="10">LEVEL</th>
		</tr>
			<form action="<?php echo base_url(); ?>admin/submit_level/<?php echo $apt_id; ?>" method="POST">
			<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				<input type="hidden" name="apt_id" value="<?php echo $apt_id;?>">
				<input type="hidden" name="apt_name" value="<?php echo $apt_name;?>">
				<input type="hidden" name="item" value="premium_level">
				<tr>
					<td class="righter">BASE COST:</td>
					<td>$<input type="number" class="part_of_the_equation" name="base_cost" id="base_cost" value="<?php echo $cost[0]['premium_cost']; ?>" required></td>
					<td class="righter">% DEDUCTION:</td>
					<td><input type="number" class="part_of_the_equation" name="percent_deduction" id="percent_deduction" value="0"></td>
					<td class="righter">AMOUNT DEDUCTION:</td>
					<td>$<input type="number" class="part_of_the_equation" name="amount_deduction" id="amount_deduction" value="0"></td>
					<td class="righter">TOTAL DEDUCTION:</td>
					<td>$<span id="tot_ded_screen">0</span><input type="hidden" name="total_deduction" id="total_deduction" value="0"></td>
					<td class="righter">FINAL COST:</td>
					<td>$<input type="number" step="0.01" name="cost" id="cost" value="<?php echo $cost[0]['premium_cost']; ?>" required></td>
				<tr>
					<td class="righter">
						START DATE:
					</td>
					<td>
						<input type="text" name="start_date" class="date-picker" id="start_date" required>
					</td>
					<td class="righter">
						END DATE:
					</td>
					<td>
						<input type="text" name="end_date" class="date-picker" id="end_date" required>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="10"><input type="submit" value="Enter Level"></td>
				</tr>
			</form>
		</table>

		<table>
			<tr>
				<th colspan="2">TOP 3</th>
			</tr>
			<td></td>
			<td><input type="submit" value="Enter Level"></td>
		</table>

		<table>
			<tr>
				<th colspan="2">SITE TAKEOVER</th>
			</tr>
			<td></td>
			<td><input type="submit" value="Enter Level"></td>
		</table>
</div>
<div id="message_table" style="color:red;">
		
</div>

<?php print_r($cost); 

	echo $cost[0]['premium_cost'];

?>
<script>
	
	var start_picker = new Pikaday({ field: document.getElementById('start_date') });
	var end_picker = new Pikaday({ field: document.getElementById('end_date') });

</script>

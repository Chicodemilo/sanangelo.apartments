<div class="specials_box">
		<div class="hours_head">
			ENTER YOUR CURRENT SPECIAL
		</div>
		<form action="<?php echo base_url() ?>edit/submit_specials" method="post">
		<?php 
			$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
			); 
		?>
		<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			<div class="specials_table">
			<table>
				<tr>
					<th>Title</th>
					<th>Descripton</th>
					<th>Start Date</th>
					<th>End Date</th>
				</tr>

				<tr>
					<td>
						<input type="text" name="title" id="title" maxlength="30">
					</td>
					<td>
						<textarea name="description" id="description" cols="40" rows="4" placeholder="Enter details of this special" maxlength="150"></textarea>
					</td>

					<td>
						<input type="text" name="start" class="date-picker" id="start">
					</td>
					<td>
						<input type="text" name="end" class="date-picker" id="end">
					</td>
			</table>
			<table id="specials_box_lower">
				<tr>
					<th>Condition 1</th>
					<th>Condition 2</th>
					<th>Condition 3</th>
					<th>Custom Condition</th>
				</tr>

				<tr>
					<td>
						<select name="condition_1" id="condition_1">
							<option value="">None</option>
							<option value="*In Select Units">*In Select Units</option>
							<option value="*New Residents Only">*New Residents Only</option>
							<option value="*Year Lease Required">*Year Lease Required</option>
						</select>
					</td>
					<td>
						<select name="condition_2" id="condition_2">
							<option value="">None</option>
							<option value="*In Select Units">*In Select Units</option>
							<option value="*New Residents Only">*New Residents Only</option>
							<option value="*Year Lease Required">*Year Lease Required</option>
						</select>
					</td>
					<td>
						<select name="condition_3" id="condition_2">
							<option value="">None</option>
							<option value="*In Select Units">*In Select Units</option>
							<option value="*New Residents Only">*New Residents Only</option>
							<option value="*Year Lease Required">*Year Lease Required</option>
						</select>
					</td>
					<td colspan="2">
						<textarea name="condition_4" id="condition_4" cols="40" rows="4" placeholder="Enter any custom conditions" maxlength="100"></textarea>
					</td>
				</tr>
			</table>
			</div>
			<div class="specials_submit">
				<input type="submit"> <span class="smaller"> &#8226; Submiting a new special will over-write the current one.</span>
			</div>
		</form>
		<div class="specials_table_b_div">
			<table class="specials_table_b">
			
			<?php 
			if(count($specials) >= 1){
				echo "<th colspan='4'>YOUR CURRENT SPECIAL</th>";
				echo "<tr><th>Title</th><th>Description</th><th>Start Date</th><th>End Date</th></tr>";
			}
			foreach ($specials as $key => $value) {
				$start_date = $value['start']; 
				$phpdate = strtotime( $start_date);
				$start_date = date( 'F, d Y', $phpdate );
				
				$end_date = $value['end']; 
				$phpdate2 = strtotime( $end_date);
				$end_date = date( 'F, d Y', $phpdate2 );
				
				

				echo "<tr>";
				echo "<td>".$value['title']."</td>";
				echo "<td>".$value['description']."</td>";
				echo "<td>".$start_date."</td>";
				echo "<td>".$end_date."</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<th>Condition 1</th><th>Condition 2</th><th>Condition 3</th><th>Condition 4</th>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>".$value['condition_1']."</td>";
				echo "<td>".$value['condition_2']."</td>";
				echo "<td>".$value['condition_3']."</td>";
				echo "<td>".$value['condition_4']."</td>";
				echo "</tr>";
				echo "<tr><td colspan='4'><a href='".base_url()."edit/delete_special/".$value['id']."' id='noblock'>delete special</a></td></tr>";

			}
			?>
			</table>
		</div>

	</div>
<script>
	
	var start_picker = new Pikaday({ field: document.getElementById('start') });
	var end_picker = new Pikaday({ field: document.getElementById('end') });
	
</script>


	</div>
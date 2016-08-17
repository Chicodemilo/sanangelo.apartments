<div class="hours_box">
		<div class="hours_head">
			ENTER THE FLOORPLANS AT YOUR COMMUNITY
		</div>
		<form action="<?php echo base_url() ?>edit/submit_floorplans" method="post">
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
					<th style="width: 100px;">Name</th>
					<th style="width: 50px;">Bedrooms</th>
					<th>Baths</th>
					<th style="width: 120px;">Square Feet</th>
					<th style="width: 120px;">Rent</th>
					<th style="width: 120px;">Deposit</th>
				</tr>
				<tr>
					<td>
						<input type="text" name="name" id="name" maxlength="60" style="width: 200px;" placeholder="Not Required">
					</td>
					<td><select name="bedroom" id="bedroom">
						<option value="">None</option>
						<?php 
							for ($i=1; $i <= 9; $i++) { 
								if($i == 1){
									echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
								}else{
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								
							}
						 ?>
					</select></td>
					<td><select name="bathroom" id="bathroom">
						<option value="">None</option>
						<option value="1" selected="selected">1</option>
						<option value="1.5">1.5</option>
						<option value="2">2</option>
						<option value="2.5">2.5</option>
						<option value="3">3</option>
						<option value="3.5">3.5</option>
						<option value="4">4</option>
						<option value="4.5">4.5</option>
						<option value="5">5</option>
					</select></td>
					<td>
						<input type="number" name="square_footage" id="square_footage" max="9999" placeholder="Numbers Only" required="required" style="width: 100px;">
					</td>
					<td>
						$<input type="number" name="rent" id="rent" max="9999" placeholder="Numbers Only" required="required" style="width: 100px;">
						
					</td>
					<td>
						$<input type="number" name="deposit" id="deposit" max="9999" placeholder="Numbers Only" required="required" style="width: 100px;">
					</td>
				</tr>
			</table>
			<table class="floorplan_table_lower">
				<tr>
					<th>Description</th>
					<th>Available</th>
					<th>Units Currently<br>Available</th>
					
				</tr>
				<tr>
					<td>
						<textarea name="description" id="description" cols="60" rows="4" maxlength="200" placeholder="Write a quick description of this floorplan.  200 characters max."></textarea>
					</td>
					<td>
						<select name="is_available" id="is_available">
							<option value="Y">Yes</option>
							<option value="N">No</option>
						</select>
					</td>
					<td>
						<select name="units_available" id="units_available">
							<?php 
							for ($i=0; $i <= 1000; $i++) { 
								if($i == 1){
									echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
								}else{
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								
							}
						 ?>
						</select>
					</td>
					
				</tr>
		
			</table>
			</div>
			<div class="floorplans_submit">
				<input type="submit">
			</div>
		</form>
		<div class="floorplan_table_b_div">
			<table class="floorplan_table_b">
			
			<?php 
			if(count($floorplans) >= 1){
				echo "<th colspan='6'>YOUR FLOORPLANS</th>";
			}
			foreach ($floorplans as $key => $value) {
				echo "<tr>";
				echo "<td class='bold'>".$value['name']."</td>";
				echo "<td>Bed: ".$value['bedroom']." / Bath:".$value['bathroom']."</td>";
				echo "<td> Sq Ft: ".$value['square_footage']."</td>";
				echo "<td>Rent: $".$value['rent']." / Deposit: $".$value['deposit']."</td>";
				
				echo "<td>Available: ".$value['is_available']." / Units Available: ".$value['units_available']."</td>";
				if($value['floorplan_pic'] == ''){
					echo "<td rowspan='3'><a href='".base_url()."edit/upload_this/".$value['id']."'>Upload Diagram</a></td>";
				}else{
					echo "<td rowspan='3'><img src='".base_url()."images/floorplans/".$this->session->userdata('apt_id')."/".$value['id']."/".$value['floorplan_pic']."' alt='".$value['name']."' width='100px'></td>";
				}
				
				echo "</tr><tr>";
				echo "<td colspan='5'>".$value['description']."</td>";
				echo "</tr><tr>";
				echo "<td colspan='3'><a href='".base_url()."edit/edit_floorplan/".$value['id']."'>Edit</a></td><td colspan='2'><a href='".base_url()."edit/delete_floorplan/".$value['id']."'>Delete</a></td>";
				echo "</tr><tr><th colspan ='6' class='floorplan_table_b_head'></tr>";
			}
			?>
			</table>
		</div>
</div>

<div class="bottom_room">
	&nbsp;
</div>





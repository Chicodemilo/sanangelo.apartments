<div class="hours_box">
		<div class="hours_head">
			ENTER THE EDITS FOR THIS FLOORPLAN
		</div>
		<form action="<?php echo base_url() ?>edit/submit_floorplan_edits/<?php echo $floorplan_info[0]['id']; ?>" method="post">
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
						<input type="hidden" name="id" id="id" value="<?php echo $floorplan_info[0]['id']; ?>">
						<input type="text" name="name" id="name" maxlength="60" style="width: 200px;" placeholder="Not Required" value="<?php echo $floorplan_info[0]['name']; ?>">
					</td>
					<td><select name="bedroom" id="bedroom">
						<option value="">None</option>
						<?php 
							for ($i=1; $i <= 8; $i++) { 
								if($i == 1){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}else{
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								
							}
						 ?>
					</select></td>
					<td><select name="bathroom" id="bathroom">
						<option value="">None</option>
						<option value="1.00" selected="selected">1</option>
						<option value="1.50">1.5</option>
						<option value="2.00">2</option>
						<option value="2.50">2.5</option>
						<option value="3.00">3</option>
						<option value="3.50">3.5</option>
						<option value="4.00">4</option>
						<option value="4.50">4.5</option>
						<option value="5.00">5</option>
					</select></td>
					<td>
						<input type="number" value="<?php echo $floorplan_info[0]['square_footage']; ?>" name="square_footage" id="square_footage" maxlength="5" placeholder="Numbers Only" required="required" style="width: 100px;" >
					</td>
					<td>
						$<input type="number" value="<?php echo $floorplan_info[0]['rent']; ?>" name="rent" id="rent" maxlength="5" placeholder="Numbers Only" required="required" style="width: 100px;">
						
					</td>
					<td>
						$<input type="number" value="<?php echo $floorplan_info[0]['deposit']; ?>" name="deposit" id="deposit" maxlength="5" placeholder="Numbers Only" required="required" style="width: 100px;">
					</td>
				</tr>
			</table>
			<table class="floorplan_table_lower">
				<tr>
					<th>Description</th>
					<th>Available</th>
					<th>Units Currently<br>Available</th>
					<th>Upload A<br>Floorplan Diagram</th>
				</tr>
				<tr>
					<td>
						<textarea name="description" id="description" cols="60" rows="3" maxlength="200" placeholder="Write a quick description of this floorplan.  200 characters max."><?php echo $floorplan_info[0]['description']; ?></textarea>
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
					<td><a href="<?php echo base_url() ?>edit/upload_this/<?php echo $floorplan_info[0]['id'] ?>">Upload Diagram</a></td>
				</tr>
			</table>
			</div>
			<div class="floorplans_submit_uploader">
				<input type="submit" value="Submit Edits">
			</div>
			<?php  
			if($floorplan_info[0]['floorplan_pic'] != ''){
				echo	'<div class="floorplans_pic">
						<img src="'.base_url().'images/floorplans/'.$this->session->userdata('apt_id')."/".$floorplan_info[0]['id'].'/'.$floorplan_info[0]['floorplan_pic'].'" alt="'.$floorplan_info[0]['name'].'" width="500px">
						<br>
						<a href="'.base_url().'edit/upload_this/'.$floorplan_info[0]['id'].'" class="not_fancy" style="font-size: .6em;">Upload Another Diagram</a>
						<br>
						<a href="'.base_url().'edit/delete_this_diagram/'.$floorplan_info[0]['id'].'" class="not_fancy" style="font-size: .6em;">Delete This Diagram</a>
					</div>';
			}
			?>
		</form>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#bedroom option[value="<?php echo $floorplan_info[0]["bedroom"] ?>"]').prop('selected',true);
			$('#bathroom option[value="<?php echo $floorplan_info[0]["bathroom"] ?>"]').prop('selected',true);
			$('#is_available option[value="<?php echo $floorplan_info[0]["is_available"] ?>"]').prop('selected',true);
			$('#units_available option[value="<?php echo $floorplan_info[0]["units_available"] ?>"]').prop('selected',true);
		});
	</script>











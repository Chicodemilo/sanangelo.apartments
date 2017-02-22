<div class="hours_box">
		<div class="hours_head">
			OFFICE HOURS : <?php echo $apt_name; ?>
		</div>
		<form action="<?php echo base_url() ?>admin/submit_hours/<?php echo $apt_id ?>" method="post">
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
					<th style="width: 200px;">Days</th>
					<th>Open Hour</th>
					<th>Open Minute</th>
					<th>Open AM/PM</th>
					<th>Close Hour</th>
					<th>Close Minute</th>
					<th>Close AM/PM</th>
					<th>Condition</th>
				</tr>
				<tr>
					<td><select name="day_type" id="day_type">
						<option value="Monday - Friday">Monday - Friday</option>
						<option value="Monday">Monday</option>
						<option value="Tuesday">Tuesday</option>
						<option value="Wednesday">Wednesday</option>
						<option value="Thursday">Thursday</option>
						<option value="Friday">Friday</option>
						<option value="Saturday">Saturday</option>
						<option value="Sunday">Sunday</option>
						<option value="Monday - Thursday">Monday - Thursday</option>
					</select></td>
					<td><select name="open_hour" id="open_hour">
						<option value="">None</option>
						<?php 
							for ($i=1; $i <= 12; $i++) { 
								if($i == 9){
									echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
								}else{
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								
							}
						 ?>
					</select></td>
					<td><select name="open_min" id="open_min">
						<option value="">None</option>
						<option value="00" selected="selected">00</option>
						<option value="15">15</option>
						<option value="30">30</option>
						<option value="45">45</option>
					</select></td>
					<td><select name="open_am_pm" id="open_am_pm">
						<option value="">None</option>
						<option value="am" selected="selected">am</option>
						<option value="pm">pm</option>
					</select></td>
					<td><select name="close_hour" id="close_hour">
						<option value="">None</option>
						<?php 
							for ($i=1; $i <= 12; $i++) { 
								if($i == 5){
									echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
								}else{
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
								
							}
						 ?>
					</select></td>
					<td><select name="close_min" id="close_min">
						<option value="">None</option>
						<option value="00" selected="selected">00</option>
						<option value="15">15</option>
						<option value="30">30</option>
						<option value="45">45</option>
					</select></td>
					<td><select name="close_am_pm" id="close_am_pm">
						<option value="">None</option>
						<option value="am">am</option>
						<option value="pm" selected="selected">pm</option>
					</select></td>
					<td><select name="day_condition" id="day_condition">
						<option value="">No Conditions</option>
						<option value="Closed">Closed</option>
						<option value="Closed For Lunch">Closed For Lunch</option>
						<option value="By Appointment">By Appointment</option>
					</select></td>
				</tr>
		
			</table>
			</div>
			<div class="hours_submit">
				<input type="submit">
			</div>
		</form>
		<div class="hours_table_b_div">
			<table class="hours_table_b">
			
			<?php 
			if(count($office_hours) >= 1){
				echo "<th colspan='5'>YOUR HOURS</th>";
			}
			foreach ($office_hours as $key => $value) {
				if($value['open_min'] == 0){
					$value['open_min'] = "00";
				}

				if($value['close_min'] == 0){
					$value['close_min'] = "00";
				}

				echo "<tr>";
				echo "<td>".$value['day_type']."</td>";
				echo "<td>".$value['open_hour'].":".$value['open_min']." ".$value['open_am_pm']."</td>";
				echo "<td>".$value['close_hour'].":".$value['close_min']." ".$value['close_am_pm']."</td>";
				echo "<td>".$value['day_condition']."</td>";
				echo "<td><a href='".base_url()."admin/delete_hours/".$apt_id."/".$value['id']."'>delete</a></td>";
				echo "</tr>";
			}
			?>
			</table>
		</div>

	</div>



	</div>
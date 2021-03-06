<div class='message_head'>
	<table>
		<tr>
			<th colspan='7'>ADVERTISING <?php echo $apt_name; ?></th>
		</tr>
		</table>

		<table>
		<tr>
			<th colspan="10">PREMIUM LEVEL</th>
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
			<th colspan="10">TOP 3</th>
		</tr>
			<form action="<?php echo base_url(); ?>admin/submit_top_3/<?php echo $apt_id; ?>" method="POST">
			<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				<input type="hidden" name="apt_id" value="<?php echo $apt_id;?>">
				<input type="hidden" name="apt_name" value="<?php echo $apt_name;?>">
				<input type="hidden" name="item" value="top_3">
				<tr>
					<td class="righter">BASE COST:</td>
					<td>$<input type="number" class="part_of_the_equation_top_3" name="base_cost" id="base_cost_top_3" value="<?php echo $cost[0]['top_three_cost']; ?>" required></td>
					<td class="righter">% DEDUCTION:</td>
					<td><input type="number" class="part_of_the_equation_top_3" name="percent_deduction" id="percent_deduction_top_3" value="0"></td>
					<td class="righter">AMOUNT DEDUCTION:</td>
					<td>$<input type="number" class="part_of_the_equation_top_3" name="amount_deduction" id="amount_deduction_top_3" value="0"></td>
					<td class="righter">TOTAL DEDUCTION:</td>
					<td>$<span id="tot_ded_screen_top_3">0</span><input type="hidden" name="total_deduction" id="total_deduction_top_3" value="0"></td>
					<td class="righter">FINAL COST:</td>
					<td>$<input type="number" step="0.01" name="cost" id="cost_top_3" value="<?php echo $cost[0]['top_three_cost']; ?>" required></td>
				<tr>
					<td class="righter">
						START DATE:
					</td>
					<td>
						<input type="text" name="start_date" class="date-picker" id="start_date_top_3" required>
						<span class="smaller">Defaults To First Day Of Month Picked</span>
					</td>
					<td class="righter">
						END DATE:
					</td>
					<td>
						<span class="smaller">Will Be Last Day Of Month Picked</span>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="10"><input type="submit" value="Enter Top 3"></td>
				</tr>
			</form>
		</table>

		<table>
		<tr>
			<th colspan="10">SITE TAKEOVER</th>
		</tr>
			<form action="<?php echo base_url(); ?>admin/submit_sto/<?php echo $apt_id; ?>" method="POST">
			<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				<input type="hidden" name="apt_id" value="<?php echo $apt_id;?>">
				<input type="hidden" name="apt_name" value="<?php echo $apt_name;?>">
				<input type="hidden" name="item" value="site_takeover">
				<tr>
					<td class="righter">BASE COST:</td>
					<td>$<input type="number" class="part_of_the_equation_sto" name="base_cost" id="base_cost_sto" value="<?php echo $cost[0]['site_takeover_cost']; ?>" required></td>
					<td class="righter">% DEDUCTION:</td>
					<td><input type="number" class="part_of_the_equation_sto" name="percent_deduction" id="percent_deduction_sto" value="0"></td>
					<td class="righter">AMOUNT DEDUCTION:</td>
					<td>$<input type="number" class="part_of_the_equation_sto" name="amount_deduction" id="amount_deduction_sto" value="0"></td>
					<td class="righter">TOTAL DEDUCTION:</td>
					<td>$<span id="tot_ded_screen_sto">0</span><input type="hidden" name="total_deduction" id="total_deduction_sto" value="0"></td>
					<td class="righter">FINAL COST:</td>
					<td>$<input type="number" step="0.01" name="cost" id="cost_sto" value="<?php echo $cost[0]['site_takeover_cost']; ?>" required></td>
				<tr>
					<td class="righter">
						START DATE:
					</td>
					<td>
						<input type="text" name="start_date" class="date-picker" id="start_date_sto" required>
					</td>
					<td class="righter">
						END DATE:
					</td>
					<td>
						<span class="smaller">Site Takeovers Are One Day Long</span>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="10"><input type="submit" value="Enter Site Takeover"></td>
				</tr>
			</form>
		</table>

		<?php 
		 if(count($upcoming_sales) > 0){
		 	echo "<table>";
		 	echo "<tr><th colspan='9'>".$apt_name." ALL ADVERTISEMENTS</th></tr>";
		 	echo "<tr><th>ITEM</th>";
		 	echo "<th>START<br>DATE</th>";
		 	echo "<th>END<br>DATE</th>";
		 	echo "<th>BASE<br>COST</th>";
		 	echo "<th>PERCENT<br>DEDUCTION</th>";
		 	echo "<th>AMOUNT<br>DEDUCTION</th>";
		 	echo "<th>TOTAL<br>DEDUCTION</th>";
		 	echo "<th>COST</th>";
		 	echo "<th></th>";
		 	echo "<tr>";
		 	foreach ($upcoming_sales as $key => $value) {
		 		echo "<tr>";
		 		echo "<td>".$value['item']."</td>";
		 		echo "<td>".$value['start_date']."</td>";
		 		echo "<td>".$value['end_date']."</td>";
		 		echo "<td>$".$value['base_cost']."</td>";
		 		echo "<td>".$value['percent_deduction']."%</td>";
		 		echo "<td>$".$value['amount_deduction']."</td>";
		 		echo "<td>$".$value['total_deduction']."</td>";
		 		echo "<td>$".$value['cost']."</td>";
		 		echo "<td><a href='".base_url()."admin/delete_this_advertising/".$value['ID']."/".$value['apt_id']."'>DELETE</a></td>";
		 		echo "</tr>";
		 	}
		 	echo "</table>";
		 }

		echo '<span class="bold_red">';
		if($feedback != ""){
			echo $feedback;
		}
		echo	'</span>';


		if($banner_names == 'N'){
		}else{
			
			echo "<table><tr>";

				echo "<td>";
					if($banner_names['left_takeover_name'] != ''){
						echo $banner_names['left_takeover_name']."<br><br>";
						echo "<img src='".base_url()."images/takeover/left/".$banner_names['left_takeover_name']."'>";
						echo "<a href=".base_url()."admin/left_banner_upload/".$banner_names['apt_id'].">Upload Left Banner</a>";
					}else{
						echo "<span class='bold_red smaller'>No Left Banner Uploaded</span><br>";
						echo "<a href=".base_url()."admin/left_banner_upload/".$banner_names['apt_id'].">Upload Left Banner</a>";
					}
				echo "</td>";

				echo "<td>";
					if($banner_names['right_takeover_name'] != ''){
						echo $banner_names['right_takeover_name']."<br><br>";
						echo "<img src='".base_url()."images/takeover/right/".$banner_names['right_takeover_name']."'>";
						echo "<a href=".base_url()."admin/right_banner_upload/".$banner_names['apt_id'].">Upload Right Banner</a>";
					}else{
						echo "<span class='bold_red smaller'>No Right Banner Uploaded</span><br>";
						echo "<a href=".base_url()."admin/right_banner_upload/".$banner_names['apt_id'].">Upload Right Banner</a>";
					}
				echo "</td>";

				echo "<td>";
					if($banner_names['top_takeover_name'] != ''){
						echo $banner_names['top_takeover_name']."<br><br>";
						echo "<img src='".base_url()."images/takeover/top/".$banner_names['top_takeover_name']."'>";
						echo "<a href=".base_url()."admin/top_banner_upload/".$banner_names['apt_id'].">Upload Top Banner</a>";
					}else{
						echo "<span class='bold_red smaller'>No Top Banner Uploaded</span><br>";
						echo "<a href=".base_url()."admin/top_banner_upload/".$banner_names['apt_id'].">Upload Top Banner</a>";
					}
				echo "</td>";

				echo "<td>";
					if($banner_names['mobile_takeover_name'] != ''){
						echo $banner_names['mobile_takeover_name']."<br><br>";
						echo "<img src='".base_url()."images/takeover/mobile/".$banner_names['mobile_takeover_name']."'>";
						echo "<a href=".base_url()."admin/mobile_banner_upload/".$banner_names['apt_id'].">Upload Mobile Banner</a>";
					}else{
						echo "<span class='bold_red smaller'>No Mobile Banner Uploaded</span><br>";
						echo "<a href=".base_url()."admin/mobile_banner_upload/".$banner_names['apt_id'].">Upload Mobile Banner</a>";
					}
				echo "</td>";

			echo "</tr></table>";
		}


		 if(count($taken_sales[site_takeovers]) > 0){
		 	echo "<div class='taken_date'>";
		 	echo "<h4>TAKEN SITE TAKEOVERS</h4>";
		 	echo "<ul>";
		 	foreach ($taken_sales[site_takeovers] as $key => $value) {
		 		echo "<li>".$value['start_date']." : ".$value['apt_name'];
		 	}
		 	echo "</ul>";
		 	echo "</div>";
		 	echo "<br>";
		 }
		
		 if(count($taken_sales[top_3]) > 0){
		 	$x = 1;
		 	echo "<div class='taken_date'>";
		 	echo "<h4>TAKEN TOP 3</h4>";
		 	
		 	foreach ($taken_sales[top_3] as $key => $value) {
		 		 
		 		 echo "<ul>";
		 		 echo "Start Date: ".$value[0]['start_date'];

		 		 if(count($taken_sales[top_3][$x]) >= 3){
		 		 	echo "<span class='bold_red'> FULL</span>";
		 		 }

		 		 echo "<br>";
		 		 // print_r($taken_sales[top_3][$x]);

		 		 foreach ($taken_sales[top_3][$x] as $key => $value) {
		 		 		echo "<li>".$value['apt_name'];
		 		 }
		 		 echo "</ul>";
		 		 $x = $x + 1;
		 	}
		 	
		 	echo "</div>";
		 }

		?>
</div>
<?php 
	// print_r($taken_sales[top_3]);
 ?>
<div id="message_table" style="color:red;">
		
</div>


<script>
	
	var start_picker = new Pikaday({ field: document.getElementById('start_date') });
	var end_picker = new Pikaday({ field: document.getElementById('end_date') });
	var start_picker_top_3 = new Pikaday({ field: document.getElementById('start_date_top_3') });
	var end_picker_top_3 = new Pikaday({ field: document.getElementById('end_date_top_3') });
	var start_picker_sto = new Pikaday({ field: document.getElementById('start_date_sto') });
	var end_picker_sto = new Pikaday({ field: document.getElementById('end_date_sto') });

</script>

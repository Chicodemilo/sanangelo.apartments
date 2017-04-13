<div>
	<table class="inv_table">
		<tr>
			<th colspan='7'>YOUR SITE ADS</th>
		</tr>
		<tr>
			<th style=" text-align: left;">ITEM</th>
			<th style=" text-align: left;">START DATE</th>
			<th style=" text-align: left;">END DATE</th>
			<th style=" text-align: left;">ADJUSTMENTS</th>
			<th style=" text-align: left;">COST</th>
		</tr>

			<?php 
				foreach ($their_ads as $key => $value) {
					
					echo "<tr>
						<td>".$value['item']."</td>
						<td>".$value['start_date']."</td>
						<td>".$value['end_date']."</td>
						";

						if($value['total_deduction'] > 0){
							echo "<td>Deduction: $".$value['total_deduction']."</td>";
						}else{
							echo "<td></td>";
						}
						echo "<td>$".$value['cost']."</td></tr>";
					}
			 ?>
		</table>
</div>
<?php 
		if($banner_names == 'N'){
		}else{
			
			echo "<table id='banner_table'>";

				echo "<tr><td>";
					if($banner_names['left_takeover_name'] != ''){
						echo $banner_names['left_takeover_name']."<br><br>";
						echo "<img src='".base_url()."images/takeover/left/".$banner_names['left_takeover_name']."'>";
						echo "<a href=".base_url()."edit/left_banner_upload/".$banner_names['apt_id'].">Upload Left Banner</a>";
						echo "Left banner size is 170px wide by 700px tall.<br><br> File types .jpg .gif and .png accepted.";
					}else{
						echo "<span class='bold_red smaller'>No Left Banner Uploaded</span><br>";
						echo "<a href=".base_url()."edit/left_banner_upload/".$banner_names['apt_id'].">Upload Left Banner</a>";
						echo "Left banner size is 170px wide by 700px tall.<br><br> File types .jpg .gif and .png accepted.";
					}
				echo "</td></tr><tr><td class='inv_bg_c'></td></tr>";

				echo "<tr><td>";
					if($banner_names['right_takeover_name'] != ''){
						echo $banner_names['right_takeover_name']."<br><br>";
						echo "<img src='".base_url()."images/takeover/right/".$banner_names['right_takeover_name']."'>";
						echo "<a href=".base_url()."edit/right_banner_upload/".$banner_names['apt_id'].">Upload Right Banner</a>";
						echo "Right banner size is 170px wide by 700px tall.<br><br> File types .jpg .gif and .png accepted.";
					}else{
						echo "<span class='bold_red smaller'>No Right Banner Uploaded</span><br>";
						echo "<a href=".base_url()."edit/right_banner_upload/".$banner_names['apt_id'].">Upload Right Banner</a>";
						echo "Right banner size is 170px wide by 700px tall.<br><br> File types .jpg .gif and .png accepted.";
					}
				echo "</td></tr><tr><td class='inv_bg_c'></td></tr>";

				echo "<tr><td>";
					if($banner_names['top_takeover_name'] != ''){
						echo $banner_names['top_takeover_name']."<br><br>";
						echo "<img src='".base_url()."images/takeover/top/".$banner_names['top_takeover_name']."'>";
						echo "<a href=".base_url()."edit/top_banner_upload/".$banner_names['apt_id'].">Upload Top Banner</a>";
						echo "Top banner size is 870px wide by 80px tall.<br><br> File types .jpg .gif and .png accepted.";
					}else{
						echo "<span class='bold_red smaller'>No Top Banner Uploaded</span><br>";
						echo "<a href=".base_url()."edit/top_banner_upload/".$banner_names['apt_id'].">Upload Top Banner</a>";
						echo "Top banner size is 870px wide by 80px tall.<br><br> File types .jpg .gif and .png accepted.";
					}
				echo "</td></tr><tr><td class='inv_bg_c'></td></tr>";

				echo "<tr><td>";
					if($banner_names['mobile_takeover_name'] != ''){
						echo $banner_names['mobile_takeover_name']."<br><br>";
						echo "<img src='".base_url()."images/takeover/mobile/".$banner_names['mobile_takeover_name']."'>";
						echo "<a href=".base_url()."edit/mobile_banner_upload/".$banner_names['apt_id'].">Upload Mobile Banner</a>";
						echo "Mobile banner size is 400px wide by 175px tall.<br><br> File types .jpg .gif and .png accepted.";
					}else{
						echo "<span class='bold_red smaller'>No Mobile Banner Uploaded</span><br>";
						echo "<a href=".base_url()."edit/mobile_banner_upload/".$banner_names['apt_id'].">Upload Mobile Banner</a>";
						echo "Mobile banner size is 400px wide by 175px tall.<br><br> File types .jpg .gif and .png accepted.";
					}
				echo "</td></tr>";

			echo "</tr></table>";
		}


 ?>


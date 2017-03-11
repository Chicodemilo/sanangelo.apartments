<div class="wrapper">
	 <table class="ad_table">
	 	<tr>
	 		<th>AD ID</th>
	 		<th>APT ID</th>
	 		<th>APT NAME
				<a class="not_fancy_dark bold" href="<?php echo base_url(); ?>admin/see_all_ads/adv_asc">&#x25B2;</a>
				<a class="not_fancy_dark" href="<?php echo base_url(); ?>admin/see_all_ads/adv_desc">&#x25BC;</a>

	 		</th>
	 		<th>ITEM
				<a class="not_fancy_dark bold" href="<?php echo base_url(); ?>admin/see_all_ads/type_asc">&#x25B2;</a>
				<a class="not_fancy_dark" href="<?php echo base_url(); ?>admin/see_all_ads/type_desc">&#x25BC;</a>
	 		</th>
	 		<th>START<br>DATE
				<a class="not_fancy_dark bold" href="<?php echo base_url(); ?>admin/see_all_ads/date_asc">&#x25B2;</a>
				<a class="not_fancy_dark" href="<?php echo base_url(); ?>admin/see_all_ads/">&#x25BC;</a>
	 		</th>
	 		<th>END<br>DATE
				<a class="not_fancy_dark bold" href="<?php echo base_url(); ?>admin/see_all_ads/date_end_asc">&#x25B2;</a>
				<a class="not_fancy_dark" href="<?php echo base_url(); ?>admin/see_all_ads/date_end_desc">&#x25BC;</a>
			</th>
	 		<th>PERCENT<br>DEDUCTION</th>
	 		<th>AMOUNT<br>DEDUCTION</th>
	 		<th>TOTAL<br>DEDUCTION</th>
	 		<th>BASE<BR>COST</th>
	 		<th>COST
				<a class="not_fancy_dark bold" href="<?php echo base_url(); ?>admin/see_all_ads/cost_asc">&#x25B2;</a>
				<a class="not_fancy_dark" href="<?php echo base_url(); ?>admin/see_all_ads/cost_desc">&#x25BC;</a>
	 		</th>
	 		<th>DELETE</th>
	 	</tr>
	 <?php 
	 	foreach ($all_ads as $key => $value) {
	 		echo "<tr>";
	 			echo "<td>";
	 				echo $value['ID'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value['apt_id'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value['apt_name'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value['item'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value['start_date'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value['end_date'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo $value['percent_deduction']."%";
	 			echo "</td>";
	 			echo "<td>";
	 				echo "$".$value['amount_deduction'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo "$".$value['total_deduction'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo "$".$value['base_cost'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo "$".$value['cost'];
	 			echo "</td>";
	 			echo "<td>";
	 				echo "<a href='".base_url()."admin/delete_this_advertising_all_ads/".$value['ID']."/".$order."'>DELETE</a>";
	 			echo "</td>";
	 		echo "</tr>";
	 	}
	  ?>
	 </table>
 </div>
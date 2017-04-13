<div class="wrapper">
	<table>
		<tr>
			<th>CUSTOM ITEMS</th>
		</tr>
	</table>
	<table class="inv_table">
		<tr>
			<th colspan="15">ITEMS FOR <?php echo $custom_items[0]['apt_name'] ?></th>
		</tr>
		<tr>
			<th>ITEM</th>
			<th>DATE</th>
			<th>COST</th>
			<th>DELETE</th>
		</tr>
		<?php 
			
			$row_flipper = 'A';
			foreach ($custom_items as $key => $value) {

						echo "<tr>";

							echo "<td class='inv_bg_".$row_flipper."'>";
								echo $value['item'];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Date: ".$value['start_date'];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "Item Cost: $".$value['cost'];
							echo "</td>";
							echo "<td class='inv_bg_".$row_flipper."'>";
								echo "<a href='".base_url()."admin/custom_item_delete/".$value['ID']."/".$value['apt_id']."'>DELETE</a>";
							echo "</td>";
						echo "</tr>";

						echo "<tr><td class='inv_bg_c' colspan='17'></td></tr>";

				if($row_flipper == 'A'){
					$row_flipper = 'B';
				}else{
					$row_flipper = 'A';
				}
			}
		 ?>
	</table>










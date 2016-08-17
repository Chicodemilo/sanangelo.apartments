				<?php 
					$table_class = 1;
					foreach ($all_apartments as $key => $value) {
						
						echo "<tr><td>";
						echo "<section>";
							echo "<table id='inner_table' class='inner_table_".$table_class."'>";
								echo "<tr>";
								echo "<td rowspan='2' id='table_pic_box'>";
								echo "<img src='".base_url()."images/pictures/".$value['apt_id']."/".$value['pic_id']."/".$value['pic_name']."'>";
								echo "</td>";
								echo "<td class='table_name'>";
								echo $value['property_name'];
								echo "</td>";
								echo "<tr>";
								echo "<td class='table_little'>";
								if($value['level'] != 'free'){
									echo $value['property_phone']." &bull; ";
								}
								echo $value['property_address'].", ".$value['property_city'];
								echo "</td>";
								echo "</tr>";
							echo "</table>";
						echo "</section>";
						echo "</td></tr>";
						

						if($table_class == 1){
							$table_class = 2;
						}elseif($table_class == 2){
							$table_class = 1;
						}
					}


				 ?>
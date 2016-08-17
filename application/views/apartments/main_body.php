<div class="body_wrapper">
	<div class="left_col">
		<div id="market_table">
			<table class="left_tab" id="fixed_head">
				<th colspan="2">MARKET DATA</th>
			</table>
			<table class="left_tab" id="market_results">
				<tr>
					<td>Ave 1br Rent:</td>
					<td>$<?php echo $market_data['ave_one_bed_rent'];?></td>
				</tr>
				<tr>
					<td>Ave 2br Rent:</td>
					<td>$<?php echo $market_data['ave_two_bed_rent'];?></td>
				</tr>
				<tr>
					<td>Ave Rent Per Sq Ft:</td>
					<td>$<?php echo $market_data['ave_sq_ft'];?></td>
				</tr>
			</table>
		</div>
		<div class="open_table">
			<table class="left_tab" id="fixed_head">
				<th colspan="2">OPEN APARTMENTS</th>
			</table>
			<table class="left_tab" id="open_results">
				<?php 
					if(isset($open_takeover_apt)){
						echo "<tr><td colspan='2'><div class='left_link_box'>";
						echo "<a href='".base_url()."main/apartment/".$open_takeover_apt['takeover_apt']['property_search_name']."/".$open_takeover_apt['takeover_apt']['apt_id']."'>";
						echo "<span class='open_bold'>".$open_takeover_apt['takeover_apt']['property_name']."</span>";
						foreach ($open_takeover_apt['takeover_apt']['open_apts'] as $key => $value) {
							foreach ($value as $key_b => $value_b) {
								if($key_b == 'bedroom'){
									echo $value_b."bd";
								}
								if($key_b == 'bathroom'){
									if($value_b == 1.00){$ba = 1;}
									if($value_b == 1.50){$ba = 1.5;}
									if($value_b == 2.00){$ba = 2;}
									if($value_b == 2.50){$ba = 2.5;}
									if($value_b == 3.00){$ba = 3;}
									if($value_b == 3.50){$ba = 3.5;}
									if($value_b == 4.00){$ba = 4;}
									if($value_b == 4.50){$ba = 4.5;}
									if($value_b == 5.00){$ba = 5;}
									echo "/".$ba."ba";
								}
								if($key_b == 'square_footage'){
									echo " &bull; ".$value_b." SqFt &bull; ";
								}
								if($key_b == 'rent'){
									echo "$".$value_b."<br>";
								}
							}
						}
						echo "</a>";
						echo "</div></td></tr>";
					}

					if($open_basic_apt != false){
						foreach ($open_basic_apt as $key => $value) {

							echo "<tr><td colspan='2'><div class='left_link_box'>";
							echo "<a href='".base_url()."main/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
							echo "<span class='open_bold'>".$value['property_name']."</span>";
							foreach ($value['open_apts'] as $key => $value) {
								foreach ($value as $key_b => $value_b) {
									if($key_b == 'bedroom'){
										echo $value_b."bd";
									}
									if($key_b == 'bathroom'){
										if($value_b == 1.00){$ba = 1;}
										if($value_b == 1.50){$ba = 1.5;}
										if($value_b == 2.00){$ba = 2;}
										if($value_b == 2.50){$ba = 2.5;}
										if($value_b == 3.00){$ba = 3;}
										if($value_b == 3.50){$ba = 3.5;}
										if($value_b == 4.00){$ba = 4;}
										if($value_b == 4.50){$ba = 4.5;}
										if($value_b == 5.00){$ba = 5;}
										echo "/".$ba."ba";
									}
									if($key_b == 'square_footage'){
										echo " &bull; ".$value_b." SqFt &bull; ";
									}
									if($key_b == 'rent'){
										echo "$".$value_b."<br>";
									}
								}
							}
							echo "</a>";
							echo "</div></td></tr>";
						}
					}

					if(isset($open_free_apt)){
						foreach ($open_free_apt as $key => $value) {

							echo "<tr><td colspan='2'><div class='left_link_box'>";
							echo "<a href='".base_url()."main/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
							echo "<span class='open_bold'>".$value['property_name']."</span>";
							foreach ($value['open_apts'] as $key => $value) {
								foreach ($value as $key_b => $value_b) {
									if($key_b == 'bedroom'){
										echo $value_b."bd";
									}
									if($key_b == 'bathroom'){
										if($value_b == 1.00){$ba = 1;}
										if($value_b == 1.50){$ba = 1.5;}
										if($value_b == 2.00){$ba = 2;}
										if($value_b == 2.50){$ba = 2.5;}
										if($value_b == 3.00){$ba = 3;}
										if($value_b == 3.50){$ba = 3.5;}
										if($value_b == 4.00){$ba = 4;}
										if($value_b == 4.50){$ba = 4.5;}
										if($value_b == 5.00){$ba = 5;}
										echo "/".$ba."ba";
									}
									if($key_b == 'square_footage'){
										echo " &bull; ".$value_b." SqFt &bull; ";
									}
									if($key_b == 'rent'){
										echo "$".$value_b."<br>";
									}
								}
							}
							echo "</a>";
							echo "</div></td></tr>";
								
						}
						
					}


				 ?>
			</table>
		</div>
		<div class="special_table">
			<table class="left_tab" id="fixed_head">
				<th colspan="2">CURRENT SPECIALS</th>
			</table>
			<table class="left_tab" id="special_results">
				<?php 
				if($special_takeover != false){
					echo "<tr><td colspan='2'><div class='left_link_box'>";
					echo "<a href='".base_url()."main/apartment/".$special_takeover['takeover_special']['property_search_name']."/".$special_takeover['takeover_special']['apt_id']."'>";
					echo "<span class='open_bold'>".$special_takeover['takeover_special']['property_name']."</span>";
					foreach ($special_takeover['takeover_special']['special'] as $key => $value) {
						echo $value['title'];
					}
					echo "</a>";
					echo "</div></td></tr>";
				}

				if($special_basic != false){
						foreach ($special_basic as $key => $value) {

							echo "<tr><td colspan='2'><div class='left_link_box'>";
							echo "<a href='".base_url()."main/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
							echo "<span class='open_bold'>".$value['property_name']."</span>";
							foreach ($value['special'] as $key => $value) {
								foreach ($value as $key_b => $value_b) {
									if($key_b == 'title'){
										echo $value_b;
									}
								}
							}
							echo "</a>";
							echo "</div></td></tr>";
								
						}
						
					}

				if($special_free != false){
						foreach ($special_free as $key => $value) {

							echo "<tr><td colspan='2'><div class='left_link_box'>";
							echo "<a href='".base_url()."main/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
							echo "<span class='open_bold'>".$value['property_name']."</span>";
							foreach ($value['special'] as $key => $value) {
								foreach ($value as $key_b => $value_b) {
									if($key_b == 'title'){
										echo $value_b;
									}
								}
							}
							echo "</a>";
							echo "</div></td></tr>";
								
						}
						
					}

				 ?>
			</table>
		</div>
	</div>
	<div class="search_results_box">
		<a href='#'>
			<div class="pic_box" style="
				background-image:url('images/pictures/<?php echo $all_apartments[0]['apt_id']?>/<?php echo $all_apartments[0]['pic_id']?>/<?php echo $all_apartments[0]['pic_name']?>');
				background-repeat: no-repeat;
				background-size: cover;
			">
				<span id="pic_box_name"><?php echo $all_apartments[0]['property_name'] ?></span>
			</div>
		</a>
		<div class="search_param_box">
					SEARCH PARAMATERS:<br>BD: any &bull; BA: any &bull; RENT: any to $1200 &bull; AMENITIES: any
		</div>
		<div class="panel_container">
            <?php 
					$table_class = 1;
					foreach ($all_apartments as $key => $value) {

						echo "<section>";
							echo "<a href='".base_url()."main/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
								echo "<table id='inner_table_".$value['apt_id']."' class='inner_table_".$table_class."'>";
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
							echo "</a>";
						echo "</section>";
						echo "<script>";
						echo "jQuery(document).ready(function($) {";
						echo "$('#inner_table_".$value['apt_id']."').mouseenter(function(){";
						echo "link_enter(".$value['apt_id'].", '".$value['property_name']."', '".$value['pic_id']."', '".$value['pic_name']."');";
						echo "});";
						echo "$('#inner_table_".$value['apt_id']."').mouseleave(function(){";
						echo "link_leave(".$value['apt_id'].", '".$value['property_name']."', '".$value['pic_id']."', '".$value['pic_name']."');";
						echo "});";
						echo "});";
						echo "</script>";

					}


				 ?>
			
            <section data-panel="third" class=""></section>
            <section data-panel="third" class=""></section>
            <section data-panel="third" class=""></section>
            <section data-panel="third" class=""></section>
        </div>
        <div class="under_table">
        	
        </div>
		
	</div>
</div>
<br>
<a href="<?php echo base_url(); ?>login/login_user">login</a>
<br>
<a href="<?php echo base_url(); ?>login/register">register</a>
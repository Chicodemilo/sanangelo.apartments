
<div class="inner_main_bg">

	<div class="left_takeover_banner">
		<?php 

			if($background_data != 'N'){
				if($background_data['takeover_link'] != 'N'){
					echo '<a target="blank" rel="nofollow" href="http://'.$background_data['takeover_link'].'">';
				}

				if($background_data['takeover_left'] != ''){
					echo '<img src="'.base_url().'images/takeover/left/'.$background_data['takeover_left'].'">';
				}

				if($background_data['takeover_link'] != 'N'){
					echo '</a>';
				}

				}
		?>
	</div>
	<div class="right_takeover_banner">
		<?php 
			if($background_data != 'N'){
				if($background_data['takeover_link'] != 'N'){
					echo '<a target="blank" rel="nofollow" href="http://'.$background_data['takeover_link'].'">';
				}

				if($background_data['takeover_left'] != ''){
					echo '<img src="'.base_url().'images/takeover/right/'.$background_data['takeover_right'].'">';
				}

				if($background_data['takeover_link'] != 'N'){
					echo '</a>';
				}
			}
		?>
	</div>
	<div class="takeover_top_banner">
		<?php 
			if($background_data != 'N'){
				if($background_data['takeover_link'] != 'N'){
					echo '<a target="blank" rel="nofollow" href="http://'.$background_data['takeover_link'].'">';
				}

				if($background_data['takeover_top'] != ''){
					echo '<img src="'.base_url().'images/takeover/top/'.$background_data['takeover_top'].'">';
				}

				if($background_data['takeover_link'] != 'N'){
					echo '</a>';
				}
			}
		?>
	</div>
	<div class="takeover_banner_mobile">
		<?php 
			if($background_data != 'N'){
				if($background_data['takeover_link'] != 'N'){
					echo '<a target="blank" rel="nofollow" href="http://'.$background_data['takeover_link'].'">';
				}

				if($background_data['takeover_mobile'] != ''){
					echo '<img src="'.base_url().'images/takeover/mobile/'.$background_data['takeover_mobile'].'">';
				}

				if($background_data['takeover_link'] != 'N'){
					echo '</a>';
				}
			}
		?>
	</div>

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
						if($open_takeover_apt != false){
							echo "<tr><td colspan='2'><div class='left_link_box'>";
							echo "<a href='".base_url()."texas/apartment/".$open_takeover_apt['takeover_apt']['property_search_name']."/".$open_takeover_apt['takeover_apt']['apt_id']."'>";
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

								if(count($value) > 1){
									echo "<tr><td colspan='2'><div class='left_link_box'>";
									echo "<a href='".base_url()."texas/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
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
						}

						if(isset($open_free_apt)){
							foreach ($open_free_apt as $key => $value) {
								if(count($value) > 1){
									echo "<tr><td colspan='2'><div class='left_link_box'>";
									echo "<a href='".base_url()."texas/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
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
						echo "<a href='".base_url()."texas/apartment/".$special_takeover['takeover_special']['property_search_name']."/".$special_takeover['takeover_special']['apt_id']."'>";
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
								echo "<a href='".base_url()."texas/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
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
								echo "<a href='".base_url()."texas/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
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
				<div class="pic_box" style="
					background-image:url('<?php echo base_url(); ?>images/pictures/<?php echo $all_apartments[0]['apt_id']?>/<?php echo $all_apartments[0]['pic_id']?>/<?php echo $all_apartments[0]['pic_name']?>');
					background-repeat: no-repeat;
					background-size: cover;
				">
					<span id="pic_box_name"><?php echo $all_apartments[0]['property_name']; ?></span><br><hr>
					<span id="pic_box_slogan"><?php if($all_apartments[0]['property_slogan'] != ''){echo $all_apartments[0]['property_slogan']."<br>";} ?></span>
				</div>
			<div class="search_param_box">
						<h1 class="search_param_bold">SAN ANGELO APARTMENTS SEARCH RESULTS:</h1><br>APARTMENTS FOUND: <?php echo $apt_count; ?><br>
						BD:
						<?php 
							if(!isset($bedroom)){
								echo "ANY";
							}else{
								if($bedroom == 0){
									echo "ANY";
								}elseif($bedroom == 3){
									echo "3+";
								}else{
									echo $bedroom;
								}
							}
						 ?> 
						 &nbsp;&nbsp;&nbsp;BA:
						<?php 
							if(!isset($bathroom)){
								echo "ANY";
							}else{
								if($bathroom == 0){
									echo "ANY";
								}else{
									echo $bathroom."+";
								}
							}
						 ?> 
						 &nbsp;&nbsp;&nbsp; RENT:
						<?php 
							if(!isset($min_rent)){
								echo "ANY";
							}else{
								if($min_rent == 0){
									echo "ANY";
								}else{
									echo "$".$min_rent;
								}
							}
						 ?> 
						 to
						<?php 
							if(!isset($max_rent)){
								echo "ANY";
							}else{
								if($max_rent == 0 || $max_rent == 100000){
									echo "ANY";
								}else{
									echo "$".$max_rent;
								}
							}
						 ?> 

						<br>
						AMENITIES:
						<?php 
							if(isset($pets) || isset($pool) || isset($gated) || isset($fitness) || isset($wd) || isset($clubhouse) || isset($furnished) || isset($seniors) || isset($covered) || isset($laundry))
							{
								if(isset($pets)){echo "&bull;".$pets." ";}
								if(isset($pool)){echo "&bull;".$pool." ";}
								if(isset($gated)){echo "&bull;".$gated." ";}
								if(isset($fitness)){echo "&bull;".$fitness." ";}
								if(isset($wd)){echo "&bull;".$wd." ";}
								if(isset($clubhouse)){echo "&bull;".$clubhouse." ";}
								if(isset($furnished)){echo "&bull;".$furnished." ";}
								if(isset($seniors)){echo "&bull;".$seniors." ";}
								if(isset($covered)){echo "&bull;".$covered." ";}
								if(isset($laundry)){echo "&bull;".$laundry." ";}
							}else{
								echo "ANY";
							}
						 ?>
			</div>
			<div class="panel_container">
	            <?php 
	            		
						$table_class = 1;
						foreach ($all_apartments as $key => $value) {
							if($value['property_name'] == ''){$value['property_name'] = '&nbsp;';}
							if($value['property_slogan'] == ''){$value['property_slogan'] = '&nbsp;';}
							$value['slogan'] = $value['property_slogan'];
							echo "<section>";
								echo "<a href='".base_url()."texas/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
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
										echo $value['property_address'].", ".$value['property_city'];
										echo "</td>";
										echo "</tr>";
									echo "</table>";
								echo "</a>";
							echo "</section>";
							echo "<script>";
							echo "jQuery(document).ready(function($) {";
							echo "$('#inner_table_".$value['apt_id']."').mouseenter(function(){";
							echo "link_enter(".$value['apt_id'].", '".$value['property_name']."', '".$value['pic_id']."', '".$value['pic_name']."', '".base_url()."', '".$value['slogan']."', '".$value['property_address']."', '".$value['property_city']."', '".$value['property_phone']."' );";
							echo "});";
							echo "$('#inner_table_".$value['apt_id']."').mouseleave(function(){";
							echo "link_leave(".$value['apt_id'].", '".$value['property_name']."', '".$value['pic_id']."', '".$value['pic_name']."');";
							echo "});";
							echo "});";
							echo "</script>";
						}
					 ?>
	            <section data-panel="third" class="under_fakies"></section>
	            <section data-panel="third" class="under_fakies"></section>
	            <section data-panel="third" class="under_fakies"></section>
	            <section data-panel="third" class="under_fakies"></section>
	        </div>
	        <div class="under_table">
	        </div>

		</div>

	</div>

</div>
<div class="footer">
	<div class="footer_bold">To Advertise On SANANGELO.APARTMENTS<br>call: 866-866-4727 or <a target="_blank" href="mailto:miles@bayrummedia.com?Subject=SANANGELO.APARTMENTS%20Contact">EMAIL</a></div>
	<a href="<?php echo base_url(); ?>login/login_user">Advertiser Login</a>
	&nbsp;&bull;&nbsp;
	<a href="<?php echo base_url(); ?>login/register">Register A New Account</a>
	<div class='footer_right'>
		this website made by <a href='http://www.mileschick.com' alt='Miles Chick Web Developer Austin Texas' target="blank">Miles Chick, Web Developer, Austin Texas<a>
	</div>
</div>

<script>
	jQuery(document).ready(function($) {
		var bedroom_get = <?php if(isset($bedroom)){echo $bedroom;}else{ echo 0;} ?>;
		$('#bedroom').val(bedroom_get);
		var bathroom_get = <?php if(isset($bathroom)){echo $bathroom;}else{ echo 0;} ?>;
		$('#bathroom').val(bathroom_get);
		var min_rent_get = <?php if(isset($min_rent)){echo $min_rent;}else{ echo 0;} ?>;
		$('#min-rent').val(min_rent_get);
		var max_rent_get = <?php if(isset($max_rent)){echo $max_rent;}else{ echo 100000;} ?>;
		$('#max-rent').val(max_rent_get);

		var pets = "<?php if(isset($pets)){echo $pets;}else{ echo 0;} ?>";
		if(pets != 0){$('#pets').prop('checked', true);}

		var pool = "<?php if(isset($pool)){echo $pool;}else{ echo 0;} ?>";
		if(pool != 0){$('#pool').prop('checked', true);}

		var gated = "<?php if(isset($gated)){echo $gated;}else{ echo 0;} ?>";
		if(gated != 0){$('#gated').prop('checked', true);}

		var fitness = "<?php if(isset($fitness)){echo $fitness;}else{ echo 0;} ?>";
		if(fitness != 0){$('#fitness').prop('checked', true);}

		var wd = "<?php if(isset($wd)){echo $wd;}else{ echo 0;} ?>";
		if(wd != 0){$('#wd').prop('checked', true);}

		var clubhouse = "<?php if(isset($clubhouse)){echo $clubhouse;}else{ echo 0;} ?>";
		if(clubhouse != 0){$('#clubhouse').prop('checked', true);}

		var furnished = "<?php if(isset($furnished)){echo $furnished;}else{ echo 0;} ?>";
		if(furnished != 0){$('#furnished').prop('checked', true);}

		var seniors = "<?php if(isset($seniors)){echo $seniors;}else{ echo 0;} ?>";
		if(seniors != 0){$('#seniors').prop('checked', true);}

		var covered = "<?php if(isset($covered)){echo $covered;}else{ echo 0;} ?>";
		if(covered != 0){$('#covered').prop('checked', true);}

		var laundry = "<?php if(isset($laundry)){echo $laundry;}else{ echo 0;} ?>";
		if(laundry != 0){$('#laundry').prop('checked', true);}


	});
</script>
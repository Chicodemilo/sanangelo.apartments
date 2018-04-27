<div class="nav_bar_pics">
	<div class="inner_pics" id="inner_pic1">
		<div class="inner_pic_name">
			<?php echo $pos_1['property_name'];?>
		</div>
		<a href="<?php echo base_url(); ?>texas/apartment/<?php echo $pos_1['property_search_name'].'/'.$pos_1['ID'] ?>">
			<img src="
				<?php
					if($pos_1['picture_id'] !== 'generic'){
						$exp_pic_name = explode('.', $pos_1['picture_name']);
						echo base_url();
						echo 'images/pictures/'.$pos_1['ID'].'/'.$pos_1['picture_id'].'/'.$exp_pic_name[0].'_big.'.$exp_pic_name[1]; 
					}else{
						echo base_url();
						echo 'images/pictures/generic/generic_big.jpg'; 
					}
					
				?>" alt="">
		</a>
	</div>
	<div class="inner_pics" id="inner_pic2">
		<div class="inner_pic_name">
			<?php echo $pos_2['property_name'];?>
		</div>
		<a href="<?php echo base_url(); ?>texas/apartment/<?php echo $pos_2['property_search_name'].'/'.$pos_2['ID'] ?>">
			<img src="
				<?php
					if($pos_2['picture_id'] == 'generic'){
						echo base_url();
						echo 'images/pictures/generic/generic_big.jpg';
					}else{ 
						$exp_pic_name = explode('.', $pos_2['picture_name']);
						echo base_url();
						echo 'images/pictures/'.$pos_2['ID'].'/'.$pos_2['picture_id'].'/'.$exp_pic_name[0].'_big.'.$exp_pic_name[1]; 
					}
					
				?>" alt="">
		</a>
	</div>
	<div class="inner_pics" id="inner_pic3">
		<div class="inner_pic_name">
			<?php echo $pos_3['property_name'];?>
		</div>
		<a href="<?php echo base_url(); ?>texas/apartment/<?php echo $pos_3['property_search_name'].'/'.$pos_3['ID'] ?>">
			<img src="
				<?php
					if($pos_3['picture_id'] !== 'generic'){
						$exp_pic_name = explode('.', $pos_3['picture_name']);
						echo base_url();
						echo 'images/pictures/'.$pos_3['ID'].'/'.$pos_3['picture_id'].'/'.$exp_pic_name[0].'_big.'.$exp_pic_name[1]; 
					}else{
						echo base_url();
						echo 'images/pictures/generic/generic_big.jpg';
					}
					
				?>" alt="">
		</a>
	</div>
</div>
<div class="navbar">
	<div class="inner_navbar">
		<a href="<?php echo base_url(); ?>">
			<img src="<?php echo base_url(); ?>images/logo_lil.svg" alt="<?php echo WEBSITELOWER; ?>">
		</a>
		<a class="blog_link" href="<?php echo base_url(); ?>texas/blog"><span class='mob_hide'>SEE OUR </span>BLOG</a>
		
		<div class="navbar_links">
			<div class="little_links" id="little_link1">
				<img src="<?php echo base_url(); ?>images/search.svg" alt="search icon">

			</div>
			<a href="<?php echo base_url(); ?>texas/map">
				<div class="little_links" id="little_link2">
					<img src="<?php echo base_url(); ?>images/map.svg" alt="map icon">
				</div>
			</a>
			<div class="little_links" id="little_link3">
				<img src="<?php echo base_url(); ?>images/trending.svg" alt="trending icon">

			</div>
			<a href="<?php echo FBPAGE; ?>" target="blank">
				<div class="little_links" id="little_link4">
					<img src="<?php echo base_url(); ?>images/fb.svg" alt="facebook icon">
				</div>
			</a>
			<div class="most_viewed_window">

				<table class="most_viewed_table">
					<th colspan="2">MOST VIEWED APARTMENTS</th>
					<?php 
						foreach ($viewed as $key => $value) {
							echo "<tr>";
							echo "<td>";
							echo "<div class='link_box'>";
							echo "<a href='".base_url()."texas/apartment/".$value['property_search_name']."/".$value['ID']."'>".$value['property_name']."</a>";
							echo "</div>";
							echo "</td>";
							echo "<td>";
							echo $value['views_month'];
							echo "</td>";
							echo "</tr>";
						}
					 ?>
					 <td colspan="2" class="table_disclaim">*view counts reset monthly<span class='most_viewed_closer'><a href="#">close</a></span></td>
				</table>
				
			</div>
			<div id="navbar_search_window">

					<form action=" <?php echo base_url(); ?>texas/find_apts" method="GET">
							<?php 
								$csrf = array(
						        'name' => $this->security->get_csrf_token_name(),
						        'hash' => $this->security->get_csrf_hash()
								); 
							?>
							<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
							<div class="left">
								BEDROOMS:<br>
								<select name="bedroom"  class="input-small" id="bedroom">
									<option value="0">Any</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3 or More</option>
								</select>
							</div>
							<div class="right">
								BATHROOMS:<br>
								<select name="bathroom" class="input-small" id="bathroom">
									<option value="0">Any</option>
									<option value="1">1 or More</option>
									<option value="2">2 or More</option>
									<option value="3">3 or More</option>
								</select>
							</div>
							<div class="clear"><hr></div>
							<div class="left">
							MIN RENT:<br>
							<select name="min-rent" class="input-small" id="min-rent">
								<option value="0">Any</option>
								<option value="400">$400</option>
								<option value="600">$600</option>
								<option value="800">$800</option>
								<option value="1000">$1000</option>
								<option value="1200">$1200</option>
								<option value="1400">$1400</option>
								<option value="1600">$1600</option>
								<option value="1800">$1800</option>
								<option value="2000">$2000</option>
								<option value="2200">$2200</option>
								<option value="2400">$2400+</option>
							</select>
							</div>
							<div class="right">
							MAX RENT:<br>
							<select name="max-rent" class="input-small" id="max-rent">
								<option value="100000">Any</option>
								<option value="400">$400</option>
								<option value="600">$600</option>
								<option value="800">$800</option>
								<option value="1000">$1000</option>
								<option value="1200">$1200</option>
								<option value="1400">$1400</option>
								<option value="1600">$1600</option>
								<option value="1800">$1800</option>
								<option value="2000">$2000</option>
								<option value="2200">$2200</option>
								<option value="2400">$2400+</option>
							</select>
							</div>
							<div class="clear"><hr></div>
							<div class="clear">
								AMENITIES:<br>
								<div class="left">
									<label class="checkbox smaller"><input type="checkbox" id="pets" name="pets" value="Pets">Pets</label>
									<label class="checkbox smaller"><input type="checkbox" id="pool" name="pool" value="Swimming Pool">Pool</label>
									<label class="checkbox smaller"><input type="checkbox" id="gated" name="gated" value="Gated Access">Gated Access</label>
									<label class="checkbox smaller"><input type="checkbox" id="fitness" name="fitness" value="Fitness Center">Fitness Center</label>
									<label class="checkbox smaller"><input type="checkbox" id="wd" name="wd" value="Washer / Dryer Connections">W/D Connections</label>
								</div>
								<div class="right">
									<label class="checkbox smaller"><input type="checkbox" id="clubhouse" name="clubhouse" value="Clubhouse">Clubhouse</label>
									<label class="checkbox smaller"><input type="checkbox" id="furnished" name="furnished" value="Furnished Available">Furnished</label>
									<label class="checkbox smaller"><input type="checkbox" id="seniors" name="seniors" value="Seniors Community">Seniors</label>
									<label class="checkbox smaller"><input type="checkbox" id="covered" name="covered" value="Covered Parking">Covered Parking</label>
									<label class="checkbox smaller"><input type="checkbox" id="laundry" name="laundry" value="Laundry Facility">Laundry Facility</label>
								</div>
								<input type="submit" class="btn btn-default" value="SEARCH">
								<a id="search_closer">close</a>
							</div>
							
					</form>
			</div>
			
		</div>
	</div>
	
</div>

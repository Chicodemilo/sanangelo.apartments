<div class="nav_prop_name"><?php echo $property_name; ?>
	<div class="nav_prop_slogan"><?php echo $property_slogan; ?>
		
	</div>
</div>

<?php 
	if($special != 'N'){
		echo "<div class='special_box'>";
		echo "<span class='spec_title'>".$special[0]['title']."</span>";
		echo "<hr>";
		echo "<span class='spec_desc'>".$special[0]['description']."</span>";
		echo "<hr>";
		echo "<span class='spec_cond'>";
		echo $special[0]['condition_1']."<br>".$special[0]['condition_2']."<br>".$special[0]['condition_3']."<br>".$special[0]['condition_4']." ";
		echo "</span>";
		echo "</div>";
	}


 ?>

<div class="nav_bar_pics">

	<div class="apt_page_header_pic">

		<img src="<?php echo base_url(); ?>images/pictures/<?php echo $apt_id?>/<?php echo $pic_id?>/<?php echo $pic_name?>" alt="<?php echo $pic_name?>">
	</div>
</div>

<div class="navbar">
	<div class="inner_navbar">
		<a href="<?php echo base_url(); ?>">
			<img src="<?php echo base_url(); ?>images/sanangelo_logo_lil.svg" alt="sanangelo.apartments">
		</a>
		<div class="navbar_links">
			<div class="little_links" id="little_link1">
				<img src="<?php echo base_url(); ?>images/search.svg" alt="search icon">

			</div>
			<a href="<?php echo base_url(); ?>main/map">
				<div class="little_links" id="little_link2">
					<img src="<?php echo base_url(); ?>images/map.svg" alt="map icon">
				</div>
			</a>
			<div class="little_links" id="little_link3">
				<img src="<?php echo base_url(); ?>images/trending.svg" alt="trending icon">
			</div>
			<a href="http://www.facebook.com/therentersanangelo" target="blank">
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
							echo "<a href='".base_url()."main/apartment/".$value['property_search_name']."/".$value['ID']."'>".$value['property_name']."</a>";
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

					<form action=" <?php echo base_url(); ?>main/find_apts" method="GET">
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
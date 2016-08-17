<div class="nav_bar_pics">
	<div class="inner_pics" id="inner_pic1">
		<div class="inner_pic_name">
			<?php echo $pos_1['property_name'];?>
		</div>
		<a href="<?php echo base_url(); ?>main/apartment/<?php echo $pos_1['property_search_name'].'/'.$pos_1['ID'] ?>">
			<img src="
				<?php

					if($pos_1['picture_id'] !== 'generic'){
						echo base_url();
						echo 'images/pictures/'.$pos_1['ID'].'/'.$pos_1['picture_id'].'/'.$pos_1['picture_name']; 
					}else{
						echo base_url();
						echo 'images/'.$pos_1['picture_name']; 
					}
					
				?>" alt="">
		</a>
	</div>
	<div class="inner_pics" id="inner_pic2">
		<div class="inner_pic_name">
			<?php echo $pos_2['property_name'];?>
		</div>
		<a href="<?php echo base_url(); ?>main/apartment/<?php echo $pos_2['property_search_name'].'/'.$pos_2['ID'] ?>">
			<img src="
				<?php

					if($pos_2['picture_id'] == 'generic'){
						echo base_url();
						echo 'images/'.$pos_2['picture_name'];
					}else{ 
						echo base_url();
						echo 'images/pictures/'.$pos_2['ID'].'/'.$pos_2['picture_id'].'/'.$pos_2['picture_name']; 
					}
					
				?>" alt="">
		</a>
	</div>
	<div class="inner_pics" id="inner_pic3">
		<div class="inner_pic_name">
			<?php echo $pos_3['property_name'];?>
		</div>
		<a href="<?php echo base_url(); ?>main/apartment/<?php echo $pos_3['property_search_name'].'/'.$pos_3['ID'] ?>">
			<img src="
				<?php

					if($pos_3['picture_id'] !== 'generic'){
						echo base_url();
						echo 'images/pictures/'.$pos_3['ID'].'/'.$pos_3['picture_id'].'/'.$pos_3['picture_name']; 
					}else{
						echo base_url();
						echo 'images/'.$pos_3['picture_name']; 
					}
					
				?>" alt="">
		</a>
	</div>
</div>
<div class="navbar">
	<div class="inner_navbar">

		<img src="<?php echo base_url(); ?>images/sanangelo_logo_lil.svg" alt="sanangelo.apartments">
		
		<div class="navbar_links">
			<div class="little_links" id="little_link1">
				<img src="<?php echo base_url(); ?>images/search.svg" alt="search icon">

			</div>
			<a href="<?php echo base_url(); ?>apartments/map">
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
			<div class="navbar_search_window">
			</div>
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
					 <td colspan="2" class="table_disclaim">*view counts reset monthly</td>
				</table>
			</div>
		</div>
	</div>
	
</div>
<div class="search_results_box_map">
	<div class="search_param_box_map">
				<span class="search_param_bold_map">SEARCH RESULTS</span><br>APARTMENTS FOUND: <?php echo $apt_count; ?><br>
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
        		
				$hover_id = 0;
				foreach ($all_apartments as $key => $value) {
					if($value['property_name'] == ''){$value['property_name'] = '&nbsp;';}
					if($value['property_slogan'] == ''){$value['property_slogan'] = '&nbsp;';}
					$value['slogan'] = $value['property_slogan'];
					echo "<section >";
						echo "<a href='".base_url()."main/apartment/".$value['property_search_name']."/".$value['apt_id']."'>";
							echo "<table id='".$hover_id."' class='inner_table_1_map'>";
								echo "<tr>";
								echo "<td rowspan='2' id='table_pic_box_map'>";
								echo "<img src='".base_url()."images/pictures/".$value['apt_id']."/".$value['pic_id']."/".$value['pic_name']."'>";
								echo "</td>";
								echo "<td class='table_name_map'>";
								echo $value['property_name'];
								echo "</td>";
								echo "<tr>";
								echo "<td class='table_little_map'>";
								echo $value['property_address'].", ".$value['property_city'];
								echo "</td>";
								echo "</tr>";
							echo "</table>";
						echo "</a>";
					echo "</section>";
					echo "<script>";
					echo "jQuery(document).ready(function($) {";
					echo "$('#".$hover_id."').mouseenter(function(){";
					echo "";
					echo "});";
					echo "$('#".$hover_id."').mouseleave(function(){";
					echo "});";
					echo "});";
					echo "</script>";
					$hover_id = $hover_id + 1;
				}
			 ?>
        <section data-panel="third" class=""></section>
        <section data-panel="third" class=""></section>
        <section data-panel="third" class=""></section>
        <section data-panel="third" class=""></section>
    </div>
</div>

<div class="super_map" id="super_map">
	<div class="map_no_load">The Map Could Not Load. Sorry!</div>
</div>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn87Zc_6XoEGDPiAZM9WBofRLNaNOX6bU&callback=initMap"
    type="text/javascript"></script>
<script>
	   var markers=[];
       function initMap() {
       		  
			  var mapOptions = {
			    zoom: 13,
			    scrollwheel: false,
			    center: new google.maps.LatLng(31.44, -100.47)
			  }
			  var map = new google.maps.Map(document.getElementById('super_map'), mapOptions);
			  var bounds = new google.maps.LatLngBounds(), markers=[];
			  var geocoder = new google.maps.Geocoder();
			  for (var x = 0; x < addresses.length; x++) {
			    var name = names[x];
			    var id = x;
			    geocoder.geocode({
			      'address': addresses[x]
			    }, (function(name, id) {
			      // get function closure on "name"
			      return function(results, status) {
			        if (status == google.maps.GeocoderStatus.OK) {
			          bounds.extend(results[0].geometry.location);
			          var image = '<?php echo base_url() ?>images/map_icon.svg';
			          var marker = new google.maps.Marker({
			            map: map,
			            position: results[0].geometry.location,
			            animation: google.maps.Animation.DROP,
			            icon: image,
			          });
			          var contentString = name;
			          var infowindow = new google.maps.InfoWindow({
			            content: contentString
			          });
			          google.maps.event.addListener(marker, 'click', function() {
			            infowindow.open(map, marker);
			          });
			          var this_element = document.getElementById(id);
			          google.maps.event.addDomListener(this_element, 'mouseenter', function() {
			            infowindow.open(map, marker);
			          });
			          google.maps.event.addDomListener(this_element, 'mouseleave', function() {
			            infowindow.close(map, marker);
			          });
			        }
			      }
			    })(name, id));
			  }
			}

		var addresses = [
			<?php 
				foreach ($all_apartments as $key => $value) {
					echo "'".$value["property_address"]." ".$value["property_city"]." ".$value["property_state"]."', ";
				}
			 ?>
		];
		var names = [
			<?php 
				foreach ($all_apartments as $key => $value) {
					echo "'<a class=\'map_info_link\' href=\'".base_url()."main/apartment/".$value['property_search_name']."/".$value['apt_id']."\'>".$value["property_name"]."</a>', ";
				}

			 ?>
		];
        google.maps.event.addDomListener(window, 'load', initMap);
        google.maps.event.addDomListener(window, 'resize', initMap);
</script>
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
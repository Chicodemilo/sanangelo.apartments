
<div class="inner_main_bg">
	<div class="left_takeover_banner">
		<?php 

			if($background_data != 'N'){
				if($background_data['takeover_link'] != 'N'){
					echo '<a target="blank" href="http://'.$background_data['takeover_link'].'">';
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
					echo '<a target="blank" href="http://'.$background_data['takeover_link'].'">';
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
					echo '<a target="blank" href="http://'.$background_data['takeover_link'].'">';
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

	<div class="body_wrapper">
		<div class="apt_map_contact">
			<div class="apt_map" id="apt_map">
				<div class="map_no_load">The Map Could Not Load. Sorry!</div>
			</div>
			<div class="apt_contact">
				<span class="contact_name"><?php echo $property_name; ?></span><br>
				<span class="contact_add"><?php echo $property_address.', '.$property_city.', '.$property_state; ?></span><br>
				<span class="contact_name"><?php if($free != 'Y'){echo $property_phone;} ?></span><hr class="move_up">
				<div class="contact_form_div">
					<span class="form_bold">CONTACT</span>
					<form id="contact_form">
						<?php 
							$csrf = array(
					        'name' => $this->security->get_csrf_token_name(),
					        'hash' => $this->security->get_csrf_hash()
							); 
						?>
						<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" /> 
						<input type="hidden" name="apt_id" value="<?php echo $apt_id; ?>">
						<input type="text" name="name" id="form_name" cols="30" rows="4" maxlength="10" value="">
						<label for="email">Your Email Address:</label>
						<input type="email" name="email" id="email" required="required" maxlength="70">
						<label for="message">Your Message:</label>
						<textarea name="message" id="message" cols="30" rows="4" required="required" maxlength="300"></textarea><br>
						<input type="submit" value="SEND" class="btn btn-default">
						<p class="message_sent">Your Message Has Been Sent</p>
					</form>
					<script>
					   $(function(){
					       $("#contact_form").submit(function(){
					         dataString = $("#contact_form").serialize();
					 
					         $.ajax({
					           type: "POST",
					           url: "<?php echo base_url(); ?>texas/contact",
					           data: dataString,
					 
					           success: function(json){	
					           		$('#email').val('');				
					           		$('#message').val('');	
					           		$('.message_sent').fadeIn('400').delay('2000').fadeOut('400');			
									 },
								error: function(){						
									alert('There was a problem sending your email. Wait a little bit and try again.');
									}
					         });
					 
					         return false;  //stop the actual form post !important!
					 
					      });
					   });
					</script>
				</div>

			</div>
		</div>
		<div class="apt_pics">
			<ul id="menu">
			<?php 
				if(count($pictures) > 1){

					foreach ($pictures as $key => $value) {
						echo '<a href="#"><li><img class="apt_pics_list" src="'.base_url().'images/pictures/'.$apt_id.'/'.$value['id'].'/'.$value['name'].'"></li></a>';
					}
				}else{
					echo '<img class="solo_pic" class="apt_pics_list" src="'.base_url().'images/pictures/'.$apt_id.'/'.$pictures[0]['id'].'/'.$pictures[0]['name'].'">';
				}
			 ?>
			</ul>

		</div>
		<div class="apt_pics_mob">
			
			<?php 
				
					foreach ($pictures as $key => $value) {
						echo '<img class="apt_pics_list_mob" src="'.base_url().'images/pictures/'.$apt_id.'/'.$value['id'].'/'.$value['name'].'">';
					}
			 ?>


		</div>

		<?php 
			if($floorplans != 'N'){
				echo '<div class="apt_floorplans_big">
						<div class="apt_floorplans">
						<span class="fp_word">Floorplans</span>
							<table class="fp_table">';

				foreach ($floorplans as $key => $value) {
					switch ($value['bathroom']) {
						case '1.00':
							$value['bathroom'] = 1;
							break;
						case '1.50':
							$value['bathroom'] = 1.5;
							break;
						case '2.00':
							$value['bathroom'] = 2;
							break;
						case '2.50':
							$value['bathroom'] = 2.5;
							break;
						case '3.00':
							$value['bathroom'] = 3;
							break;
						case '3.50':
							$value['bathroom'] = 3.5;
							break;
						case '4.00':
							$value['bathroom'] = 4;
							break;
						case '4.50':
							$value['bathroom'] = 4.5;
							break;
						
						default:
							$value['bathroom'] = '5+';
							break;
					}

					$per_sq_ft = round(($value['rent']/$value['square_footage']), 2);
					if($value['name'] == ''){
						$value['name'] = 'The '.$value['bedroom'].' Bedroom';
					}
					
					echo '<tr><td class="fp_name" colspan="12">'.$value['name'].'&nbsp;</td></tr>';
					echo '<tr><td class="fp_data">Bed:</td><td class="fp_data">Bath:</td><td class="fp_data">SqFt:</td><td class="fp_data">Rent:</td><td class="fp_data">Deposit:</td><td class="fp_data">Rent Per SqFt:</td><td class="fp_data">Units Available:</td>';
					if($value['floorplan_pic'] != ''){
						echo '<td class="fp_data_pic" id="show_fp_'.$value['id'].'">see<br>floorplan</td>';
						echo '<div class="hidden_fp_pic" id="hidden_fp_pic_'.$value['id'].'">';
						echo '<span class="fp_name">'.$value['name'].'</span>';
						echo '<img src="'.base_url().'images/floorplans/'.$apt_id.'/'.$value['id'].'/'.$value['floorplan_pic'].'">';
						echo '</div>';

						echo '<script type="text/javascript">
								$("#show_fp_'.$value['id'].'").click(function(event){
									$("#hidden_fp_pic_'.$value['id'].'").fadeIn("fast");
								});
								$("#hidden_fp_pic_'.$value['id'].'").click(function(event){
									$("#hidden_fp_pic_'.$value['id'].'").fadeOut("fast");
								});
							</script>
						';
					}
					echo '</tr>';
					echo '<tr><td class="fp_data bolder">'.$value['bedroom'].'</td><td class="fp_data bolder">'.$value['bathroom'].'</td><td class="fp_data bolder">'.$value['square_footage'].'</td><td class="fp_data bolder">$'.$value['rent'];
					if($value['bedroom'] == 1){
						if($value['rent'] > $market_data['ave_one_bed_rent']){
							echo '<span class="above" id="bed_average_'.$value['id'].'">&nbsp;&#9650;</span>';
							echo '<div class="hidden_ab_be" id="bed_hidden_ab_be_'.$value['id'].'">above market average for 1 bedroom apartments</div>';
						}elseif ($value['rent'] < $market_data['ave_one_bed_rent']) {
							echo '<span class="below" id="bed_average_'.$value['id'].'">&nbsp;&#9660;</span>';
							echo '<div class="hidden_ab_be" id="bed_hidden_ab_be_'.$value['id'].'">below market average for 1 bedroom apartments</div>';
						}elseif($value['rent'] == $market_data['ave_one_bed_rent']){
							echo '<span class="equal" id="bed_average_'.$value['id'].'">&nbsp;=</span>';
							echo '<div class="hidden_ab_be" id="bed_hidden_ab_be_'.$value['id'].'">equal to market average for 1 bedroom apartments</div>';
						}

						echo '<script type="text/javascript">
						 	$("#bed_average_'.$value['id'].'").mouseenter(function(event) {
						 		$("#bed_hidden_ab_be_'.$value['id'].'").fadeIn("fast");
						 	});
						 	$("#bed_average_'.$value['id'].'").mouseleave(function(event) {
						 		$("#bed_hidden_ab_be_'.$value['id'].'").fadeOut("fast");
						 	});
						 </script>';
					}
					if($value['bedroom'] == 2){
						if($value['rent'] > $market_data['ave_two_bed_rent']){
							echo '<span class="above" id="bed_average_'.$value['id'].'">&nbsp;&#9650;</span>';
							echo '<div class="hidden_ab_be" id="bed_hidden_ab_be_'.$value['id'].'">above market average for 2 bedroom apartments</div>';
						}elseif ($value['rent'] < $market_data['ave_two_bed_rent']) {
							echo '<span class="below" id="bed_average_'.$value['id'].'">&nbsp;&#9660;</span>';
							echo '<div class="hidden_ab_be" id="bed_hidden_ab_be_'.$value['id'].'">below market average for 2 bedroom apartments</div>';
						}elseif($value['rent'] == $market_data['ave_two_bed_rent']){
							echo '<span class="equal" id="bed_average_'.$value['id'].'">&nbsp;=</span>';
							echo '<div class="hidden_ab_be" id="bed_hidden_ab_be_'.$value['id'].'">equal to market average for 2 bedroom apartments</div>';
						}

						echo '<script type="text/javascript">
						 	$("#bed_average_'.$value['id'].'").mouseenter(function(event) {
						 		$("#bed_hidden_ab_be_'.$value['id'].'").fadeIn("fast");
						 	});
						 	$("#bed_average_'.$value['id'].'").mouseleave(function(event) {
						 		$("#bed_hidden_ab_be_'.$value['id'].'").fadeOut("fast");
						 	});
						 </script>';
					}



					echo '</td><td class="fp_data bolder">$'.$value['deposit'].'</td><td class="fp_data bolder">$'.$per_sq_ft;

					if($per_sq_ft > $market_data['ave_sq_ft']){
						echo '<span class="above" id="average_'.$value['id'].'">&nbsp;&#9650;</span>';
						echo '<div class="hidden_ab_be" id="hidden_ab_be_'.$value['id'].'">above market average of all apartments</div>';
					}elseif ($per_sq_ft < $market_data['ave_sq_ft']) {
						echo '<span class="below" id="average_'.$value['id'].'">&nbsp;&#9660;</span>';
						echo '<div class="hidden_ab_be" id="hidden_ab_be_'.$value['id'].'">below market average of all apartments</div>';
					}elseif ($per_sq_ft == $market_data['ave_sq_ft']){
						echo '<span class="equal" id="average_'.$value['id'].'">&nbsp;=</span>';
						echo '<div class="hidden_ab_be" id="hidden_ab_be_'.$value['id'].'">equal to market average of all apartments</div>';
					}

					echo '<script type="text/javascript">
					 	$("#average_'.$value['id'].'").mouseenter(function(event) {
					 		$("#hidden_ab_be_'.$value['id'].'").fadeIn("fast");
					 	});
					 	$("#average_'.$value['id'].'").mouseleave(function(event) {
					 		$("#hidden_ab_be_'.$value['id'].'").fadeOut("fast");
					 	});
					 </script>';

					echo '</td><td class="fp_data bolder">'.$value['units_available'].'</td>';

					if($value['floorplan_pic'] != ''){
						echo '<td class="fp_data"></td>';
					}
					

					echo '</tr>';
					echo '<tr><td class="fp_spacer" colspan="12"></td></tr>';
					
					
				}
				echo 	'</table>';
				echo '<span class="apt_pg_mkt_data">San Angelo Average 1 Bed Rent: $'.$market_data['ave_one_bed_rent'].'&nbsp;&nbsp;&bull;&nbsp;&nbsp;Average 2 Bed Rent: $'.$market_data['ave_two_bed_rent'].'&nbsp;&nbsp;&bull;&nbsp;&nbsp;Average Rent Per SqFt For All Apts: $'.$market_data['ave_sq_ft'].'</span>';
				echo '</div>';
				echo '</div>';
			}
		 ?>
		
		<div class="apt_hour_amen">
		
			<div class="apt_amenities_pet">
				<span class="amen_word">Amenities</span>
					<ul class="amenlist">
						<?php 
							$select_yes = 'N';
							$extra_yes = 'N';
							foreach ($amenities as $key => $value) {
								echo '<li class="amen_item>">'.$value['name'];
								if($value['select_units'] != 'N'){
									echo '&#42;';
									$select_yes = 'Y';
								}
								if($value['extra_fees'] != 'N'){
									echo '&#43;';
									$extra_yes = 'Y';
								}
								echo '</li>';
							}
							if($select_yes != 'N'){
								echo '<br><span class="in_select">&#42;In Select Units</span>&nbsp;&nbsp;';
							}
							if($extra_yes != 'N'){
								echo '<span class="extra_fees">&#43;Extra Fees May Apply</span>';
							}
						?>
					</ul>
					<hr>
				<?php 
					if($pets != 'N'){
						echo '<span class="amen_word">Pets</span>';
						echo '<div class="pet_info_div">';
						if($pets['pet_type'] == 'No Pets Allowed'){
							echo '<span class="bolder">'.$pets['pet_type']."</span><br>";
							echo '<br><span class="pet_restrict">'.$pets['pet_restrictions'].'</span>';
						}else{
							echo '<span class="bolder">'.$pets['pet_type']."</span><br>";
							if($pets['pet_dep'] > 0){
								echo 'Deposit:$'.$pets['pet_dep'].'<br>';
								echo 'Refund Possible:$'.$pets['pet_refund'].'<br>';
							}
							echo '<br><span class="pet_restrict">'.$pets['pet_restrictions'].'</span>';
						}

						echo '<hr>';
						echo '</div>';
						
					}



				 ?>
			</div>
			<div class="apt_desc_hours">
				<?php 
					if($logo != 'N'){
						echo '<div class="logo_block">';
						echo '<img src="'.base_url().'images/logos/property/'.$apt_id.'/'.$logo['name'].'">';
						echo '</div>';
					}

					if($property_description != 'N'){
						echo '<div class="desc_block">';
						echo $property_description;
						echo '</div>';
						echo '<hr>';
					}

					if($hours != 'N'){
						echo '<span class="off_word">Office Hours</span>';
						echo '<div class="off_hour_block">';
							foreach ($hours as $key => $value) {
								if($value['open_min'] == 0){
									$value['open_min'] = '00';
								}
								if($value['close_min'] == 0){
									$value['close_min'] = '00';
								}
								echo '&bull;&nbsp;';
								echo '<span class="bolder">'.$value['day_type'].'</span> ';
								if($value['open_hour'] != 0 || $value['close_hour'] != 0){
									echo $value['open_hour'].':'.$value['open_min'].$value['open_am_pm'].' - '.$value['close_hour'].':'.$value['close_min'].$value['close_am_pm'].' ';
								}
								echo '&nbsp;'.$value['day_condition'];
								
								echo '<br>';
							}
						echo '</div>';
					}
				 ?>

				<div class="apt_website">
					<?php 
						if($free == 'N'){
							
							if($property_website != ""){
								echo "<hr>";
								echo "<a href='http://".$property_website."' target='blank'>";
								echo "See Our Website<br>".$property_name;
								echo "</a>";
							}
						}
					 ?>
				</div>

				<div class="apt_desc_management">
					<?php 
						if($free == 'N'){
							if($property_management_url != ""){
								echo "<hr>";
								echo "<a href='http://".$property_management_url."' target='blank'>";
							}

							if($management_logo != 'N'){
								echo "<div class='apt_man_logo'>";
								echo "<img src='".base_url()."images/logos/management/".$apt_id."/".$management_logo."'>";
								echo "</div>";
							}


							if($property_management_name !=""){
								echo $property_management_name;
							}

							if($property_management_url != ""){
								echo "</a>";
							}

						}



					 ?>
				</div>
			</div>
		</div>
	</div><!--  end body_wrapper -->

</div><!-- end inner_main_bg -->
	<div class="apt_footer">
		<div class="footer_bold">To Advertise On SANANGELO.APARTMENTS<br>call: 866-866-4727 or <a target="_blank" href="mailto:miles@bayrummedia.com?Subject=SANANGELO.APARTMENTS%20Contact">EMAIL</a></div>
		<a href="<?php echo base_url(); ?>login/login_user">Advertiser Login</a>
		&nbsp;&bull;&nbsp;
		<a href="<?php echo base_url(); ?>login/register">Register A New Account</a>
	</div>





<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn87Zc_6XoEGDPiAZM9WBofRLNaNOX6bU&callback=initMap"
    type="text/javascript"></script>
<script>
	 function initMap() {
          var geocoder = new google.maps.Geocoder();

          var address = "<?php echo $property_address ?>"+" "+"<?php echo $property_city ?>"+" "+"<?php echo $property_state?>";

          geocoder.geocode( { 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
              	var image = '<?php echo base_url() ?>images/map_icon.svg';
                var mapOptions = {
                  zoom: 14,
                  scrollwheel: false,
                }
                var mapOptions_mobile = {
                  zoom: 15,
                  scrollwheel: false,
                  draggable: false
                }
                var map = new google.maps.Map(document.getElementById('apt_map'), mapOptions);
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    map: map,
                    position: results[0].geometry.location,
                    title: "<?php echo $property_name ?>",

                    icon: image,
                });
                var contentString = "<h5><?php echo $property_name ?></h5>"+"<p>"+"<?php echo $property_address ?>"+" "+"<?php echo $property_city ?>"+", "+"<?php echo $property_state ?>"+"</p>";

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                google.maps.event.addListener(marker, 'click', function() {
                  infowindow.open(map,marker);
                });
              } else {
              	// alert("NOOO");
              	$('.map_no_load').fadeIn('fast');
              }
            });
        }

        google.maps.event.addDomListener(window, 'load', initMap);
        google.maps.event.addDomListener(window, 'resize', initMap);
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$item_count = $('#menu li').length;
		$initial_width = Math.round((826/$item_count));

		if($item_count > 1){
			$('#menu').AccordionImageMenu({
				'closeDim': $initial_width, //(items dimension when the menu is not activated)
				'openDim': 500, //(items dimension when mouseopen)
				'width':400, //(width of the menu if it's vertical)
				'height':350, //(height of the menu if it's horizontal)
				//'effect': 'swing', //(animation effect based on:jQuery UI Effects)
				'duration': 300, //(transition timing)
				'openItem': null, //(item opened when the menu is not activated)
				'border': 4, //(items separation)
				'color':'#FFFFFF', //(separation color)
				'position':'horizontal', //(menu position vertical/horizontal)
				'fadeInTitle': true //(fade in or fade out the items title)
			});
		}

		
	});
</script>
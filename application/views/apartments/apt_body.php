
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
						<label for="email">Your Email Address:</label>
						<input type="email" name="email" id="email" required="required" maxlength="70">
						<label for="message">Your Message:</label>
						<textarea name="message" id="message" cols="30" rows="4" required="required" maxlength="300"></textarea>
						<input type="submit" value="SEND" class="btn btn-default">
						<p class="message_sent">Your Message Has Been Sent</p>
					</form>
					<script>
					   $(function(){
					       $("#contact_form").submit(function(){
					         dataString = $("#contact_form").serialize();
					 
					         $.ajax({
					           type: "POST",
					           url: "<?php echo base_url(); ?>main/contact",
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
					
					echo '<tr><td class="fp_name" colspan="8">'.$value['name'].'&nbsp;</td></tr>';
					echo '<tr><td class="fp_data">Bed:'.$value['bedroom'].'</td><td class="fp_data">Bath:'.$value['bathroom'].'</td><td class="fp_data">SqFt:'.$value['square_footage'].'</td><td class="fp_data">Rent:$'.$value['rent'].'</td><td class="fp_data">Deposit:$'.$value['deposit'].'</td></tr>';
					echo '<tr><td class="fp_spacer" colspan="8"></td></tr>';
					
					
				}
				echo 	'</table>
					</div>';


				$show_pic_div = 'N';		
				foreach ($floorplans as $key => $value) {
					if($value['floorplan_pic'] != '' || $value['floorplan_pic'] != null){
						$show_pic_div = 'Y';
					}
				}

				// if($show_pic_div == 'Y'){
				// 	echo '<div class="apt_floorplans_pics">';

				// 	echo '</div>';
				// }
				
				echo '</div>';
			}
		 ?>

		
		<div class="apt_hour_amen">
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
		</div>
	</div>

</div>
<div class="footer">
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
                    map: map,
                    position: results[0].geometry.location,
                    title: "<?php echo $property_name ?>"
                });
                var contentString = "<h3><?php echo $property_name ?></h3>"+"<p>"+"<?php echo $property_address ?>"+" "+"<?php echo $property_city ?>"+", "+"<?php echo $property_state ?>"+"</p>"+"<h3>"+"<?php echo $property_phone ?>"+"</h3>";

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
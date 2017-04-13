<div class="site_info">
	<?php 
		if($adv_mssg != 'N' && $adv_mssg != ''){
			echo '<div class="site_message">';
			echo $adv_mssg;
			echo '</div>';
		}
		if($adv_pic != 'N' && $adv_pic != ''){
			echo '<div class="site_message_pic">';
			echo '<img src="'.base_url().'images/site/'.$adv_pic.'">';
			echo '</div>';
		}
		if($their_mssg != 'N' && $their_mssg != ''){
			echo '<div class="their_message">';
			echo $their_mssg;
			echo '</div>';
		}
	 ?>
</div>
	<div class="big_advertising_wrapper">
		<?php 
			if(count($recent_ads) > 0){
				echo "<span class='smaller bold'>YOUR RECENT ADS:</span><br>";
				echo "<span class='smaller_indent'>";
			}
			foreach ($recent_ads as $key => $value) {
				echo "&nbsp;&nbsp;&nbsp;&bull; ".$value['item']." &nbsp; start date: ".$value['start_date']." &nbsp; end date: ".$value['end_date']." &nbsp; cost: $".$value['cost'];
				if($value['item'] == 'site_takeover'){
					echo "/per day<br>";
				}elseif($value['item'] == 'premium_level' || $value['item'] == 'top_3'){
					echo "/per month<br>";
				}else{
					echo "<br>";
				}
			}

			echo "</span>";
			if($prem_end_soon == 'Y'){
				echo '<form action="'.base_url().'edit/submit_level/'.$apt_id.'" method="POST">';
				$csrf = array(
			        'name' => $this->security->get_csrf_token_name(),
			        'hash' => $this->security->get_csrf_hash()
					); 
				echo '
						<input type="hidden" name="'.$csrf['name'].'" value="'.$csrf['hash'].'" />
						<input type="hidden" name="apt_id" value="'.$apt_id.'">
						<input type="hidden" name="apt_name" value="'.$apt_name.'">
						<input type="hidden" name="item" value="premium_level">
						
							<input type="hidden" class="part_of_the_equation" name="base_cost" id="base_cost" value="'.$premium.'" required>
							<input type="hidden" class="part_of_the_equation" name="percent_deduction" id="percent_deduction" value="0">
							<input type="hidden" class="part_of_the_equation" name="amount_deduction" id="amount_deduction" value="0">
							<input type="hidden" name="total_deduction" id="total_deduction" value="0">
							<input type="hidden" step="0.01" name="cost" id="cost" value="'.$premium.'" >
							<input type="hidden" name="start_date" class="date-picker" id="extend_start_date" value="'.$extend_prem_start.'" required>
							<input type="hidden" name="end_date" class="date-picker" id="extend_end_date" value="'.$extend_prem_end.'" required>
							<br>
							
							<br>
							<br>
							<span class="adv_stickout smaller">Your Premium Membership Ends Soon!</span><br>
							Make Sure Your Premium Membership Doesn\'t Lapse.<br>
							<input type="submit" value="EXTEND MY PREMIUM MEMEBERSHIP"><br>
							<span class="smaller bold">START DATE: '.$extend_prem_start.' - END DATE: '.$extend_prem_end.'</span>
					</form>
					<hr>
					';

			}
			echo "<span class='smaller bold'><a class='not_fancy_dark' href='".base_url()."edit/your_ads'>ADS & BANNERS</a>&nbsp;&nbsp;&nbsp;<a class='not_fancy_dark' href='".base_url()."edit/invoi'>INVOICES</a></span>";
			
			echo '<div class="adv_page_title"><span id="title_text">GET MORE FROM &nbsp;</span><img id="ad_page_logo" src="'.base_url().'images/sanangelo_logo_lil.svg" alt="sanangelo.apartments"></div>
				<hr>';

			if($feedback !=''){
				$new_feedback = str_replace('%20', ' ', $feedback);
				// $new_feedback = "TACOS!!!!";
				echo "<span class='bold_red'>".$new_feedback."</span>";
			}

			if($show_prem == 'Y'){
				echo '
				
				<div class="adv_item_block item_block_one">
					<span class="adv_page_sm_title"><span style="color:gray;">BASIC</span> TO <span style="color:#EF7007">PREMIUM</span></span>
					<div class="adv_desc_block">
						<br>Go <span class="adv_stickout">PREMIUM</span>!&nbsp;&nbsp;&nbsp;Only $<span class="adv_stickout">'.$premium.' a Month</span>...
					</div>
					<ul>
						<li><span class="adv_stickout">You</span> Appear <span class="adv_stickout">ABOVE</span> the BASIC Level Apartments On...
							<ul class="small_ul">
								<li>The Home Page</li>
								<li>The Map Page</li>
								<li>Search Results Pages</li>
								<li>List Of Open Apartments</li>
								<li>List Of Monthly Specials</li>
							</ul>

						</li>
						<li>A <span class="adv_stickout">PHONE NUMBER</span> On Your Page - We Supply A Trackable 1-800 Number For You... <span class="smaller_indent">Basic Pages have NO phone number listed.
						</span></li>
						<li>A <span class="adv_stickout">LINK</span> To Your Property Website</li>
						<li>A <span class="adv_stickout">LINK</span>  &amp; <span class="adv_stickout">Logo</span> of your Property Management Company</li>
						<li><span class="adv_stickout">FACEBOOK</span> Promotion For Your Property Once a Quarter... <a class="not_fancy_dark" href="http://www.facebook.com/therentersanangelo" target="blank">See Our FB Page</a></li>
						<li><span class="adv_stickout">LEADS</span> Are Emailed Directly To You... <span class="smaller_indent">you don\'t have to log on to see them!</span></li>
					</ul>
					<hr>
						<form action="'.base_url().'edit/submit_level/'.$apt_id.'" method="POST">
				';

				$csrf = array(
			        'name' => $this->security->get_csrf_token_name(),
			        'hash' => $this->security->get_csrf_hash()
					); 

					echo '
						<input type="hidden" name="'.$csrf['name'].'" value="'.$csrf['hash'].'" />
						<input type="hidden" name="apt_id" value="'.$apt_id.'">
						<input type="hidden" name="apt_name" value="'.$apt_name.'">
						<input type="hidden" name="item" value="premium_level">
						
							<input type="hidden" class="part_of_the_equation" name="base_cost" id="base_cost" value="'.$premium.'" required>
							<input type="hidden" class="part_of_the_equation" name="percent_deduction" id="percent_deduction" value="0">
							<input type="hidden" class="part_of_the_equation" name="amount_deduction" id="amount_deduction" value="0">
							<input type="hidden" name="total_deduction" id="total_deduction" value="0">
							<input type="hidden" step="0.01" name="cost" id="cost" value="'.$premium.'" >
							<input type="hidden" name="start_date" class="date-picker" id="start_date" required>
							<input type="hidden" name="end_date" class="date-picker" id="end_date" required>
							<br>
							<input type="submit" value="START MY PREMIUM MEMBERSHIP"><br>
							<span class="smaller bold">START DATE: '.date('m/d/Y').' - END DATE: '.date('m/d/Y', strtotime('+1 year')).'</span>
							<br>
							<br>
							<span class="adv_stickout smaller">Nothing To Pay Today!</span><br>
							<span class="smaller">We will send you an invoice at the end of each month of your PREMIUM MEMBERSHIP.<br>
							Premium Memberships are a twelve month commitment.<br>
							Invoices will be emailed to the addresses listed on your account.<br></span>
					</form>
					</div>
					<hr>
					';
				}
			?>
				
		<div class="adv_item_block">
			<div class="adv_pic">
				<img id="takeover_pic" src="<?php echo base_url(); ?>images/takeover.jpg" alt="Site Takeover Pic">
			</div>
			<div class="adv_item_two">
				<span class="adv_page_sm_title">SITE TAKEOVER</span>
				
				<div class="adv_desc_block lower_block">
					Pick A Day &amp; Takeover Our Site... 
					<br>Only <span class="adv_stickout">$<?php echo $site_take_over; ?> A DAY</span>!
				</div>
				<ul class="lower_block">
					<li>Your Apartment Is Listed <span class="adv_stickout">FIRST</span> On...
						<ul class="small_ul">
							<li>The Home Page</li>
							<li>The Map Page</li>
							<li>Search Results Pages</li>
							<li>List Of Open Apartments</li>
							<li>List Of Monthly Specials</li>
						</ul>

					</li>
					<li><span class="adv_stickout">BANNERS</span> On the Left, Right &amp; Center - All Link To Your Website!</span></li>
					<li>Your Mobile Banner Appears and Disolves On Our <span class="adv_stickout">MOBILE</span> Site</li>
					<li>A Paid <span class="adv_stickout">FACEBOOK</span> Promotion On The Day Of Your Takeover... <a class="not_fancy_dark" href="http://www.facebook.com/therentersanangelo" target="blank">See Our FB Page</a></li>
					<li>We'll Help You Make Your Banner Ads</li>
					<li>Commitment Free! A Site Takeover Is One Day At A Time</li>
				</ul>
			</div>
			<form action="<?php echo base_url(); ?>edit/submit_sto/<?php echo $apt_id; ?>" method="POST">
			<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				<input type="hidden" name="apt_id" value="<?php echo $apt_id;?>">
				<input type="hidden" name="apt_name" value="<?php echo $apt_name;?>">
				<input type="hidden" name="item" value="site_takeover">
				<input type="hidden" class="" name="base_cost" id="base_cost_sto" value="<?php echo $site_take_over; ?>" required>
				<input type="hidden" class="" name="percent_deduction" id="percent_deduction_sto" value="0">
				<input type="hidden" class="" name="amount_deduction" id="amount_deduction_sto" value="0">
				<input type="hidden" name="total_deduction" id="total_deduction_sto" value="0">
				<input type="hidden" step="0.01" name="cost" id="cost_sto" value="<?php echo $site_take_over; ?>" required>
				<br>
				Pick A Date For Your Site Take Over:
				<input type="text" name="start_date" class="date-picker" id="start_date_sto" required>
				<br>
				<input type="submit" value="TAKEOVER SANANGELO.APARTMENTS">
				<br>
				<br>
				<span class="adv_stickout smaller">Nothing To Pay Today!</span><br>
				<span class="smaller">We will send you an invoice at the end the month of your SITE TAKEOVER runs.<br>
				Please let us know if you need help creating or uploading your banners.<br></span>
			</form>
		</div>
		<hr>
		<div class="adv_item_block">
			<div class="adv_pic">
				<img id="takeover_pic" src="<?php echo base_url(); ?>images/topthree.jpg" alt="Top Three Pic">
			</div>
			<div class="adv_item_two">
				<span class="adv_page_sm_title">TOP 3 BANNER</span>
				
				<div class="adv_desc_block lower_block">
					Keep Your Apartment In The Top Banner<br>Only <span class="adv_stickout">$<?php echo $top_three; ?> A MONTH</span>!					
					<br>
					Get <span class="adv_stickout">MORE VIEWS</span> On Your Page 
					
				</div>
				<ul class="lower_block">
					<li>Your Apartment Name And Picture <span class="adv_stickout">ON TOP</span>. This Is Seen On...
						<ul class="small_ul">
							<li>The Home Page</li>
							<li>ALL Search Results Pages</li>
							<li>The Apartment Blog Pages</li>
						</ul>
					</li>
					<li>A <span class="adv_stickout">LINK</span> Directly To Your Page!</span></li>
					<li>Commitment Free! Top 3 Banner is One Month At A Time</span></li>
				</ul>
			</div>
			<br>
			<br>
			<form action="<?php echo base_url(); ?>edit/submit_top_3/<?php echo $apt_id; ?>" method="POST">
				<?php 
					$csrf = array(
			        'name' => $this->security->get_csrf_token_name(),
			        'hash' => $this->security->get_csrf_hash()
					); 
				?>
				<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
				<input type="hidden" name="apt_id" value="<?php echo $apt_id;?>">
				<input type="hidden" name="apt_name" value="<?php echo $apt_name;?>">
				<input type="hidden" name="item" value="top_3">
				<input type="hidden" class="" name="base_cost" id="base_cost_top_3" value="<?php echo $top_three; ?>" required>
				<input type="hidden" class="" name="percent_deduction" id="percent_deduction_top_3" value="0">
				<input type="hidden" class="" name="amount_deduction" id="amount_deduction_top_3" value="0">
				<input type="hidden" name="total_deduction" id="total_deduction_top_3" value="0">
				<input type="hidden" step="0.01" name="cost" id="cost_top_3" value="<?php echo $top_three; ?>" required>
				<!-- <input type="text" name="start_date" class="date-picker" id="start_date_top_3" required> -->

				Month:
				<select name="top_3_month" id="top_3_month">
					<option value='01'>Janaury</option>
				    <option value='02'>February</option>
				    <option value='03'>March</option>
				    <option value='04'>April</option>
				    <option value='05'>May</option>
				    <option value='06'>June</option>
				    <option value='07'>July</option>
				    <option value='08'>August</option>
				    <option value='09'>September</option>
				    <option value='10'>October</option>
				    <option value='11'>November</option>
				    <option value='12'>December</option>
				</select>
				Year:
				<select name="top_3_year" id="top_3_year">
					<option value='<?php echo date('Y') ?>'><?php echo date('Y') ?></option>
					<option value='<?php echo date('Y', strtotime('+1 year')) ?>'><?php echo date('Y', strtotime('+1 year')) ?></option>
					<option value='<?php echo date('Y', strtotime('+2 year')) ?>'><?php echo date('Y', strtotime('+2 year')) ?></option>
				    
				</select>
				<br>
				<br>
				<input type="submit" value="PUT MY COMMUNITY ON THE TOP BANNER">
				<br>
				<br>
				<span class="adv_stickout smaller">Nothing To Pay Today!</span><br>
				<span class="smaller">We will send you an invoice at the end the month of your TOP 3 BANNER.<br>
				If you choose this month, you banner will start immediately and run to the end of the month.<br>
				If you choose an upcoming month, your banner will start on the first of that month and run to the end of that month.</span>
			</form>
			
		</div>
		<div class="moreinfo">
				<span class="adv_stickout">QUESTIONS? CALL:</span> (325) 340-9310 For More Info :: Or Send Us An <a class="not_fancy_dark" href="mailto:miles@bayrummedia.com?subject=SANANGELO.APARTMENTS%20Advertising">Email</a>
			</div>

		<form action="<?php echo base_url(); ?>edit/submit_advertising_edits" method="post">
			<input type="hidden" name="id" id="id" value="<?php echo $main_info[0]['ID'] ?>">
			<?php 
				$csrf = array(
		        'name' => $this->security->get_csrf_token_name(),
		        'hash' => $this->security->get_csrf_hash()
				); 
			?>
			<input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
			
			<!-- <input type="submit" value="ORDER"> -->
		</form>
	</div>
<div class="bottom_room">
	&nbsp;
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var the_date= new Date();
		var curr_month = (the_date.getMonth()+1);
		var this_curr_month = ('0'+curr_month).slice(-2);
		$("#top_3_month").val(this_curr_month)
	});

	var start_picker_sto = new Pikaday({ field: document.getElementById('start_date_sto') });
</script>


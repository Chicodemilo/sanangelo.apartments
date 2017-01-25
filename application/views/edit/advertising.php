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
		<div class="adv_page_title"><span id="title_text">GET MORE FROM &nbsp;</span><img id="ad_page_logo" src="<?php echo base_url(); ?>images/sanangelo_logo_lil.svg" alt="sanangelo.apartments"></div>
		<hr>
		<div class="adv_item_block item_block_one">
			<span class="adv_page_sm_title">UPGRADE FROM <span style="color:gray;">BASIC</span> TO <span style='color:#EF7007'>PREMIUM</span></span>
			<div class="adv_desc_block">
				If you advertise in the Renter Magazine you have a <span class="adv_stickout">BASIC</span> page for free...
				<span class="smaller_indent">a $120/month value!</span>
				<br>
				<br>But Check Out Our <span class="adv_stickout">PREMIUM</span> Level for only <span class="adv_stickout">$70 a Month...</span>
			</div>
			<ul>
				<li>PREMIUM Level apartments apear <span class="adv_stickout">ABOVE</span> the BASIC level apartments on...
					<ul class="small_ul">
						<li>The Home Page</li>
						<li>The Map Page</li>
						<li>Search Results Pages</li>
						<li>List Of Open Apartments</li>
						<li>List Of Monthly Specials</li>
					</ul>

				</li>
				<li>Your Page Includes A <span class="adv_stickout">TRACKABLE</span> Toll-Free Number... <span class="smaller_indent">you can see how many calls you're getting</span></li>
				<li>Your Page Includes A <span class="adv_stickout">LINK</span> To Your Property Website</li>
				<li>Your Page Includes A <span class="adv_stickout">LINK</span>  &amp; The Logo of your Property Management Company</li>
				<li>We Post A <span class="adv_stickout">FACEBOOK</span> Promotion For Your Property Once a Quarter... <a class="not_fancy_dark" href="http://www.facebook.com/therentersanangelo" target="blank">See Our FB Page</a></li>
				<li>All Generated <span class="adv_stickout">LEADS</span> Are Emailed Directly To You... <span class="smaller_indent">you don't have to logon to see them!</span></li>
			</ul>
			<div class="moreinfo">
				<span class="adv_stickout">CALL:</span> 1-866-800-4727 For More Info :: Or Send Us An <a class="not_fancy_dark" href="mailto:miles@bayrummedia.com?subject=SANANGELO.APARTMENTS%20Advertising">Email</a>
			</div>
		</div>
		<hr>
		<div class="adv_item_block">
			<div class="adv_pic">
				<img id="takeover_pic" src="<?php echo base_url(); ?>images/takeover.jpg" alt="Site Takeover Pic">
			</div>
			<div class="adv_item_two">
				<span class="adv_page_sm_title">SITE TAKEOVER</span>
				
				<div class="adv_desc_block lower_block">
					Pick A Day &amp; Takeover Our Site... 
					<br>Only <span class="adv_stickout">$60 A DAY</span>!
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
					<li><span class="adv_stickout">BANNERS</span> On the Left, Right &amp; Center - All Link To Your Site!</span></li>
					<li>Your Mobile Banner Appears and Disolves On Our <span class="adv_stickout">MOBILE</span> Site</li>
					<li>A Paid <span class="adv_stickout">FACEBOOK</span> Promotion On The Day Of Your Takeover... <a class="not_fancy_dark" href="http://www.facebook.com/therentersanangelo" target="blank">Facebook Page</a></li>
					<li>We'll Help You Make Your Banner Ads</li>
					<li>Commitment Free! You Only Commit To This One Day At A Time.</li>
				</ul>
			</div>
			<div class="moreinfo">
				<span class="adv_stickout">CALL:</span> 1-866-800-4727 For More Info :: Or Send Us An <a class="not_fancy_dark" href="mailto:miles@bayrummedia.com?subject=SANANGELO.APARTMENTS%20Advertising">Email</a>
			</div>
		</div>
		<hr>
		<div class="adv_item_block">
			<div class="adv_pic">
				<img id="takeover_pic" src="<?php echo base_url(); ?>images/topthree.jpg" alt="Top Three Pic">
			</div>
			<div class="adv_item_two">
				<span class="adv_page_sm_title">TOP 3 BANNER</span>
				
				<div class="adv_desc_block lower_block">
					Get <span class="adv_stickout">MORE VIEWS</span> On Your Page With The TOP 3 BANNER 
					<br>
					<br>
					Keep Your Apartment In The Top Banner<br>For Only <span class="adv_stickout">$200 A MONTH</span>
				</div>
				<ul class="lower_block">
					<li>Your Apartment Name And Picture <span class="adv_stickout">ON TOP</span>. This Is Seen On...
						<ul class="small_ul">
							<li>The Home Page</li>
							<li>ALL Search Results Pages</li>
							<li>The Apartment Blog Pages</li>
						</ul>
					</li>
					<li>A <span class="adv_stickout">LINK</span> Goes Directly To Your Page!</span></li>
					<li>No Commitment Needed! You Can Go A Month To Month With This One</span></li>
				</ul>
			</div>
			<div class="moreinfo">
				<span class="adv_stickout">CALL:</span> 1-866-800-4727 For More Info :: Or Send Us An <a class="not_fancy_dark" href="mailto:miles@bayrummedia.com?subject=SANANGELO.APARTMENTS%20Advertising">Email</a>
			</div>
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


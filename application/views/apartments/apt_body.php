
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
		</div>
		<div class="search_results_box">
				
			<div class="panel_container">
	           

		</div>

	</div>

</div>
<div class="footer">
	<div class="footer_bold">To Advertise On SANANGELO.APARTMENTS<br>call: 866-866-4727 or <a target="_blank" href="mailto:miles@bayrummedia.com?Subject=SANANGELO.APARTMENTS%20Contact">EMAIL</a></div>
	<a href="<?php echo base_url(); ?>login/login_user">Advertiser Login</a>
	&nbsp;&bull;&nbsp;
	<a href="<?php echo base_url(); ?>login/register">Register A New Account</a>
</div>


<script>
	jQuery(document).ready(function($) {
		
	});
</script>

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
	
	
	<?php 
		if($background_data['takeover_mobile'] != 'N'){
			echo '<div class="takeover_banner_mobile">';
			if($background_data['takeover_link'] != 'N'){
				echo '<a target="blank" rel="nofollow" href="http://'.$background_data['takeover_link'].'">';
			}

			if($background_data['takeover_mobile'] != ''){
				echo '<img src="'.base_url().'images/takeover/mobile/'.$background_data['takeover_mobile'].'">';
			}

			if($background_data['takeover_link'] != 'N'){
				echo '</a>';
			}
			echo "</div>";
		}
	?>
	<div class="body_wrapper">
		<?php 
			if($background_data != 'N'){
				echo '<div class="takeover_top_banner">';
				if($background_data['takeover_link'] != 'N'){
					echo '<a target="blank" rel="nofollow" href="http://'.$background_data['takeover_link'].'">';
				}

				if($background_data['takeover_top'] != ''){
					echo '<img src="'.base_url().'images/takeover/top/'.$background_data['takeover_top'].'">';
				}

				if($background_data['takeover_link'] != 'N'){
					echo '</a>';
				}
				echo '</div>';
			}
		?>
		<?php
            foreach ($blog_list->result() as $blog) {
        ?>
        <div class="post">
            <h1 class="post_title"><?php echo $blog->post_title; ?></h1>
            <p class="meta">
        <?php
            
            $originalDate = $blog->post_date;
			$newDate = date("F j, Y", strtotime($originalDate));
			echo $newDate;
        ?>
        <?php
        	if($blog->post_pic != ''){
        		echo "<div class='blog_pic'><img src='".base_url()."images/blog/".$blog->post_pic."'></div>";
        	}
        ?>
            <div class="entry">
                <p><?php echo $blog->post_text; ?></p>
        
            </div>
            <hr class="clear_float">
        </div>
        <?php
            }
        ?>	

	</div>

</div>
<div class="footer">
	<div class="footer_bold">To Advertise On <?php echo WEBSITE; ?><br>call: 866-866-4727 or <a target="_blank" href="mailto:miles@bayrummedia.com?Subject=<?php echo WEBSITE; ?>%20Contact">EMAIL</a></div>
	<a href="<?php echo base_url(); ?>login/login_user">Advertiser Login</a>
	&nbsp;&bull;&nbsp;
	<a href="<?php echo base_url(); ?>login/register">Register A New Account</a>
</div>

<script>
	jQuery(document).ready(function($) {
		

	});
</script>
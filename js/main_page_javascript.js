jQuery(document).ready(function($) {
	console.log('jQuery & Javascript Loaded');


	$(window).scroll(function(){
        		if($(window).width() > 900){
        				var topper = '0';
        				var scrollTop = 220;
        			}else{
        				var topper = '50';
        				var scrollTop = 140;
        			}

        		// alert("width: "+$(window).width()+" topper: "+topper+" srolltop: "+scrollTop);
        		if($(window).scrollTop() >= scrollTop){
        			$('.navbar').css({
        				position : 'fixed',
        				top : topper
        			});

        			$('.most_viewed_window').css({
        				position : 'fixed',
        				top : topper
        			});
        			
        			right_dist = ($(window).width() - 1250) / 2;
        			$('.left_takeover_banner').addClass('left_takeover_banner_fixed');
        			$('.right_takeover_banner').css({
        				position: 'fixed',
        				top: '70',
        				right: right_dist
        			});
        			$('.inner_main_bg').css('margin-top', '70px');

        		}
        		
        		if($(window).scrollTop() < scrollTop){
        			$('.navbar').removeAttr('style');
        			$('.left_takeover_banner').removeClass('left_takeover_banner_fixed');
        			$('.right_takeover_banner').css({
        				position: 'absolute',
        				top: '0',
        				right: '0'
        			});
        			$('.inner_main_bg').css('margin-top', '20px');	
        		}

        		$(window).resize(function(event) {
        			if($(window).scrollTop() >= scrollTop){
        				right_dist = ($(window).width() - 1250) / 2;
        				$('.right_takeover_banner').css({
	        				position: 'fixed',
	        				top: '70',
	        				right: right_dist
	        			});
        			}
        		});
      	});

	$('#little_link1').click(function(event) {
		$('#navbar_search_window').slideDown('fast');
		
	});

	$('#search_closer').click(function(event) {
		$('#navbar_search_window').slideUp('fast');
	});

	$('#little_link3').click(function(event) {
		$('.most_viewed_window').slideDown('fast');
	});

	$('.most_viewed_closer').click(function(event) {
		$('.most_viewed_window').slideUp('fast');
	});

	$('#little_link3').click(function(event) {
		$('.most_viewed_window_map').slideDown('fast');
	});

	$('.most_viewed_closer').click(function(event) {
		$('.most_viewed_window_map').slideUp('fast');
	});

	// $('.takeover_top_banner').delay(8000).slideDown(150).delay(2900).slideUp(150);

	$('.sign_up_screen').delay(7000).slideDown(500);

	$('.no_thanks').click(function(event) {
		$('.sign_up_screen').slideUp(200);
	});

	if($(window).width() > 900){
			
		}else{
			$('.takeover_banner_mobile').delay(3000).slideDown(150).delay(5000).slideUp(150);
    }

});

var link_enter = function ($id, $apt_name, $pic_id, $pic_name, $base_url, $slogan, $address, $state, $phone){
	$('#pic_box_name').html($apt_name);
	if($slogan === '&nbsp;'){
		$('#pic_box_slogan').html($slogan);
	}else{
		$('#pic_box_slogan').html($slogan+'<br>');
	}
	
	$('.pic_box').css('background-image', 'url("'+$base_url+'images/pictures/'+$id+'/'+$pic_id+'/'+$pic_name+'"');
	// $('#pic_box_address').html($address+', '+$state);
	// $('#pic_box_phone').html($phone);
}

var link_leave = function ($id, $apt_name, $pic_id, $pic_name){
	// alert("Leave: "+$id+" "+$apt_name+" "+$pic_id+" "+$pic_name);
}
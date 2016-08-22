jQuery(document).ready(function($) {
	console.log('jQuery & Javascript Loaded');


	$(window).scroll(function(){
        		var scrollTop = 350;
        		if($(window).scrollTop() >= scrollTop){
        			$('.navbar').css({
        				position : 'fixed',
        				top : '0'
        			});
        			$('.body_wrapper').css('margin-top', '70px');

        		}
        		if($(window).scrollTop() < scrollTop){
        			$('.navbar').removeAttr('style');
        			$('.body_wrapper').css('margin-top', '20px');	
        		}
      	});

	$('#little_link1').click(function(event) {
		$('#navbar_search_window').slideDown('fast');
	});

	$('#navbar_search_window').mouseleave(function(event) {
		$('#navbar_search_window').slideUp('fast');
	});

	$('#little_link3').click(function(event) {
		$('.most_viewed_window').slideDown('fast');
	});

	$('.most_viewed_window').mouseleave(function(event) {
		$('.most_viewed_window').slideUp('fast');
	});

});

var link_enter = function ($id, $apt_name, $pic_id, $pic_name, $base_url, $slogan){
	$('#pic_box_name').html($apt_name);
	$('#pic_box_slogan').html($slogan);
	$('.pic_box').css('background-image', 'url("'+$base_url+'images/pictures/'+$id+'/'+$pic_id+'/'+$pic_name+'"');
}

var link_leave = function ($id, $apt_name, $pic_id, $pic_name){
	// alert("Leave: "+$id+" "+$apt_name+" "+$pic_id+" "+$pic_name);
}
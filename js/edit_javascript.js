$(document).ready(function() {
    $('#contact_drop').mouseenter(function(event) {
        $('#contact_menu').fadeToggle('fast')
    });

    $('#contact_drop').mouseleave(function(event) {
        $('#contact_menu').fadeToggle('fast');
    });
    console.log('LINKED JS LOADED');

    $('.upper_name').css({
        position: 'relative',
        left: '-400px'
    });
    $('.name_parts').css({
        position: 'relative',
        left: '-100px'
    });
    $('.upper_name').fadeIn({queue: false, duration: 4000});
    $('.upper_name').animate({left: "0px"}, 4000);
    $('.name_parts').animate({left: "0px"}, 5000);
    $('.slogan').delay(4000).fadeIn(4500);

    $(window).on('scroll', function() {
        var scrollTop = $(this).scrollTop();

        $('#nav_bar').each(function() {
            var topDistance = $(this).offset().top;

            if ( (topDistance+42) < scrollTop ) {
                $('#nav_bar_scroll_top').css({top: "0px"});
            }
        });

        $('#nav_bar').each(function() {
            var topDistance = $(this).offset().top;

            if ( (topDistance+43) > scrollTop ) {
                $('#nav_bar_scroll_top').css({top: "-100px"});
            }
        });
    });

    function calc_ded(){
        var base = Number($('#base_cost').val());
        var percent_deduction = Number($('#percent_deduction').val());
        var amount_deduction = Number($('#amount_deduction').val());

        if(percent_deduction > 0 || percent_deduction < 0){
            var total_deduction = Number(((base*percent_deduction)/100) + amount_deduction);
        }

        if(percent_deduction == 0){
            var total_deduction = Number(amount_deduction);
        }

        total_deduction = Math.round(total_deduction * 100)/100;

        return total_deduction;
    }

    function calc_tot(deduction) {
        var base = Number($('#base_cost').val());
        var total_cost = base - deduction;
        return total_cost;
    }

    $(".part_of_the_equation").change(function(){
        var deduction = calc_ded();
        $('#tot_ded_screen').html(deduction);
        $('#total_deduction').val(deduction);
        var total_cost = calc_tot(deduction);
        $('#cost').val(total_cost);
    });

    var d = new Date();
    var dd = d.getDate();
    var mm = d.getMonth() + 1;
    var yyyy = d.getFullYear();
    var next_yyyy = yyyy+1
    var today = yyyy+'-'+mm+'-'+dd;
    var final_today = next_yyyy+'-'+mm+'-'+dd;
    $('#start_date').val(today);
    $('#end_date').val(final_today);

 });

    var hide = 2;
    var left_position = -20;
    var navigationSlider;
    
    function show_contact(){
        document.getElementById("links").style.zIndex = -1;
        document.getElementById('contact_wrapper').style.visibility = "visible";
        var d = new Date(); //creates a new date
        var hh = d.getHours();
        var min = d.getUTCMinutes();
        var dd = d.getDate(); 
        var mm = d.getMonth() + 1; 
        var yyyy = d.getFullYear(); 
        var now = hh + ":" + min + " " + mm + "/" + dd + "/" + yyyy; 

        document.messager.system_date.value = now; 
    }
    
    function show_big_pic(){
        document.getElementById("links").style.zIndex = -1;
        document.getElementById('big_pic_wrapper').style.visibility = "visible";
    }
    
    function hide_contact(){
        document.getElementById("links").style.zIndex = 1;
        document.getElementById('contact_wrapper').style.visibility = "hidden";
    }
    
    function hide_big_pic(){
        document.getElementById("links").style.zIndex = 1;
        document.getElementById('big_pic_wrapper').style.visibility = "hidden";
    }
    
    function show_links(){
        if(hide == 1){
            document.getElementById("links").style.zIndex = 1;
            document.getElementById('links').style.visibility = 'visible';
            hide = 2;
            
            if(left_position < 100){
                
                clearInterval(navigationSlider);
                
                navigationSlider = setInterval("showNavigationMenu()", 10);
            }
            
        }else{
            document.getElementById("links").style.zIndex = -1;
            clearInterval(navigationSlider);
            hide = 1;
            navigationSlider = setInterval("hideNavigationMenu()", 10);
//            document.getElementById('links').style.visibility = 'hidden';
        }
    }
    
    function showNavigationMenu(){
        if(left_position < -25)
            {
            left_position = left_position + 10;
            document.getElementById("links").style.left = left_position + "px";
            }
    }
    
    function hideNavigationMenu(){
        if(left_position > -1000)
        {
        left_position = left_position - 10;
        document.getElementById("links").style.left = left_position + "px";
        }
    }
    
    function onImgError(source){
        document.getElementById("info_block_pic").style.visibility = 'hidden';
        // disable onerror to prevent endless loop
        source.onerror = "";
        return true;
    }



    
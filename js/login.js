var first_num = 1+Math.floor(Math.random()*5);
var second_num = 1+Math.floor(Math.random()*5);
var correct_ans = first_num + second_num;

jQuery(document).ready(function($) {
		console.log('Javascript and jQuery Loaded');

		$('#first_num').html(first_num);
		$('#second_num').html(second_num);
});



function validate_resistration() {
	var their_ans = $('#num_ans').val();
	if(their_ans != correct_ans){
		$('#not_correct').css('display', 'inline');
		return false;
	}else{
		return true;
	}
}
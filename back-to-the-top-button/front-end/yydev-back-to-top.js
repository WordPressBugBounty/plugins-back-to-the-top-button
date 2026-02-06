// ----------------------------------------------
// yydevelopment back to top js code
// ----------------------------------------------   

jQuery(document).ready(function($){

	var amountScrolled = 300;

	$(window).scroll(function() {

		if ( $(window).scrollTop() > amountScrolled ) {
			$('.yydev-back-to-top').fadeIn('slow');
		} else {
			$('.yydev-back-to-top').fadeOut('slow');
		} // if ( $(window).scrollTop() > amountScrolled ) {

	}); // $(window).scroll(function() {

    // adding smooth scrolling to button
	$('.yydev-back-to-top').click(function() {
		$('html, body').animate({ scrollTop: 0 }, 700);
		return false;
	}); // $('a.yydev-back-to-top').click(function() {

}); // // jQuery(document).ready(function($){
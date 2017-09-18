$(document).ready(function(){
	$('.back-to-top').hide();
	//scroll
	$(window).scroll(function(){
		if($(window).scrollTop() != 0){
			$('.back-to-top').fadeIn();
		} else{
			$('.back-to-top').fadeOut();
		}
	});

	//click
	$('.back-to-top').click(function(){
		$('html, body').animate({scrollTop:0}, 500);
	});
	
});
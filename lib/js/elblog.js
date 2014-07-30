jQuery(document).ready(function($) {
	$(window).scroll(function () {
		if ($(this).scrollTop() > $('.site-header').offset().top ) {
			
			if( !$('.master-title').hasClass('fixed') ){
			
				$('.simple-social-icons').appendTo('.master-title .wrap');
				$('.master-title').addClass('fixed').hide().fadeIn();
			
			}	
		} else {
			if( $('.master-title').hasClass('fixed') ){
				$('.simple-social-icons').appendTo('.top-header .wrap');
				$('.master-title').removeClass('fixed').hide().fadeIn('fast');
			}
		}
	})	
});

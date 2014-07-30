jQuery(document).ready(function($) {
	$(window).scroll(function () {
		if ($(this).scrollTop() > $('.site-header').offset().top ) {
			
			if( !$('.master-title').hasClass('fixed') ){
			
				if( $('body').hasClass('single') ){

					$('.sharedaddy').appendTo('.master-title .wrap');

				} else {

					$('.simple-social-icons').appendTo('.master-title .wrap');
					
				}
				$('.master-title').addClass('fixed').hide().fadeIn();
			
			}	
		} else {
			if( $('.master-title').hasClass('fixed') ){
				
				if( $('body').hasClass('single') ){

					$('.sharedaddy').appendTo('.entry-header');

				} else {

					$('.simple-social-icons').appendTo('.top-header .wrap');
					
				}				
				
				$('.master-title').removeClass('fixed').hide().fadeIn('fast');
			}
		}
	})	
});

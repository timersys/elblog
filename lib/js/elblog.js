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

	// Mobile Menu	
	$( 'nav.nav-primary' ).before( '<a class="menu-toggle" role="button" aria-pressed="false"><i class="fa fa-bars"></i> MENU</a>' ); // Add toggles to menus
	$( 'nav.nav-primary .sub-menu' ).before( '<a class="sub-menu-toggle" role="button" aria-pressed="false"></a>' ); // Add toggles to sub menus
 
	// Show/hide the navigation
	$( '.menu-toggle, .sub-menu-toggle' ).on( 'click', function() {
		var $this = $( this );
		$this.attr( 'aria-pressed', function( index, value ) {
			return 'false' === value ? 'true' : 'false';
		});
 
		$this.toggleClass( 'activated' );
		$this.next( 'nav, .sub-menu' ).slideToggle( 'fast' );
 
	});
});

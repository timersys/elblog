<?php
//Inserts ads after first post only
add_action( 'genesis_after_entry', 'elblog_adsense');
function elblog_adsense(){
	global $wp_query;
	global $wp_registered_sidebars;
	
	if( is_singular( )  )
		return;

	//if first post Also we want an ad after 5
	if( $wp_query->current_post == 0 || $wp_query->current_post == 4 ) {
	
		if ( ( isset( $wp_registered_sidebars['ads-after-first-post'] ) && is_active_sidebar( 'ads-after-first-post' ) ) || has_action( 'ads-after-first-post' ) ) {
			genesis_markup( array(
				'html5'   => '<aside %s>',
				'xhtml'   => '<div class="ads-after-first-post widget-area header-widget-area">',
				'context' => 'ads-after-first-post',
			) );
		

				do_action( 'ads-after-first-post' );
				
				dynamic_sidebar( 'ads-after-first-post' );
			

			genesis_markup( array(
				'html5' => '</aside>',
				'xhtml' => '</div>',
			) );
		}
	}
}

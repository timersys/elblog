<?php

/**
 * Sharing daddy
 */
remove_filter( 'the_content', 'sharing_display', 19 );
remove_filter( 'the_excerpt', 'sharing_display', 19 );

/**
 * Add clearfix to entry-header
 */

add_filter( 'genesis_attr_entry-header_output', 'elblog_entry_header_markup_open' );
function elblog_entry_header_markup_open( $output ) {

	return 'class="clearfix entry-header"' ;
}

/**
 * Change meta Info
 */
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

add_filter( 'genesis_post_info', 'elblog_post_info_filter' );
function elblog_post_info_filter($post_info) {
	$post_info = __( 'By [post_author_posts_link] on [post_date]', 'elblog' );


	return $post_info;
}

/**
 * Add sharing
 */
add_action( 'genesis_entry_header', 'elblog_add_sharing', 14 );
function elblog_add_sharing(){
	
	if( function_exists( 'sharing_display' ) ) {

		echo sharing_display();

	}

}

//Inserts ads before content
add_action( 'genesis_before_entry', 'elblog_ads_before_entry');
function elblog_ads_before_entry(){
	global $wp_query;
	global $wp_registered_sidebars;
	
	if( !is_singular( )  )
		return;

	if ( ( isset( $wp_registered_sidebars['ads-before-post'] ) && is_active_sidebar( 'ads-before-post' ) ) || has_action( 'ads-before-post' ) ) {
		genesis_markup( array(
			'html5'   => '<aside %s>',
			'xhtml'   => '<div class="ads-before-post widget-area header-widget-area">',
			'context' => 'ads-before-post',
		) );
	

			do_action( 'ads-before-post' );
			
			dynamic_sidebar( 'ads-before-post' );
		

		genesis_markup( array(
			'html5' => '</aside>',
			'xhtml' => '</div>',
		) );
	}
	
}


genesis();
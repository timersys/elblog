<?php

//remove meta everywhere except single posts

remove_action( 'genesis_entry_header', 'genesis_post_info', 12);
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

 /**
 *  Asigns class to articles and change image location after first post
 */
function be_archive_post_class( $classes ) {
	global $wp_query;

	if( 0 == $wp_query->current_post ) {
		$classes[] = 'featured-post';
		//add read more button
		
		return $classes;
	}
		
	// relocate image
	remove_action( 'genesis_entry_content', 'genesis_do_post_image' , 8);
	add_action( 'genesis_entry_header','elblog_do_image' , 8 );


	$classes[] = 'one-half';


	if( 1 == $wp_query->current_post || 1 == $wp_query->current_post % 2 )
		$classes[] = 'first';

	return $classes;
}
add_filter( 'post_class', 'be_archive_post_class' );


function elblog_do_image( ) {
	global $post;

	echo genesis_get_image( array( 'post_id' => $post->ID, 'size' => 'archives-thumb'));
}

//Add readmore to first postt
add_action( 'genesis_entry_content', 'elblog_read_more', 99);
function elblog_read_more( ) {
	global $post;
	global $wp_query;

	if( 0 == $wp_query->current_post ) {
		echo '<a href="'.get_permalink( $post->ID ).'" title="'. __('Read More', 'elblog') .'" class="button read-more">'. __('Read More', 'elblog') .'<i class="fa fa-chevron-circle-right"></i></a>';
	}	
}


genesis();
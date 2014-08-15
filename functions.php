<?php

define ('JETPACK_DEV_DEBUG', true);
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'El Blog' );
define( 'CHILD_THEME_URL', 'http://demos.timersys.com/elblog' );
define( 'CHILD_THEME_VERSION', '1.0.1' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'elblog_scripts' );
function elblog_scripts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'fontawesome', get_stylesheet_directory_uri() . '/lib/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'elblog', get_stylesheet_directory_uri() . '/lib/js/elblog.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}

// remove seo genesis

//* Remove Genesis in-post SEO Settings
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );



//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

// Add image size
add_image_size( 'archives-thumb', 390, 190, true );

// Posts excerpts
add_filter( 'excerpt_length', 'elblog_excerpt_length' );
function elblog_excerpt_length( $length ) {
	return 50; // pull first 50 words
}

//Wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'site-inner',
	'footer-widgets',
	'footer',
	'top-header'
) );

//header
include_once('lib/structure/header.php');
// footer
include_once('lib/structure/footer.php');
// loops
include_once('lib/structure/loops.php');

// tags widget
function elblog_custom_tag_cloud_widget($args) {
	$args['largest'] = 14; //largest tag
	$args['smallest'] = 14; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'elblog_custom_tag_cloud_widget' );

//add icons to widget titles
add_filter( 'dynamic_sidebar_params', 'elblog_widget_titles', 20 );
function elblog_widget_titles( $params ) {
 
        // $params will ordinarily be an array of 2 elements, we're only interested in the first element
        $widget =& $params[0];
        $widget['before_title'] = '<h4 class="widgettitle">';
        $widget['after_title'] = '<i class="fa fa-globe"></i></h4>';
 
        return $params;
        
}

/**
 * Sidebars
 */
add_action( 'init', 'elblog_unregister_footer_sidebars');
function elblog_unregister_footer_sidebars(){

	unregister_sidebar( 'footer-1' );
	unregister_sidebar( 'footer-2' );
	unregister_sidebar( 'footer-3' );

}	

genesis_register_sidebar( array(
	'id'            => 'top-header',
	'name'          => __( 'Above Header', 'elblog' ),
	'description'   => __( 'This is a widget area that can be placed before the header', 'elblog' ),
) );
genesis_register_sidebar( array(
	'id'            => 'ads-after-first-post',
	'name'          => __( 'Ads #1', 'elblog' ),
	'description'   => __( 'This is a widget area that can be used to place ads. It runs only once after the first and fith post in blog/archives/search/ mode', 'elblog' ),
) );
genesis_register_sidebar( array(
	'id'            => 'ads-after-first-post-m',
	'name'          => __( 'Ads #1 Mobile', 'elblog' ),
	'description'   => __( 'This is a widget area that can be used to place ads. It runs only once after the first and fith post in blog/archives/search/ mode only on low resolutions', 'elblog' ),
) );
genesis_register_sidebar( array(
	'id'            => 'ads-before-post',
	'name'          => __( 'Ads #2', 'elblog' ),
	'description'   => __( 'This is a widget area that can be used to place ads. It shows on single pages before content', 'elblog' ),
) );
genesis_register_sidebar( array(
	'id'            => 'ads-before-post-m',
	'name'          => __( 'Ads #2 Mobile', 'elblog' ),
	'description'   => __( 'This is a widget area that can be used to place ads. It shows on single pages before content only on low resolutions', 'elblog' ),
) );

/**
 * Disable SEO genesis
 */

remove_filter('wp_title', 'genesis_default_title', 10, 3); 
remove_action('get_header', 'genesis_doc_head_control'); 
remove_action('genesis_meta','genesis_seo_meta_description'); 
remove_action('genesis_meta','genesis_seo_meta_keywords'); 
remove_action('genesis_meta','genesis_robots_meta'); 
remove_action('wp_head','genesis_canonical'); 
add_action('wp_head', 'rel_canonical'); 

remove_action('admin_menu', 'genesis_add_inpost_seo_box'); 
remove_action('save_post', 'genesis_inpost_seo_save', 1, 2); 

remove_action('admin_init', 'genesis_add_taxonomy_seo_options'); 
remove_action('edit_term', 'genesis_term_meta_save', 10, 2); 

remove_action('show_user_profile', 'genesis_user_seo_fields'); 
remove_action('edit_user_profile', 'genesis_user_seo_fields'); 
remove_action('personal_options_update', 'genesis_user_meta_save'); 
remove_action('edit_user_profile_update', 'genesis_user_meta_save'); 

remove_theme_support('genesis-seo-settings-menu'); 
add_filter('pre_option_' . GENESIS_SEO_SETTINGS_FIELD, '__return_empty_array'); 


<?php
//unregister right header
unregister_sidebar( 'header-right' );

//* Reposition the primary navigation menu and remove wrap
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header_right', 'genesis_do_nav' );

//subnav reposition
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'top-header', 'genesis_do_subnav' );


//Register top area

add_action( 'genesis_before_header', 'elblog_top_header' );

function elblog_top_header(){

	global $wp_registered_sidebars;


	if ( ( isset( $wp_registered_sidebars['top-header'] ) && is_active_sidebar( 'top-header' ) ) || has_action( 'top-header' ) ) {
		genesis_markup( array(
			'html5'   => '<aside %s>',
			'xhtml'   => '<div class="top-header widget-area header-widget-area">',
			'context' => 'top-header',
		) );
			echo genesis_structural_wrap( 'top-header', 'open', 0 );

			do_action( 'top-header' );
			
			dynamic_sidebar( 'top-header' );
			
			echo genesis_structural_wrap( 'top-header', 'close', 0 );

		genesis_markup( array(
			'html5' => '</aside>',
			'xhtml' => '</div>',
		) );
	}
}

// Site title and single titles
add_action( 'genesis_after_header', 'elblog_site_title' );
function elblog_site_title(){
	genesis_markup( array(
			'html5'   => '<aside %s>',
			'xhtml'   => '<div class="site-title">',
			'context' => 'master-title',
		) );
			echo genesis_structural_wrap( 'site-inner', 'open', 0 );
			echo '<div class="the-title"><h1 itemprop="headline">';
			if ( is_category() ) {
			
				_e('Category:', 'elblog');?> <?php single_cat_title();
			
			}elseif( is_tag() ) {
			
				_e('Tag:', 'elblog');?> <?php single_tag_title();
			
			} elseif ( is_author()) {
			
				global $post;
				$author_id = $post->post_author;
				_e( 'Posts by:', 'elblog' ); ?> <?php the_author_meta('display_name', $author_id);
			
			} elseif (is_day()) { 
				
				_e( 'Daily archives:', 'elblog' );?> <?php the_time('l, F j, Y'); 
				

			 } elseif (is_month()) { 
				
				_e( 'Monthly archives:', 'elblog' );?> <?php the_time('F Y'); 
					

			 } elseif (is_year()) { 
					
				_e( 'Yearly Archives:', 'elblog' );?> <?php the_time('Y'); 
					
			} elseif( is_single() || is_singular() ) {
			
				the_title();
			
			} elseif( is_home() || is_front_page() ) {
				
				echo get_bloginfo('name') . __(' - Home', 'elblog');
			
			} elseif( is_search() ) {

				_e( 'Search Results for:', 'elblog' );?> <?php echo esc_attr(get_search_query());

			}

			echo '</h1></div>';
			echo genesis_structural_wrap( 'site-inner', 'close', 0 );

	genesis_markup( array(
		'html5' => '</aside>',
		'xhtml' => '</div>',
	) );
}

?>
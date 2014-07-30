<?php

add_filter( 'genesis_footer_creds_text', 'elblog_footer_creds' );
function elblog_footer_creds() {
    
	$creds_text = sprintf( '[footer_copyright before="%1$s "] &#x000B7; [footer_childtheme_link before="" after=""] with %2$s for <a href="http://blogadelgazar.com" title="Blog Adelgazar">Blog Adelgazar</a>', __( 'Copyright', 'elblog' ), '<i class="fa fa-heart" style="color:red;"></i>' );
    return $creds_text ;
}

remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );	
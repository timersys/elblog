<?php
//remove meta everywhere except single posts

	remove_action( 'genesis_entry_header', 'genesis_post_info', 12);
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


genesis();
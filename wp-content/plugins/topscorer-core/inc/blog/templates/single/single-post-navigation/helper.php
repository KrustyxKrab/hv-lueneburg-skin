<?php

if ( ! function_exists( 'topscorer_core_include_blog_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single posts page
	 */
	function topscorer_core_include_blog_single_post_navigation_template() {
		if ( is_single() ) {
			include_once 'templates/single-post-navigation.php';
		}
	}
	
	add_action( 'topscorer_action_after_blog_post_item', 'topscorer_core_include_blog_single_post_navigation_template', 20 ); // permission 20 is set to define template position
}
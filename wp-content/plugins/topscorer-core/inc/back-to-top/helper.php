<?php

if ( ! function_exists( 'topscorer_core_is_back_to_top_enabled' ) ) {
	function topscorer_core_is_back_to_top_enabled() {
		return topscorer_core_get_post_value_through_levels( 'qodef_back_to_top' ) !== 'no';
	}
}

if ( ! function_exists( 'topscorer_core_add_back_to_top_to_body_classes' ) ) {
	function topscorer_core_add_back_to_top_to_body_classes( $classes ) {
		$classes[] = topscorer_core_is_back_to_top_enabled() ? 'qodef-back-to-top--enabled' : '';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'topscorer_core_add_back_to_top_to_body_classes' );
}

if ( ! function_exists( 'topscorer_core_load_back_to_top' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function topscorer_core_load_back_to_top() {
		
		if ( topscorer_core_is_back_to_top_enabled() ) {
			$parameters = array();
			
			topscorer_core_template_part( 'back-to-top', 'templates/back-to-top', '', $parameters );
		}
	}
	
	add_action( 'topscorer_action_before_wrapper_close_tag', 'topscorer_core_load_back_to_top' );
}
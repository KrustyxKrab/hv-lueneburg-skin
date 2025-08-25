<?php

if ( ! function_exists( 'topscorer_core_add_blog_list_variation_standard' ) ) {
	function topscorer_core_add_blog_list_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_blog_list_layouts', 'topscorer_core_add_blog_list_variation_standard' );
}

if ( ! function_exists( 'topscorer_core_load_blog_list_variation_standard_assets' ) ) {
	function topscorer_core_load_blog_list_variation_standard_assets( $is_enabled, $params ) {
		
		if ( $params['layout'] === 'standard' ) {
			$is_enabled = true;
		}
		
		return $is_enabled;
	}
	
	add_filter( 'topscorer_core_filter_load_blog_list_assets', 'topscorer_core_load_blog_list_variation_standard_assets', 10, 2 );
}
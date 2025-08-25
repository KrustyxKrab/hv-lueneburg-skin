<?php

if ( ! function_exists( 'topscorer_core_add_blog_list_variation_minimal' ) ) {
	function topscorer_core_add_blog_list_variation_minimal( $variations ) {
		$variations['minimal'] = esc_html__( 'Minimal', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_blog_list_layouts', 'topscorer_core_add_blog_list_variation_minimal' );
}
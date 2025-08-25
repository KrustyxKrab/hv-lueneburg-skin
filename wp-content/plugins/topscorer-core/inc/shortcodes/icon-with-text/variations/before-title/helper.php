<?php

if ( ! function_exists( 'topscorer_core_add_icon_with_text_variation_before_title' ) ) {
	function topscorer_core_add_icon_with_text_variation_before_title( $variations ) {
		
		$variations['before-title'] = esc_html__( 'Before Title', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_icon_with_text_layouts', 'topscorer_core_add_icon_with_text_variation_before_title' );
}

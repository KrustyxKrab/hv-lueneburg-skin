<?php

if ( ! function_exists( 'topscorer_core_add_icon_with_text_variation_before_content' ) ) {
	function topscorer_core_add_icon_with_text_variation_before_content( $variations ) {
		
		$variations['before-content'] = esc_html__( 'Before Content', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_icon_with_text_layouts', 'topscorer_core_add_icon_with_text_variation_before_content' );
}

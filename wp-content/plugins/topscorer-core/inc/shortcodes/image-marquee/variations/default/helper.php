<?php

if ( ! function_exists( 'topscorer_core_add_image_marquee_variation_default' ) ) {
	function topscorer_core_add_image_marquee_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_image_marquee_layouts', 'topscorer_core_add_image_marquee_variation_default' );
}

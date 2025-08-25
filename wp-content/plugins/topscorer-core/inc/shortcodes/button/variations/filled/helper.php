<?php

if ( ! function_exists( 'topscorer_core_add_button_variation_filled' ) ) {
	function topscorer_core_add_button_variation_filled( $variations ) {
		
		$variations['filled'] = esc_html__( 'Filled', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_button_layouts', 'topscorer_core_add_button_variation_filled' );
}

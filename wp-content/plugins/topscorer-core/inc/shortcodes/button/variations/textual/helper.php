<?php

if ( ! function_exists( 'topscorer_core_add_button_variation_textual' ) ) {
	function topscorer_core_add_button_variation_textual( $variations ) {
		
		$variations['textual'] = esc_html__( 'Textual', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_button_layouts', 'topscorer_core_add_button_variation_textual' );
}

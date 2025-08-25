<?php

if ( ! function_exists( 'topscorer_core_add_countdown_variation_simple' ) ) {
	function topscorer_core_add_countdown_variation_simple( $variations ) {
		
		$variations['simple'] = esc_html__( 'Simple', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_countdown_layouts', 'topscorer_core_add_countdown_variation_simple' );
}

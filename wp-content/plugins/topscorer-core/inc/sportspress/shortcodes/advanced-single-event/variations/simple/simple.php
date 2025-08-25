<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_advanced_single_event_variation_simple' ) ) {
	function topscorer_core_sportspress_add_advanced_single_event_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_sportspress_advanced_single_event_layouts', 'topscorer_core_sportspress_add_advanced_single_event_variation_simple' );
}
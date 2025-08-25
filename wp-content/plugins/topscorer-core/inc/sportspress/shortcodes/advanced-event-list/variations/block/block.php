<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_advanced_event_list_variation_block' ) ) {
	function topscorer_core_sportspress_add_advanced_event_list_variation_block( $variations ) {
		$variations['block'] = esc_html__( 'Block', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_sportspress_advanced_event_list_layouts', 'topscorer_core_sportspress_add_advanced_event_list_variation_block' );
}
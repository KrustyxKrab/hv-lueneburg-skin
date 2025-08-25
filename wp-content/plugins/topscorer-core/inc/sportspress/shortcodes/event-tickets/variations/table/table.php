<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_event_tickets_variation_table' ) ) {
	function topscorer_core_sportspress_add_event_tickets_variation_table( $variations ) {
		$variations['table'] = esc_html__( 'Table', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_sportspress_event_tickets_layouts', 'topscorer_core_sportspress_add_event_tickets_variation_table' );
}
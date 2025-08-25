<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_advanced_player_list_variation_info_below' ) ) {
	function topscorer_core_sportspress_add_advanced_player_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_sportspress_advanced_player_list_layouts', 'topscorer_core_sportspress_add_advanced_player_list_variation_info_below' );
}
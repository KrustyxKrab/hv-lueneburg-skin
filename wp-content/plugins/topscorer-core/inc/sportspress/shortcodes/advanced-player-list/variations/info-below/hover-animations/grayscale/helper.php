<?php

if ( ! function_exists( 'topscorer_core_sportspress_advanced_player_list_info_below_grayscale' ) ) {
	function topscorer_core_sportspress_advanced_player_list_info_below_grayscale( $variations ) {
		$variations['grayscale'] = esc_html__( 'Grayscale', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_sportspress_advanced_player_list_info_below_animation_options', 'topscorer_core_sportspress_advanced_player_list_info_below_grayscale' );
}
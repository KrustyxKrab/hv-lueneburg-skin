<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_player_social_networks_variation_list' ) ) {
	function topscorer_core_sportspress_add_player_social_networks_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_sportspress_player_social_networks_layouts', 'topscorer_core_sportspress_add_player_social_networks_variation_list' );
}
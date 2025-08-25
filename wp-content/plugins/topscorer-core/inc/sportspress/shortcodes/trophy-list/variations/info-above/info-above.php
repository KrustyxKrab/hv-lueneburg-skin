<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_trophy_list_variation_info_above' ) ) {
	function topscorer_core_sportspress_add_trophy_list_variation_info_above( $variations ) {
		$variations['info-above'] = esc_html__( 'Info Above', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_sportspress_trophy_list_layouts', 'topscorer_core_sportspress_add_trophy_list_variation_info_above' );
}
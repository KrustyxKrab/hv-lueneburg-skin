<?php

if ( ! function_exists( 'topscorer_core_add_social_share_variation_list' ) ) {
	function topscorer_core_add_social_share_variation_list( $variations ) {
		
		$variations['list'] = esc_html__( 'List', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_social_share_layouts', 'topscorer_core_add_social_share_variation_list' );
}

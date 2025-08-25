<?php

if ( ! function_exists( 'topscorer_core_add_social_share_variation_dropdown' ) ) {
	function topscorer_core_add_social_share_variation_dropdown( $variations ) {
		
		$variations['dropdown'] = esc_html__( 'Dropdown', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_social_share_layouts', 'topscorer_core_add_social_share_variation_dropdown' );
}

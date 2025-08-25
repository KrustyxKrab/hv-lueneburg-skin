<?php

if ( ! function_exists( 'topscorer_core_add_banner_variation_link_button' ) ) {
	function topscorer_core_add_banner_variation_link_button( $variations ) {
		
		$variations['link-button'] = esc_html__( 'Link Button', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_banner_layouts', 'topscorer_core_add_banner_variation_link_button' );
}

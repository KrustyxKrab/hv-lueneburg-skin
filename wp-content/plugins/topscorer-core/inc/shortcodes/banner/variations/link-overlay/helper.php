<?php

if ( ! function_exists( 'topscorer_core_add_banner_variation_link_overlay' ) ) {
	function topscorer_core_add_banner_variation_link_overlay( $variations ) {
		
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_banner_layouts', 'topscorer_core_add_banner_variation_link_overlay' );
}

<?php

if ( ! function_exists( 'topscorer_core_add_clients_list_variation_image_only' ) ) {
	function topscorer_core_add_clients_list_variation_image_only( $variations ) {
		
		$variations['image-only'] = esc_html__( 'Image Only', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_clients_list_layouts', 'topscorer_core_add_clients_list_variation_image_only' );
}
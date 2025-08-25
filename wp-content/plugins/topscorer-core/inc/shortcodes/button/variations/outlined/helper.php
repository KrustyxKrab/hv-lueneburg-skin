<?php

if ( ! function_exists( 'topscorer_core_add_button_variation_outlined' ) ) {
	function topscorer_core_add_button_variation_outlined( $variations ) {
		
		$variations['outlined'] = esc_html__( 'Outlined', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_button_layouts', 'topscorer_core_add_button_variation_outlined' );
}

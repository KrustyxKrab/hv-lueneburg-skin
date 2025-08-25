<?php

if ( ! function_exists( 'topscorer_core_add_social_share_variation_text' ) ) {
	function topscorer_core_add_social_share_variation_text( $variations ) {
		
		$variations['text'] = esc_html__( 'Text', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_social_share_layouts', 'topscorer_core_add_social_share_variation_text' );
}

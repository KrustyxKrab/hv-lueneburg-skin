<?php
if ( ! function_exists( 'topscorer_core_filter_clients_list_image_only_move' ) ) {
	function topscorer_core_filter_clients_list_image_only_move( $variations ) {
		
		$variations['move'] = esc_html__( 'Move', 'topscorer-core' );
		
		return $variations;
	}
	
	add_filter( 'topscorer_core_filter_clients_list_image_only_animation_options', 'topscorer_core_filter_clients_list_image_only_move' );
}
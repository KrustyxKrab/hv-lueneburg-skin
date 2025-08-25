<?php

if ( ! function_exists( 'topscorer_core_add_fixed_header_options' ) ) {
	function topscorer_core_add_fixed_header_options( $page ) {
	
	}
	
	add_action( 'topscorer_core_action_after_header_options_map', 'topscorer_core_add_fixed_header_options' );
}
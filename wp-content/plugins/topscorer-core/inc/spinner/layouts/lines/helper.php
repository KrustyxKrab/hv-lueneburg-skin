<?php

if ( ! function_exists( 'topscorer_core_add_lines_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function topscorer_core_add_lines_spinner_layout_option( $layouts ) {
		$layouts['lines'] = esc_html__( 'Lines', 'topscorer-core' );
		
		return $layouts;
	}
	
	add_filter( 'topscorer_core_filter_page_spinner_layout_options', 'topscorer_core_add_lines_spinner_layout_option' );
}
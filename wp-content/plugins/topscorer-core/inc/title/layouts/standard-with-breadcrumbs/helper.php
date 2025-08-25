<?php

if ( ! function_exists( 'topscorer_core_register_standard_with_breadcrumbs_title_layout' ) ) {
	function topscorer_core_register_standard_with_breadcrumbs_title_layout( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = 'TopScorerCoreStandardWithBreadcrumbsTitle';
		
		return $layouts;
	}
	
	add_filter( 'topscorer_core_filter_register_title_layouts', 'topscorer_core_register_standard_with_breadcrumbs_title_layout');
}

if ( ! function_exists( 'topscorer_core_add_standard_with_breadcrumbs_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param $layouts array - module layouts
	 *
	 * @return array
	 */
	function topscorer_core_add_standard_with_breadcrumbs_title_layout_option( $layouts ) {
		$layouts['standard-with-breadcrumbs'] = esc_html__( 'Standard With Breadcrums', 'topscorer-core' );
		
		return $layouts;
	}
	
	add_filter( 'topscorer_core_filter_title_layout_options', 'topscorer_core_add_standard_with_breadcrumbs_title_layout_option' );
}


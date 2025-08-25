<?php
if ( ! function_exists( 'topscorer_core_add_blog_list_mosaic_variation_mosaic' ) ) {
	function topscorer_core_add_blog_list_mosaic_variation_mosaic( $variations ) {
		$variations['mosaic'] = esc_html__( 'Mosaic', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_blog_list_mosaic_layouts', 'topscorer_core_add_blog_list_mosaic_variation_mosaic' );
}
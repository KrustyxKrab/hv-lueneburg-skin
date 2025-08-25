<?php

if ( ! function_exists( 'topscorer_core_add_blog_list_variation_metro' ) ) {
	function topscorer_core_add_blog_list_variation_metro( $variations ) {
		$variations['metro'] = esc_html__( 'Metro', 'topscorer-core' );

		return $variations;
	}

	add_filter( 'topscorer_core_filter_blog_list_layouts', 'topscorer_core_add_blog_list_variation_metro' );
}


if ( ! function_exists( 'topscorer_core_add_additional_options_for_blog_metro' ) ) {
	function topscorer_core_add_additional_options_for_blog_metro( $options ) {
		$blog_list_metro_options = array(
			array(
				'field_type' => 'select',
				'name'       => 'enable_counter',
				'title'      => esc_html__( 'Enable Counter', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'yes_no' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values' => 'metro',
						)
					)
				),
				'group'      => esc_html__( 'Layout', 'topscorer-core' )
			),
			array(
				'field_type' => 'select',
				'name'       => 'enable_mosaic',
				'title'      => esc_html__( 'Enable Mosaic effect', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'yes_no' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values' => 'metro',
						)
					)
				),
				'group'      => esc_html__( 'Layout', 'topscorer-core' )
			)
		);


		return array_merge( $options, $blog_list_metro_options );
	}

	add_filter( 'topscorer_core_filter_blog_list_extra_options', 'topscorer_core_add_additional_options_for_blog_metro', 10, 1 );
}
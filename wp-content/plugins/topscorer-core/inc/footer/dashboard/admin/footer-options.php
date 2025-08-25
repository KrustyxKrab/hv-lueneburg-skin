<?php

if ( ! function_exists( 'topscorer_core_add_page_footer_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function topscorer_core_add_page_footer_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => TOPSCORER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'footer',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Footer', 'topscorer-core' ),
				'description' => esc_html__( 'Global settings related to page footer', 'topscorer-core' )
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_footer',
					'title'         => esc_html__( 'Enable Page Footer', 'topscorer-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page footer', 'topscorer-core' ),
					'default_value' => 'yes'
				)
			);

			$page_footer_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_footer_section',
					'title'      => esc_html__( 'Footer Area', 'topscorer-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_footer' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			// Top Footer Area Section

			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_top_footer_area',
					'title'         => esc_html__( 'Enable Top Footer Area', 'topscorer-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable top footer area', 'topscorer-core' ),
					'default_value' => 'yes'
				)
			);

			$top_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_section',
					'title'      => esc_html__( 'Top Footer Area', 'topscorer-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_top_footer_area' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_top_area_in_grid',
					'title'         => esc_html__( 'Top Footer Area In Grid', 'topscorer-core' ),
					'description'   => esc_html__( 'Enabling this option will set page top footer area to be in grid', 'topscorer-core' ),
					'default_value' => 'yes'
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_top_area_columns',
					'title'         => esc_html__( 'Top Footer Area Columns', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose number of columns for top footer area', 'topscorer-core' ),
					'options'       => topscorer_core_get_select_type_options_pool( 'columns_number', true, array( '5', '6' ) ),
					'default_value' => '4'
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_grid_gutter',
					'title'       => esc_html__( 'Top Footer Area Grid Gutter', 'topscorer-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for top footer area', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'items_space' )
				)
			);

			$top_footer_area_styles_section = $top_footer_area_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_styles_section',
					'title'      => esc_html__( 'Top Footer Area Styles', 'topscorer-core' )
				)
			);

			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'topscorer-core' )
				)
			);

			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_top_footer_area_background_image',
					'title'      => esc_html__( 'Background Image', 'topscorer-core' )
				)
			);

			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'topscorer-core' )
				)
			);

			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'topscorer-core' ),
					'args'       => array(
						'suffix' => 'px'
					)
				)
			);

			// Bottom Footer Area Section

			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_bottom_footer_area',
					'title'         => esc_html__( 'Enable Bottom Footer Area', 'topscorer-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable bottom footer area', 'topscorer-core' ),
					'default_value' => 'yes'
				)
			);

			$bottom_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_section',
					'title'      => esc_html__( 'Bottom Footer Area', 'topscorer-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_bottom_footer_area' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_bottom_area_in_grid',
					'title'         => esc_html__( 'Bottom Footer Area In Grid', 'topscorer-core' ),
					'description'   => esc_html__( 'Enabling this option will set page bottom footer area to be in grid', 'topscorer-core' ),
					'default_value' => 'yes'
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_bottom_area_columns',
					'title'         => esc_html__( 'Bottom Footer Area Columns', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose number of columns for bottom footer area', 'topscorer-core' ),
					'options'       => topscorer_core_get_select_type_options_pool( 'columns_number', true, array( '4', '5', '6' ) ),
					'default_value' => '2'
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter',
					'title'       => esc_html__( 'Bottom Footer Area Grid Gutter', 'topscorer-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for bottom footer area', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'items_space' )
				)
			);

			$bottom_footer_area_styles_section = $bottom_footer_area_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_styles_section',
					'title'      => esc_html__( 'Bottom Footer Area Styles', 'topscorer-core' )
				)
			);

			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'topscorer-core' )
				)
			);

			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'topscorer-core' )
				)
			);

			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'topscorer-core' ),
					'args'       => array(
						'suffix' => 'px'
					)
				)
			);

			// Hook to include additional options after module options
			do_action( 'topscorer_core_action_after_page_footer_options_map', $page );
		}
	}

	add_action( 'topscorer_core_action_default_options_init', 'topscorer_core_add_page_footer_options', topscorer_core_get_admin_options_map_position( 'footer' ) );
}
<?php

if ( ! function_exists( 'topscorer_core_add_standard_header_meta' ) ) {
	function topscorer_core_add_standard_header_meta( $page ) {
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_standard_header_section',
				'title'      => esc_html__( 'Standard Header', 'topscorer-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'standard',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_standard_header_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'topscorer-core' ),
				'description' => esc_html__( 'Set content to be in grid', 'topscorer-core' ),
				'default_value' => '',
				'options'       => topscorer_core_get_select_type_options_pool( 'no_yes' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'topscorer-core' ),
				'description' => esc_html__( 'Enter header height', 'topscorer-core' ),
				'args'        => array(
					'suffix' => 'px'
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'topscorer-core' ),
				'description' => esc_html__( 'Enter header background color', 'topscorer-core' )
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'topscorer-core' ),
				'default_value' => '',
				'options'       => array(
					''       => esc_html__( 'Default', 'topscorer-core' ),
					'left'   => esc_html__( 'Left', 'topscorer-core' ),
					'center' => esc_html__( 'Center', 'topscorer-core' ),
					'right'  => esc_html__( 'Right', 'topscorer-core' ),
				)
			)
		);

	}
	
	add_action( 'topscorer_core_action_after_page_header_meta_map', 'topscorer_core_add_standard_header_meta' );
}
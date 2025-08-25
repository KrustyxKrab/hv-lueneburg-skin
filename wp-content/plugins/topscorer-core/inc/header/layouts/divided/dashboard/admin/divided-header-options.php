<?php

if ( ! function_exists( 'topscorer_core_add_divided_header_options' ) ) {
	function topscorer_core_add_divided_header_options( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_divided_header_section',
				'title'      => esc_html__( 'Divided Header', 'topscorer-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'divided',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_divided_header_height',
				'title'       => esc_html__( 'Header Height', 'topscorer-core' ),
				'description' => esc_html__( 'Enter header height', 'topscorer-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'topscorer-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_divided_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'topscorer-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'topscorer-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'topscorer-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_divided_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'topscorer-core' ),
				'description' => esc_html__( 'Enter header background color', 'topscorer-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'topscorer-core' )
				)
			)
		);

	}
	
	add_action( 'topscorer_core_action_after_header_options_map', 'topscorer_core_add_divided_header_options', 10, 2 );
}
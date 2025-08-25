<?php

if ( ! function_exists( 'topscorer_core_add_minimal_header_meta' ) ) {
	function topscorer_core_add_minimal_header_meta( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_header_section',
				'title'      => esc_html__( 'Minimal Header', 'topscorer-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_minimal_header_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'topscorer-core' ),
				'description' => esc_html__( 'Set content to be in grid', 'topscorer-core' ),
				'default_value' => '',
				'options'       => topscorer_core_get_select_type_options_pool( 'no_yes' )
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_header_height',
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
				'name'        => 'qodef_minimal_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'topscorer-core' ),
				'description' => esc_html__( 'Enter header background color', 'topscorer-core' ),
				'args'        => array(
					'suffix' => 'px'
				)
			)
		);

	}
	
	add_action( 'topscorer_core_action_after_page_header_meta_map', 'topscorer_core_add_minimal_header_meta' );
}
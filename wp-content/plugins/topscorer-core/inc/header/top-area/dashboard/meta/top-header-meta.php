<?php
if ( ! function_exists( 'topscorer_core_add_top_area_meta_options' ) ) {
	function topscorer_core_add_top_area_meta_options($page){
		$top_area_section = $page->add_section_element(
			array(
				'name' => 'qodef_top_area_section',
				'title' => esc_html__('Top Area', 'topscorer-core'),
				'dependency' => array(
					'hide' => array(
						'qodef_header_layout' => array(
							'values' => topscorer_core_dependency_for_top_area_options(),
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$top_area_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_top_area_header',
				'title'       => esc_html__( 'Top Area', 'topscorer-core' ),
				'description' => esc_html__( 'Enable Top Area', 'topscorer-core' ),
				'options'     => topscorer_core_get_select_type_options_pool( 'yes_no' )
			)
		);
		
		$top_area_options_section = $top_area_section->add_section_element(
			array(
				'name'        => 'qodef_top_area_options_section',
				'title'       => esc_html__( 'Top Area Options', 'topscorer-core' ),
				'description' => esc_html__( 'Set desired values for top area', 'topscorer-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_top_area_header' => array(
							'values' => 'yes',
							'default_value' => 'no'
						)
					)
				)
			)
		);
		
		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_top_area_header_background_color',
				'title'       => esc_html__( 'Top Area Background Color', 'topscorer-core' ),
				'description' => esc_html__( 'Choose top area background color', 'topscorer-core' )
			)
		);
		
		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_height',
				'title'       => esc_html__( 'Top Area Height', 'topscorer-core' ),
				'description' => esc_html__( 'Enter top area height (Default is 40px)', 'topscorer-core' ),
				'args'        => array(
					'suffix'    => 'px'
				)
			)
		);
		
		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_side_padding',
				'title'       => esc_html__( 'Top Area Side Padding', 'topscorer-core' ),
				'args'        => array(
					'suffix'    => esc_html__( 'px or %', 'topscorer-core' )
				)
			)
		);
	}
	
	add_action( 'topscorer_core_action_after_page_header_meta_map', 'topscorer_core_add_top_area_meta_options' );
}
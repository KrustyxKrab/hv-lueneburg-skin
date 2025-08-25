<?php

if ( ! function_exists( 'topscorer_core_add_page_spinner_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function topscorer_core_add_page_spinner_options( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_spinner',
					'title'         => esc_html__( 'Enable Page Spinner', 'topscorer-core' ),
					'description'   => esc_html__( 'Enable Page Spinner Effect', 'topscorer-core' ),
					'default_value' => 'no'
				)
			);
			
			$spinner_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_spinner_section',
					'title'      => esc_html__( 'Page Spinner Section', 'topscorer-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_page_spinner' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					)
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_spinner_type',
					'title'         => esc_html__( 'Select Page Spinner Type', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose a page spinner animation style', 'topscorer-core' ),
					'options'       => apply_filters( 'topscorer_core_filter_page_spinner_layout_options', array() ),
					'default_value' => apply_filters( 'topscorer_core_filter_page_spinner_default_layout_option', '' ),
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_background_color',
					'title'       => esc_html__( 'Spinner Background Color', 'topscorer-core' ),
					'description' => esc_html__( 'Choose the spinner background color', 'topscorer-core' )
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_color',
					'title'       => esc_html__( 'Spinner Color', 'topscorer-core' ),
					'description' => esc_html__( 'Choose the spinner color', 'topscorer-core' )
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_page_spinner_text',
					'title'         => esc_html__( 'Spinner Text', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose the spinner text', 'topscorer-core' ),
					'default_value' => 'Loading...',
					'dependency'    => array(
						'show' => array(
							'qodef_page_spinner_type' => array(
								'values'        => 'predefined',
								'default_value' => 'no'
							)
						)
					)
				
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_page_spinner_background_image',
					'title'         => esc_html__( 'Background Image', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose the spinner background image', 'topscorer-core' ),
					'default_value' => '',
					'dependency'    => array(
						'show' => array(
							'qodef_page_spinner_type' => array(
								'values'        => 'predefined',
								'default_value' => 'no'
							)
						)
					)
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_page_spinner_fade_out_animation',
					'title'         => esc_html__( 'Enable Fade Out Animation', 'topscorer-core' ),
					'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'topscorer-core' ),
					'default_value' => 'no',
				)
			);
		}
	}
	
	add_action( 'topscorer_core_action_after_general_options_map', 'topscorer_core_add_page_spinner_options' );
}
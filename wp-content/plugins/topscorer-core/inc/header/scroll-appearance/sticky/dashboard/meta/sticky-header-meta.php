<?php

if ( ! function_exists( 'topscorer_core_add_sticky_header_meta_options' ) ) {
	/**
	 * Function that add additional meta box options for current module
	 *
	 * @param object $section
	 * @param array $custom_sidebars
	 */
	function topscorer_core_add_sticky_header_meta_options( $section, $custom_sidebars ) {

		if ( $section ) {

			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_header_scroll_amount',
					'title'       => esc_html__( 'Sticky Scroll Amount', 'topscorer-core' ),
					'description' => esc_html__( 'Enter scroll amount for sticky header to appear', 'topscorer-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'topscorer-core' )
					),
					'dependency'  => array(
						'show' => array(
							'qodef_header_scroll_appearance' => array(
								'values'        => 'sticky',
								'default_value' => ''
							)
						)
					)
				)
			);

			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_header_side_padding',
					'title'       => esc_html__( 'Sticky Header Side Padding', 'topscorer-core' ),
					'description' => esc_html__( 'Enter side padding for sticky header area', 'topscorer-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'topscorer-core' )
					),
					'dependency'  => array(
						'show' => array(
							'qodef_header_scroll_appearance' => array(
								'values'        => 'sticky',
								'default_value' => ''
							)
						)
					)
				)
			);

			$section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_sticky_header_background_color',
					'title'       => esc_html__( 'Sticky Header Background Color', 'topscorer-core' ),
					'description' => esc_html__( 'Enter sticky header background color', 'topscorer-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_header_scroll_appearance' => array(
								'values'        => 'sticky',
								'default_value' => ''
							)
						)
					)
				)
			);

			$section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_sticky_header_custom_widget_area_one',
					'title'       => esc_html__( 'Choose Custom Sticky Header Widget Area', 'topscorer-core' ),
					'description' => esc_html__( 'Choose custom widget area to display in sticky header widget area', 'topscorer-core' ),
					'options'     => $custom_sidebars,
					'dependency'  => array(
						'show' => array(
							'qodef_header_scroll_appearance' => array(
								'values'        => 'sticky',
								'default_value' => ''
							)
						)
					)
				)
			);
		}
	}

	add_action( 'topscorer_core_action_after_header_scroll_appearance_meta_options_map', 'topscorer_core_add_sticky_header_meta_options', 10, 2 );
}

if ( ! function_exists( 'topscorer_core_add_sticky_header_logo_meta_options' ) ) {
	/**
	 * Function that add additional header logo meta box options
	 *
	 * @param object $logo_tab
	 * @param array $header_logo_section
	 */
	function topscorer_core_add_sticky_header_logo_meta_options( $logo_tab, $header_logo_section ) {

		if ( $header_logo_section ) {

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_sticky',
					'title'       => esc_html__( 'Logo - Sticky', 'topscorer-core' ),
					'description' => esc_html__( 'Choose sticky logo image', 'topscorer-core' ),
					'multiple'    => 'no'
				)
			);
		}
	}

	add_action( 'topscorer_core_action_after_page_logo_meta_map', 'topscorer_core_add_sticky_header_logo_meta_options', 10, 2 );
}
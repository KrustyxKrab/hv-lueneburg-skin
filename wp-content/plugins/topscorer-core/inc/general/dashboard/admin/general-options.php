<?php

if ( ! function_exists( 'topscorer_core_add_general_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function topscorer_core_add_general_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_color',
					'title'       => esc_html__( 'Main Color', 'topscorer-core' ),
					'description' => esc_html__( 'Choose the most dominant theme color', 'topscorer-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_background_color',
					'title'       => esc_html__( 'Page Background Color', 'topscorer-core' ),
					'description' => esc_html__( 'Set a background color for this website', 'topscorer-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_background_image',
					'title'       => esc_html__( 'Page Background Image', 'topscorer-core' ),
					'description' => esc_html__( 'Set Background Image for Website', 'topscorer-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_repeat',
					'title'       => esc_html__( 'Page Background Repeat', 'topscorer-core' ),
					'description' => esc_html__( 'Set Background Repeat for Website', 'topscorer-core' ),
					'options'     => array(
						''          => esc_html__( 'Default', 'topscorer-core' ),
						'no-repeat' => esc_html__( 'No Repeat', 'topscorer-core' ),
						'repeat'    => esc_html__( 'Repeat', 'topscorer-core' ),
						'repeat-x'  => esc_html__( 'Repeat-x', 'topscorer-core' ),
						'repeat-y'  => esc_html__( 'Repeat-y', 'topscorer-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_size',
					'title'       => esc_html__( 'Page Background Size', 'topscorer-core' ),
					'description' => esc_html__( 'Set Background Size for Website', 'topscorer-core' ),
					'options'     => array(
						''        => esc_html__( 'Default', 'topscorer-core' ),
						'contain' => esc_html__( 'Contain', 'topscorer-core' ),
						'cover'   => esc_html__( 'Cover', 'topscorer-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_background_attachment',
					'title'       => esc_html__( 'Page Background Attachment', 'topscorer-core' ),
					'description' => esc_html__( 'Set Background Attachment for Website', 'topscorer-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'topscorer-core' ),
						'fixed'  => esc_html__( 'Fixed', 'topscorer-core' ),
						'scroll' => esc_html__( 'Scroll', 'topscorer-core' )
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding',
					'title'       => esc_html__( 'Page Content Padding', 'topscorer-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'topscorer-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding_mobile',
					'title'       => esc_html__( 'Page Content Padding Mobile', 'topscorer-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'topscorer-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_boxed',
					'title'         => esc_html__( 'Boxed Layout', 'topscorer-core' ),
					'description'   => esc_html__( 'Set Boxed Layout', 'topscorer-core' ),
					'default_value' => 'no'
				)
			);

			$boxed_section = $page->add_section_element(
				array(
					'name'       => 'qodef_boxed_section',
					'title'      => esc_html__( 'Boxed Layout Section', 'topscorer-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_boxed' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$boxed_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_boxed_background_color',
					'title'       => esc_html__( 'Boxed Background Color', 'topscorer-core' ),
					'description' => esc_html__( 'Set Boxed Background Color', 'topscorer-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_passepartout',
					'title'         => esc_html__( 'Passepartout', 'topscorer-core' ),
					'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'topscorer-core' ),
					'default_value' => 'no'
				)
			);

			$passepartout_section = $page->add_section_element(
				array(
					'name'       => 'qodef_passepartout_section',
					'title'      => esc_html__( 'Passepartout Section', 'topscorer-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_passepartout' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_passepartout_color',
					'title'       => esc_html__( 'Passepartout Color', 'topscorer-core' ),
					'description' => esc_html__( 'Choose background color for passepartout', 'topscorer-core' )
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_passepartout_image',
					'title'       => esc_html__( 'Passepartout Background Image', 'topscorer-core' ),
					'description' => esc_html__( 'Set background image for passepartout', 'topscorer-core' )
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size',
					'title'       => esc_html__( 'Passepartout Size', 'topscorer-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout', 'topscorer-core' ),
					'args'        => array(
						'suffix' => 'px or %'
					)
				)
			);

			$passepartout_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_passepartout_size_responsive',
					'title'       => esc_html__( 'Passepartout Responsive Size', 'topscorer-core' ),
					'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'topscorer-core' ),
					'args'        => array(
						'suffix' => 'px or %'
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_width',
					'title'         => esc_html__( 'Initial Width of Content', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'topscorer-core' ),
					'options'       => topscorer_core_get_select_type_options_pool( 'content_width', false ),
					'default_value' => '1100'
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_custom_js',
					'title'       => esc_html__( 'Custom JS', 'topscorer-core' ),
					'description' => esc_html__( 'Enter your custom Javascript here', 'topscorer-core' )
				)
			);

			// Hook to include additional options after module options
			do_action( 'topscorer_core_action_after_general_options_map', $page );
		}
	}

	add_action( 'topscorer_core_action_default_options_init', 'topscorer_core_add_general_options', topscorer_core_get_admin_options_map_position( 'general' ) );
}
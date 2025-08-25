<?php

if ( ! function_exists( 'topscorer_core_add_page_header_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function topscorer_core_add_page_header_meta_box( $page ) {

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array (
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Settings', 'topscorer-core' ),
					'description' => esc_html__( 'Header layout settings', 'topscorer-core' ),
				)
			);

			$header_tab->add_field_element(
				array (
					'field_type'  => 'select',
					'name'        => 'qodef_header_layout',
					'title'       => esc_html__( 'Header Layout', 'topscorer-core' ),
					'description' => esc_html__( 'Choose header layout to set for your site', 'topscorer-core' ),
					'args'        => array ( 'images' => true ),
					'options'     => topscorer_core_header_radio_to_select_options( apply_filters( 'topscorer_core_filter_header_layout_option', $header_layout_options = array() ) ),
				)
			);

			$header_tab->add_field_element(
				array (
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'topscorer-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'topscorer-core' ),
					'options'     => array (
						''      => esc_html__( 'Default', 'topscorer-core' ),
						'none'  => esc_html__( 'None', 'topscorer-core' ),
						'light' => esc_html__( 'Light', 'topscorer-core' ),
						'dark'  => esc_html__( 'Dark', 'topscorer-core' ),
					),
				)
			);

			$header_tab->add_field_element(
				array (
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_header_widget_areas',
					'title'         => esc_html__( 'Show Header Widget Areas', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose if you want to show or hide header widget areas', 'topscorer-core' ),
					'default_value' => 'yes',
				)
			);

			$header_tab->add_field_element(
				array (
					'field_type'    => 'yesno',
					'name'          => 'qodef_logo_covers_top_bar',
					'title'         => esc_html__( 'Logo Covers Top Bar', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose if you want to logo cover top bar', 'topscorer-core' ),
					'dependency'    => array (
						'show' => array (
							'qodef_header_layout' => array (
								'values'        => 'divided',
								'default_value' => '',
							),

						),
					),
					'default_value' => 'no',
				)
			);
			$header_tab->add_field_element(
				array (
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_banner_before_header',
					'title'         => esc_html__( 'Show Banner Before Header', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose if you want to show or hide banner before header', 'topscorer-core' ),
					'default_value' => 'no',
				)
			);

			$banner_section = $header_tab->add_section_element(
				array (
					'name'       => 'qodef_header_banner_area_section',
					'dependency' => array (
						'hide' => array (
							'qodef_show_banner_before_header' => array (
								'values'        => 'no',
								'default_value' => 'no',
							),
						),
					),
				)
			);

			$banner_section->add_field_element(
				array (
					'field_type'  => 'image',
					'name'        => 'qodef_banner_image',
					'title'       => esc_html__( 'Banner Image', 'topscorer-core' ),
					'description' => esc_html__( 'Set banner image ', 'topscorer-core' ),
				)
			);

			$banner_section->add_field_element(
				array (
					'field_type'  => 'text',
					'name'        => 'qodef_banner_link',
					'title'       => esc_html__( 'Banner Link', 'topscorer-core' ),
					'description' => esc_html__( 'Set banner link', 'topscorer-core' ),
				)
			);

			$banner_section->add_field_element(
				array (
					'field_type'  => 'text',
					'name'        => 'qodef_page_banner_height',
					'title'       => esc_html__( 'Height', 'topscorer-core' ),
					'description' => esc_html__( 'Enter banner height', 'topscorer-core' ),
					'args'        => array (
						'suffix' => 'px',
					),
				)
			);

			$custom_sidebars = topscorer_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {

				$section = $header_tab->add_section_element(
					array (
						'name'       => 'qodef_header_custom_widget_area_section',
						'dependency' => array (
							'show' => array (
								'qodef_show_header_widget_areas' => array (
									'values'        => 'yes',
									'default_value' => 'yes',
								),
							),
						),
					)
				);
				$section->add_field_element(
					array (
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_one',
						'title'       => esc_html__( 'Choose Custom Header Widget Area One', 'topscorer-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'topscorer-core' ),
						'options'     => $custom_sidebars,
					)
				);
				$section->add_field_element(
					array (
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_two',
						'title'       => esc_html__( 'Choose Custom Header Widget Area Two', 'topscorer-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'topscorer-core' ),
						'options'     => $custom_sidebars,
					)
				);

				// Hook to include additional options after module options
				do_action( 'topscorer_core_action_after_custom_widget_area_header_meta_map', $section, $custom_sidebars );
			}

			// Hook to include additional options after module options

			do_action( 'topscorer_core_action_after_page_header_meta_map', $header_tab, $custom_sidebars );
		}
	}

	add_action( 'topscorer_core_action_after_general_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
	add_action( 'topscorer_core_action_after_portfolio_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
	add_action( 'topscorer_core_action_after_sportspress_player_single_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
	add_action( 'topscorer_core_action_after_sportspress_team_single_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
	add_action( 'topscorer_core_action_after_sportspress_event_single_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
	add_action( 'topscorer_core_action_after_sportspress_league_single_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
	add_action( 'topscorer_core_action_after_sportspress_player_list_single_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
	add_action( 'topscorer_core_action_after_sportspress_staff_single_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
	add_action( 'topscorer_core_action_after_sportspress_official_single_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
	add_action( 'topscorer_core_action_after_sportspress_calendar_single_meta_box_map', 'topscorer_core_add_page_header_meta_box' );
}
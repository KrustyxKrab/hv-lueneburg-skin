<?php

if ( ! function_exists( 'topscorer_core_add_sportspress_league_single_sidebar_meta_boxes' ) ) {
	/**
	 * function that add sidebar meta boxes for sportspress league single module
	 */
	function topscorer_core_add_sportspress_league_single_sidebar_meta_boxes( $page ) {
		if ( $page ) {

			$sidebar_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-sidebar',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Sidebar Settings', 'topscorer-core' ),
					'description' => esc_html__( 'League sidebar settings', 'topscorer-core' )
				)
			);

			$sidebar_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_sportspress_league_single_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for league singles', 'topscorer-core' ),
					'default_value' => 'no-sidebar',
					'options'       => topscorer_core_get_select_type_options_pool( 'sidebar_layouts' )
				)
			);

			$custom_sidebars = topscorer_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$sidebar_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_sportspress_league_single_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'topscorer-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on league singles', 'topscorer-core' ),
						'options'     => $custom_sidebars
					)
				);
			}

			$sidebar_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_sportspress_league_single_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'topscorer-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'items_space' )
				)
			);
		}
	}

	add_action( 'topscorer_core_action_after_sportspress_league_single_meta_box_map', 'topscorer_core_add_sportspress_league_single_sidebar_meta_boxes' );
}
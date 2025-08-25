<?php

if ( ! function_exists( 'topscorer_core_add_page_logo_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function topscorer_core_add_page_logo_meta_box( $page ) {

		if ( $page ) {

			$logo_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-logo',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Logo Settings', 'topscorer-core' ),
					'description' => esc_html__( 'Logo settings', 'topscorer-core' )
				)
			);

			$header_logo_section = $logo_tab->add_section_element(
				array(
					'name'  => 'qodef_header_logo_section',
					'title' => esc_html__( 'Header Logo Options', 'topscorer-core' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'topscorer-core' ),
					'description' => esc_html__( 'Enter Logo Height', 'topscorer-core' ),
					'args'        => array(
						'suffix' => 'px'
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_main',
					'title'       => esc_html__( 'Logo - Main', 'topscorer-core' ),
					'description' => esc_html__( 'Choose main logo image', 'topscorer-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'topscorer-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'topscorer-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'topscorer-core' ),
					'description' => esc_html__( 'Choose light logo image', 'topscorer-core' ),
					'multiple'    => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'topscorer_core_action_after_page_logo_meta_map', $logo_tab, $header_logo_section );
		}
	}

	add_action( 'topscorer_core_action_after_general_meta_box_map', 'topscorer_core_add_page_logo_meta_box' );
	add_action( 'topscorer_core_action_after_portfolio_meta_box_map', 'topscorer_core_add_page_logo_meta_box' );
}
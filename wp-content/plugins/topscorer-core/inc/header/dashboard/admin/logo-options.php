<?php

if ( ! function_exists( 'topscorer_core_add_logo_options' ) ) {
	function topscorer_core_add_logo_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => TOPSCORER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'logo',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Logo', 'topscorer-core' ),
				'description' => esc_html__( 'Logo Settings', 'topscorer-core' ),
				'layout'      => 'tabbed'
			)
		);
		
		if ( $page ) {
			
			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Logo Options', 'topscorer-core' ),
					'description' => esc_html__( 'Set options for initial headers', 'topscorer-core' )
				)
			);
			
			$header_tab->add_field_element(
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
			
			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_main',
					'title'         => esc_html__( 'Logo - Main', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose main logo image', 'topscorer-core' ),
					'default_value' => defined( 'TOPSCORER_ASSETS_ROOT' ) ? TOPSCORER_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'      => 'no'
				)
			);
			
			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'topscorer-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'topscorer-core' ),
					'multiple'    => 'no'
				)
			);
			
			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'topscorer-core' ),
					'description' => esc_html__( 'Choose light logo image', 'topscorer-core' ),
					'multiple'    => 'no'
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'topscorer_core_action_after_header_logo_options_map', $page, $header_tab );
		}
	}
	
	add_action( 'topscorer_core_action_default_options_init', 'topscorer_core_add_logo_options', topscorer_core_get_admin_options_map_position( 'logo' ) );
}
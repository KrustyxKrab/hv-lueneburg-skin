<?php

if ( ! function_exists( 'topscorer_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function topscorer_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => TOPSCORER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'topscorer-core' ),
				'description' => esc_html__( 'General Fonts Options', 'topscorer-core' ),
				'icon'        => 'fa fa-cog'
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'topscorer-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts'
					)
				)
			);
			
			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'topscorer-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts To Include', 'topscorer-core' ),
					'description' => esc_html__( 'Choose google fonts which you want to use on your website', 'topscorer-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'topscorer-core' )
				)
			);
			
			$page_repeater->add_field_element( array(
				'field_type'  => 'googlefont',
				'name'        => 'qodef_choose_google_font',
				'title'       => esc_html__( 'Google Font', 'topscorer-core' ),
				'description' => esc_html__( 'Choose google font', 'topscorer-core' ),
				'args'        => array(
					'include' => 'google-fonts'
				)
			) );
			
			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Style & Weight', 'topscorer-core' ),
					'description' => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'topscorer-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'topscorer-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'topscorer-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'topscorer-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'topscorer-core' ),
						'300'  => esc_html__( '300 Light', 'topscorer-core' ),
						'300i' => esc_html__( '300 Light Italic', 'topscorer-core' ),
						'400'  => esc_html__( '400 Regular', 'topscorer-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'topscorer-core' ),
						'500'  => esc_html__( '500 Medium', 'topscorer-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'topscorer-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'topscorer-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'topscorer-core' ),
						'700'  => esc_html__( '700 Bold', 'topscorer-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'topscorer-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'topscorer-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'topscorer-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'topscorer-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'topscorer-core' )
					)
				)
			);
			
			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style & Weight', 'topscorer-core' ),
					'description' => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'topscorer-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'topscorer-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'topscorer-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'topscorer-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'topscorer-core' ),
						'greek'        => esc_html__( 'Greek', 'topscorer-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'topscorer-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'topscorer-core' )
					)
				)
			);
			
			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'topscorer-core' ),
					'description' => esc_html__( 'Add Custom Fonts', 'topscorer-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'topscorer-core' )
				)
			);
			
			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_ttf',
				'title'      => esc_html__( 'Custom Font TTF', 'topscorer-core' ),
				'args'       => array(
					'allowed_type' => 'font/ttf'
				)
			) );
			
			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_otf',
				'title'      => esc_html__( 'Custom Font OTF', 'topscorer-core' ),
				'args'       => array(
					'allowed_type' => 'font/otf'
				)
			) );
			
			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff',
				'title'      => esc_html__( 'Custom Font WOFF', 'topscorer-core' ),
				'args'       => array(
					'allowed_type' => 'font/woff'
				)
			) );
			
			$page_repeater->add_field_element( array(
				'field_type' => 'file',
				'name'       => 'qodef_custom_font_woff2',
				'title'      => esc_html__( 'Custom Font WOFF2', 'topscorer-core' ),
				'args'       => array(
					'allowed_type' => 'font/woff2'
				)
			) );
			
			$page_repeater->add_field_element( array(
				'field_type' => 'text',
				'name'       => 'qodef_custom_font_name',
				'title'      => esc_html__( 'Custom Font Name', 'topscorer-core' ),
			) );
			
			// Hook to include additional options after module options
			do_action( 'topscorer_core_action_after_page_fonts_options_map', $page );
		}
	}
	
	add_action( 'topscorer_core_action_default_options_init', 'topscorer_core_add_fonts_options', topscorer_core_get_admin_options_map_position( 'fonts' ) );
}
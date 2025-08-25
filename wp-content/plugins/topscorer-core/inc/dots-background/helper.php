<?php

// row

if ( ! function_exists( 'topscorer_core_vc_row_background_dots' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function topscorer_core_vc_row_background_dots() {

		/******* VC Row shortcode - begin *******/

		//Background text options

		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'enable_dots_background',
				'heading'    => esc_html__( 'Enable Background Dots', 'topscorer-core' ),
				'value'      => array(
					esc_html__( 'Default', 'topscorer-core' ) => '',
					esc_html__( 'Yes', 'topscorer-core' )     => 'yes',
					esc_html__( 'No', 'topscorer-core' )      => 'no'
				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' )
			)
		);
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_dots_align',
				'heading'    => esc_html__( 'Background Dots Align', 'topscorer-core' ),
				'value'      => array(
					esc_html__( 'Default', 'topscorer-core' )        => '',
					esc_html__( 'Left', 'topscorer-core' )           => 'left',
					esc_html__( 'Center', 'topscorer-core' )         => 'center',
					esc_html__( 'Right', 'topscorer-core' )          => 'right',
					esc_html__( 'Left and Right', 'topscorer-core' ) => 'left-right'
				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' =>
					array( 'element' => 'enable_dots_background', 'value' => array( 'yes' ) )

			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_dots_skin',
				'heading'    => esc_html__( 'Background Dots Skin', 'topscorer-core' ),
				'value'      => array(
					esc_html__( 'Dark', 'topscorer-core' )  => 'dark',
					esc_html__( 'Light', 'topscorer-core' ) => 'light',

				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' =>
					array( 'element' => 'enable_dots_background', 'value' => array( 'yes' ) )

			)
		);


		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_dots_top_position',
				'heading'    => esc_html__( 'Background Dots Top Position (% or px)', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' =>
					array( 'element' => 'enable_dots_background', 'value' => array( 'yes' ) )
			)
		);

		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_dots_height',
				'heading'    => esc_html__( 'Background Dots Height (% or px)', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' =>
					array( 'element' => 'enable_dots_background', 'value' => array( 'yes' ) )
			)
		);

		/******* VC Row shortcode - end *******/

	}

	add_action( 'topscorer_core_action_additional_vc_row_params', 'topscorer_core_vc_row_background_dots' );
}

// row inner

if ( ! function_exists( 'topscorer_core_vc_row_inner_background_dots' ) ) {
	/**
	 * Map VC Row inner shortcode
	 * Hooks on vc_after_init action
	 */
	function topscorer_core_vc_row_inner_background_dots() {

		/******* VC Row Inner shortcode - begin *******/

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'enable_dots_background',
				'heading'    => esc_html__( 'Enable Background Dots', 'topscorer-core' ),
				'value'      => array(
					esc_html__( 'Default', 'topscorer-core' ) => '',
					esc_html__( 'Yes', 'topscorer-core' )     => 'yes',
					esc_html__( 'No', 'topscorer-core' )      => 'no'
				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_dots_align',
				'heading'    => esc_html__( 'Background Dots Align', 'topscorer-core' ),
				'value'      => array(
					esc_html__( 'Default', 'topscorer-core' )        => '',
					esc_html__( 'Left', 'topscorer-core' )           => 'left',
					esc_html__( 'Center', 'topscorer-core' )         => 'center',
					esc_html__( 'Right', 'topscorer-core' )          => 'right',
					esc_html__( 'Left and Right', 'topscorer-core' ) => 'left-right',
				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' =>
					array( 'element' => 'enable_dots_background', 'value' => array( 'yes' ) )


			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'background_dots_skin',
				'heading'    => esc_html__( 'Background Dots Skin', 'topscorer-core' ),
				'value'      => array(
					esc_html__( 'Dark', 'topscorer-core' )  => 'dark',
					esc_html__( 'Light', 'topscorer-core' ) => 'light',

				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' =>
					array( 'element' => 'enable_dots_background', 'value' => array( 'yes' ) )

			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_dots_top_position',
				'heading'    => esc_html__( 'Background Dots Top Position (% or px)', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' => array( 'element' => 'enable_dots_background', 'value' => array( 'yes' ) )
			)
		);

		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'textfield',
				'param_name' => 'background_dots_height',
				'heading'    => esc_html__( 'Background Dots Height (% or px)', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' =>
					array( 'element' => 'enable_dots_background', 'value' => array( 'yes' ) )
			)
		);

		/******* VC Row Inner shortcode - end *******/

	}

	add_action( 'topscorer_core_action_additional_vc_row_inner_params', 'topscorer_core_vc_row_inner_background_dots' );
}

if ( ! function_exists( 'topscorer_core_add_additional_classes_on_row_dots' ) ) {
	function topscorer_core_add_additional_classes_on_row_dots( $classes, $base, $atts ) {

		if ( $base == 'vc_row' || $base == 'vc_row_inner' ) {
			if ( $atts['enable_dots_background'] == 'yes' ) {
				$classes .= ' qodef-background-dots';
			}

			if ( $atts['background_dots_align'] != '' ) {
				$classes .= ' qodef-background-dots-position--' . $atts['background_dots_align'];
			}
			if ( $atts['background_dots_skin'] != '' ) {
				$classes .= ' qodef-background-dots-skin--' . $atts['background_dots_skin'];
			}
		}

		return $classes;
	}

	add_filter( 'vc_shortcodes_css_class', 'topscorer_core_add_additional_classes_on_row_dots', 10, 3 );
}


if ( ! function_exists( 'topscorer_core_add_background_dots' ) ) {
	function topscorer_core_add_background_dots( $html, $atts ) {

		$params = array();

		$background_dots_content_style = array();

		if ( $atts['background_dots_top_position'] != '' ) {
			$background_dots_content_style[] = 'top:' . $atts['background_dots_top_position'];
		}

		if ( $atts['background_dots_height'] != '' ) {
			$background_dots_content_style[] = 'height:' . $atts['background_dots_height'];
		}



		$params['background_dots_content_style'] = implode( '; ', $background_dots_content_style );


		if ( $atts['enable_dots_background'] === 'yes' ) {

			if ( $atts['background_dots_align'] === 'center' ) {
				$html .= topscorer_core_get_template_part( 'dots-background', 'templates/dots-background-full-width', '', $params );
			} else {
				$html .= topscorer_core_get_template_part( 'dots-background', 'templates/dots-background', '', $params );
			}

		}

		return $html;
	}

	add_filter( 'topscorer_core_filter_vc_row_after_wrapper_open', 'topscorer_core_add_background_dots', 10, 2 );
	add_filter( 'topscorer_core_filter_vc_row_inner_after_wrapper_open', 'topscorer_core_add_background_dots', 10, 2 );
}


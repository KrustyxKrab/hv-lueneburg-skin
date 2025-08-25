<?php

// row

if ( ! function_exists( 'topscorer_core_vc_row_background_text' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function topscorer_core_vc_row_background_text() {

		/******* VC Row shortcode - begin *******/

		// background text options

		vc_add_param( 'vc_row',
			array (
				'type'       => 'dropdown',
				'param_name' => 'background_text_enable',
				'heading'    => esc_html__( 'Enable Background Text', 'topscorer-core' ),
				'value'      => array (
					esc_html__( 'Default', 'topscorer-core' ) => '',
					esc_html__( 'Yes', 'topscorer-core' )     => 'yes',
					esc_html__( 'No', 'topscorer-core' )      => 'no',
				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
			)
		);

		vc_add_param( 'vc_row',
			array (
				'type'       => 'textfield',
				'param_name' => 'background_text',
				'heading'    => esc_html__( 'Background Text', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);

		vc_add_param( 'vc_row',
			array (
				'type'       => 'colorpicker',
				'param_name' => 'background_text_color',
				'heading'    => esc_html__( 'Background Text  Color', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);

		vc_add_param( 'vc_row',
			array (
				'type'        => 'textfield',
				'param_name'  => 'background_text_size',
				'heading'     => esc_html__( 'Background Text Size', 'topscorer-core' ),
				'description' => esc_html( 'Set the background text size in px or em', 'topscorer-core' ),
				'group'       => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency'  => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);

		vc_add_param( 'vc_row',
			array (
				'type'       => 'dropdown',
				'param_name' => 'background_text_align',
				'heading'    => esc_html__( 'Background Text Align', 'topscorer-core' ),
				'value'      => array (
					esc_html__( 'Default', 'topscorer-core' ) => '',
					esc_html__( 'Left', 'topscorer-core' )    => 'left',
					esc_html__( 'Center', 'topscorer-core' )  => 'center',
					esc_html__( 'Right', 'topscorer-core' )   => 'right',
				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);

		vc_add_param( 'vc_row',
			array (
				'type'       => 'textfield',
				'param_name' => 'background_text_top_position',
				'heading'    => esc_html__( 'Background Text Top', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);

		/******* VC Row shortcode - end *******/

	}

	add_action( 'topscorer_core_action_additional_vc_row_params', 'topscorer_core_vc_row_background_text' );
}

// row inner

if ( ! function_exists( 'topscorer_core_vc_row_inner_background_text' ) ) {
	/**
	 * Map VC Row inner shortcode
	 * Hooks on vc_after_init action
	 */
	function topscorer_core_vc_row_inner_background_text() {

		/******* VC Row Inner shortcode - begin *******/

		vc_add_param( 'vc_row_inner',
			array (
				'type'       => 'dropdown',
				'param_name' => 'background_text_enable',
				'heading'    => esc_html__( 'Enable Background Text', 'topscorer-core' ),
				'value'      => array (
					esc_html__( 'Default', 'topscorer-core' ) => '',
					esc_html__( 'Yes', 'topscorer-core' )     => 'yes',
					esc_html__( 'No', 'topscorer-core' )      => 'no',
				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
			)
		);

		vc_add_param( 'vc_row_inner',
			array (
				'type'       => 'textfield',
				'param_name' => 'background_text',
				'heading'    => esc_html__( 'Background Text', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);

		vc_add_param( 'vc_row_inner',
			array (
				'type'       => 'colorpicker',
				'param_name' => 'background_text_color',
				'heading'    => esc_html__( 'Background Text  Color', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);

		vc_add_param( 'vc_row_inner',
			array (
				'type'        => 'textfield',
				'param_name'  => 'background_text_size',
				'heading'     => esc_html__( 'Background Text Size', 'topscorer-core' ),
				'description' => esc_html( 'Set the background text size in px or em', 'topscorer-core' ),
				'group'       => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency'  => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);

		vc_add_param( 'vc_row_inner',
			array (
				'type'       => 'dropdown',
				'param_name' => 'background_text_align',
				'heading'    => esc_html__( 'Background Text Align', 'topscorer-core' ),
				'value'      => array (
					esc_html__( 'Default', 'topscorer-core' ) => '',
					esc_html__( 'Left', 'topscorer-core' )    => 'flex-start',
					esc_html__( 'Center', 'topscorer-core' )  => 'center',
					esc_html__( 'Right', 'topscorer-core' )   => 'flex-end',
				),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);
		vc_add_param( 'vc_row_inner',
			array (
				'type'       => 'textfield',
				'param_name' => 'background_text_top_position',
				'heading'    => esc_html__( 'Background Text Top', 'topscorer-core' ),
				'group'      => esc_html__( 'TopScorer Core Settings', 'topscorer-core' ),
				'dependency' => array ( 'element' => 'background_text_enable', 'value' => array ( 'yes' ) ),
			)
		);

		/******* VC Row Inner shortcode - end *******/

	}

	add_action( 'topscorer_core_action_additional_vc_row_inner_params', 'topscorer_core_vc_row_inner_background_text' );
}

if ( ! function_exists( 'topscorer_core_add_background_text' ) ) {
	function topscorer_core_add_background_text( $html, $atts ) {

		$params = array();

		// text
		$params[ 'text' ] = topscorer_core_get_split_text( $atts[ 'background_text' ] );

		// content style
		$background_text_content_style = array();
		if ( $atts[ 'background_text_align' ] != '' ) {
			$background_text_content_style[] = 'justify-content:' . $atts[ 'background_text_align' ];
		}
		if ( $atts[ 'background_text_top_position' ] != '' ) {
			$background_text_content_style[] = 'top:' . $atts[ 'background_text_top_position' ];
		}

		if ( $atts[ 'background_text_size' ] != '' ) {
			$background_text_content_style [] = 'font-size:' . $atts[ 'background_text_size' ];
		}
		$params[ 'background_text_content_style' ] = implode( '; ', $background_text_content_style );

		// text color style
		$background_text_style = array();
		if ( $atts[ 'background_text_color' ] != '' ) {
			$background_text_style [] = 'color:' . $atts[ 'background_text_color' ];
		}

		$params[ 'background_text_style' ] = implode( '; ', $background_text_style );

		if ( $atts[ 'background_text' ] !== '' ) {
			$html .= topscorer_core_get_template_part( 'background-text', 'templates/background-text', '', $params );
		}

		return $html;
	}

	add_filter( 'topscorer_core_filter_vc_row_after_wrapper_open', 'topscorer_core_add_background_text', 10, 2 );
	add_filter( 'topscorer_core_filter_vc_row_inner_after_wrapper_open', 'topscorer_core_add_background_text', 10, 2 );
}

if ( ! function_exists( 'str_split_unicode' ) ) {
	function str_split_unicode( $str ) {
        $str = preg_split( '~~u', $str, - 1, PREG_SPLIT_NO_EMPTY );
	    $str = str_replace(' ', '&nbsp;', $str);

		return $str;
	}
}

if ( ! function_exists( 'topscorer_core_get_split_text' ) ) {
	function topscorer_core_get_split_text( $text ) {
		if ( ! empty( $text ) ) {
			$split_text = str_split_unicode( $text );

			foreach ( $split_text as $key => $value ) {
				$split_text[ $key ] = '<span class="qodef-m-character">' . $value . '</span>';
			}

			return implode( ' ', $split_text );
		}

		return $text;
	}
}

if ( ! function_exists( 'topscorer_core_add_additional_classes_on_row_text' ) ) {
	function topscorer_core_add_additional_classes_on_row_text( $classes, $base, $atts ) {

		if ( $base == 'vc_row' || $base == 'vc_row_inner' ) {
			if ( $atts[ 'background_text_enable' ] == 'yes' ) {
				$classes .= ' qodef-background-text';
			}

			if ( $atts[ 'background_text_align' ] != '' ) {
				$classes .= ' qodef-background-text-alignment--' . $atts[ 'background_text_align' ];
			}
		}

		return $classes;
	}

	add_filter( 'vc_shortcodes_css_class', 'topscorer_core_add_additional_classes_on_row_text', 10, 3 );
}
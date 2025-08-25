<?php

if ( ! function_exists( 'topscorer_is_side_area_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 */
	function topscorer_is_side_area_enabled() {
		$is_enabled = is_active_widget( false, false, 'topscorer_core_side_area_opener' );
		
		return apply_filters( 'topscorer_filter_enable_side_area', $is_enabled );
	}
}

if ( ! function_exists( 'topscorer_core_enqueue_side_area_assets' ) ) {
	/**
	 * Function that enqueue 3rd party plugins script
	 */
	function topscorer_core_enqueue_side_area_assets() {
		
		if ( topscorer_is_side_area_enabled() ) {
			wp_enqueue_style( 'perfect-scrollbar', TOPSCORER_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.css', array() );
			wp_enqueue_script( 'perfect-scrollbar', TOPSCORER_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
		}
	}
	
	add_action( 'topscorer_core_action_before_main_css', 'topscorer_core_enqueue_side_area_assets' );
}

if ( ! function_exists( 'topscorer_core_load_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function topscorer_core_load_side_area() {

		if ( topscorer_is_side_area_enabled() ) {
			$parameters = array(
				'classes' => topscorer_core_side_area_classes()
			);

			topscorer_core_template_part( 'side-area', 'templates/side-area', '', $parameters );
		}
	}

	add_action( 'topscorer_action_before_wrapper_close_tag', 'topscorer_core_load_side_area', 10 );
}

if ( ! function_exists( 'topscorer_core_side_area_classes' ) ) {
	function topscorer_core_side_area_classes() {
		$classes = array();
		
		$alignment = topscorer_core_get_option_value( 'admin', 'qodef_side_area_alignment' );
		
		if ( ! empty( $alignment ) ) {
			$classes[] = 'qodef-content-alignment-' . $alignment;
		}
		
		return $classes;
	}
}

if ( ! function_exists( 'topscorer_core_get_side_area_config' ) ) {
	/**
	 * Function that return config variables for side area
	 *
	 * @return array
	 */
	function topscorer_core_get_side_area_config() {
		
		// Config variables
		$config = apply_filters( 'topscorer_core_filter_side_area_config', array(
			'title_tag'   => 'h4',
			'title_class' => 'qodef-widget-title'
		) );
		
		return $config;
	}
}

if ( ! function_exists( 'topscorer_core_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function topscorer_core_register_side_area_sidebar() {
		
		// Sidebar config variables
		$config = topscorer_core_get_side_area_config();
		
		register_sidebar(
			array(
				'id'            => 'qodef-side-area',
				'name'          => esc_html__( 'Side Area', 'topscorer-core' ),
				'description'   => esc_html__( 'Widgets added here will appear in side area', 'topscorer-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s" data-area="side-area">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. topscorer_core_escape_title_tag( $config['title_tag'] ) .' class="'. esc_attr( $config['title_class'] ) .'">',
				'after_title'   => '</'. topscorer_core_escape_title_tag( $config['title_tag'] ) .'>'
			)
		);
	}

	add_action( 'widgets_init', 'topscorer_core_register_side_area_sidebar' );
}

if ( ! function_exists( 'topscorer_core_include_side_area_widget' ) ) {
	/**
	 * Function that includes widgets
	 */
	function topscorer_core_include_side_area_widget() {
		foreach ( glob( TOPSCORER_CORE_INC_PATH . '/side-area/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'topscorer_core_include_side_area_widget' );
}

if ( ! function_exists( 'topscorer_core_get_side_area_icon_html' ) ) {
	/**
	 * Returns html for icon sources
	 *
	 * @param bool $is_close_icon
	 *
	 * @return string/html
	 */
	function topscorer_core_get_side_area_icon_html( $is_close_icon = false ) {
		$html = '';
		
		$icon_source         = topscorer_core_get_option_value( 'admin', 'qodef_side_area_icon_source' );
		$icon_pack           = topscorer_core_get_option_value( 'admin', 'qodef_side_area_icon_pack' );
		$icon_svg_path       = topscorer_core_get_option_value( 'admin', 'qodef_side_area_icon_svg_path' );
		$close_icon_svg_path = topscorer_core_get_option_value( 'admin', 'qodef_side_area_close_icon_svg_path' );
		
		if ( $icon_source === 'icon_pack' && ! empty( $icon_pack ) ) {
			if ( $is_close_icon ) {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'close', $icon_pack, array( 'icon_attributes' => array( 'class' => 'qodef-side-area-close-icon' ) ) );
			} else {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'menu', $icon_pack, array( 'icon_attributes' => array( 'class' => 'qodef-side-area-opener-icon' ) ) );
			}
			
		} else if ( $icon_source === 'svg_path' && ( ( isset( $icon_svg_path ) && ! empty( $icon_svg_path ) ) || ( isset( $close_icon_svg_path ) && ! empty( $close_icon_svg_path ) ) ) ) {
			
			if ( $is_close_icon ) {
				$html .= $close_icon_svg_path;
			} else {
				$html .= $icon_svg_path;
			}
			
		} else if ( $icon_source === 'predefined' ) {
			if ( $is_close_icon ) {
				$html .= topscorer_core_get_svg( 'close' );
			} else {
				$html .= topscorer_core_get_svg( 'sidearea' );
			}
		}
		
		return $html;
	}
}

if ( ! function_exists( 'topscorer_core_side_area_set_icon_styles' ) ) {
	/**
	 * Function that generates p typography styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function topscorer_core_side_area_set_icon_styles( $style ) {
		$icon_style             = array();
		$icon_hover_style       = array();
		$close_icon_style       = array();
		$close_icon_hover_style = array();
		
		$icon_color       = topscorer_core_get_option_value( 'admin', 'qodef_side_area_icon_color' );
		$icon_hover_color = topscorer_core_get_option_value( 'admin', 'qodef_side_area_icon_hover_color' );
		
		$close_icon_color       = topscorer_core_get_option_value( 'admin', 'qodef_side_area_close_icon_color' );
		$close_icon_hover_color = topscorer_core_get_option_value( 'admin', 'qodef_side_area_close_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			$icon_style['color'] = $icon_color;
		}
		
		if ( ! empty( $icon_hover_style ) ) {
			$icon_hover_color['color'] = $icon_hover_style;
		}
		
		if ( ! empty( $icon_style ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-side-area-opener', $icon_style );
		}
		
		if ( ! empty( $icon_hover_style ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-side-area-opener:hover', $icon_hover_style );
		}
		
		if ( ! empty( $close_icon_color ) ) {
			$close_icon_style['color'] = $close_icon_color;
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			$close_icon_hover_style['color'] = $close_icon_hover_color;
		}
		
		if ( ! empty( $close_icon_style ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area-close', $close_icon_style );
		}
		
		if ( ! empty( $close_icon_hover_style ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area-close:hover', $close_icon_hover_style );
		}
		
		return $style;
	}
	
	add_filter( 'topscorer_filter_add_inline_style', 'topscorer_core_side_area_set_icon_styles' );
}

if ( ! function_exists( 'topscorer_core_set_side_area_styles' ) ) {
	/**
	 * Function that generates page side area inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function topscorer_core_set_side_area_styles( $style ) {
		$side_area_styles       = array();
		$side_area_cover_styles = array();

		$side_area_background_color = topscorer_core_get_post_value_through_levels( 'qodef_side_area_background_color' );
		$side_area_width            = topscorer_core_get_post_value_through_levels( 'qodef_side_area_width' );

		$side_area_cover_background_color = topscorer_core_get_post_value_through_levels( 'qodef_side_area_content_overlay_color' );

		if ( ! empty( $side_area_background_color ) ) {
			$side_area_styles['background-color'] = $side_area_background_color;
		}

		if ( ! empty( $side_area_width ) ) {
			if ( qode_framework_string_ends_with_space_units( $side_area_width ) ) {
				$side_area_styles['width'] = $side_area_width;
				$side_area_styles['right'] = '-' . $side_area_width;
			} else {
				$side_area_styles['width'] = intval( $side_area_width ) . 'px';
				$side_area_styles['right'] = '-' . intval( $side_area_width ) . 'px';
			}
		}

		if ( ! empty( $side_area_cover_background_color ) ) {
			$side_area_cover_styles['background-color'] = $side_area_cover_background_color;
		}

		if ( ! empty( $side_area_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-side-area', $side_area_styles );
		}

		if ( ! empty( $side_area_cover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-side-area-cover', $side_area_cover_styles );
		}

		return $style;
	}

	add_filter( 'topscorer_filter_add_inline_style', 'topscorer_core_set_side_area_styles' );
}
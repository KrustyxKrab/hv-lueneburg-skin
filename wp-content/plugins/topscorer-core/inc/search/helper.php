<?php

if ( ! function_exists( 'topscorer_core_search_include_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function topscorer_core_search_include_widgets() {
		foreach ( glob( TOPSCORER_CORE_INC_PATH . '/search/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'topscorer_core_search_include_widgets' );
}

if ( ! function_exists( 'topscorer_core_search_include_layout' ) ) {
	function topscorer_core_search_include_layout() {
		$header_object = TopScorerCoreHeaders::get_instance()->get_header_object();

		if ( ! empty( $header_object ) ) {
			$search_layout = $header_object->search_layout;
			$layouts       = apply_filters( 'topscorer_core_filter_register_search_layouts', $header_layouts_option = array() );

			if ( ! empty( $layouts ) ) {
				foreach ( $layouts as $key => $value ) {
					if ( $search_layout === $key ) {
						$value::get_instance();
					}
				}
			}
		}
	}

	add_action( 'wp', 'topscorer_core_search_include_layout' );
}

if ( ! function_exists( 'topscorer_core_set_search_page_page_title' ) ) {
	/**
	 * Function that enable/disable page title area for blog single page
	 *
	 * @param $enable_page_title bool
	 *
	 * @return bool
	 */
	function topscorer_core_set_search_page_page_title( $enable_page_title ) {
		$option = topscorer_core_get_post_value_through_levels( 'qodef_search_page_enable_page_title' ) !== 'no';

		if ( is_search() && $option !== '' ) {
			$enable_page_title = $option;
		}

		return $enable_page_title;
	}

	add_filter( 'topscorer_filter_enable_page_title', 'topscorer_core_set_search_page_page_title' );
}

if ( ! function_exists( 'topscorer_core_set_search_page_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function topscorer_core_set_search_page_sidebar_layout( $layout ) {

		if ( is_search() ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_search_page_sidebar_layout' );

			if ( ! empty( $option ) ) {
				$layout = $option;
			}
		}

		return $layout;
	}

	add_filter( 'topscorer_filter_sidebar_layout', 'topscorer_core_set_search_page_sidebar_layout' );
}

if ( ! function_exists( 'topscorer_core_set_search_page_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function topscorer_core_set_search_page_custom_sidebar_name( $sidebar_name ) {

		if ( is_search() ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_search_page_custom_sidebar' );

			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}

		return $sidebar_name;
	}

	add_filter( 'topscorer_filter_sidebar_name', 'topscorer_core_set_search_page_custom_sidebar_name' );
}

if ( ! function_exists( 'topscorer_core_set_search_page_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function topscorer_core_set_search_page_sidebar_grid_gutter_classes( $classes ) {

		if ( is_search() ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_search_page_sidebar_grid_gutter' );

			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}

		return $classes;
	}

	add_filter( 'topscorer_filter_grid_gutter_classes', 'topscorer_core_set_search_page_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'topscorer_core_set_search_page_post_excerpt_length' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param $excerpt_length int
	 *
	 * @return int
	 */
	function topscorer_core_set_search_page_post_excerpt_length( $excerpt_length ) {
		$option = topscorer_core_get_post_value_through_levels( 'qodef_search_page_excerpt_number_of_characters' );

		if ( $option !== '' ) {
			$excerpt_length = $option;
		}

		return $excerpt_length;
	}

	add_filter( 'topscorer_filter_search_page_excerpt_length', 'topscorer_core_set_search_page_post_excerpt_length' );
}

if ( ! function_exists( 'topscorer_core_get_search_icon_html' ) ) {
	/**
	 * Returns html for icon sources
	 *
	 * @param bool $is_close_icon
	 *
	 * @return string/html
	 */
	function topscorer_core_get_search_icon_html( $is_close_icon = false ) {
		$html = '';

		$icon_source         = topscorer_core_get_option_value( 'admin', 'qodef_search_icon_source' );
		$icon_pack           = topscorer_core_get_option_value( 'admin', 'qodef_search_icon_pack' );
		$icon_svg_path       = topscorer_core_get_option_value( 'admin', 'qodef_search_icon_svg_path' );
		$close_icon_svg_path = topscorer_core_get_option_value( 'admin', 'qodef_search_close_icon_svg_path' );

		if ( $icon_source === 'icon_pack' && isset( $icon_pack ) ) {
			if ( $is_close_icon ) {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'close', $icon_pack );
			} else {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'search', $icon_pack );
			}
		} else if ( ( isset( $icon_svg_path ) && ! empty( $icon_svg_path ) ) || ( isset( $close_icon_svg_path ) && ! empty( $close_icon_svg_path ) ) ) {
			if ( $is_close_icon ) {
				$html .= $close_icon_svg_path;
			} else {
				$html .= $icon_svg_path;
			}
		} else if ( $icon_source === 'predefined' ) {
			if ( $is_close_icon ) {
				$html .= topscorer_core_get_svg( 'close' );
			} else {
				$html .= topscorer_core_get_svg( 'search' );
			}
		}

		return $html;
	}
}
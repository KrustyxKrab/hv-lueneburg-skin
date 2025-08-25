<?php

if ( ! function_exists( 'topscorer_core_get_fullscreen_icon_html' ) ) {
	/**
	 * Returns html for icon sources
	 *
	 * @param bool $is_close_icon
	 *
	 * @return string/html
	 */
	function topscorer_core_get_fullscreen_icon_html( $is_close_icon = false ) {
		$html = '';

		$icon_source         = topscorer_core_get_option_value( 'admin', 'qodef_fullscreen_menu_icon_source' );
		$icon_pack           = topscorer_core_get_option_value( 'admin', 'qodef_fullscreen_menu_icon_pack' );
		$icon_svg_path       = topscorer_core_get_option_value( 'admin', 'qodef_fullscreen_menu_icon_svg_path' );
		$close_icon_svg_path = topscorer_core_get_option_value( 'admin', 'qodef_fullscreen_menu_close_icon_svg_path' );


		if ( $icon_source === 'icon_pack' && ! empty( $icon_pack ) ) {
			if ( $is_close_icon ) {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'close', $icon_pack );

			} else {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'menu', $icon_pack );
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

if ( ! function_exists( 'topscorer_core_register_fullscreen_menu' ) ) {
	function topscorer_core_register_fullscreen_menu( $menus ) {

		$menus['fullscreen-menu-navigation'] = esc_html__( 'Fullscreen Navigation', 'topscorer-core' );

		return $menus;
	}

	add_filter( 'topscorer_filter_register_navigation_menus', 'topscorer_core_register_fullscreen_menu' );
}
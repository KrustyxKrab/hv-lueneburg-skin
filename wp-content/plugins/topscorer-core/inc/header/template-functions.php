<?php

if ( ! function_exists( 'topscorer_core_get_header_logo_image' ) ) {
	function topscorer_core_get_header_logo_image() {
		$logo_height         = topscorer_core_get_post_value_through_levels( 'qodef_logo_height' );
		$logo_main_image_id  = topscorer_core_get_post_value_through_levels( 'qodef_logo_main' );
		$logo_dark_image_id  = topscorer_core_get_post_value_through_levels( 'qodef_logo_dark' );
		$logo_light_image_id = topscorer_core_get_post_value_through_levels( 'qodef_logo_light' );
		$customizer_logo     = topscorer_core_get_customizer_logo();

		$parameters = array (
			'logo_classes'     => ! empty( $logo_height ) ? 'qodef-height--set' : 'qodef-height--not-set',
			'logo_height'      => ! empty( $logo_height ) ? 'height:' . intval( $logo_height ) . 'px' : '',
			'logo_main_image'  => '',
			'logo_dark_image'  => '',
			'logo_light_image' => '',
		);

		if ( ! empty( $logo_main_image_id ) ) {
			$logo_main_image_attr = array (
				'class'    => 'qodef-header-logo-image qodef--main',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo main', 'topscorer-core' ),
			);

			$image      = wp_get_attachment_image( $logo_main_image_id, 'full', false, $logo_main_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_main_image_id, $logo_main_image_attr );

			$parameters[ 'logo_main_image' ] = $image_html;
		}

		if ( ! empty( $logo_dark_image_id ) ) {
			$logo_dark_image_attr = array (
				'class'    => 'qodef-header-logo-image qodef--dark',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo dark', 'topscorer-core' ),
			);

			$parameters[ 'logo_dark_image' ] = wp_get_attachment_image( $logo_dark_image_id, 'full', false, $logo_dark_image_attr );
		}

		if ( ! empty( $logo_light_image_id ) ) {
			$logo_light_image_attr = array (
				'class'    => 'qodef-header-logo-image qodef--light',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo main', 'topscorer-core' ),
			);

			$parameters[ 'logo_light_image' ] = wp_get_attachment_image( $logo_light_image_id, 'full', false, $logo_light_image_attr );
		}

		if ( ! empty( $logo_main_image_id ) || ! empty( $logo_dark_image_id ) || ! empty( $logo_light_image_id ) ) {
			topscorer_core_template_part( 'header/templates', 'parts/logo', '', $parameters );
		} else if ( ! empty( $customizer_logo ) ) {
			echo qode_framework_wp_kses_html( 'html', $customizer_logo );
		}
	}
}

if ( ! function_exists( 'topscorer_core_get_header_widget_area' ) ) {
	function topscorer_core_get_header_widget_area( $header_layout = '', $widget_area = 'one' ) {
		$page_id = qode_framework_get_page_id();

		$widget_area_map = apply_filters( 'topscorer_core_filter_header_widget_area', array (
			'page_id'             => $page_id,
			'header_layout'       => $header_layout,
			'is_enabled'          => get_post_meta( $page_id, 'qodef_show_header_widget_areas', true ) !== 'no',
			'default_widget_area' => 'qodef-header-widget-area-' . esc_attr( $widget_area ),
			'custom_widget_area'  => get_post_meta( $page_id, 'qodef_header_custom_widget_area_' . esc_attr( $widget_area ), true ),
		) );

		extract( $widget_area_map );

		if ( $is_enabled ) {
			if ( is_active_sidebar( $default_widget_area ) && empty( $custom_widget_area ) ) {
				dynamic_sidebar( $default_widget_area );
			} else if ( ! empty( $custom_widget_area ) && is_active_sidebar( $custom_widget_area ) ) {
				dynamic_sidebar( $custom_widget_area );
			}
		}
	}
}


if ( ! function_exists( 'topscorer_core_is_banner_enabled' ) ) {
	function topscorer_core_is_banner_enabled() {
		if ( topscorer_core_get_post_value_through_levels( 'qodef_show_banner_before_header' ) === 'yes' ) {
			echo topscorer_core_template_part( 'header', 'templates/parts/banner', '' );
		}
	}

	add_action( 'topscorer_action_before_page_header', 'topscorer_core_is_banner_enabled', 9 );
}

if ( ! function_exists( 'topscorer_core_set_banner_styles' ) ) {
	/**
	 * Function that generates general inline styles
	 *
	 * @param $style string
	 *
	 * @return string
	 */
	function topscorer_core_set_banner_styles( $style ) {

		if ( topscorer_core_get_post_value_through_levels( 'qodef_show_banner_before_header' ) === 'yes' ) {
			$banner_styles = array();

			$background_image = topscorer_core_get_post_value_through_levels( 'qodef_banner_image' );
			$banner_height    = topscorer_core_get_post_value_through_levels( 'qodef_page_banner_height' );

			if ( ! empty( $background_image ) ) {
				$banner_styles[ 'background-image' ] = 'url(' . esc_url( wp_get_attachment_image_url( $background_image, 'full' ) ) . ')';
			}
			if ( ! empty( $banner_height ) ) {
				$banner_styles[ 'height' ] = intval( $banner_height ) . 'px';
			}

			if ( ! empty( $banner_styles ) ) {
				$style .= qode_framework_dynamic_style( '#qodef-page-banner .qodef-page-banner-image', $banner_styles );
			}

			$banner_styles_responsive = array();

			$banner_height_responsive = ( intval( $banner_height ) > 0 ) ? $banner_height / 1.777 : '';

			if ( ! empty( $banner_height_responsive ) ) {
				$banner_styles_responsive[ 'height' ] = intval( $banner_height_responsive ) . 'px';
			}

			if ( ! empty( $banner_styles_responsive ) ) {
				$style .= qode_framework_dynamic_style_responsive( '#qodef-page-banner .qodef-page-banner-image', $banner_styles_responsive, '', '1440' );
			}
		}

		return $style;
	}

	add_filter( 'topscorer_filter_add_inline_style', 'topscorer_core_set_banner_styles' );
}


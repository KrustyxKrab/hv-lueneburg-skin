<?php

include_once 'helper.php';
include_once 'dashboard/admin/social-share-options.php';

if ( ! function_exists( 'topscorer_core_include_social_share_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function topscorer_core_include_social_share_shortcodes() {
		foreach ( glob( TOPSCORER_CORE_INC_PATH . '/social-share/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}
	
	add_action( 'qode_framework_action_before_shortcodes_register', 'topscorer_core_include_social_share_shortcodes' );
}

if ( ! function_exists( 'topscorer_core_include_social_share_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function topscorer_core_include_social_share_widgets() {
		foreach ( glob( TOPSCORER_CORE_INC_PATH . '/social-share/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'topscorer_core_include_social_share_widgets' );
}
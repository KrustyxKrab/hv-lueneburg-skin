<?php

if ( ! function_exists( 'topscorer_core_include_twitter_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function topscorer_core_include_twitter_shortcodes() {
		foreach ( glob( TOPSCORER_CORE_INC_PATH . '/twitter/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}
	
	add_action( 'qode_framework_action_before_shortcodes_register', 'topscorer_core_include_twitter_shortcodes' );
}

if ( ! function_exists( 'topscorer_core_include_twitter_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function topscorer_core_include_twitter_widgets() {
		foreach ( glob( TOPSCORER_CORE_INC_PATH . '/twitter/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}
	
	add_action( 'qode_framework_action_before_widgets_register', 'topscorer_core_include_twitter_widgets' );
}

if ( ! function_exists( 'topscorer_core_include_twitter_plugin_is_installed' ) ) {
	function topscorer_core_include_twitter_plugin_is_installed( $installed, $plugin ) {
		if( $plugin === 'twitter' ) {
			return defined( 'CTF_VERSION' );
		}
		
		return $installed;
	}
	
	add_filter( 'qode_framework_filter_is_plugin_installed', 'topscorer_core_include_twitter_plugin_is_installed', 10, 2 );
}
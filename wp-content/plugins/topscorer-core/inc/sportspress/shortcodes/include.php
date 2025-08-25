<?php

include_once TOPSCORER_CORE_INC_PATH . '/sportspress/constants.php';
include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/helper.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/*/include.php' ) as $shortcode ) {
	include_once $shortcode;
}
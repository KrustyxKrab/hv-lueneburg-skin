<?php

include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-single-event/advanced-single-event.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-single-event/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
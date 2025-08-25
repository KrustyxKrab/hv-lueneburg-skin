<?php

include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-event-list/advanced-event-list.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-event-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
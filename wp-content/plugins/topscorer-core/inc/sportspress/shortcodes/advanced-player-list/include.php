<?php

include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-player-list/advanced-player-list.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-player-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
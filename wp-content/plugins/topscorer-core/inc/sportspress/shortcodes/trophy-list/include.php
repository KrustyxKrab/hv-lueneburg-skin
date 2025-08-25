<?php

include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/trophy-list/trophy-list.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/trophy-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
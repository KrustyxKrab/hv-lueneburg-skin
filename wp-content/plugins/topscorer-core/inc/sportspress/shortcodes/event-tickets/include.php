<?php

include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/event-tickets/event-tickets.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/event-tickets/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
<?php

include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/player-social-networks/player-social-networks.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/player-social-networks/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
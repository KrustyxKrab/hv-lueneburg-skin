<?php

include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-player-list/variations/info-below/hover-animations/hover-animations.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-player-list/variations/info-below/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}
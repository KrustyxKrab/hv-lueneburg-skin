<?php

include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-player-details/advanced-player-details.php';

foreach ( glob ( TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/advanced-player-details/variations/*/include.php' ) as $variation ) {
    include_once $variation;
}
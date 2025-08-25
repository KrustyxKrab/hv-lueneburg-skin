<?php

include_once TOPSCORER_CORE_SHORTCODES_PATH . '/banner/banner.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
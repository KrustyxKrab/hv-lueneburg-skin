<?php

include_once 'countdown.php';

foreach ( glob( TOPSCORER_CORE_SHORTCODES_PATH . '/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
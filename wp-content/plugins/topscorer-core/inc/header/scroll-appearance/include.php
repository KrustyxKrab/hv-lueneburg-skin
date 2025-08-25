<?php

include_once TOPSCORER_CORE_INC_PATH . '/header/scroll-appearance/helper.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/header/scroll-appearance/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/header/scroll-appearance/*/include.php' ) as $appearance ) {
	include_once $appearance;
}
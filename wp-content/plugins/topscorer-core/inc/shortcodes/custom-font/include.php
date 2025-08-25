<?php

include_once 'custom-font.php';

foreach ( glob( TOPSCORER_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
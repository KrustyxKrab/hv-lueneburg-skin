<?php

include_once 'icon-with-text.php';

foreach ( glob( TOPSCORER_CORE_SHORTCODES_PATH . '/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
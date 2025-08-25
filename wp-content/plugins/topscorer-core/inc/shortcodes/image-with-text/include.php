<?php

include_once 'image-with-text.php';

foreach ( glob( TOPSCORER_CORE_SHORTCODES_PATH . '/image-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
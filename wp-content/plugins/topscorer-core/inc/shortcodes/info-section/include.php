<?php

include_once 'info-section.php';

foreach ( glob( TOPSCORER_CORE_SHORTCODES_PATH . '/info-section/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
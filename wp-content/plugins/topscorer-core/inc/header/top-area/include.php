<?php

include_once 'top-area.php';
include_once 'helper.php';
foreach ( glob( TOPSCORER_CORE_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}
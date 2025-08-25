<?php

include_once 'blog-list-mosaic.php';

foreach ( glob( TOPSCORER_CORE_INC_PATH . '/blog/shortcodes/blog-list-mosaic/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
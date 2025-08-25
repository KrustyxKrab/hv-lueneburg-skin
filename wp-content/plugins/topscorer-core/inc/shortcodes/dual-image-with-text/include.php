<?php

include_once 'dual-image-with-text.php';

foreach ( glob ( TOPSCORER_CORE_SHORTCODES_PATH . '/dual-image-with-text/variations/*/include.php' ) as $variation ) {
    include_once $variation;
}
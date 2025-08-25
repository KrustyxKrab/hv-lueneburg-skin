<?php
// Include mobile logo
topscorer_core_get_mobile_header_logo_image();

// Include mobile haeder widget area
dynamic_sidebar( 'qodef-mobile-header-widget-area' );

// Include mobile navigation opener
topscorer_core_template_part( 'mobile-header', 'templates/parts/mobile-navigation-opener' );

// Include mobile navigation
topscorer_core_template_part( 'mobile-header', 'templates/parts/mobile-navigation' );
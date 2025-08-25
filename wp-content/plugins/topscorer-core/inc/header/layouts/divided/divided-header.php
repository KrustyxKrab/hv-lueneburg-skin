<?php

class DividedHeader extends TopscorerCoreHeader
{
    private static $instance;

    public function __construct () {
        $this->slug                  = 'divided';
        $this->search_layout         = 'covers-header';
        $this->default_header_height = 90;

        add_filter ( 'body_class', array ( $this, 'add_body_classes' ) );

        parent::__construct();
    }

    public static function get_instance () {
        if ( is_null ( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function add_body_classes ( $classes ) {
        $logo_covers_top_bar = topscorer_core_get_post_value_through_levels ( 'qodef_logo_covers_top_bar' );
        $top_bar_enabled     = topscorer_core_get_post_value_through_levels ( 'qodef_top_area_header' ) === 'yes';

        $classes[] = ( $logo_covers_top_bar === 'yes' && $top_bar_enabled ) ? 'qodef-header--divided-large-logo' : '';

        return $classes;
    }
}
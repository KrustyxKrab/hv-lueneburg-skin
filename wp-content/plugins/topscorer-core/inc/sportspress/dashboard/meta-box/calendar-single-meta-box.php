<?php

if ( ! function_exists ( 'topscorer_core_add_sportspress_calendar_single_meta_box' ) ) {
    /**
     * function that add meta box group for this module
     */
    function topscorer_core_add_sportspress_calendar_single_meta_box () {
        $qode_framework = qode_framework_get_framework_root();

        $page = $qode_framework->add_options_page (
            array (
                'scope'  => array ( 'sp_calendar' ),
                'type'   => 'meta',
                'slug'   => 'sp_calendar',
                'title'  => esc_html__( 'Calendar Table Settings', 'topscorer-core' ),
                'layout' => 'tabbed',
            )
        );

        if ( $page ) {
            // hook to include additional options after module options
            // @hooked topscorer_core_add_sportspress_page_meta_box
            // @hooked topscorer_core_add_page_header_meta_box
            // @hooked topscorer_core_add_page_mobile_header_meta_box
            // @hooked topscorer_core_add_page_title_meta_box
            do_action ( 'topscorer_core_action_after_sportspress_calendar_single_meta_box_map', $page );
        }
    }

    add_action ( 'topscorer_core_action_default_meta_boxes_init', 'topscorer_core_add_sportspress_calendar_single_meta_box' );
}
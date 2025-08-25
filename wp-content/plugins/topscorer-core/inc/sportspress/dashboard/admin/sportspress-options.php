<?php

if ( ! function_exists ( 'topscorer_core_add_sportspress_options' ) ) {
    /**
     * Function that add general options for this module
     */
    function topscorer_core_add_sportspress_options () {
        $qode_framework = qode_framework_get_framework_root();

        $page = $qode_framework->add_options_page (
            array (
                'scope'       => TOPSCORER_CORE_OPTIONS_NAME,
                'type'        => 'admin',
                'slug'        => 'sportspress',
                'icon'        => 'fa fa-book',
                'title'       => esc_html__( 'SportsPress', 'topscorer-core' ),
                'description' => esc_html__( 'Global settings related to Sportspress', 'topscorer-core' ),
                'layout'      => 'tabbed',
            )
        );

        if ( $page ) {
            // hook to include additional options after module options
            do_action ( 'topscorer_core_action_after_sportspress_options_map', $page );
        }
    }

    add_action ( 'topscorer_core_action_default_options_init', 'topscorer_core_add_sportspress_options', topscorer_core_get_admin_options_map_position ( 'sportspress' ) );
}
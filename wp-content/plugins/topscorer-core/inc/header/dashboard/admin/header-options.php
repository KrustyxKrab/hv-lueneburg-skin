<?php

if ( ! function_exists ( 'topscorer_core_add_header_options' ) ) {
    /**
     * Function that add header options for this module
     */
    function topscorer_core_add_header_options () {
        $qode_framework = qode_framework_get_framework_root();

        $page = $qode_framework->add_options_page (
            array (
                'scope'       => TOPSCORER_CORE_OPTIONS_NAME,
                'type'        => 'admin',
                'slug'        => 'header',
                'icon'        => 'fa fa-cog',
                'title'       => esc_html__( 'Header', 'topscorer-core' ),
                'description' => esc_html__( 'Header Settings', 'topscorer-core' ),
            )
        );

        if ( $page ) {
            $general_tab = $page->add_tab_element (
                array (
                    'name'  => 'tab-header-general',
                    'icon'  => 'fa fa-cog',
                    'title' => esc_html__( 'General Settings', 'topscorer-core' ),
                )
            );
            $general_tab->add_field_element (
                array (
                    'field_type'    => 'radio',
                    'name'          => 'qodef_header_layout',
                    'title'         => esc_html__( 'Header Layout', 'topscorer-core' ),
                    'description'   => esc_html__( 'Choose header layout to set for your site', 'topscorer-core' ),
                    'args'          => array ( 'images' => true ),
                    'options'       => apply_filters ( 'topscorer_core_filter_header_layout_option', $header_layout_options = array() ),
                    'default_value' => apply_filters ( 'topscorer_core_filter_header_layout_default_option_value', '' ),
                )
            );

            $general_tab->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_header_skin',
                    'title'       => esc_html__( 'Header Skin', 'topscorer-core' ),
                    'description' => esc_html__( 'Choose a predefined header style for header elements', 'topscorer-core' ),
                    'options'     => array (
                        'none'  => esc_html__( 'None', 'topscorer-core' ),
                        'light' => esc_html__( 'Light', 'topscorer-core' ),
                        'dark'  => esc_html__( 'Dark', 'topscorer-core' ),
                    ),
                )
            );

            // Hook to include additional options after module options
            do_action ( 'topscorer_core_action_after_header_options_map', $page, $general_tab );
        }
    }

    add_action ( 'topscorer_core_action_default_options_init', 'topscorer_core_add_header_options', topscorer_core_get_admin_options_map_position ( 'header' ) );
}
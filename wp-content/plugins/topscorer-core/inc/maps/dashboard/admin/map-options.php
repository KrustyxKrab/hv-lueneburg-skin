<?php

if ( ! function_exists ( 'topscorer_core_add_map_options' ) ) {
    /**
     * Function that add map options
     */
    function topscorer_core_add_map_options () {
        $qode_framework = qode_framework_get_framework_root();

        $page = $qode_framework->add_options_page (
            array (
                'scope'       => TOPSCORER_CORE_OPTIONS_NAME,
                'type'        => 'admin',
                'slug'        => 'map',
                'icon'        => 'fa fa-book',
                'title'       => esc_html__( 'Maps', 'topscorer-core' ),
                'description' => esc_html__( 'Global Maps Options', 'topscorer-core' ),
            )
        );

        if ( $page ) {
            $page->add_field_element (
                array (
                    'field_type'  => 'text',
                    'name'        => 'qodef_maps_api_key',
                    'title'       => esc_html__( 'Maps API Key', 'topscorer-core' ),
                    'description' => esc_html__( 'Enter Google Maps API key', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type'  => 'textarea',
                    'name'        => 'qodef_map_style',
                    'title'       => esc_html__( 'Map Style', 'topscorer-core' ),
                    'description' => esc_html__( 'Enter Snazzy Map style JSON code', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type'  => 'text',
                    'name'        => 'qodef_map_zoom',
                    'title'       => esc_html__( 'Map Zoom', 'topscorer-core' ),
                    'description' => esc_html__( 'Enter default zoom value for map', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_enable_map_scroll',
                    'title'         => esc_html__( 'Enable Map Scroll', 'topscorer-core' ),
                    'description'   => esc_html__( 'Use this option to enable map scrolling', 'topscorer-core' ),
                    'default_value' => 'no',
                )
            );

            $page->add_field_element (
                array (
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_enable_map_drag',
                    'title'         => esc_html__( 'Enable Map Dragging', 'topscorer-core' ),
                    'description'   => esc_html__( 'Use this option to enable map dragging', 'topscorer-core' ),
                    'default_value' => 'yes',
                )
            );

            $page->add_field_element (
                array (
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_enable_map_street_view_control',
                    'title'         => esc_html__( 'Enable Map Street View Control', 'topscorer-core' ),
                    'description'   => esc_html__( 'Use this option to enable street view control on map', 'topscorer-core' ),
                    'default_value' => 'yes',
                )
            );

            $page->add_field_element (
                array (
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_enable_map_zoom_control',
                    'title'         => esc_html__( 'Enable Map Zoom Control', 'topscorer-core' ),
                    'description'   => esc_html__( 'Use this option to enable zoom control on map', 'topscorer-core' ),
                    'default_value' => 'yes',
                )
            );

            $page->add_field_element (
                array (
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_enable_map_type_control',
                    'title'         => esc_html__( 'Enable Map Type Control', 'topscorer-core' ),
                    'description'   => esc_html__( 'Use this option to enable type control on map', 'topscorer-core' ),
                    'default_value' => 'yes',
                )
            );

            $page->add_field_element (
                array (
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_enable_map_full_screen_control',
                    'title'         => esc_html__( 'Enable Map Full Screen Control', 'topscorer-core' ),
                    'description'   => esc_html__( 'Use this option to enable full screen control on map', 'topscorer-core' ),
                    'default_value' => 'yes',
                )
            );

            // Hook to include additional options after module options
            do_action ( 'topscorer_core_action_after_map_options_map', $page );
        }
    }

    add_action ( 'topscorer_core_action_default_options_init', 'topscorer_core_add_map_options', topscorer_core_get_admin_options_map_position ( 'maps' ) );
}
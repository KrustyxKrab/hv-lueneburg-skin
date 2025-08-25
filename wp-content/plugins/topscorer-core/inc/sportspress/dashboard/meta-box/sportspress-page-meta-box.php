<?php

if ( ! function_exists ( 'topscorer_core_add_sportspress_page_meta_box' ) ) {
    /**
     * function that add general options for this module
     */
    function topscorer_core_add_sportspress_page_meta_box ( $page ) {
        if ( $page ) {

            $page_tab = $page->add_tab_element (
                array (
                    'name'        => 'tab-page',
                    'icon'        => 'fa fa-cog',
                    'title'       => esc_html__( 'Page Settings', 'topscorer-core' ),
                    'description' => esc_html__( 'General page layout settings', 'topscorer-core' ),
                )
            );

            $page_tab->add_field_element (
                array (
                    'field_type'  => 'text',
                    'name'        => 'qodef_page_content_padding',
                    'title'       => esc_html__( 'Page Content Padding', 'topscorer-core' ),
                    'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'topscorer-core' ),
                )
            );

            $page_tab->add_field_element (
                array (
                    'field_type'  => 'text',
                    'name'        => 'qodef_page_content_padding_mobile',
                    'title'       => esc_html__( 'Page Content Padding Mobile', 'topscorer-core' ),
                    'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'topscorer-core' ),
                )
            );

            $page_tab->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_content_width',
                    'title'       => esc_html__( 'Initial Width of Content', 'topscorer-core' ),
                    'description' => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'topscorer-core' ),
                    'options'     => topscorer_core_get_select_type_options_pool ( 'content_width' ),
                )
            );

            $page_tab->add_field_element ( array (
                'field_type'    => 'yesno',
                'default_value' => 'no',
                'name'          => 'qodef_content_behind_header',
                'title'         => esc_html__( 'Always put content behind header', 'topscorer-core' ),
                'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'topscorer-core' ),
            ) );
        }
    }

    add_action ( 'topscorer_core_action_after_sportspress_player_single_meta_box_map', 'topscorer_core_add_sportspress_page_meta_box', 1 );
    add_action ( 'topscorer_core_action_after_sportspress_team_single_meta_box_map', 'topscorer_core_add_sportspress_page_meta_box', 1 );
    add_action ( 'topscorer_core_action_after_sportspress_event_single_meta_box_map', 'topscorer_core_add_sportspress_page_meta_box', 1 );
    add_action ( 'topscorer_core_action_after_sportspress_league_single_meta_box_map', 'topscorer_core_add_sportspress_page_meta_box', 1 );
    add_action ( 'topscorer_core_action_after_sportspress_player_list_single_meta_box_map', 'topscorer_core_add_sportspress_page_meta_box', 1 );
    add_action ( 'topscorer_core_action_after_sportspress_staff_single_meta_box_map', 'topscorer_core_add_sportspress_page_meta_box', 1 );
    add_action ( 'topscorer_core_action_after_sportspress_official_single_meta_box_map', 'topscorer_core_add_sportspress_page_meta_box', 1 );
    add_action ( 'topscorer_core_action_after_sportspress_calendar_single_meta_box_map', 'topscorer_core_add_sportspress_page_meta_box', 1 );
}
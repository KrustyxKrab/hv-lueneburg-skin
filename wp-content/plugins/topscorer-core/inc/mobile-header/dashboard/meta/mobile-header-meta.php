<?php

if ( ! function_exists ( 'topscorer_core_add_page_mobile_header_meta_box' ) ) {
    /**
     * Function that add general options for this module
     */
    function topscorer_core_add_page_mobile_header_meta_box ( $page ) {

        if ( $page ) {

            $mobile_header_tab = $page->add_tab_element (
                array (
                    'name'        => 'tab-mobile-header',
                    'icon'        => 'fa fa-cog',
                    'title'       => esc_html__( 'Mobile Header Settings', 'topscorer-core' ),
                    'description' => esc_html__( 'Mobile header layout settings', 'topscorer-core' ),
                )
            );

            $mobile_header_tab->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_mobile_header_layout',
                    'title'       => esc_html__( 'Mobile Header Layout', 'topscorer-core' ),
                    'description' => esc_html__( 'Choose mobile header layout to set for your site', 'topscorer-core' ),
                    'args'        => array ( 'images' => true ),
                    'options'     => topscorer_core_header_radio_to_select_options ( apply_filters ( 'topscorer_core_filter_mobile_header_layout_option', $mobile_header_layout_options = array() ) ),
                )
            );

            // Hook to include additional options after module options
            do_action ( 'topscorer_core_action_after_page_mobile_header_meta_map', $mobile_header_tab );
        }
    }

    add_action ( 'topscorer_core_action_after_general_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
    add_action ( 'topscorer_core_action_after_portfolio_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_player_single_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_team_single_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_event_single_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_league_single_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_player_list_single_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_staff_single_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_official_single_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_calendar_single_meta_box_map', 'topscorer_core_add_page_mobile_header_meta_box' );
}
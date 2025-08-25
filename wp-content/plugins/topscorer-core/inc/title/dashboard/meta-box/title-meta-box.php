<?php

if ( ! function_exists ( 'topscorer_core_add_page_title_meta_box' ) ) {
    /**
     * Function that add general options for this module
     */
    function topscorer_core_add_page_title_meta_box ( $page ) {

        if ( $page ) {

            $title_tab = $page->add_tab_element (
                array (
                    'name'        => 'tab-title',
                    'icon'        => 'fa fa-cog',
                    'title'       => esc_html__( 'Title Settings', 'topscorer-core' ),
                    'description' => esc_html__( 'Title layout settings', 'topscorer-core' ),
                )
            );

            $title_tab->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_enable_page_title',
                    'title'       => esc_html__( 'Enable Page Title', 'topscorer-core' ),
                    'description' => esc_html__( 'Use this option to enable/disable page title', 'topscorer-core' ),
                    'options'     => topscorer_core_get_select_type_options_pool ( 'no_yes' ),
                )
            );

            $page_title_section = $title_tab->add_section_element (
                array (
                    'name'       => 'qodef_page_title_section',
                    'title'      => esc_html__( 'Title Area', 'topscorer-core' ),
                    'dependency' => array (
                        'hide' => array (
                            'qodef_enable_page_title' => array (
                                'values'        => 'no',
                                'default_value' => '',
                            ),
                        ),
                    ),
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_title_layout',
                    'title'       => esc_html__( 'Title Layout', 'topscorer-core' ),
                    'description' => esc_html__( 'Choose title layout to set for your site', 'topscorer-core' ),
                    'options'     => apply_filters ( 'topscorer_core_filter_title_layout_options', $layouts = array ( '' => esc_html__( 'Default', 'topscorer-core' ) ) ),
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_set_page_title_area_in_grid',
                    'title'       => esc_html__( 'Page Title In Grid', 'topscorer-core' ),
                    'description' => esc_html__( 'Enabling this option will set page title area to be in grid', 'topscorer-core' ),
                    'options'     => topscorer_core_get_select_type_options_pool ( 'no_yes' ),
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type'  => 'text',
                    'name'        => 'qodef_page_title_height',
                    'title'       => esc_html__( 'Height', 'topscorer-core' ),
                    'description' => esc_html__( 'Enter title height', 'topscorer-core' ),
                    'args'        => array (
                        'suffix' => 'px',
                    ),
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type'  => 'text',
                    'name'        => 'qodef_page_title_height_on_smaller_screens',
                    'title'       => esc_html__( 'Height on Smaller Screens', 'topscorer-core' ),
                    'description' => esc_html__( 'Enter title height to be displayed on smaller screens with active mobile header', 'topscorer-core' ),
                    'args'        => array (
                        'suffix' => esc_html__( 'px', 'topscorer-core' ),
                    ),
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type'  => 'color',
                    'name'        => 'qodef_page_title_background_color',
                    'title'       => esc_html__( 'Background Color', 'topscorer-core' ),
                    'description' => esc_html__( 'Enter page title area background color', 'topscorer-core' ),
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type'  => 'image',
                    'name'        => 'qodef_page_title_background_image',
                    'title'       => esc_html__( 'Background Image', 'topscorer-core' ),
                    'description' => esc_html__( 'Enter page title area background image', 'topscorer-core' ),
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type' => 'select',
                    'name'       => 'qodef_page_title_background_image_behavior',
                    'title'      => esc_html__( 'Background Image Behavior', 'topscorer-core' ),
                    'options'    => array (
                        ''           => esc_html__( 'Default', 'topscorer-core' ),
                        'responsive' => esc_html__( 'Set Responsive Image', 'topscorer-core' ),
                        'parallax'   => esc_html__( 'Set Parallax Image', 'topscorer-core' ),
                    ),
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_page_title_color',
                    'title'      => esc_html__( 'Title Color', 'topscorer-core' ),
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type'    => 'select',
                    'name'          => 'qodef_page_title_text_alignment',
                    'title'         => esc_html__( 'Text Alignment', 'topscorer-core' ),
                    'options'       => array (
                        'left'   => esc_html__( 'Left', 'topscorer-core' ),
                        'center' => esc_html__( 'Center', 'topscorer-core' ),
                        'right'  => esc_html__( 'Right', 'topscorer-core' ),
                    ),
                    'default_value' => 'left',
                )
            );

            $page_title_section->add_field_element (
                array (
                    'field_type'    => 'select',
                    'name'          => 'qodef_page_title_vertical_text_alignment',
                    'title'         => esc_html__( 'Vertical Text Alignment', 'topscorer-core' ),
                    'options'       => array (
                        ''              => esc_html__( 'Default', 'topscorer-core' ),
                        'header-bottom' => esc_html__( 'From Bottom of Header', 'topscorer-core' ),
                        'window-top'    => esc_html__( 'From Window Top', 'topscorer-core' ),
                    ),
                    'default_value' => '',
                )
            );

            // Hook to include additional options after module options
            do_action ( 'topscorer_core_action_after_page_title_meta_box_map', $page_title_section );
        }
    }

    add_action ( 'topscorer_core_action_after_general_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
    add_action ( 'topscorer_core_action_after_portfolio_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_player_single_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_team_single_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_event_single_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_league_single_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_player_list_single_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_staff_single_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_official_single_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
    add_action ( 'topscorer_core_action_after_sportspress_calendar_single_meta_box_map', 'topscorer_core_add_page_title_meta_box' );
}
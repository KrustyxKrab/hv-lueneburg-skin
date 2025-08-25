<?php

if ( ! function_exists ( 'topscorer_core_add_sportspress_player_single_meta_box' ) ) {
    /**
     * function that add meta box group for this module
     */
    function topscorer_core_add_sportspress_player_single_meta_box () {
        $qode_framework = qode_framework_get_framework_root();

        $page = $qode_framework->add_options_page (
            array (
                'scope'  => array ( 'sp_player' ),
                'type'   => 'meta',
                'slug'   => 'sp_player',
                'title'  => esc_html__( 'Player Settings', 'topscorer-core' ),
                'layout' => 'tabbed',
            )
        );

        if ( $page ) {

            $general_tab = $page->add_tab_element (
                array (
                    'name'        => 'tab-general',
                    'icon'        => 'fa fa-cog',
                    'title'       => esc_html__( 'General Settings', 'topscorer-core' ),
                    'description' => esc_html__( 'General player settings', 'topscorer-core' ),
                )
            );

            $general_tab->add_field_element (
                array (
                    'field_type'    => 'select',
                    'name'          => 'qodef_sportspress_player_single_enable_trending_posts',
                    'title'         => esc_html__( 'Enable Trending Posts', 'topscorer-core' ),
                    'description'   => esc_html__( 'Use this option to enable/disable trending posts section on single player page', 'topscorer-core' ),
                    'options'       => topscorer_core_get_select_type_options_pool ( 'yes_no' ),
                    'default_value' => '',
                )
            );

            $trending_section = $general_tab->add_section_element (
                array (
                    'name'       => 'qodef_sportspress_player_single_trending_section',
                    'title'      => esc_html__( 'Trending Settings', 'topscorer-core' ),
                    'dependency' => array (
                        'hide' => array (
                            'qodef_sportspress_player_single_enable_trending_posts' => array (
                                'values'        => 'no',
                                'default_value' => '',
                            ),
                        ),
                    ),
                )
            );

            $trending_taxonomies = topscorer_core_get_trending_taxonomies();
            if ( ! empty( $trending_taxonomies ) && count ( $trending_taxonomies ) > 1 ) {
                $trending_section->add_field_element (
                    array (
                        'field_type' => 'select',
                        'name'       => 'qodef_sportspress_player_single_trending_posts_taxonomy',
                        'title'      => esc_html__( 'Trending', 'topscorer-core' ),
                        'options'    => $trending_taxonomies,
                    )
                );
            }

            $general_tab->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_sportspress_player_single_enable_related_players',
                    'title'       => esc_html__( 'Enable Related', 'topscorer-core' ),
                    'description' => esc_html__( 'Use this option to enable/disable related players section on single player page', 'topscorer-core' ),
                    'options'     => topscorer_core_get_select_type_options_pool ( 'yes_no' ),
                )
            );

            $related_section = $general_tab->add_section_element (
                array (
                    'name'       => 'qodef_sportspress_player_single_related_section',
                    'title'      => esc_html__( 'Related Settings', 'topscorer-core' ),
                    'dependency' => array (
                        'hide' => array (
                            'qodef_sportspress_player_single_enable_related_players' => array (
                                'values'        => 'no',
                                'default_value' => '',
                            ),
                        ),
                    ),
                )
            );

            $player_lists = topscorer_core_sportspress_get_player_lists ( true );
            if ( ! empty( $player_lists ) && count ( $player_lists ) > 1 ) {
                $related_section->add_field_element (
                    array (
                        'field_type' => 'select',
                        'name'       => 'qodef_sportspress_player_single_related_players_list',
                        'title'      => esc_html__( 'Player List', 'topscorer-core' ),
                        'options'    => $player_lists,
                    )
                );
            }

            $social_section = $general_tab->add_section_element (
                array (
                    'name'        => 'section-social',
                    'title'       => esc_html__( 'Social Networks Settings', 'topscorer-core' ),
                    'description' => esc_html__( 'Populate player single social networks info', 'topscorer-core' ),
                )
            );

            $social_icons_repeater = $social_section->add_repeater_element (
                array (
                    'name'        => 'qodef_sportspress_player_single_social_icons',
                    'title'       => esc_html__( 'Social Networks', 'topscorer-core' ),
                    'button_text' => esc_html__( 'Add New Network', 'topscorer-core' ),
                )
            );

            $social_icons_repeater->add_field_element (
                array (
                    'field_type' => 'iconpack',
                    'name'       => 'qodef_sportspress_player_single_social_icon',
                    'title'      => esc_html__( 'Icon', 'topscorer-core' ),
                )
            );

            $social_icons_repeater->add_field_element (
                array (
                    'field_type' => 'text',
                    'name'       => 'qodef_sportspress_player_single_social_icon_link',
                    'title'      => esc_html__( 'Icon Link', 'topscorer-core' ),
                )
            );

            $social_icons_repeater->add_field_element (
                array (
                    'field_type' => 'select',
                    'name'       => 'qodef_sportspress_player_single_social_icon_target',
                    'title'      => esc_html__( 'Icon Target', 'topscorer-core' ),
                    'options'    => topscorer_core_get_select_type_options_pool ( 'link_target' ),
                )
            );

            // hook to include additional options after module options
            // @hooked topscorer_core_add_sportspress_page_meta_box
            // @hooked topscorer_core_add_page_header_meta_box
            // @hooked topscorer_core_add_page_mobile_header_meta_box
            // @hooked topscorer_core_add_page_title_meta_box
            do_action ( 'topscorer_core_action_after_sportspress_player_single_meta_box_map', $page );
        }
    }

    add_action ( 'topscorer_core_action_default_meta_boxes_init', 'topscorer_core_add_sportspress_player_single_meta_box' );
}
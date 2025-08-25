<?php

if ( ! function_exists ( 'topscorer_core_add_sportspress_team_single_meta_box' ) ) {
    /**
     * function that add meta box group for this module
     */
    function topscorer_core_add_sportspress_team_single_meta_box () {
        $qode_framework = qode_framework_get_framework_root();

        $page = $qode_framework->add_options_page (
            array (
                'scope'  => array ( 'sp_team' ),
                'type'   => 'meta',
                'slug'   => 'sp_team',
                'title'  => esc_html__( 'Team Settings', 'topscorer-core' ),
                'layout' => 'tabbed',
            )
        );

        if ( $page ) {

            $general_tab = $page->add_tab_element (
                array (
                    'name'        => 'tab-general',
                    'icon'        => 'fa fa-cog',
                    'title'       => esc_html__( 'General Settings', 'topscorer-core' ),
                    'description' => esc_html__( 'General team settings', 'topscorer-core' ),
                )
            );

            $general_tab->add_field_element (
                array (
                    'field_type'  => 'text',
                    'name'        => 'qodef_sportspress_team_single_first_name',
                    'title'       => esc_html__( '1st Name', 'topscorer-core' ),
                    'description' => esc_html__( 'Input a first part of the team name which will be displayed in front of the short team name (e.g. a city)', 'topscorer-core' ),
                )
            );

            $trophy_section = $general_tab->add_section_element (
                array (
                    'name'        => 'section-trophy',
                    'title'       => esc_html__( 'Trophies and Awards', 'topscorer-core' ),
                    'description' => esc_html__( 'Populate team single trophies and awards info', 'topscorer-core' ),
                )
            );

            $trophies_repeater = $trophy_section->add_repeater_element (
                array (
                    'name'        => 'qodef_sportspress_team_single_trophies',
                    'title'       => esc_html__( 'Trophy', 'topscorer-core' ),
                    'button_text' => esc_html__( 'Add New Trophy', 'topscorer-core' ),
                )
            );

            $trophies_repeater->add_field_element (
                array (
                    'field_type' => 'text',
                    'name'       => 'qodef_sportspress_team_single_trophy_tagline',
                    'title'      => esc_html__( 'Tagline', 'topscorer-core' ),
                )
            );

            $trophies_repeater->add_field_element (
                array (
                    'field_type' => 'text',
                    'name'       => 'qodef_sportspress_team_single_trophy_title',
                    'title'      => esc_html__( 'Title', 'topscorer-core' ),
                )
            );

            $trophies_repeater->add_field_element (
                array (
                    'field_type' => 'image',
                    'name'       => 'qodef_sportspress_team_single_trophy_image',
                    'title'      => esc_html__( 'Image', 'topscorer-core' ),
                )
            );

            $trophies_repeater->add_field_element (
                array (
                    'field_type' => 'text',
                    'name'       => 'qodef_sportspress_team_single_trophy_link',
                    'title'      => esc_html__( 'Link', 'topscorer-core' ),
                )
            );

            $trophies_repeater->add_field_element (
                array (
                    'field_type' => 'select',
                    'name'       => 'qodef_sportspress_team_single_trophy_link_target',
                    'title'      => esc_html__( 'Target', 'topscorer-core' ),
                    'options'    => topscorer_core_get_select_type_options_pool ( 'link_target' ),
                )
            );

            // hook to include additional options after module options
            // @hooked topscorer_core_add_sportspress_page_meta_box
            // @hooked topscorer_core_add_page_header_meta_box
            // @hooked topscorer_core_add_page_mobile_header_meta_box
            // @hooked topscorer_core_add_page_title_meta_box
            do_action ( 'topscorer_core_action_after_sportspress_team_single_meta_box_map', $page );
        }
    }

    add_action ( 'topscorer_core_action_default_meta_boxes_init', 'topscorer_core_add_sportspress_team_single_meta_box' );
}
<?php

if ( ! function_exists ( 'topscorer_core_add_sportspress_archive_sidebar_options' ) ) {
    /**
     * function that add options group for this module
     */
    function topscorer_core_add_sportspress_archive_sidebar_options ( $page ) {
        if ( $page ) {

            $archive_tab = $page->add_tab_element (
                array (
                    'name'        => 'tab-archive',
                    'icon'        => 'fa fa-cog',
                    'title'       => esc_html__( 'Archive Settings', 'topscorer-core' ),
                    'description' => esc_html__( 'Settings related to archive pages', 'topscorer-core' ),
                )
            );

            $archive_tab->add_field_element (
                array (
                    'field_type'  => 'text',
                    'name'        => 'qodef_sportspress_archive_number_of_characters',
                    'title'       => esc_html__( 'Number of Characters in Excerpt', 'topscorer-core' ),
                    'description' => esc_html__( 'Fill a number of characters in excerpt for post summary. Default value is 180', 'topscorer-core' ),
                )
            );

            $archive_tab->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_sportspress_archive_columns',
                    'title'       => esc_html__( 'Columns Number', 'topscorer-core' ),
                    'description' => esc_html__( 'Choose number of columns for item list on archive pages', 'topscorer-core' ),
                    'options'     => topscorer_core_get_select_type_options_pool ( 'columns_number' ),
                )
            );

            $archive_tab->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_sportspress_archive_columns_space',
                    'title'       => esc_html__( 'Space Between Items', 'topscorer-core' ),
                    'description' => esc_html__( 'Choose space between items for on archive pages', 'topscorer-core' ),
                    'options'     => topscorer_core_get_select_type_options_pool ( 'items_space' ),
                )
            );

            $archive_tab->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_sportspress_archive_title_tag',
                    'title'       => esc_html__( 'Title Tag', 'topscorer-core' ),
                    'description' => esc_html__( 'Choose title tag for item on archive pages', 'topscorer-core' ),
                    'options'     => topscorer_core_get_select_type_options_pool ( 'title_tag' ),
                )
            );

            $archive_tab->add_field_element (
                array (
                    'field_type'    => 'select',
                    'name'          => 'qodef_sportspress_archive_sidebar_layout',
                    'title'         => esc_html__( 'Sidebar Layout', 'topscorer-core' ),
                    'description'   => esc_html__( 'Choose default sidebar layout for archive pages', 'topscorer-core' ),
                    'default_value' => 'no-sidebar',
                    'options'       => topscorer_core_get_select_type_options_pool ( 'sidebar_layouts' ),
                )
            );

            $custom_sidebars = topscorer_core_get_custom_sidebars();
            if ( ! empty( $custom_sidebars ) && count ( $custom_sidebars ) > 1 ) {
                $archive_tab->add_field_element (
                    array (
                        'field_type'  => 'select',
                        'name'        => 'qodef_sportspress_archive_custom_sidebar',
                        'title'       => esc_html__( 'Custom Sidebar', 'topscorer-core' ),
                        'description' => esc_html__( 'Choose a custom sidebar to display on archive pages', 'topscorer-core' ),
                        'options'     => $custom_sidebars,
                    )
                );
            }

            $archive_tab->add_field_element (
                array (
                    'field_type'  => 'select',
                    'name'        => 'qodef_sportspress_archive_sidebar_grid_gutter',
                    'title'       => esc_html__( 'Set Grid Gutter', 'topscorer-core' ),
                    'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'topscorer-core' ),
                    'options'     => topscorer_core_get_select_type_options_pool ( 'items_space' ),
                )
            );
        }
    }

    add_action ( 'topscorer_core_action_after_sportspress_options_map', 'topscorer_core_add_sportspress_archive_sidebar_options' );
}
    
    
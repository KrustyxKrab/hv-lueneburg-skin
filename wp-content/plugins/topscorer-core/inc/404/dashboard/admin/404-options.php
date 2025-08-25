<?php

if ( ! function_exists ( 'topscorer_core_add_404_page_options' ) ) {
    /**
     * Function that add general options for this module
     */
    function topscorer_core_add_404_page_options () {
        $qode_framework = qode_framework_get_framework_root();

        $page = $qode_framework->add_options_page (
            array (
                'scope'       => TOPSCORER_CORE_OPTIONS_NAME,
                'type'        => 'admin',
                'slug'        => '404',
                'icon'        => 'fa fa-book',
                'title'       => esc_html__( '404', 'topscorer-core' ),
                'description' => esc_html__( 'Global settings related to 404 page', 'topscorer-core' ),
            )
        );

        if ( $page ) {
            $page->add_field_element (
                array (
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_enable_404_page_title',
                    'title'         => esc_html__( 'Enable Page Title', 'topscorer-core' ),
                    'description'   => esc_html__( 'Use this option to enable/disable page title on 404 page', 'topscorer-core' ),
                    'default_value' => 'no',
                )
            );

            $page->add_field_element (
                array (
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_enable_404_page_footer',
                    'title'         => esc_html__( 'Enable Page Footer', 'topscorer-core' ),
                    'description'   => esc_html__( 'Use this option to enable/disable page footer on 404 page', 'topscorer-core' ),
                    'default_value' => 'yes',
                )
            );

            $page->add_field_element (
                array (
                    'field_type'  => 'color',
                    'name'        => 'qodef_404_page_background_color',
                    'title'       => esc_html__( 'Background Color', 'topscorer-core' ),
                    'description' => esc_html__( 'Enter 404 page area background color', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type'  => 'image',
                    'name'        => 'qodef_404_page_background_image',
                    'title'       => esc_html__( 'Background Image', 'topscorer-core' ),
                    'description' => esc_html__( 'Enter 404 page area background image', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type' => 'text',
                    'name'       => 'qodef_404_page_tagline',
                    'title'      => esc_html__( 'Tagline Label', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_tagline_color',
                    'title'      => esc_html__( 'Tagline Color', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type' => 'text',
                    'name'       => 'qodef_404_page_title',
                    'title'      => esc_html__( 'Title Label', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_title_color',
                    'title'      => esc_html__( 'Title Color', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type' => 'text',
                    'name'       => 'qodef_404_page_text',
                    'title'      => esc_html__( 'Text Label', 'topscorer-core' ),
                )
            );

            $page->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_text_color',
                    'title'      => esc_html__( 'Text Color', 'topscorer-core' ),
                )
            );

            $button_section = $page->add_section_element (
                array (
                    'name'  => 'qodef_404_page_button_section',
                    'title' => esc_html__( 'Button', 'topscorer-core' ),
                )
            );

            $button_section->add_field_element (
                array (
                    'field_type' => 'text',
                    'name'       => 'qodef_404_page_button_text',
                    'title'      => esc_html__( 'Text', 'topscorer-core' ),
                )
            );

            $button_section->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_button_color',
                    'title'      => esc_html__( 'Color', 'topscorer-core' ),
                )
            );

            $button_section->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_button_background_color',
                    'title'      => esc_html__( 'Background Color', 'topscorer-core' ),
                )
            );

            $button_section->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_button_border_color',
                    'title'      => esc_html__( 'Border Color', 'topscorer-core' ),
                )
            );

            $button_section->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_button_hover_color',
                    'title'      => esc_html__( 'Hover Color', 'topscorer-core' ),
                )
            );

            $button_section->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_button_background_hover_color',
                    'title'      => esc_html__( 'Background Hover Color', 'topscorer-core' ),
                )
            );

            $button_section->add_field_element (
                array (
                    'field_type' => 'color',
                    'name'       => 'qodef_404_page_button_border_hover_color',
                    'title'      => esc_html__( 'Border Hover Color', 'topscorer-core' ),
                )
            );

            // Hook to include additional options after module options
            do_action ( 'topscorer_core_action_after_404_page_options_map', $page );
        }
    }

    add_action ( 'topscorer_core_action_default_options_init', 'topscorer_core_add_404_page_options', topscorer_core_get_admin_options_map_position ( '404' ) );
}
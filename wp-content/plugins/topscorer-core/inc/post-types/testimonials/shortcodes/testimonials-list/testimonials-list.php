<?php

if ( ! function_exists ( 'topscorer_core_add_testimonials_list_shortcode' ) ) {
    /**
     * Function that is adding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - Array of registered shortcodes
     *
     * @return array
     */
    function topscorer_core_add_testimonials_list_shortcode ( $shortcodes ) {
        $shortcodes[] = 'TopScorerCoreTestimonialsListShortcode';

        return $shortcodes;
    }

    add_filter ( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_add_testimonials_list_shortcode' );
}

if ( class_exists ( 'TopScorerCoreListShortcode' ) ) {
    class TopScorerCoreTestimonialsListShortcode extends TopScorerCoreListShortcode
    {

        public function __construct () {
            $this->set_post_type ( 'testimonials' );
            $this->set_post_type_additional_taxonomies ( array ( 'testimonials-category' ) );
            $this->set_layouts ( apply_filters ( 'topscorer_core_filter_testimonials_list_layouts', array() ) );
            $this->set_extra_options ( apply_filters ( 'topscorer_core_filter_testimonials_list_extra_options', array() ) );

            parent::__construct();
        }

        public function map_shortcode () {
            $this->set_shortcode_path ( TOPSCORER_CORE_CPT_URL_PATH . '/testimonials/shortcodes/testimonials-list' );
            $this->set_base ( 'topscorer_core_testimonials_list' );
            $this->set_name ( esc_html__( 'Testimonials List', 'topscorer-core' ) );
            $this->set_description ( esc_html__( 'Shortcode that displays list of testimonials', 'topscorer-core' ) );
            $this->set_category ( esc_html__( 'TopScorer Core', 'topscorer-core' ) );
            $this->set_option ( array (
                'field_type' => 'text',
                'name'       => 'custom_class',
                'title'      => esc_html__( 'Custom Class', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'slider_loop',
                'title'      => esc_html__( 'Enable Slider Loop', 'topscorer-core' ),
                'options'    => topscorer_core_get_select_type_options_pool ( 'yes_no' ),
                'dependency' => array (
                    'show' => array (
                        'behavior' => array (
                            'values'        => 'slider',
                            'default_value' => 'columns',
                        ),
                    ),
                ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'slider_autoplay',
                'title'      => esc_html__( 'Enable Slider Autoplay', 'topscorer-core' ),
                'options'    => topscorer_core_get_select_type_options_pool ( 'yes_no' ),
                'dependency' => array (
                    'show' => array (
                        'behavior' => array (
                            'values'        => 'slider',
                            'default_value' => 'columns',
                        ),
                    ),
                ),
            ) );
            $this->set_option ( array (
                'field_type'  => 'text',
                'name'        => 'slider_speed',
                'title'       => esc_html__( 'Slide Duration', 'topscorer-core' ),
                'description' => esc_html__( 'Default value is 5000 (ms)', 'topscorer-core' ),
                'dependency'  => array (
                    'show' => array (
                        'behavior' => array (
                            'values'        => 'slider',
                            'default_value' => 'columns',
                        ),
                    ),
                ),
            ) );
            $this->set_option ( array (
                'field_type'  => 'text',
                'name'        => 'slider_speed_animation',
                'title'       => esc_html__( 'Slide Animation Duration', 'topscorer-core' ),
                'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 800.', 'topscorer-core' ),
                'dependency'  => array (
                    'show' => array (
                        'behavior' => array (
                            'values'        => 'slider',
                            'default_value' => 'columns',
                        ),
                    ),
                ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'slider_navigation',
                'title'      => esc_html__( 'Enable Slider Navigation', 'topscorer-core' ),
                'options'    => topscorer_core_get_select_type_options_pool ( 'yes_no' ),
                'dependency' => array (
                    'show' => array (
                        'behavior' => array (
                            'values'        => 'slider',
                            'default_value' => 'columns',
                        ),
                    ),
                ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'slider_pagination',
                'title'      => esc_html__( 'Enable Slider Pagination', 'topscorer-core' ),
                'options'    => topscorer_core_get_select_type_options_pool ( 'yes_no' ),
                'dependency' => array (
                    'show' => array (
                        'behavior' => array (
                            'values'        => 'slider',
                            'default_value' => 'columns',
                        ),
                    ),
                ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'skin',
                'title'      => esc_html__( 'Skin', 'topscorer-core' ),
                'options'    => array (
                    ''      => esc_html__( 'Default', 'topscorer-core' ),
                    'light' => esc_html__( 'Light', 'topscorer-core' ),
                ),
            ) );
            $this->set_option ( array (
                'field_type'    => 'select',
                'name'          => 'text_position',
                'title'         => esc_html__( 'Text position', 'topscorer-core' ),
                'options'       => array (
                    'left'   => esc_html__( 'Left', 'topscorer-core' ),
                    'center' => esc_html__( 'Center', 'topscorer-core' ),
                ),
                'default_value' => 'left',
            ) );
            $this->map_query_options ( array ( 'post_type' => $this->get_post_type() ) );
            $this->map_layout_options ( array (
                'layouts'        => $this->get_layouts(),
                'exclude_option' => array ( 'title_tag', 'text_transform' ),
            ) );
        }

        public function render ( $options, $content = null ) {
            parent ::render ( $options );

            $atts = $this->get_atts();

            // forced atts
	        $atts['behavior']  = 'slider';
	        $atts['columns']   = 1;
	        $atts['space']     = 'no';

            $atts[ 'post_type' ] = $this->get_post_type();

            // Additional query args
            $atts[ 'additional_query_args' ] = $this->get_additional_query_args ( $atts );

            $atts[ 'unique' ] = wp_rand ( 1000, 9999 );

            $atts[ 'holder_classes' ] = $this->get_holder_classes ( $atts );
            $atts[ 'item_classes' ]   = $this->get_item_classes ( $atts );
            $atts[ 'slider_attr' ]    = $this->get_slider_data ( $atts, array (
	            'unique'            => $atts['unique'],
	            'outsideNavigation' => 'yes',
	            'direction'         => 'vertical',
            ) );
            $atts[ 'query_result' ]   = new \WP_Query( topscorer_core_get_query_params ( $atts ) );

            $atts[ 'this_shortcode' ] = $this;

            return topscorer_core_get_template_part ( 'post-types/testimonials/shortcodes/testimonials-list', 'templates/content', $atts[ 'behavior' ], $atts );
        }

        private function get_holder_classes ( $atts ) {
            $holder_classes = $this->init_holder_classes();

            $holder_classes[] = 'qodef-testimonials-list';
            $holder_classes[] = isset( $atts[ 'skin' ] ) && ! empty( $atts[ 'skin' ] ) ? 'qodef-skin--' . $atts[ 'skin' ] : '';
            $holder_classes[] = isset( $atts[ 'text_position' ] ) && ! empty( $atts[ 'text_position' ] ) ? 'qodef-position--' . $atts[ 'text_position' ] : '';

            $list_classes   = $this->get_list_classes ( $atts );
            $holder_classes = array_merge ( $holder_classes, $list_classes );

            return implode ( ' ', $holder_classes );
        }

        private function get_item_classes ( $atts ) {
            $item_classes = $this->init_item_classes();

            $list_item_classes = $this->get_list_item_classes ( $atts );

            $item_classes = array_merge ( $item_classes, $list_item_classes );

            return implode ( ' ', $item_classes );
        }
    }
}
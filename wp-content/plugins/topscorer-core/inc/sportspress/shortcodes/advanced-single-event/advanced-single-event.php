<?php

if ( ! function_exists ( 'topscorer_core_sportspress_add_advanced_single_event_shortcode' ) ) {
    /**
     * function that is adding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - array of registered shortcodes
     *
     * @return array
     */
    function topscorer_core_sportspress_add_advanced_single_event_shortcode ( $shortcodes ) {
        $shortcodes[] = 'TopScorerCoreSportsPressAdvancedSingleEventShortcode';

        return $shortcodes;
    }

    add_filter ( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_advanced_single_event_shortcode' );
}

if ( class_exists ( 'TopScorerCoreListShortcode' ) ) {
    class TopScorerCoreSportsPressAdvancedSingleEventShortcode extends TopScorerCoreListShortcode
    {
        public function __construct () {
            $this->set_layouts ( apply_filters ( 'topscorer_core_filter_sportspress_advanced_single_event_layouts', array() ) );
            $this->set_extra_options ( apply_filters ( 'topscorer_core_filter_sportspress_advanced_single_event_extra_options', array() ) );

            parent::__construct();
        }

        public function map_shortcode () {
            $this->set_shortcode_path ( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/advanced-single-event' );
            $this->set_base ( 'topscorer_core_sportspress_advanced_single_event' );
            $this->set_name ( esc_html__( 'Advanced Single Event', 'topscorer-core' ) );
            $this->set_description ( esc_html__( 'Shortcode that displays a single event', 'topscorer-core' ) );
            $this->set_category ( esc_html__( 'TopScorer Core SportsPress', 'topscorer-core' ) );
            $this->set_option ( array (
                'field_type' => 'text',
                'name'       => 'custom_class',
                'title'      => esc_html__( 'Custom Class', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'skin',
                'title'      => esc_html__( 'Skin', 'topscorer-core' ),
                'options'    => topscorer_core_get_select_type_options_pool ( 'skin' ),
            ) );
            $this->set_option ( array (
                'field_type'    => 'select',
                'name'          => 'event_type',
                'title'         => esc_html__( 'Events', 'topscorer-core' ),
                'options'       => array (
                    'next'     => esc_html__( 'Next Event', 'topscorer-core' ),
                    'upcoming' => esc_html__( 'Upcoming Events', 'topscorer-core' ),
                    'archived' => esc_html__( 'Archived Events', 'topscorer-core' ),
                ),
                'default_value' => 'next',
                'group'         => esc_html__( 'Query', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'upcoming_id',
                'title'      => esc_html__( 'Upcoming Event', 'topscorer-core' ),
                'options'    => topscorer_core_sportspress_get_events ( 'future' ),
                'dependency' => array (
                    'show' => array (
                        'event_type' => array (
                            'values'        => 'upcoming',
                            'default_value' => 'next',
                        ),
                    ),
                ),
                'group'      => esc_html__( 'Query', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'archived_id',
                'title'      => esc_html__( 'Archived Event', 'topscorer-core' ),
                'options'    => topscorer_core_sportspress_get_events(),
                'dependency' => array (
                    'show' => array (
                        'event_type' => array (
                            'values'        => 'archived',
                            'default_value' => 'next',
                        ),
                    ),
                ),
                'group'      => esc_html__( 'Query', 'topscorer-core' ),
            ) );
            $this->map_layout_options ( array (
                'layouts'        => $this->get_layouts(),
                'exclude_option' => array ( 'title_tag', 'text_transform' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'text',
                'name'       => 'background_text',
                'title'      => esc_html__( 'Background Text', 'topscorer-core' ),
                'group'      => esc_html__( 'Layout', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'color',
                'name'       => 'background_text_color',
                'title'      => esc_html__( 'Background Text Color', 'topscorer-core' ),
                'group'      => esc_html__( 'Layout', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'show_details_link',
                'title'      => esc_html__( 'Show Details Link', 'topscorer-core' ),
                'options'    => topscorer_core_get_select_type_options_pool ( 'no_yes', false ),
                'group'      => esc_html__( 'Layout', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'details_link_target',
                'title'      => esc_html__( 'Details Link Target', 'topscorer-core' ),
                'options'    => topscorer_core_get_select_type_options_pool ( 'link_target', false ),
                'dependency' => array (
                    'show' => array (
                        'show_details_link' => array (
                            'values'        => 'yes',
                            'default_value' => '',
                        ),
                    ),
                ),
                'group'      => esc_html__( 'Layout', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'show_tickets_link',
                'title'      => esc_html__( 'Show Ticket Link', 'topscorer-core' ),
                'options'    => topscorer_core_get_select_type_options_pool ( 'no_yes', false ),
                'group'      => esc_html__( 'Layout', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'select',
                'name'       => 'show_stream_link',
                'title'      => esc_html__( 'Show Live Stream Link', 'topscorer-core' ),
                'options'    => topscorer_core_get_select_type_options_pool ( 'no_yes', false ),
                'group'      => esc_html__( 'Layout', 'topscorer-core' ),
            ) );
        }

        public static function call_shortcode ( $params ) {
            $html = qode_framework_call_shortcode ( 'topscorer_core_sportspress_advanced_single_event', $params );
            $html = str_replace ( "\n", '', $html );

            return $html;
        }

        public function render ( $options, $content = null ) {
            parent ::render ( $options );

            $atts                             = $this->get_atts();
            $atts[ 'behavior' ]               = 'gallery';
            $atts[ 'holder_classes' ]         = $this->get_holder_classes ( $atts );
            $atts[ 'item_classes' ]           = $this->get_item_classes ( $atts );
            $atts[ 'event_id' ]               = topscorer_core_sportspress_get_event_id ( $atts );
            $atts[ 'team_ids' ]               = $this->get_team_ids ( $atts );
            $atts[ 'button_params' ]          = $this->get_button_params ( $atts );
            $atts[ 'background_text' ]        = $this->get_split_text ( $atts[ 'background_text' ] );
            $atts[ 'background_text_styles' ] = $this->get_background_text_styles ( $atts );
            $atts[ 'this_shortcode' ]         = $this;

            return topscorer_core_get_template_part ( 'sportspress/shortcodes/advanced-single-event', 'templates/content', '', $atts );
        }

        private function get_holder_classes ( $atts ) {
            $holder_classes = $this->init_holder_classes();

            $holder_classes[] = 'qodef-sportspress-advanced-single-event';
            $holder_classes[] = ! empty( $atts[ 'layout' ] ) ? 'qodef-item-layout--' . $atts[ 'layout' ] : '';
            $holder_classes[] = ! empty( $atts[ 'skin' ] ) ? 'qodef-skin--' . $atts[ 'skin' ] : '';

            $list_classes            = $this->get_list_classes ( $atts );
            $hover_animation_classes = $this->get_hover_animation_classes ( $atts );

            $holder_classes = array_merge ( $holder_classes, $list_classes, $hover_animation_classes );

            return implode ( ' ', $holder_classes );
        }

        public function get_item_classes ( $atts ) {
            $item_classes      = $this->init_item_classes();
            $list_item_classes = $this->get_list_item_classes ( $atts );

            $item_classes = array_merge ( $item_classes, $list_item_classes );

            return implode ( ' ', $item_classes );
        }

        public function get_title_styles ( $atts ) {
            $styles = array();

            if ( ! empty( $atts[ 'text_transform' ] ) ) {
                $styles[] = 'text-transform: ' . $atts[ 'text_transform' ];
            }

            return $styles;
        }

        public function get_team_ids ( $atts ) {
            $team_ids = array();

            if ( ! empty( $atts[ 'event_id' ] ) ) {
                $team_ids = get_post_meta ( $atts[ 'event_id' ], 'sp_team', false );
            }

            return $team_ids;
        }

        public function get_button_params ( $atts ) {
            $button_params = array();

            $button_params[ 'button_layout' ] = 'outlined';

            if ( 'light' === $atts[ 'skin' ] ) {
                $button_params[ 'color' ]              = '#ffffff';
                $button_params[ 'border_color' ]       = '#bbbbbb';
                $button_params[ 'hover_border_color' ] = '#fe5900';
            }

            return $button_params;
        }

        private function str_split_unicode ( $str ) {
            return preg_split ( '~~u', $str, - 1, PREG_SPLIT_NO_EMPTY );
        }

        private function get_split_text ( $text ) {
            if ( ! empty( $text ) ) {
                $split_text = $this->str_split_unicode ( $text );

                foreach ( $split_text as $key => $value ) {
                    $split_text[ $key ] = '<span class="qodef-m-character">' . $value . '</span>';
                }

                return implode ( ' ', $split_text );
            }

            return $text;
        }

        public function get_background_text_styles ( $atts ) {
            $styles = array();

            if ( ! empty( $atts[ 'background_text_color' ] ) ) {
                $styles[] = 'color: ' . $atts[ 'background_text_color' ];
            }

            return $styles;
        }
    }
}
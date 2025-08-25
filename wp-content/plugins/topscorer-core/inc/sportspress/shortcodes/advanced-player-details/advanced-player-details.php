<?php

if ( ! function_exists ( 'topscorer_core_sportspress_add_advanced_player_details_shortcode' ) ) {
    /**
     * function that is adding shortcode into shortcodes list for registration
     *
     * @param array $shortcodes - array of registered shortcodes
     *
     * @return array
     */
    function topscorer_core_sportspress_add_advanced_player_details_shortcode ( $shortcodes ) {
        $shortcodes[] = 'TopScorerCoreSportsPressAdvancedPlayerDetailsShortcode';

        return $shortcodes;
    }

    add_filter ( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_advanced_player_details_shortcode' );
}

if ( class_exists ( 'TopScorerCoreListShortcode' ) ) {
    class TopScorerCoreSportsPressAdvancedPlayerDetailsShortcode extends TopScorerCoreListShortcode
    {

        public function __construct () {
            $this->set_layouts ( apply_filters ( 'topscorer_core_filter_sportspress_advanced_player_details_layouts', array() ) );
            $this->set_extra_options ( apply_filters ( 'topscorer_core_filter_sportspress_advanced_player_details_extra_options', array() ) );

            parent::__construct();
        }

        public function map_shortcode () {
            $this->set_shortcode_path ( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/advanced-player-details' );
            $this->set_base ( 'topscorer_core_sportspress_advanced_player_details' );
            $this->set_name ( esc_html__( 'Advanced Player Details', 'topscorer-core' ) );
            $this->set_description ( esc_html__( 'Shortcode that displays details of a single player', 'topscorer-core' ) );
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
                'field_type' => 'select',
                'name'       => 'player_id',
                'title'      => esc_html__( 'Player', 'topscorer-core' ),
                'options'    => topscorer_core_sportspress_get_players(),
                'group'      => esc_html__( 'Query', 'topscorer-core' ),
            ) );
            $this->map_layout_options ( array (
                'layouts' => $this->get_layouts(),
            ) );
        }

        public static function call_shortcode ( $params ) {
            $html = qode_framework_call_shortcode ( 'topscorer_core_sportspress_advanced_single_event', $params );
            $html = str_replace ( "\n", '', $html );

            return $html;
        }

        public function render ( $options, $content = null ) {
            parent ::render ( $options );

            $atts                     = $this->get_atts();
            $atts[ 'behavior' ]       = 'gallery';
            $atts[ 'holder_classes' ] = $this->get_holder_classes ( $atts );
            $atts[ 'item_classes' ]   = $this->get_item_classes ( $atts );
            $atts[ 'button_params' ]  = $this->get_button_params ( $atts );
            $atts[ 'this_shortcode' ] = $this;

            return topscorer_core_get_template_part ( 'sportspress/shortcodes/advanced-player-details', 'templates/content', '', $atts );
        }

        private function get_holder_classes ( $atts ) {
            $holder_classes = $this->init_holder_classes();

            $holder_classes[] = 'qodef-sportspress-advanced-player-details';
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
    }
}
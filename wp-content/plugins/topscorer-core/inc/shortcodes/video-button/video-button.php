<?php

if ( ! function_exists ( 'topscorer_core_add_video_button_shortcode' ) ) {
    /**
     * Function that add shortcode into shortcodes list for registration
     *
     * @param $shortcodes array
     *
     * @return array
     */
    function topscorer_core_add_video_button_shortcode ( $shortcodes ) {
        $shortcodes[] = 'TopScorerCoreVideoButton';

        return $shortcodes;
    }

    add_filter ( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_add_video_button_shortcode' );
}

if ( class_exists ( 'TopScorerCoreShortcode' ) ) {
    class TopScorerCoreVideoButton extends TopScorerCoreShortcode
    {

        public function map_shortcode () {
            $this->set_shortcode_path ( TOPSCORER_CORE_SHORTCODES_URL_PATH . '/video-button' );
            $this->set_base ( 'topscorer_core_video_button' );
            $this->set_name ( esc_html__( 'Video Button', 'topscorer-core' ) );
            $this->set_description ( esc_html__( 'Shortcode that adds video button element', 'topscorer-core' ) );
            $this->set_category ( esc_html__( 'TopScorer Core', 'topscorer-core' ) );
            $this->set_option ( array (
                'field_type' => 'text',
                'name'       => 'custom_class',
                'title'      => esc_html__( 'Custom Class', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type' => 'text',
                'name'       => 'video_link',
                'title'      => esc_html__( 'Video Link', 'topscorer-core' ),
            ) );
            $this->set_option ( array (
                'field_type'  => 'image',
                'name'        => 'video_image',
                'title'       => esc_html__( 'Image', 'topscorer-core' ),
                'description' => esc_html__( 'Select image from media library', 'topscorer-core' ),
            ) );
        }

        public function render ( $options, $content = null ) {
            parent ::render ( $options );
            $atts = $this->get_atts();

            $atts[ 'holder_classes' ] = $this->get_holder_classes ( $atts );

            return topscorer_core_get_template_part ( 'shortcodes/video-button', 'templates/video-button', '', $atts );
        }

        private function get_holder_classes ( $atts ) {
            $holder_classes = $this->init_holder_classes();

            $holder_classes[] = 'qodef-video-button';
            $holder_classes[] = ! empty( $atts[ 'video_image' ] ) ? 'qodef-vb-has-img' : '';

            return implode ( ' ', $holder_classes );
        }
    }
}
<?php

if ( ! function_exists ( 'topscorer_core_add_blog_list_widget' ) ) {
    /**
     * Function that add widget into widgets list for registration
     *
     * @param $widgets array
     *
     * @return array
     */
    function topscorer_core_add_blog_list_widget ( $widgets ) {
        $widgets[] = 'TopScorerCoreBlogListWidget';

        return $widgets;
    }

    add_filter ( 'topscorer_core_filter_register_widgets', 'topscorer_core_add_blog_list_widget' );
}

if ( class_exists ( 'QodeFrameworkWidget' ) ) {
    class TopScorerCoreBlogListWidget extends QodeFrameworkWidget
    {

        public function map_widget () {
            $this->set_widget_option (
                array (
                    'field_type' => 'text',
                    'name'       => 'widget_title',
                    'title'      => esc_html__( 'Title', 'topscorer-core' ),
                )
            );
            $this->set_widget_option (
                array (
                    'field_type' => 'select',
                    'name'       => 'layout',
                    'title'      => esc_html__( 'Layout', 'topscorer-core' ),
                    'options'    => array (
                        'minimal' => esc_html__( 'Minimal', 'topscorer-core' ),
                        'simple'  => esc_html__( 'Simple', 'topscorer-core' ),
                    ),
                ) );
            $this->set_widget_option (
                array (
                    'field_type' => 'text',
                    'name'       => 'posts_per_page',
                    'title'      => esc_html__( 'Number of Posts', 'topscorer-core' ),
                )
            );
            $widget_mapped = $this->import_shortcode_options (
                array (
                    'shortcode_base' => 'topscorer_core_blog_list',
                    'exclude'        => array (
                        'enable_share_on_blog_list',
                        'enable_filter',
                        'pagination_type',
                        'layout',
                        'columns',
                        'columns_responsive',
                        'behavior',
                        'images_proportion',
                        'space',
                        'posts_per_page',
                        'excerpt_length',
                    ),
                ) );

            if ( $widget_mapped ) {
                $this->set_base ( 'topscorer_core_blog_list' );
                $this->set_name ( esc_html__( 'TopScorer Blog List', 'topscorer-core' ) );
                $this->set_description ( esc_html__( 'Display a list of blog posts', 'topscorer-core' ) );
            }
        }

        public function render ( $atts ) {
            // Forced atts
            $atts[ 'columns' ]           = 1;
            $atts[ 'behavior' ]          = 'columns';
            $atts[ 'images_proportion' ] = 'thumbnail';
            $atts[ 'space' ]             = 'no';

            $params = $this->generate_string_params ( $atts );

            echo do_shortcode ( "[topscorer_core_blog_list $params]" ); // XSS OK
        }
    }
}

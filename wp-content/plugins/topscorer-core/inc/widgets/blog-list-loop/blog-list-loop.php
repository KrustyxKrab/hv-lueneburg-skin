<?php

if ( ! function_exists ( 'topscorer_core_add_blog_list_loop_widget' ) ) {
    /**
     * Function that add widget into widgets list for registration
     *
     * @param $widgets array
     *
     * @return array
     */
    function topscorer_core_add_blog_list_loop_widget ( $widgets ) {
        $widgets[] = 'TopScorerCoreBlogListLoopWidget';

        return $widgets;
    }

    add_filter ( 'topscorer_core_filter_register_widgets', 'topscorer_core_add_blog_list_loop_widget' );
}

if ( class_exists ( 'QodeFrameworkWidget' ) ) {
    class TopScorerCoreBlogListLoopWidget extends QodeFrameworkWidget
    {

        public function map_widget () {
            $this->set_widget_option (
                array (
                    'field_type' => 'text',
                    'name'       => 'widget_tagline',
                    'title'      => esc_html__( 'Title', 'topscorer-core' ),
                )
            );
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
                        'layout',
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
                        'title_tag',
                        'text_transform',
                    ),
                ) );

            if ( $widget_mapped ) {
                $this->set_base ( 'topscorer_core_blog_list_loop' );
                $this->set_name ( esc_html__( 'TopScorer Blog List Loop', 'topscorer-core' ) );
                $this->set_description ( esc_html__( 'Display a list of blog posts in a loop', 'topscorer-core' ) );
            }
        }

        public function render ( $atts ) {
            // Forced atts
            $atts[ 'layout' ]            = 'title-only';
            $atts[ 'columns' ]           = 1;
            $atts[ 'behavior' ]          = 'slider';
            $atts[ 'space' ]             = 'no';
            $atts[ 'title_tag' ]         = 'p';
            $atts[ 'slider_navigation' ] = 'no';
            $atts[ 'slider_pagination' ] = 'no';
            $atts[ 'slider_autoplay' ]   = 'yes';
            $atts[ 'slider_loop' ]       = 'yes';

            $params = $this->generate_string_params ( $atts );

            echo '<div class="qodef-blog-list-loop-wrapper">';

            if ( ! empty( $atts[ 'widget_tagline' ] ) ) {
                echo '<div class="qodef-blog-list-loop-tagline">';
                echo esc_html ( $atts[ 'widget_tagline' ] );
                echo '</div>';
            }

            echo do_shortcode ( "[topscorer_core_blog_list $params]" ); // XSS OK

            echo '</div>';
        }
    }
}

<?php

if ( ! function_exists ( 'topscorer_core_add_blog_list_variation_standard_featured_image' ) ) {
    function topscorer_core_add_blog_list_variation_standard_featured_image ( $variations ) {
        $variations[ 'standard-featured-image' ] = esc_html__( 'Standard Featured Image', 'topscorer-core' );

        return $variations;
    }

    add_filter ( 'topscorer_core_filter_blog_list_layouts', 'topscorer_core_add_blog_list_variation_standard_featured_image' );
}
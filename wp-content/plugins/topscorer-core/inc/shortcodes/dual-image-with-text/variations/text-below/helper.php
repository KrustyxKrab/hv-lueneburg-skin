<?php

if ( ! function_exists ( 'topscorer_core_add_dual_image_with_text_variation_text_below' ) ) {
    function topscorer_core_add_dual_image_with_text_variation_text_below ( $variations ) {

        $variations[ 'text-below' ] = esc_html__( 'Text Below', 'topscorer-core' );

        return $variations;
    }

    add_filter ( 'topscorer_core_filter_dual_image_with_text_layouts', 'topscorer_core_add_dual_image_with_text_variation_text_below' );
}
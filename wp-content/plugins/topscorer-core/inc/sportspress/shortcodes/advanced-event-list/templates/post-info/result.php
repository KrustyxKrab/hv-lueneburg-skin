<?php

if ( 'yes' === get_option ( 'sportspress_event_show_outcome' ) ) {
    $all_results    = get_post_meta ( $event_id, 'sp_results', true ); // array of arrays
    $display_result = '';

    foreach ( $all_results as $key => $value ) {
        $current_results = array();
        $current_results = $value; // array
        end ( $current_results ); // set to last position, key->value should be 'outcome'->'win'
        $display_result .= prev ( $current_results ); // set to one before last position, should be final result

        if ( true == next ( $all_results ) ) {
            $display_result .= ':';
        }
    }

    if ( ! empty( $display_result ) ) {
        echo '<span>';
        echo esc_html( $display_result );
        echo '</span>';
    } else {
        esc_html_e( 'TBD', 'topscorer-core' );
    }
}
<?php

if ( 'yes' === get_option( 'sportspress_event_show_outcome' ) ) {
	$results = get_post_meta( $event_id, 'sp_results', true );
	$result  = '';

	foreach ( $results as $key => $value ) {
		$result .= $value['goals'];

		if ( true == next( $results ) ) {
			$result .= ':';
		}
	}

	if ( ! empty( $result ) ) {
		echo '<span>';
		echo esc_html( $result );
		echo '</span>';
	} else {
		esc_html_e( 'TBD', 'topscorer-core' );
	}
}
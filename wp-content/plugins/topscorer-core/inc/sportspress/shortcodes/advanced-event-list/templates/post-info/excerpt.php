<?php

$excerpt = get_the_excerpt( $event_id );

if ( ! isset( $excerpt_length ) || ( isset( $excerpt_length ) && $excerpt_length === '' ) ) {
	$excerpt_length = 180; // 180 is number of characters
}

if ( ! empty( $excerpt ) ) {
	$new_excerpt = ( $excerpt_length > 0 ) ? substr( $excerpt, 0, intval( $excerpt_length ) ) : $excerpt;

	echo strip_tags( $new_excerpt );
}
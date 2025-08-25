<?php if ( ! empty( $event_id ) ) {
	topscorer_core_list_sc_template_part( 'sportspress/shortcodes/advanced-single-event', 'layouts/' . $layout, '', $params );
} else {
	topscorer_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}
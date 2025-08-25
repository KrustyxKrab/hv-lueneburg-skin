<?php if ( ! empty( $event_ids ) ) {
	foreach ( $event_ids as $event_id ) {
		$params['event_id']     = $event_id;
		$params['team_ids']     = $this_shortcode->get_team_ids( $params );
		$params['item_classes'] = $this_shortcode->get_item_classes( $params );

		topscorer_core_list_sc_template_part( 'sportspress/shortcodes/advanced-event-list', 'layouts/' . $layout, '', $params );
	}
} else {
	topscorer_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}
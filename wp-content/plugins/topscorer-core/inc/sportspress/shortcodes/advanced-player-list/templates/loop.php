<?php if ( ! empty( $player_ids ) ) {
	foreach ( $player_ids as $player_id ) {
		$params['player_id']       = $player_id;
		$params['item_classes']    = $this_shortcode->get_item_classes( $params );
		$params['image_dimension'] = $this_shortcode->get_list_item_image_dimension( $params );

		topscorer_core_list_sc_template_part( 'sportspress/shortcodes/advanced-player-list', 'layouts/' . $layout, '', $params );
	}
} else {
	topscorer_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}
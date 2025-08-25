<?php $trophies = get_post_meta( $team_id, 'qodef_sportspress_team_single_trophies', true ); ?>

<?php $count = 0;
if ( ! empty( $trophies ) ) {
	foreach ( $trophies as $trophy ) {
		if ( $count === intval( $posts_per_page ) ) {
			break;
		}
		$count ++;

		$params['trophy_title']       = $trophy['qodef_sportspress_team_single_trophy_title'];
		$params['trophy_tagline']     = $trophy['qodef_sportspress_team_single_trophy_tagline'];
		$params['trophy_image']       = $trophy['qodef_sportspress_team_single_trophy_image'];
		$params['trophy_link']        = $trophy['qodef_sportspress_team_single_trophy_link'];
		$params['trophy_link_target'] = $trophy['qodef_sportspress_team_single_trophy_link_target'];

		topscorer_core_list_sc_template_part( 'sportspress/shortcodes/trophy-list', 'layouts/' . $layout, '', $params );
	}
} else {
	topscorer_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}
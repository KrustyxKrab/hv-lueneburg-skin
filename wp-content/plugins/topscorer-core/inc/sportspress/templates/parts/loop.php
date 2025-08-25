<?php

if ( have_posts() ) {
	while ( have_posts() ) : the_post();

		// hook to include additional content before post item
		do_action( 'topscorer_core_action_before_sportspress_item' );

		// include post item
		topscorer_core_template_part( 'sportspress', 'templates/parts/post', $slug );

		// hook to include additional content after post item
		do_action( 'topscorer_core_action_after_sportspress_item' );

	endwhile; // end of the loop
} else {
	// include posts not found
	topscorer_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();
<?php
$is_enabled    = topscorer_core_get_post_value_through_levels( 'qodef_blog_single_enable_related_posts' );
$related_posts = topscorer_core_get_blog_single_related_posts_type( get_the_ID() );

if ( $is_enabled === 'yes' && ! empty( $related_posts ) ) { ?>
    <div id="qodef-related-posts">
        <h3 class="qodef-related-posts-title"><?php esc_html_e( 'Related posts', 'topscorer-core' ); ?></h3>
		<?php
		$params = apply_filters( 'topscorer_core_filter_blog_single_related_posts_params', array(
			'custom_class'      => 'qodef--no-bottom-space',
			'layout'            => 'simple',
			'images_proportion' => 'medium',
			'columns'           => '3',
			'posts_per_page'    => 3,
			'additional_params' => 'tax',
			'tax'               => $related_posts['taxonomy'],
			'tax__in'           => $related_posts['items'],
			'title_tag'         => 'h4',
			'excerpt_length'    => '100'
		) );

		if ( class_exists( 'TopScorerCoreBlogListShortcode' ) ) {
			echo TopScorerCoreBlogListShortcode::call_shortcode( $params );
		}
		?>
    </div>
<?php } ?>
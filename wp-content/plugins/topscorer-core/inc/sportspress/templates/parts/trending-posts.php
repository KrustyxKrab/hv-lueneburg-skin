<?php
$is_enabled = topscorer_core_get_post_value_through_levels( 'qodef_sportspress_player_single_enable_trending_posts' );
$tax_slug   = topscorer_core_get_post_value_through_levels( 'qodef_sportspress_player_single_trending_posts_taxonomy' );
$tagline    = topscorer_core_get_post_value_through_levels( 'qodef_sportspress_player_single_trending_posts_tagline' );
$title      = topscorer_core_get_post_value_through_levels( 'qodef_sportspress_player_single_trending_posts_title' );

if ( $is_enabled === 'yes' ) : ?>
    <div class="qodef-sportspress-trending-posts qodef-m">

		<?php if ( ! empty( $tagline ) || ! empty( $title ) ): ?>

            <div class="qodef-m-text">

				<?php if ( ! empty( $tagline ) ): ?>
                    <div class="qodef-m-tagline">
						<?php echo esc_html( $tagline ); ?>
                    </div>
				<?php endif; ?>

				<?php if ( ! empty( $title ) ): ?>
                    <h2 class="qodef-m-title">
						<?php echo esc_html( $title ); ?>
                    </h2>
				<?php endif; ?>

            </div>

		<?php endif; ?>

        <div class="qodef-m-gallery">

			<?php
			$params = apply_filters( 'topscorer_core_filter_blog_single_related_posts_params', array(
				'custom_class'              => 'qodef--no-bottom-space',
				'layout'                    => 'metro',
				'behavior'                  => 'masonry',
				'masonry_images_proportion' => 'fixed',
				'columns'                   => '4',
				'space'                     => 'no',
				'posts_per_page'            => 6,
				'additional_params'         => 'tax',
				'tax'                       => 'trending',
				'tax_slug'                  => $tax_slug,
				'orderby'                   => 'date',
				'order'                     => 'DESC',
				'title_tag'                 => 'h4',
				'excerpt_length'            => '100'
			) );

			if ( class_exists( 'TopScorerCoreBlogListShortcode' ) ) {
				echo TopScorerCoreBlogListShortcode::call_shortcode( $params );
			}
			?>

        </div>

    </div>
<?php endif; ?>
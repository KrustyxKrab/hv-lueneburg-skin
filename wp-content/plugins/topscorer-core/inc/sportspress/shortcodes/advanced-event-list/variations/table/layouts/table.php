<?php $title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4'; ?>

<div class="<?php echo esc_attr( $item_classes ); ?>">
    <div class="qodef-e-content">

        <div class="qodef-e-images">
			<?php if ( ! empty( $team_ids[ 0 ] ) && ! empty( $team_ids[ 1 ] ) ) : ?>
				<?php if ( ! empty( $team_ids[ 0 ] ) ): ?>
                    <div class="qodef-team--home">
						<?php $params[ 'team_id' ] = $team_ids[ 0 ]; ?>
						<?php if ( has_post_thumbnail( $team_ids[ 0 ] ) ) : ?>
                            <div class="qodef-e-image">
								<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/team-image', '', $params ); ?>
                            </div>
							<?php echo '<' . topscorer_core_escape_title_tag( $title_tag ); ?> class="qodef-e-name" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
							<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/name', '', $params ); ?>
							<?php echo '</' . topscorer_core_escape_title_tag( $title_tag ); ?>>
						<?php endif; ?>
                    </div>
				<?php endif; ?>
                <div class="qodef-e-delimiter">
					<?php echo get_option( 'sportspress_event_teams_delimiter', 'vs' ); ?>
                </div>
				<?php if ( ! empty( $team_ids[ 1 ] ) ): ?>
                    <div class="qodef-team--away">
						<?php $params[ 'team_id' ] = $team_ids[ 1 ]; ?>
						<?php if ( has_post_thumbnail( $team_ids[ 1 ] ) ) : ?>
                            <div class="qodef-e-image">
								<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/team-image', '', $params ); ?>
                            </div>
						<?php endif; ?>
						<?php echo '<' . topscorer_core_escape_title_tag( $title_tag ); ?>
                        class="qodef-e-name" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>
                        >
						<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/name', '', $params ); ?>
						<?php echo '</' . topscorer_core_escape_title_tag( $title_tag ); ?>>
                    </div>
				<?php endif; ?>
			<?php else: ?>
				<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/event-image', '', $params ); ?>
			<?php endif; ?>
        </div>

        <div class="qodef-e-details">
            <div itemprop="name" class="qodef-e-title entry-title">
				<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/title', '', $params ); ?>
            </div>
            <div class="qodef-e-excerpt">
				<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/excerpt', '', $params ); ?>
            </div>

			<?php if ( 'future' === get_post_status( $params[ 'event_id' ] ) ): ?>
                <div class="qodef-e-date">
					<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/date', '', $params ); ?>
                </div>
			<?php else: ?>
                <div class="qodef-e-result">
					<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/result', '', $params ); ?>
                </div>
			<?php endif; ?>

        </div>

		<?php if ( ! empty( $show_details_link ) || ! empty( $show_tickets_link ) || ! empty( $show_stream_link ) ): ?>
            <div class="qodef-e-links">
				<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/details-link', '', $params ); ?>
				<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/tickets-link', '', $params ); ?>
				<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/stream-link', '', $params ); ?>
            </div>
		<?php endif; ?>

    </div>
</div>
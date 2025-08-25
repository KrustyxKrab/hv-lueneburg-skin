<div class="<?php echo esc_attr( $item_classes ); ?> qodef--has-appear">
    <div class="qodef-e-content">

		<?php if ( ! empty( $team_ids[0] ) && ! empty( $team_ids[1] ) ) : ?>
			<?php if ( ! empty( $team_ids[0] ) ): ?>
				<?php $params['team_id'] = $team_ids[0]; ?>
				<?php if ( has_post_thumbnail( $team_ids[0] ) ) : ?>
                    <div class="qodef-e-image qodef-team--home">
						<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/team-image', '', $params ); ?>
                    </div>
				<?php endif; ?>
                <div class="qodef-e-name qodef-team--home">
					<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/name', '', $params ); ?>
                </div>
			<?php endif; ?>
		<?php else: ?>
            <div class="qodef-e-image">
				<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/post-info/event-image', '', $params ); ?>
            </div>
		<?php endif; ?>

		<?php if ( 'future' === get_post_status( $params['event_id'] ) ): ?>
            <div class="qodef-e-date">
				<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/date', '', $params ); ?>
            </div>
		<?php else: ?>
            <div class="qodef-e-result">
				<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/result', '', $params ); ?>
            </div>
		<?php endif; ?>

		<?php if ( ! empty( $team_ids[0] ) && ! empty( $team_ids[1] ) ) : ?>
			<?php if ( ! empty( $team_ids[1] ) ): ?>
				<?php $params['team_id'] = $team_ids[1]; ?>
                <div class="qodef-e-name qodef-team--away">
					<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/name', '', $params ); ?>
                </div>
				<?php if ( has_post_thumbnail( $team_ids[1] ) ) : ?>
                    <div class="qodef-e-image qodef-team--away">
						<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/team-image', '', $params ); ?>
                    </div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/background-text', '', $params ); ?>
    </div>

    <div class="qodef-e-links">
		<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/details-link', '', $params ); ?>
		<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/tickets-link', '', $params ); ?>
		<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-single-event', 'templates/post-info/stream-link', '', $params ); ?>
    </div>

</div>
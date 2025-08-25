<?php $link = get_post_meta( $event_id, 'qodef_sportspress_event_single_tickets_link', true ); ?>

<?php if ( $show_tickets_link === 'yes' && ! empty( $link ) ) : ?>

	<?php

	$button_params['text']   = esc_html__( 'Get Tickets', 'topscorer-core' );
	$button_params['link']   = $link;
	$button_params['target'] = $stream_link_target;

	?>

    <div class="qodef-e-button">
		<?php echo TopScorerCoreButtonShortcode::call_shortcode( $button_params ); ?>
    </div>

<?php endif; ?>
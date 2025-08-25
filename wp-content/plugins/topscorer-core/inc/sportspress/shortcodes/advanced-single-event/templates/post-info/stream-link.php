<?php $stream_link = get_post_meta( $event_id, 'qodef_sportspress_event_single_live_stream_link', true ); ?>
<?php $stream_link_target = get_post_meta( $event_id, 'qodef_sportspress_event_single_live_stream_link_target', true ); ?>

<?php if ( $show_stream_link === 'yes' && ! empty( $stream_link ) ) : ?>

	<?php

	$button_params['text']         = esc_html__( 'Watch Stream', 'topscorer-core' );
	$button_params['link']         = $stream_link;
	$button_params['target']       = $stream_link_target;
	$button_params['custom_class'] = 'qodef-stream';

	?>

    <div class="qodef-e-button">
		<?php echo TopScorerCoreButtonShortcode::call_shortcode( $button_params ); ?>
    </div>

<?php endif; ?>
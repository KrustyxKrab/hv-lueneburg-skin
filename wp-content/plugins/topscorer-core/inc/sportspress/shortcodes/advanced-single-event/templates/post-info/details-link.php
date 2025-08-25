<?php if ( $show_details_link === 'yes' ) : ?>

	<?php

	$button_params['text']   = esc_html__( 'View Event Details', 'topscorer-core' );
	$button_params['link']   = get_permalink( $event_id );
	$button_params['target'] = $details_link_target;

	?>

    <div class="qodef-e-button">
		<?php echo TopScorerCoreButtonShortcode::call_shortcode( $button_params ); ?>
    </div>

<?php endif; ?>
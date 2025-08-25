<?php

$team_short_name = get_post_meta( $team_id, 'sp_short_name', true );

?>

<?php if ( ! empty( $team_short_name ) ): ?>

    <span class="qodef-e-short-name">
		<?php echo esc_html( $team_short_name ); ?>
    </span>

<?php else: ?>

    <span class="qodef-e-full-name">
		<?php echo get_the_title( $team_id ); ?>
    </span>

<?php endif; ?>
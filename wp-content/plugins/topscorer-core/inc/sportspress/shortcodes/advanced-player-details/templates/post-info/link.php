<?php

$button_params[ 'text' ] = esc_html__( 'View Profile', 'topscorer-core' );
$button_params[ 'link' ] = get_permalink ( $player_id );

?>

<div class="qodef-e-button">
    <?php echo TopScorerCoreButtonShortcode ::call_shortcode ( $button_params ); ?>
</div>

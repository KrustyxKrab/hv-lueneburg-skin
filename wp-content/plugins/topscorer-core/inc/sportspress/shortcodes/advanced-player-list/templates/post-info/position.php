<?php

$player_position = get_the_term_list( $player_id, 'sp_position', '', ',', '' );

if ( ! empty( $player_position ) ) : ?>
    <div class="qodef-e-position"><?php echo wp_kses_post( $player_position ); ?></div>
<?php endif; ?>
<?php
global $post;
$player_id = $post->ID;

$player_position = get_the_term_list( $player_id, 'sp_position', '', ',', '' );
?>

<div class="qodef-sportspress-intro qodef-m">

	<?php if ( ! empty( $player_position ) ) : ?>
        <div class="qodef-m-position"><?php echo wp_kses_post( $player_position ); ?></div>
	<?php endif; ?>

    <h3 class="qodef-m-name">
		<?php echo get_the_title( $player_id ); ?>
    </h3>

</div>
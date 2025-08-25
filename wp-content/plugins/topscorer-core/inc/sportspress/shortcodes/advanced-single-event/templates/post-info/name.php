<?php

$team_first_name = get_post_meta ( $team_id, 'qodef_sportspress_team_single_first_name', true );
$team_short_name = get_post_meta ( $team_id, 'sp_short_name', true );
$item_link       = get_permalink ( $team_id );

?>

<a class="qodef-e-link" href="<?php echo esc_url ( $item_link ) ?>">
    <?php if ( ! empty( $team_first_name ) && ! empty( $team_short_name ) ): ?>

        <div class="qodef-e-first-name">
            <?php echo esc_html ( $team_first_name ); ?>
        </div>
        <div class="qodef-e-short-name">
            <?php echo esc_html ( $team_short_name ); ?>
        </div>

    <?php else: ?>

        <div class="qodef-e-full-name">
            <?php echo get_the_title ( $team_id ); ?>
        </div>

    <?php endif; ?>
</a>
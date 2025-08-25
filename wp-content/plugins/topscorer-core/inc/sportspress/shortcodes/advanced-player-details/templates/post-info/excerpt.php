<?php
$excerpt = get_the_excerpt ( $player_id );

if ( ! empty( $excerpt ) ) : ?>
    <h5 class="qodef-e-tagline"><?php echo esc_html__( 'Short Biography', 'topscorer-core' ); ?></h5>

    <p itemprop="description" class="qodef-e-excerpt">
        <?php echo esc_html( $excerpt ); ?>
    </p>
<?php endif; ?>
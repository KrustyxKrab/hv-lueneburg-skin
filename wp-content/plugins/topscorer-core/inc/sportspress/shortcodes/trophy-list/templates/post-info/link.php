<?php if ( ! empty( $trophy_link ) ): ?>
    <?php $trophy_target = ! empty( $trophy_target ) ? $trophy_target : '_self'; ?>

    <a class="qodef-e-link" href="<?php echo esc_url ( $trophy_link ) ?>" target="<?php echo esc_attr ( $trophy_target ); ?>"></a>

<?php endif; ?>
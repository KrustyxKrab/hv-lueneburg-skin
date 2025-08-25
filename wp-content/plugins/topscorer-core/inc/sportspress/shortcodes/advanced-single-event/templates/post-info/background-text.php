<?php if ( ! empty( $background_text ) ): ?>

    <div class="qodef-e-background-text" <?php echo qode_framework_get_inline_style ( $background_text_styles ); ?>>
        <?php  echo wp_kses_post( $background_text ); ?>
    </div>

<?php endif; ?>
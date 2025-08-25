<?php if ( ! empty( $tagline ) ) : ?>
    <p class="qodef-m-tagline" <?php qode_framework_inline_style ( $tagline_styles ); ?>>
        <?php echo esc_html ( $tagline ); ?>
    </p>
<?php endif; ?>
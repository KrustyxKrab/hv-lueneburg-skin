<?php $title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4'; ?>

<?php if ( ! empty( $price ) ): ?>
	<?php echo '<' . topscorer_core_escape_title_tag( $title_tag ); ?> class="qodef-e-price" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
	<?php echo esc_html( $price ); ?>
	<?php echo '</' . topscorer_core_escape_title_tag( $title_tag ); ?>>
<?php endif; ?>
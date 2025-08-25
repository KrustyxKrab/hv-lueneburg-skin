<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
?>

<?php echo '<' . topscorer_core_escape_title_tag( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
	<?php echo esc_html( $trophy_title ); ?>
<?php echo '</' . topscorer_core_escape_title_tag( $title_tag ); ?>>
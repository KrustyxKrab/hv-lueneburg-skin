<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
?>

<?php echo '<' . topscorer_core_escape_title_tag( $title_tag ); ?> itemprop="name" class="qodef-e-name entry-title" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
<a itemprop="url" class="qodef-e-name-link" href="<?php echo get_permalink( $player_id ); ?>" title="<?php the_title_attribute( array( 'post' => $player_id ) ); ?>">
	<?php echo get_the_title( $player_id ); ?>
</a>
<?php echo '</' . topscorer_core_escape_title_tag( $title_tag ); ?>>
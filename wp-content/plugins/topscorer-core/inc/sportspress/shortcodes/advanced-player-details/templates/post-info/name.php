<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
?>

<?php echo '<' . esc_attr ( $title_tag ); ?> itemprop="name" class="qodef-e-name entry-title" <?php qode_framework_inline_style ( $this_shortcode->get_title_styles ( $params ) ); ?>>
<?php echo get_the_title ( $player_id ); ?>
<?php echo '</' . esc_attr ( $title_tag ); ?>>
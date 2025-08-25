<?php

$option = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_archive_title_tag' );

$title_tag = ! empty( $option ) ? $option : 'h4';

?>

<?php echo '<' . esc_attr ( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title">
<a itemprop="url" class="qodef-e-title-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <?php the_title(); ?>
</a>
<?php echo '</' . esc_attr ( $title_tag ); ?>>
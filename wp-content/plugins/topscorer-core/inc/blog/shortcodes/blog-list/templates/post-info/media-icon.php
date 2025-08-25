<?php

$post_format = get_post_format();
$svg         = '';

switch ( $post_format ) {
    case 'video':
        $svg = 'play-button';
        break;
}

?>

<?php if ( ! empty( $svg ) ): ?>
    <div class="qodef-e-media-icon">
        <?php echo topscorer_core_get_svg ( $svg ); ?>
	    <a itemprop="url" class="qodef-e-post-link" href="<?php the_permalink(); ?>"
	       title="<?php the_title_attribute(); ?>"></a>
    </div>
<?php endif; ?>
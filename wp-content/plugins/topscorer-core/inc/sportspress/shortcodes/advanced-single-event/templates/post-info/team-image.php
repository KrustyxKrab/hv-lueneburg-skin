<?php

$team_image      = get_post_thumbnail_id ( $team_id );
$image_dimension = 'full';
$item_link       = get_permalink ( $team_id );

?>

<a class="qodef-e-link" href="<?php echo esc_url ( $item_link ) ?>">
    <?php echo topscorer_core_get_list_shortcode_item_image ( $image_dimension, $team_image ); ?>
</a>
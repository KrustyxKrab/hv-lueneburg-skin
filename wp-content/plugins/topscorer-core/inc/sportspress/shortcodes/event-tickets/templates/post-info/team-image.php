<?php

$team_image      = get_post_thumbnail_id( $team_id );
$image_dimension = 'full';

echo topscorer_core_get_list_shortcode_item_image( $image_dimension, $team_image );
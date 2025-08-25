<?php

$event_image     = get_post_thumbnail_id( $event_id );
$image_dimension = 'full';

echo topscorer_core_get_list_shortcode_item_image( $image_dimension, $event_image );
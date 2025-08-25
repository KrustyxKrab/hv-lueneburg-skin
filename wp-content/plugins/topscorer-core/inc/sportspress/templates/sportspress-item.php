<?php

$params = array( 'slug' => $slug );

get_header();

// include cpt content template
topscorer_core_template_part( 'sportspress', 'templates/content', '', $params );

get_footer();
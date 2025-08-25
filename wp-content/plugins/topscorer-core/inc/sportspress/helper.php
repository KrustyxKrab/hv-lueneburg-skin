<?php

if ( ! function_exists ( 'topscorer_core_register_sportspress_singles_for_meta_options' ) ) {
    function topscorer_core_register_sportspress_singles_for_meta_options ( $post_types ) {
        $post_types[] = 'sp_player';
        $post_types[] = 'sp_team';
        $post_types[] = 'sp_event';
        $post_types[] = 'sp_table';
        $post_types[] = 'sp_list';
        $post_types[] = 'sp_staff';
        $post_types[] = 'sp_official';
        $post_types[] = 'sp_calendar';

        return $post_types;
    }

    add_filter ( 'qode_framework_filter_meta_box_save', 'topscorer_core_register_sportspress_singles_for_meta_options' );
    add_filter ( 'qode_framework_filter_meta_box_remove', 'topscorer_core_register_sportspress_singles_for_meta_options' );
}

if ( ! function_exists ( 'topscorer_core_set_sportspress_league_single_custom_sidebar_name' ) ) {
    /**
     * function that return sidebar name
     *
     * @param $sidebar_name string
     *
     * @return string
     */
    function topscorer_core_set_sportspress_league_single_custom_sidebar_name ( $sidebar_name ) {
        if ( is_singular ( 'sp_table' ) ) {
            $option = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_league_single_custom_sidebar' );
        }

        if ( isset( $option ) && ! empty( $option ) ) {
            $sidebar_name = $option;
        }

        return $sidebar_name;
    }

    add_filter ( 'topscorer_filter_sidebar_name', 'topscorer_core_set_sportspress_league_single_custom_sidebar_name' );
}

if ( ! function_exists ( 'topscorer_core_set_sportspress_league_single_sidebar_layout' ) ) {
    /**
     * function that return sidebar layout
     *
     * @param $layout string
     *
     * @return string
     */
    function topscorer_core_set_sportspress_league_single_sidebar_layout ( $layout ) {
        if ( is_singular ( 'sp_table' ) ) {
            $option = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_league_single_sidebar_layout' );
        }

        if ( isset( $option ) && ! empty( $option ) ) {
            $layout = $option;
        }

        return $layout;
    }

    add_filter ( 'topscorer_filter_sidebar_layout', 'topscorer_core_set_sportspress_league_single_sidebar_layout' );
}

if ( ! function_exists ( 'topscorer_core_set_sportspress_league_single_sidebar_grid_gutter_classes' ) ) {
    /**
     * function that returns grid gutter classes
     *
     * @param $classes string
     *
     * @return string
     */
    function topscorer_core_set_sportspress_league_single_sidebar_grid_gutter_classes ( $classes ) {
        if ( is_singular ( 'sp_table' ) ) {
            $option = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_league_single_sidebar_grid_gutter' );
        }

        if ( isset( $option ) && ! empty( $option ) ) {
            $classes = 'qodef-gutter--' . esc_attr ( $option );
        }

        return $classes;
    }

    add_filter ( 'topscorer_filter_grid_gutter_classes', 'topscorer_core_set_sportspress_league_single_sidebar_grid_gutter_classes' );
}

if ( ! function_exists ( 'topscorer_core_sportspress_include_templates' ) ) {
    /**
     * function that load proper sportspress template
     *
     * @param $template
     */
    function topscorer_core_sportspress_include_templates ( $template ) {
        if ( is_singular ( 'sp_player' ) ||
            is_singular ( 'sp_event' ) ||
            is_singular ( 'sp_calendar' ) ||
            is_singular ( 'sp_team' ) ||
            is_singular ( 'sp_table' ) ||
            is_singular ( 'sp_list' ) ||
            is_singular ( 'sp_staff' ) ||
            is_singular ( 'sp_official' ) ) {

            if ( is_singular ( 'sp_player' ) ) {
                $slug = 'single-player';
            }

            if ( is_singular ( 'sp_event' ) ||
                is_singular ( 'sp_calendar' ) ||
                is_singular ( 'sp_team' ) ||
                is_singular ( 'sp_table' ) ||
                is_singular ( 'sp_list' ) ||
                is_singular ( 'sp_staff' ) ||
                is_singular ( 'sp_official' ) ) {
                $slug = '';
            }

            $params   = array ( 'slug' => $slug );
            $template = topscorer_core_template_part ( 'sportspress', 'templates/sportspress-item', '', $params );
        }

        return $template;
    }

    add_filter ( 'template_include', 'topscorer_core_sportspress_include_templates', 99 );
}

if ( ! function_exists ( 'topscorer_core_set_sportspress_player_single_page_inner_classes' ) ) {
    /**
     * function that set classes for the page inner div from header.php
     *
     * @return string
     */
    function topscorer_core_set_sportspress_player_single_page_inner_classes ( $classes ) {
        if ( is_singular ( 'sp_player' ) ) {
            $option = get_option ( 'sportspress_player_page_template' );

            if ( $option === 'page-full-width.php' ) {
                $classes = 'qodef-content-full-width';
            } else {
                $classes = 'qodef-content-mixed';
            }
        }

        if ( is_singular ( 'sp_event' ) ) {
            $option = get_option ( 'sportspress_event_page_template' );

            if ( $option === 'page-full-width.php' ) {
                $classes = 'qodef-content-full-width';
            } else {
                $classes = 'qodef-content-mixed';
            }
        }

        if ( is_singular ( 'sp_team' ) ) {
            $option = get_option ( 'sportspress_team_page_template' );

            if ( $option === 'page-full-width.php' ) {
                $classes = 'qodef-content-full-width';
            } else {
                $classes = 'qodef-content-mixed';
            }
        }

        if ( is_singular ( 'sp_staff' ) ) {
            $option = get_option ( 'sportspress_staff_page_template' );

            if ( $option === 'page-full-width.php' ) {
                $classes = 'qodef-content-full-width';
            } else {
                $classes = 'qodef-content-mixed';
            }
        }

        return $classes;
    }

    add_filter ( 'topscorer_filter_page_inner_classes', 'topscorer_core_set_sportspress_player_single_page_inner_classes' );
}

if ( ! function_exists ( 'topscorer_core_include_player_single_trending_posts_template' ) ) {
    /**
     * function that include trending posts template
     */
    function topscorer_core_include_player_single_trending_posts_template () {
        if ( is_singular ( 'sp_player' ) ) {
            include_once TOPSCORER_CORE_INC_PATH . '/sportspress/templates/parts/trending-posts.php';
        }
    }

    add_action ( 'topscorer_action_after_sportspress_player_single_content', 'topscorer_core_include_player_single_trending_posts_template' );
}

if ( ! function_exists ( 'topscorer_core_include_player_single_related_players_template' ) ) {
    /**
     * function that include related players template
     */
    function topscorer_core_include_player_single_related_players_template () {
        if ( is_singular ( 'sp_player' ) ) {
            include_once TOPSCORER_CORE_INC_PATH . '/sportspress/templates/parts/related-players.php';
        }
    }

    add_action ( 'topscorer_action_after_sportspress_player_single_content', 'topscorer_core_include_player_single_related_players_template' );
}

if ( ! function_exists ( 'topscorer_core_get_trending_taxonomies' ) ) {
    function topscorer_core_get_trending_taxonomies ( $enable_default = true ) {
        $trending_taxonomies = array();

        if ( $enable_default ) {
            $trending_taxonomies[ '' ] = esc_html__( 'Default', 'topscorer-core' );
        }

        $terms = get_terms ( array (
            'taxonomy' => 'trending',
        ) );

        if ( ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $trending_taxonomies[ $term->slug ] = $term->name;
            }
        }

        return $trending_taxonomies;
    }
}

if ( ! function_exists ( 'topscorer_core_include_player_single_intro_template' ) ) {
    /**
     * function that include intro template
     */
    function topscorer_core_include_player_single_intro_template () {
        if ( is_singular ( 'sp_player' ) ) {
            include_once TOPSCORER_CORE_INC_PATH . '/sportspress/templates/parts/player-intro.php';
        }
    }

    add_action ( 'topscorer_action_before_sportspress_player_single_content', 'topscorer_core_include_player_single_intro_template' );
}

//////////////////////////////

if ( ! function_exists ( 'topscorer_core_set_sportspress_archive_custom_sidebar_name' ) ) {
    /**
     * function that return sidebar name
     *
     * @param $sidebar_name string
     *
     * @return string
     */
    function topscorer_core_set_sportspress_archive_custom_sidebar_name ( $sidebar_name ) {
        if ( is_tax ( 'sp_venue' ) || is_tax ( 'sp_position' ) || is_tax ( 'sp_role' ) ) {
            $option = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_archive_custom_sidebar' );
        }

        if ( isset( $option ) && ! empty( $option ) ) {
            $sidebar_name = $option;
        }

        return $sidebar_name;
    }

    add_filter ( 'topscorer_filter_sidebar_name', 'topscorer_core_set_sportspress_archive_custom_sidebar_name' );
}

if ( ! function_exists ( 'topscorer_core_set_sportspress_archive_sidebar_layout' ) ) {
    /**
     * function that return sidebar layout
     *
     * @param $layout string
     *
     * @return string
     */
    function topscorer_core_set_sportspress_archive_sidebar_layout ( $layout ) {
        if ( is_tax ( 'sp_venue' ) || is_tax ( 'sp_position' ) || is_tax ( 'sp_role' ) ) {
            $option = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_archive_sidebar_layout' );
        }

        if ( isset( $option ) && ! empty( $option ) ) {
            $layout = $option;
        }

        return $layout;
    }

    add_filter ( 'topscorer_filter_sidebar_layout', 'topscorer_core_set_sportspress_archive_sidebar_layout' );
}

if ( ! function_exists ( 'topscorer_core_set_sportspress_archive_sidebar_grid_gutter_classes' ) ) {
    /**
     * function that returns grid gutter classes
     *
     * @param $classes string
     *
     * @return string
     */
    function topscorer_core_set_sportspress_archive_sidebar_grid_gutter_classes ( $classes ) {
        if ( is_tax ( 'sp_venue' ) || is_tax ( 'sp_position' ) || is_tax ( 'sp_role' ) ) {
            $option = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_archive_sidebar_grid_gutter' );
        }

        if ( isset( $option ) && ! empty( $option ) ) {
            $classes = 'qodef-gutter--' . esc_attr ( $option );
        }

        return $classes;
    }

    add_filter ( 'topscorer_filter_grid_gutter_classes', 'topscorer_core_set_sportspress_archive_sidebar_grid_gutter_classes' );
}

if ( ! function_exists ( 'topscorer_core_get_sportspress_archive_excerpt_length' ) ) {
    /**
     * function that return number of characters for excerpt on archive pages
     *
     * @return int
     */
    function topscorer_core_get_sportspress_archive_excerpt_length () {
        $length = apply_filters ( 'topscorer_core_filter_sportspress_archive_excerpt_length', 180 );

        return intval ( $length );
    }
}

if ( ! function_exists ( 'topscorer_core_set_sportspress_archive_excerpt_length' ) ) {
    /**
     * function that set number of characters for excerpt on archive pages
     *
     * @param $excerpt_length int
     *
     * @return int
     */
    function topscorer_core_set_sportspress_archive_excerpt_length ( $excerpt_length ) {
        $option = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_archive_number_of_characters' );

        if ( $option !== '' ) {
            $excerpt_length = $option;
        }

        return $excerpt_length;
    }

    add_filter ( 'topscorer_core_filter_sportspress_archive_excerpt_length', 'topscorer_core_set_sportspress_archive_excerpt_length' );
}
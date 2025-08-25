<?php

if ( ! function_exists( 'topscorer_core_include_blog_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function topscorer_core_include_blog_shortcodes() {
		foreach ( glob( TOPSCORER_CORE_INC_PATH . '/blog/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_framework_action_before_shortcodes_register', 'topscorer_core_include_blog_shortcodes' );
}

if ( ! function_exists( 'topscorer_core_include_blog_shortcodes_widget' ) ) {
	/**
	 * Function that includes widgets
	 */
	function topscorer_core_include_blog_shortcodes_widget() {
		foreach ( glob( TOPSCORER_CORE_INC_PATH . '/blog/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'topscorer_core_include_blog_shortcodes_widget' );
}

if ( ! function_exists( 'topscorer_core_set_blog_single_page_title' ) ) {
	/**
	 * Function that enable/disable page title area for blog single page
	 *
	 * @param $enable_page_title bool
	 *
	 * @return bool
	 */
	function topscorer_core_set_blog_single_page_title( $enable_page_title ) {

		if ( is_singular( 'post' ) ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_blog_single_enable_page_title' ) !== 'no';

			if ( isset ( $option ) ) {
				$enable_page_title = $option;
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_enable_page_title', true );

			if ( ! empty( $meta_option ) ) {
				$enable_page_title = $meta_option;
			}
		}

		return $enable_page_title;
	}

	add_filter( 'topscorer_filter_enable_page_title', 'topscorer_core_set_blog_single_page_title' );
}

if ( ! function_exists( 'topscorer_core_set_blog_single_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function topscorer_core_set_blog_single_sidebar_layout( $layout ) {

		if ( is_singular( 'post' ) ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_blog_single_sidebar_layout' );

			if ( ! empty( $option ) ) {
				$layout = $option;
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_layout', true );

			if ( ! empty( $meta_option ) ) {
				$layout = $meta_option;
			}
		}

		return $layout;
	}

	add_filter( 'topscorer_filter_sidebar_layout', 'topscorer_core_set_blog_single_sidebar_layout' );
}

if ( ! function_exists( 'topscorer_core_set_blog_single_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function topscorer_core_set_blog_single_custom_sidebar_name( $sidebar_name ) {

		if ( is_singular( 'post' ) ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_blog_single_custom_sidebar' );

			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_custom_sidebar', true );

			if ( ! empty( $meta_option ) ) {
				$sidebar_name = $meta_option;
			}
		}

		return $sidebar_name;
	}

	add_filter( 'topscorer_filter_sidebar_name', 'topscorer_core_set_blog_single_custom_sidebar_name' );
}

if ( ! function_exists( 'topscorer_core_set_blog_single_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function topscorer_core_set_blog_single_sidebar_grid_gutter_classes( $classes ) {

		if ( is_singular( 'post' ) ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_blog_single_sidebar_grid_gutter' );

			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}

			$meta_option = get_post_meta( get_the_ID(), 'qodef_page_sidebar_grid_gutter', true );

			if ( ! empty( $meta_option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $meta_option );
			}
		}

		return $classes;
	}

	add_filter( 'topscorer_filter_grid_gutter_classes', 'topscorer_core_set_blog_single_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'topscorer_core_enable_posts_order' ) ) {
	/**
	 * Function that enable page attributes options for blog single page
	 */
	function topscorer_core_enable_posts_order() {
		add_post_type_support( 'post', 'page-attributes' );
	}

	add_action( 'admin_init', 'topscorer_core_enable_posts_order' );
}

if ( ! function_exists( 'topscorer_core_set_blog_list_excerpt_length' ) ) {
	/**
	 * Function that set number of characters for excerpt on blog list page
	 *
	 * @param $excerpt_length int
	 *
	 * @return int
	 */
	function topscorer_core_set_blog_list_excerpt_length( $excerpt_length ) {
		$option = topscorer_core_get_post_value_through_levels( 'qodef_blog_list_excerpt_number_of_characters' );

		if ( $option !== '' ) {
			$excerpt_length = $option;
		}

		return $excerpt_length;
	}

	add_filter( 'topscorer_filter_blog_list_excerpt_length', 'topscorer_core_set_blog_list_excerpt_length' );
}

if ( ! function_exists( 'topscorer_core_get_allowed_pages_for_blog_sidebar_layout' ) ) {
	/**
	 * Function that return pages where blog sidebar is allowed
	 *
	 * @return bool
	 */
	function topscorer_core_get_allowed_pages_for_blog_sidebar_layout() {
		return ( is_archive() || ( is_home() && is_front_page() ) ) && get_post_type() === 'post';
	}
}

if ( ! function_exists( 'topscorer_core_set_blog_archive_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param $layout string
	 *
	 * @return string
	 */
	function topscorer_core_set_blog_archive_sidebar_layout( $layout ) {

		if ( topscorer_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_blog_archive_sidebar_layout' );

			if ( ! empty( $option ) ) {
				$layout = $option;
			}
		}

		return $layout;
	}

	add_filter( 'topscorer_filter_sidebar_layout', 'topscorer_core_set_blog_archive_sidebar_layout' );
}

if ( ! function_exists( 'topscorer_core_set_blog_archive_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param $sidebar_name string
	 *
	 * @return string
	 */
	function topscorer_core_set_blog_archive_custom_sidebar_name( $sidebar_name ) {

		if ( topscorer_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_blog_archive_custom_sidebar' );

			if ( ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}

		return $sidebar_name;
	}

	add_filter( 'topscorer_filter_sidebar_name', 'topscorer_core_set_blog_archive_custom_sidebar_name' );
}

if ( ! function_exists( 'topscorer_core_set_blog_archive_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function topscorer_core_set_blog_archive_sidebar_grid_gutter_classes( $classes ) {

		if ( topscorer_core_get_allowed_pages_for_blog_sidebar_layout() ) {
			$option = topscorer_core_get_post_value_through_levels( 'qodef_blog_single_archive_grid_gutter' );

			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}

		return $classes;
	}

	add_filter( 'topscorer_filter_grid_gutter_classes', 'topscorer_core_set_blog_archive_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'topscorer_core_blog_single_set_post_title_instead_of_page_title_text' ) ) {
	/**
	 * Function that set current post title text for single posts
	 *
	 * @param $title string
	 *
	 * @return string
	 */
	function topscorer_core_blog_single_set_post_title_instead_of_page_title_text( $title ) {
		$option = topscorer_core_get_option_value( 'admin', 'qodef_blog_single_set_post_title_in_title_area' );

		if ( is_singular( 'post' ) && $option === 'yes' ) {
			$title = get_the_title( qode_framework_get_page_id() );
		}

		return $title;
	}

	add_filter( 'topscorer_filter_page_title_text', 'topscorer_core_blog_single_set_post_title_instead_of_page_title_text' );
}

//New post taxonomy - trendings

if ( ! function_exists( 'topscorer_core_create_post_taxonomies' ) ) {
	add_action( 'init', 'topscorer_core_create_post_taxonomies', 0 );

	function topscorer_core_create_post_taxonomies() {
		// Add new taxonomy, hierarchical
		$labels = array(
			'name'              => esc_html__( 'Trendings', 'topscorer-core', 'topscorer' ),
			'singular_name'     => esc_html__( 'Trending', 'topscorer-core', 'topscorer' ),
			'search_items'      => esc_html__( 'Search Trendings', 'topscorer-core' ),
			'all_items'         => esc_html__( 'All Trendings', 'topscorer-core' ),
			'parent_item'       => esc_html__( 'Parent Trending', 'topscorer-core' ),
			'parent_item_colon' => esc_html__( 'Parent Trending:', 'topscorer-core' ),
			'edit_item'         => esc_html__( 'Edit Trending', 'topscorer-core' ),
			'update_item'       => esc_html__( 'Update Trending', 'topscorer-core' ),
			'add_new_item'      => esc_html__( 'Add New Trending', 'topscorer-core' ),
			'new_item_name'     => esc_html__( 'New Trending Name', 'topscorer-core' ),
			'menu_name'         => esc_html__( 'Trendings', 'topscorer-core' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'trending' ),
		);

		register_taxonomy( 'trending', array( 'post' ), $args );
	}
}
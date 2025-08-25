<?php

if ( ! function_exists( 'topscorer_core_register_testimonials_for_meta_options' ) ) {
	function topscorer_core_register_testimonials_for_meta_options( $post_types ) {
		$post_types[] = 'testimonials';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_save', 'topscorer_core_register_testimonials_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'topscorer_core_register_testimonials_for_meta_options' );
}

if ( ! function_exists( 'topscorer_core_add_testimonials_custom_post_type' ) ) {
	/**
	 * Function that adds testimonials custom post type
	 *
	 * @param $cpts array
	 *
	 * @return array
	 */
	function topscorer_core_add_testimonials_custom_post_type( $cpts ) {
		$cpts[] = 'TopScorerCoreTestimonialsCPT';

		return $cpts;
	}

	add_filter( 'topscorer_core_filter_register_custom_post_types', 'topscorer_core_add_testimonials_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class TopScorerCoreTestimonialsCPT extends QodeFrameworkCustomPostType {

		public function map_post_type() {
			$name = esc_html__( 'Testimonials', 'topscorer-core' );
			$this->set_base( 'testimonials' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-format-status' );
			$this->set_slug( 'testimonials' );
			$this->set_name( $name );
			$this->set_path( TOPSCORER_CORE_CPT_PATH . '/testimonials' );
			$this->set_labels( array (
				'name'          => esc_html__( 'TopScorer Testimonials', 'topscorer-core' ),
				'singular_name' => esc_html__( 'Testimonial', 'topscorer-core' ),
				'add_item'      => esc_html__( 'New Testimonial', 'topscorer-core' ),
				'add_new_item'  => esc_html__( 'Add New Testimonial', 'topscorer-core' ),
				'edit_item'     => esc_html__( 'Edit Testimonial', 'topscorer-core' ),
			) );
			$this->set_public( false );
			$this->set_archive( false );
			$this->set_supports( array (
				'title',
			) );
			$this->add_post_taxonomy( array (
				'base'          => 'testimonials-category',
				'slug'          => 'testimonials-category',
				'singular_name' => esc_html__( 'Category', 'topscorer-core' ),
				'plural_name'   => esc_html__( 'Categories', 'topscorer-core' ),
			) );
		}

	}
}
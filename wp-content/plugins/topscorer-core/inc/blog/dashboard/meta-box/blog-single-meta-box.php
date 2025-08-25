<?php

if ( ! function_exists( 'topscorer_core_add_blog_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function topscorer_core_add_blog_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'post' ),
				'type'  => 'meta',
				'slug'  => 'blog-single',
				'title' => esc_html__( 'Blog Single', 'topscorer-core' )
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_blog_list_image',
					'title'       => esc_html__( 'Blog List Image', 'topscorer-core' ),
					'description' => esc_html__( 'Upload image to be displayed on blog list instead of featured image', 'topscorer-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_post',
					'title'       => esc_html__( 'Image Dimension', 'topscorer-core' ),
					'description' => esc_html__( 'Choose dimension of image for blog list. If you are using fixed images proportion on list, choose option different than default.', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'masonry_image_dimension' )
				)
			);

			/*$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_blog_list_metro_image',
					'title'       => esc_html__( 'Blog list metro image', 'topscorer-core' ),
					'description' => esc_html__( 'Upload image to be displayed on blog list metro layout with mosaic effect instead of featured image', 'topscorer-core' )
				)
			);*/

			// Hook to include additional options after module options
			do_action( 'topscorer_core_action_after_blog_single_meta_box_map', $page );
		}
	}

	add_action( 'topscorer_core_action_default_meta_boxes_init', 'topscorer_core_add_blog_single_meta_box', 1 ); // Permission 1 is set in order to this module be at the first place
}
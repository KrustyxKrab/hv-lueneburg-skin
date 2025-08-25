<?php

if ( ! function_exists( 'topscorer_core_add_admin_user_options' ) ) {
	function topscorer_core_add_admin_user_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'administrator', 'author' ),
				'type'  => 'user',
				'title' => esc_html__( 'Social Networks', 'topscorer-core' ),
				'slug'  => 'admin-options',
			)
		);
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_facebook',
					'title'       => esc_html__( 'Facebook', 'topscorer-core' ),
					'description' => esc_html__( 'Enter user Instagram profile url', 'topscorer-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_instagram',
					'title'       => esc_html__( 'Instagram', 'topscorer-core' ),
					'description' => esc_html__( 'Enter user Instagram profile url', 'topscorer-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_twitter',
					'title'       => esc_html__( 'Twitter', 'topscorer-core' ),
					'description' => esc_html__( 'Enter user Twitter profile url', 'topscorer-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_linkedin',
					'title'       => esc_html__( 'LinkedIn', 'topscorer-core' ),
					'description' => esc_html__( 'Enter user LinkedIn profile url', 'topscorer-core' ),
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_pinterest',
					'title'       => esc_html__( 'Pinterest', 'topscorer-core' ),
					'description' => esc_html__( 'Enter user Pinterest profile url', 'topscorer-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'topscorer_core_action_after_admin_user_options_map', $page );
		}
	}
	
	add_action( 'topscorer_core_action_register_role_custom_fields', 'topscorer_core_add_admin_user_options' );
}
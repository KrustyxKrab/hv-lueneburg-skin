<?php

if ( ! function_exists( 'topscorer_core_add_woocommerce_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function topscorer_core_add_woocommerce_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$list_item_layouts = apply_filters( 'topscorer_core_filter_product_list_layouts', array() );
		$options_map       = topscorer_core_get_variations_options_map( $list_item_layouts );

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => TOPSCORER_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'woocommerce',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'WooCommerce', 'topscorer-core' ),
				'description' => esc_html__( 'Global settings related to WooCommerce', 'topscorer-core' ),
				'layout'      => 'tabbed'
			)
		);
		
		if ( $page ) {
			
			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Product List', 'topscorer-core' ),
					'description' => esc_html__( 'Settings related to product list', 'topscorer-core' )
				)
			);
			
			if ( $options_map['visibility'] ) {
				$list_tab->add_field_element(
					array(
						'field_type'    => 'select',
						'name'          => 'qodef_product_list_item_layout',
						'title'         => esc_html__( 'Item Layout', 'topscorer-core' ),
						'description'   => esc_html__( 'Choose layout for list item on shop list', 'topscorer-core' ),
						'options'       => $list_item_layouts,
						'default_value' => $options_map['default_value']
					)
				);
			}
			
			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_columns',
					'title'       => esc_html__( 'Columns Number', 'topscorer-core' ),
					'description' => esc_html__( 'Choose number of columns for product list on shop page', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'columns_number' )
				)
			);
			
			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_columns_space',
					'title'       => esc_html__( 'Space Between Items', 'topscorer-core' ),
					'description' => esc_html__( 'Choose space between items for product list on shop page', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_products_per_page',
					'title'       => esc_html__( 'Products per Page', 'topscorer-core' ),
					'description' => esc_html__( 'Set number of products on shop page. Default value is 12', 'topscorer-core' )
				)
			);
			
			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_title_tag',
					'title'       => esc_html__( 'Title Tag', 'topscorer-core' ),
					'description' => esc_html__( 'Choose title tag for product list item on shop page', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'title_tag' )
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_product_list_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose default sidebar layout for shop page', 'topscorer-core' ),
					'default_value' => 'no-sidebar',
					'options'       => topscorer_core_get_select_type_options_pool( 'sidebar_layouts', false )
				)
			);

			$custom_sidebars = topscorer_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$list_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_woo_product_list_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'topscorer-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on shop page', 'topscorer-core' ),
						'options'     => $custom_sidebars
					)
				);
			}

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'topscorer-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			// Hook to include additional options after section module options
			do_action( 'topscorer_core_action_after_woo_product_list_options_map', $list_tab );
			
			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Product Single', 'topscorer-core' ),
					'description' => esc_html__( 'Settings related to product single', 'topscorer-core' )
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'topscorer-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title on single product page', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'no_yes' )
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_title_tag',
					'title'       => esc_html__( 'Title Tag', 'topscorer-core' ),
					'description' => esc_html__( 'Choose title tag for product on single product page', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'title_tag' )
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_single_enable_image_lightbox',
					'title'         => esc_html__( 'Set Images Behavior', 'topscorer-core' ),
					'description'   => esc_html__( 'Enabling this option will set zoom behaviour or enable lightbox functionality for images on single product page', 'topscorer-core' ),
					'options'       => array(
						''               => esc_html__( 'None', 'topscorer-core' ),
						'thumb-featured-switch' => esc_html__( 'Switch Featured Image on Thumbnail Click', 'topscorer-core' ),
						'photo-swipe'    => esc_html__( 'Photo Swipe', 'topscorer-core' ),
						'magnific-popup' => esc_html__( 'Magnific Popup', 'topscorer-core' ),
					),
					'default_value' => 'thumb-featured-switch'
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_woo_single_enable_image_zoom',
					'title'         => esc_html__( 'Enable Zoom Maginfier', 'topscorer-core' ),
					'description'   => esc_html__( 'Enabling this option will show magnifier image on hover on single product page', 'topscorer-core' ),
					'default_value' => 'yes'
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_single_thumb_images_position',
					'title'         => esc_html__( 'Set Thumbnail Images Position', 'topscorer-core' ),
					'description'   => esc_html__( 'Choose position of the thumbnail images on single product page relative to featured image', 'topscorer-core' ),
					'options'       => array(
						'below'  => esc_html__( 'Below', 'topscorer-core' ),
						'left' => esc_html__( 'Left', 'topscorer-core' )
					),
					'default_value' => 'below',
				)
			);
			
			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_thumbnail_images_columns',
					'title'       => esc_html__( 'Thumbnail Images Columns Number', 'topscorer-core' ),
					'description' => esc_html__( 'Choose number of columns for thumbnail images on single product page', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'columns_number' )
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_related_product_list_columns',
					'title'       => esc_html__( 'Related Columns Number', 'topscorer-core' ),
					'description' => esc_html__( 'Choose number of columns for related product list on single product page', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'columns_number' )
				)
			);
			
			// Hook to include additional options after section module options
			do_action( 'topscorer_core_action_after_woo_product_single_options_map', $single_tab );
			
			// Hook to include additional options after module options
			do_action( 'topscorer_core_action_after_woo_options_map', $page );
		}
	}
	
	add_action( 'topscorer_core_action_default_options_init', 'topscorer_core_add_woocommerce_options', topscorer_core_get_admin_options_map_position( 'woocommerce' ) );
}
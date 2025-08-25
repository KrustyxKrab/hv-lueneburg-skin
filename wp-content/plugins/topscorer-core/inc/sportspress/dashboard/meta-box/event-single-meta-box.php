<?php

if ( ! function_exists( 'topscorer_core_add_sportspress_event_single_meta_box' ) ) {
	/**
	 * function that add meta box group for this module
	 */
	function topscorer_core_add_sportspress_event_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array (
				'scope'  => array ( 'sp_event' ),
				'type'   => 'meta',
				'slug'   => 'sp_event',
				'title'  => esc_html__( 'Event Settings', 'topscorer-core' ),
				'layout' => 'tabbed',
			)
		);

		if ( $page ) {

			$general_tab = $page->add_tab_element(
				array (
					'name'        => 'tab-general',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'General Settings', 'topscorer-core' ),
					'description' => esc_html__( 'General event settings', 'topscorer-core' ),
				)
			);

			$stream_section = $general_tab->add_section_element(
				array (
					'name'        => 'section-stream',
					'title'       => esc_html__( 'Live Stream', 'topscorer-core' ),
					'description' => esc_html__( 'Populate event single live stream info', 'topscorer-core' ),
				)
			);

			$stream_section->add_field_element(
				array (
					'field_type'  => 'text',
					'name'        => 'qodef_sportspress_event_single_live_stream_link',
					'title'       => esc_html__( 'Link', 'topscorer-core' ),
					'description' => esc_html__( 'Input a link for this event\'s live stream', 'topscorer-core' ),
				)
			);

			$stream_section->add_field_element(
				array (
					'field_type'  => 'select',
					'name'        => 'qodef_sportspress_event_single_live_stream_link_target',
					'title'       => esc_html__( 'Link Target', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'link_target' ),
					'description' => esc_html__( 'Choose whether the link will open in the same or a new browser tab', 'topscorer-core' ),
				)
			);

			$ticket_section = $general_tab->add_section_element(
				array (
					'name'        => 'section-tickets',
					'title'       => esc_html__( 'Tickets', 'topscorer-core' ),
					'description' => esc_html__( 'Populate event single tickets info', 'topscorer-core' ),
				)
			);

			$ticket_section->add_field_element(
				array (
					'field_type'  => 'text',
					'name'        => 'qodef_sportspress_event_single_tickets_link',
					'title'       => esc_html__( 'Link', 'topscorer-core' ),
					'description' => esc_html__( 'Input a link for the online tickets purchase', 'topscorer-core' ),
				)
			);

			$ticket_section->add_field_element(
				array (
					'field_type'  => 'select',
					'name'        => 'qodef_sportspress_event_single_tickets_link_target',
					'title'       => esc_html__( 'Link Target', 'topscorer-core' ),
					'options'     => topscorer_core_get_select_type_options_pool( 'link_target' ),
					'description' => esc_html__( 'Choose whether the link will open in the same or a new browser tab', 'topscorer-core' ),
				)
			);

			$tickets_repeater = $ticket_section->add_repeater_element(
				array (
					'name'        => 'qodef_sportspress_event_single_tickets',
					'title'       => esc_html__( 'Ticket Price', 'topscorer-core' ),
					'button_text' => esc_html__( 'Add New Ticket Price', 'topscorer-core' ),
				)
			);

			$tickets_repeater->add_field_element(
				array (
					'field_type' => 'text',
					'name'       => 'qodef_sportspress_event_single_ticket_description',
					'title'      => esc_html__( 'Description', 'topscorer-core' ),
				)
			);

			$tickets_repeater->add_field_element(
				array (
					'field_type' => 'text',
					'name'       => 'qodef_sportspress_event_single_ticket_price',
					'title'      => esc_html__( 'Price', 'topscorer-core' ),
				)
			);

			// hook to include additional options after module options
			// @hooked topscorer_core_add_sportspress_page_meta_box
			// @hooked topscorer_core_add_page_header_meta_box
			// @hooked topscorer_core_add_page_mobile_header_meta_box
			// @hooked topscorer_core_add_page_title_meta_box
			do_action( 'topscorer_core_action_after_sportspress_event_single_meta_box_map', $page );
		}
	}

	add_action( 'topscorer_core_action_default_meta_boxes_init', 'topscorer_core_add_sportspress_event_single_meta_box' );
}
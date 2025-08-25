<?php

if ( ! function_exists( 'topscorer_core_add_sportspress_player_single_options' ) ) {
	/**
	 * function that add options group for this module
	 */
	function topscorer_core_add_sportspress_player_single_options( $page ) {

		$player_single_tab = $page->add_tab_element(
			array (
				'name'        => 'tab-player-single',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Player Single', 'topscorer-core' ),
				'description' => esc_html__( 'Settings related to player single', 'topscorer-core' ),
			)
		);

		$player_single_tab->add_field_element(
			array (
				'field_type'    => 'yesno',
				'name'          => 'qodef_sportspress_player_single_enable_trending_posts',
				'title'         => esc_html__( 'Enable Trending Posts', 'topscorer-core' ),
				'description'   => esc_html__( 'Use this option to enable/disable trending posts section on single player page', 'topscorer-core' ),
				'default_value' => 'yes',
			)
		);

		$trending_posts_section = $player_single_tab->add_section_element(
			array (
				'title'      => esc_html__( 'Trending Posts', 'topscorer-core' ),
				'name'       => 'qodef_sportspress_player_single_trending_section',
				'dependency' => array (
					'show' => array (
						'qodef_sportspress_player_single_enable_trending_posts' => array (
							'values'        => 'yes',
							'default_value' => 'yes',
						),
					),
				),
			)
		);

		$trending_posts_section->add_field_element(
			array (
				'field_type'  => 'text',
				'name'        => 'qodef_sportspress_player_single_trending_posts_tagline',
				'title'       => esc_html__( 'Tagline', 'topscorer-core' ),
				'description' => esc_html__( 'Input a tagline to be displayed above the trending post title', 'topscorer-core' ),
			)
		);

		$trending_posts_section->add_field_element(
			array (
				'field_type'  => 'text',
				'name'        => 'qodef_sportspress_player_single_trending_posts_title',
				'title'       => esc_html__( 'Title', 'topscorer-core' ),
				'description' => esc_html__( 'Input a title for trending posts section', 'topscorer-core' ),
			)
		);

		$trending_taxonomies = topscorer_core_get_trending_taxonomies();
		if ( ! empty( $trending_taxonomies ) && count( $trending_taxonomies ) > 1 ) {
			$trending_posts_section->add_field_element(
				array (
					'field_type'  => 'select',
					'name'        => 'qodef_sportspress_player_single_trending_posts_taxonomy',
					'title'       => esc_html__( 'Trending', 'topscorer-core' ),
					'options'     => $trending_taxonomies,
					'description' => esc_html__( 'Choose trending posts to display on player single', 'topscorer-core' ),
				)
			);
		}

		$player_single_tab->add_field_element(
			array (
				'field_type'    => 'yesno',
				'name'          => 'qodef_sportspress_player_single_enable_related_players',
				'title'         => esc_html__( 'Enable Related Players', 'topscorer-core' ),
				'description'   => esc_html__( 'Use this option to enable/disable related players section on single player page', 'topscorer-core' ),
				'default_value' => 'yes',
			)
		);

		$related_players_section = $player_single_tab->add_section_element(
			array (
				'title'      => esc_html__( 'Related Players', 'topscorer-core' ),
				'name'       => 'qodef_sportspress_player_single_related_section',
				'dependency' => array (
					'show' => array (
						'qodef_sportspress_player_single_enable_related_players' => array (
							'values'        => 'yes',
							'default_value' => 'yes',
						),
					),
				),
			)
		);

		$related_players_section->add_field_element(
			array (
				'field_type'  => 'text',
				'name'        => 'qodef_sportspress_player_single_related_players_tagline',
				'title'       => esc_html__( 'Tagline', 'topscorer-core' ),
				'description' => esc_html__( 'Input a tagline to be displayed above the related players title', 'topscorer-core' ),
			)
		);

		$related_players_section->add_field_element(
			array (
				'field_type'  => 'text',
				'name'        => 'qodef_sportspress_player_single_related_players_title',
				'title'       => esc_html__( 'Title', 'topscorer-core' ),
				'description' => esc_html__( 'Input a title for related players section', 'topscorer-core' ),
			)
		);

		$related_players_section->add_field_element(
			array (
				'field_type'  => 'text',
				'name'        => 'qodef_sportspress_player_single_related_players_background_text',
				'title'       => esc_html__( 'Background Text', 'topscorer-core' ),
				'description' => esc_html__( 'Input some background text you wish to display', 'topscorer-core' ),
			)
		);

		$player_lists = topscorer_core_sportspress_get_player_lists( true );
		if ( ! empty( $player_lists ) && count( $player_lists ) > 1 ) {
			$related_players_section->add_field_element(
				array (
					'field_type'  => 'select',
					'name'        => 'qodef_sportspress_player_single_related_players_list',
					'title'       => esc_html__( 'Player List', 'topscorer-core' ),
					'options'     => $player_lists,
					'description' => esc_html__( 'Choose a player list from which you wish to display related players', 'topscorer-core' ),
				)
			);
		}

		// hook to include additional options after section module options
		do_action( 'topscorer_core_action_after_sportspress_player_single_options_map', $player_single_tab );
	}

	add_action( 'topscorer_core_action_after_sportspress_options_map', 'topscorer_core_add_sportspress_player_single_options' );
}
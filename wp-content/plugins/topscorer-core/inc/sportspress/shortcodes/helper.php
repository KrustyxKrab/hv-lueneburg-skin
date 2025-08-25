<?php

if ( ! function_exists( 'topscorer_core_sportspress_get_player_lists' ) ) {
	/**
	 * function that return array of sportspress player lists
	 *
	 * @param $enable_default boolean
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_get_player_lists( $enable_default = false ) {
		$options = array();

		$args = array(
			'post_type'   => 'sp_list',
			'numberposts' => - 1,
			'fields'      => 'ids, post_titles',
		);

		$player_lists = get_posts( $args );

		if ( ! empty( $player_lists ) ) {
			if ( $enable_default === true ) {
				$options[] = esc_html__( 'Default', 'topscorer-core' );
			}

			foreach ( $player_lists as $player_list ) {
				$options[ $player_list->ID ] = esc_html( $player_list->post_title );
			}
		} else {
			if ( $enable_default === false ) {
				$options[0] = esc_html__( 'No player lists found', 'topscorer-core' );
			}
		}

		return $options;
	}
}

if ( ! function_exists( 'topscorer_core_sportspress_get_events' ) ) {
	/**
	 * function that return array of sportspress events
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_get_events( $post_status = '' ) {
		$options = array();
		$args    = array(
			'post_type'   => 'sp_event',
			'numberposts' => - 1,
			'post_status' => $post_status,
			'fields'      => 'ids, post_titles',
		);

		$events = get_posts( $args );

		if ( ! empty( $events ) ) {
			foreach ( $events as $event ) {
				$options[ $event->ID ] = esc_html( $event->post_title );
			}
		} else {
			$options[0] = esc_html__( 'No events found', 'topscorer-core' );
		}

		return $options;
	}
}

if ( ! function_exists( 'topscorer_core_sportspress_get_event_id' ) ) {
	function topscorer_core_sportspress_get_event_id( $atts ) {
		$events = '';
		$id     = '';

		switch ( $atts['event_type'] ) {
			case 'upcoming':
				$id = $atts['upcoming_id'];

				break;
			case 'archived':
				$id = $atts['archived_id'];

				break;
			case 'next':
				$args = array(
					'post_type'   => 'sp_event',
					'numberposts' => - 1,
					'post_status' => 'future',
					'orderby'     => 'publish_date',
					'order'       => 'ASC',
				);

				$events = get_posts( $args );

				if ( ! empty( $events ) ) {
					$id = $events[0]->ID;
				}

				break;
		}

		return $id;
	}
}

if ( ! function_exists( 'topscorer_core_sportspress_get_calendars' ) ) {
	/**
	 * function that return array of sportspress calendars
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_get_calendars() {
		$options = array();
		$args    = array(
			'post_type'   => 'sp_calendar',
			'numberposts' => - 1,
			'fields'      => 'ids, post_titles',
		);

		$calendars = get_posts( $args );

		if ( ! empty( $calendars ) ) {
			foreach ( $calendars as $calendar ) {
				$options[ $calendar->ID ] = esc_html( $calendar->post_title );
			}
		} else {
			$options[0] = esc_html__( 'No calendars found', 'topscorer-core' );
		}

		return $options;
	}
}

if ( ! function_exists( 'topscorer_core_sportspress_get_league_tables' ) ) {
	/**
	 * function that return array of sportspress league tables
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_get_league_tables() {
		$options = array();
		$args    = array(
			'post_type'   => 'sp_table',
			'numberposts' => - 1,
			'fields'      => 'ids, post_titles',
		);

		$league_tables = get_posts( $args );

		if ( ! empty( $league_tables ) ) {
			foreach ( $league_tables as $league_table ) {
				$options[ $league_table->ID ] = esc_html( $league_table->post_title );
			}
		} else {
			$options[0] = esc_html__( 'No league tables found', 'topscorer-core' );
		}

		return $options;
	}
}

if ( ! function_exists( 'topscorer_core_sportspress_get_players' ) ) {
	/**
	 * function that return array of sportspress players
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_get_players() {
		$options = array();
		$args    = array(
			'post_type'   => 'sp_player',
			'numberposts' => - 1,
			'fields'      => 'ids, post_titles',
		);

		$players = get_posts( $args );

		if ( ! empty( $players ) ) {
			foreach ( $players as $player ) {
				$options[ $player->ID ] = esc_html( $player->post_title );
			}
		} else {
			$options[0] = esc_html__( 'No players found', 'topscorer-core' );
		}

		return $options;
	}
}

if ( ! function_exists( 'topscorer_core_sportspress_get_teams' ) ) {
	/**
	 * function that return array of sportspress teams
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_get_teams() {
		$options = array();
		$args    = array(
			'post_type'   => 'sp_team',
			'numberposts' => - 1,
			'fields'      => 'ids, post_titles',
		);

		$teams = get_posts( $args );

		if ( ! empty( $teams ) ) {
			foreach ( $teams as $team ) {
				$options[ $team->ID ] = esc_html( $team->post_title );
			}
		} else {
			$options[0] = esc_html__( 'No teams found', 'topscorer-core' );
		}

		return $options;
	}
}

if ( ! function_exists( 'topscorer_core_sportspress_get_shortcode_atts' ) ) {
	/**
	 * function that return formatted sportspress shortcode atts
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	function topscorer_core_sportspress_get_shortcode_atts( $atts ) {
		$shortcode_atts = '';

		foreach ( $atts as $key => $value ) {
			if ( strpos( $key, TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX ) !== false ) {
				$shortcode_atts .= str_replace( TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX, '', $key ) . '="' . $value . '" ';
			}
		}

		return $shortcode_atts;
	}
}
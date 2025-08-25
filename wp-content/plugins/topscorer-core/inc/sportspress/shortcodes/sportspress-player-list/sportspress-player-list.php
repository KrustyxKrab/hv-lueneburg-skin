<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_player_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_add_player_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreSportsPressPlayerListShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_player_list_shortcode' );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerCoreSportsPressPlayerListShortcode extends TopScorerCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/sportspress-player-list' );
			$this->set_base( 'topscorer_core_sportspress_player_list' );
			$this->set_name( esc_html__( 'Player List', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays a list of players and their statistics', 'topscorer-core' ) );
			$this->set_category( esc_html__( 'TopScorer Core SportsPress', 'topscorer-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Skin', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'skin' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'id',
				'title'      => esc_html__( 'Player List', 'topscorer-core' ),
				'options'    => topscorer_core_sportspress_get_player_lists(),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'number',
				'title'      => esc_html__( 'No of Players', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'columns',
				'title'       => esc_html__( 'Columns', 'topscorer-core' ),
				'description' => esc_html__( 'Include comma-separated column slugs to choose which  columns to display', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'order',
				'title'       => esc_html__( 'Order', 'topscorer-core' ),
				'options'     => topscorer_core_get_select_type_options_pool( 'order' ),
				'description' => esc_html__( 'Default player order is by their unique ID', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'grouping',
				'title'         => esc_html__( 'Group Players', 'topscorer-core' ),
				'options'       => array(
					''         => esc_html__( 'No', 'topscorer-core' ),
					'position' => esc_html__( 'Yes', 'topscorer-core' )
				),
				'default_value' => ''
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'grouptag',
				'title'         => esc_html__( 'Group Tag', 'topscorer-core' ),
				'options'       => topscorer_core_get_select_type_options_pool( 'title_tag', false ),
				'dependency'    => array(
					'show' => array(
						TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'grouping' => array(
							'values'        => 'position',
							'default_value' => ''
						)
					)
				),
				'default_value' => 'h4'
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'sortable',
				'title'      => esc_html__( 'Sortable', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'responsive',
				'title'      => esc_html__( 'Responsive', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'paginated',
				'title'      => esc_html__( 'Paginated', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'link_posts',
				'title'      => esc_html__( 'Link Players', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'link_teams',
				'title'      => esc_html__( 'Link Teams', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'show_all_players_link',
				'title'      => esc_html__( 'Show All Players Link', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_sportspress_player_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['shortcode']      = 'player_list';
			$atts['shortcode_atts'] = topscorer_core_sportspress_get_shortcode_atts( $atts );

			return topscorer_core_get_template_part( 'sportspress/shortcodes/', 'sportspress-shortcodes-content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-sportspress-player-list';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
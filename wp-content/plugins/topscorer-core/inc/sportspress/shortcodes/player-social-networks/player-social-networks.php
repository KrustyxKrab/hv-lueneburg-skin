<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_player_social_networks_shortcode' ) ) {
	/**
	 * function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_add_player_social_networks_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreSportsPressPlayerSocialNetworksShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_player_social_networks_shortcode' );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerCoreSportsPressPlayerSocialNetworksShortcode extends TopScorerCoreShortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'topscorer_core_filter_sportspress_player_social_networks_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/player-social-networks' );
			$this->set_base( 'topscorer_core_sportspress_player_social_networks' );
			$this->set_name( esc_html__( 'Player Social Networks', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays social networks of a single player', 'topscorer-core' ) );
			$this->set_category( esc_html__( 'TopScorer Core SportsPress', 'topscorer-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'player_id',
				'title'      => esc_html__( 'Player', 'topscorer-core' ),
				'options'    => topscorer_core_sportspress_get_players(),
			) );
			$options_map = topscorer_core_get_variations_options_map( $this->get_layouts() );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'topscorer-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array(
					'map_for_page_builder' => $options_map['visibility'],
					'map_for_widget'       => $options_map['visibility']
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Social Networks Title', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Social Networks Title Color', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'icon_color',
				'title'      => esc_html__( 'Social Networks Icon Color', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'icon_hover_color',
				'title'      => esc_html__( 'Social Networks Icon Hover Color', 'topscorer-core' ),
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_sportspress_player_social_networks', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );

			return topscorer_core_get_template_part( 'sportspress/shortcodes/player-social-networks', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-sportspress-player-social-networks';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}
	}
}
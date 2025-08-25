<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_event_results_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_add_event_results_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreSportsPressEventResultsShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_event_results_shortcode' );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerCoreSportsPressEventResultsShortcode extends TopScorerCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/sportspress-event-results' );
			$this->set_base( 'topscorer_core_sportspress_event_results' );
			$this->set_name( esc_html__( 'Event Results', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays team results of a single event', 'topscorer-core' ) );
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
				'field_type'    => 'select',
				'name'          => 'event_type',
				'title'         => esc_html__( 'Events', 'topscorer-core' ),
				'options'       => array(
					'next'     => esc_html__( 'Next Event', 'topscorer-core' ),
					'upcoming' => esc_html__( 'Upcoming Events', 'topscorer-core' ),
					'archived' => esc_html__( 'Archived Events', 'topscorer-core' )
				),
				'default_value' => 'archived',
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'upcoming_id',
				'title'      => esc_html__( 'Upcoming Event', 'topscorer-core' ),
				'options'    => topscorer_core_sportspress_get_events( 'future' ),
				'dependency' => array(
					'show' => array(
						'event_type' => array(
							'values'        => 'upcoming',
							'default_value' => 'archived'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'archived_id',
				'title'      => esc_html__( 'Archived Event', 'topscorer-core' ),
				'options'    => topscorer_core_sportspress_get_events(),
				'dependency' => array(
					'show' => array(
						'event_type' => array(
							'values'        => 'archived',
							'default_value' => 'archived'
						)
					)
				)
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_sportspress_event_results', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                                                      = $this->get_atts();
			$atts['holder_classes']                                    = $this->get_holder_classes( $atts );
			$atts['shortcode']                                         = 'event_results';
			$atts[ TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'id' ] = topscorer_core_sportspress_get_event_id( $atts );
			$atts['shortcode_atts']                                    = topscorer_core_sportspress_get_shortcode_atts( $atts );

			return topscorer_core_get_template_part( 'sportspress/shortcodes/', 'sportspress-shortcodes-content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-sportspress-event-results';
			$holder_classes[] = ( $atts['event_type'] === 'upcoming' ) ? 'qodef-sportspress--upcoming-event' : 'qodef-sportspress--archived-event';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_event_calendar_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_add_event_calendar_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreSportsPressEventCalendarShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_event_calendar_shortcode' );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerCoreSportsPressEventCalendarShortcode extends TopScorerCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/sportspress-event-calendar' );
			$this->set_base( 'topscorer_core_sportspress_event_calendar' );
			$this->set_name( esc_html__( 'Event Calendar', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays events as a calendar', 'topscorer-core' ) );
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
				'options'    => topscorer_core_get_select_type_options_pool( 'skin' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'id',
				'title'      => esc_html__( 'Calendar', 'topscorer-core' ),
				'options'    => topscorer_core_sportspress_get_calendars(),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'caption_tag',
				'title'      => esc_html__( 'Month Tag', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'title_tag', false )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'initial',
				'title'      => esc_html__( 'Days of the Week Shorthand', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'show_all_events_link',
				'title'      => esc_html__( 'Show All Events Link', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_sportspress_event_calendar', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['shortcode']      = 'event_calendar';
			$atts['shortcode_atts'] = topscorer_core_sportspress_get_shortcode_atts( $atts );

			return topscorer_core_get_template_part( 'sportspress/shortcodes/', 'sportspress-shortcodes-content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-sportspress-event-calendar';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
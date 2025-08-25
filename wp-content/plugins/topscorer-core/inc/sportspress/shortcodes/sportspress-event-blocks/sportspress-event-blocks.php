<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_event_blocks_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_add_event_blocks_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreSportsPressEventBlocksShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_event_blocks_shortcode' );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerCoreSportsPressEventBlocksShortcode extends TopScorerCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/sportspress-event-blocks' );
			$this->set_base( 'topscorer_core_sportspress_event_blocks' );
			$this->set_name( esc_html__( 'Event Blocks', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays a list of events from a calendar in classic fixtures and results blocks layout', 'topscorer-core' ) );
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
				'title'      => esc_html__( 'Calendar', 'topscorer-core' ),
				'options'    => topscorer_core_sportspress_get_calendars(),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'date',
				'title'      => esc_html__( 'Date', 'topscorer-core' ),
				'options'    => array(
					'default' => esc_html__( 'All', 'topscorer-core' ),
					'w'       => esc_html__( 'This Week', 'topscorer-core' ),
					'day'     => esc_html__( 'Today', 'topscorer-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'number',
				'title'      => esc_html__( 'No of Events', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'link_teams',
				'title'      => esc_html__( 'Link Teams', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'paginated',
				'title'      => esc_html__( 'Paginated', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'rows',
				'title'      => esc_html__( 'No of Rows', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'order',
				'title'       => esc_html__( 'Order', 'topscorer-core' ),
				'options'     => topscorer_core_get_select_type_options_pool( 'order' ),
				'description' => esc_html__( 'Default event order is by their unique ID', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'show_all_events_link',
				'title'      => esc_html__( 'Show All Events Link', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( '0_1', false )
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_sportspress_event_blocks', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['shortcode']      = 'event_blocks';
			$atts['shortcode_atts'] = topscorer_core_sportspress_get_shortcode_atts( $atts );

			return topscorer_core_get_template_part( 'sportspress/shortcodes/', 'sportspress-shortcodes-content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-sportspress-event-blocks';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_player_gallery_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_add_player_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreSportsPressPlayerGalleryShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_player_gallery_shortcode' );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerCoreSportsPressPlayerGalleryShortcode extends TopScorerCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/sportspress-player-gallery' );
			$this->set_base( 'topscorer_core_sportspress_player_gallery' );
			$this->set_name( esc_html__( 'Player Gallery', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays a gallery of players', 'topscorer-core' ) );
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
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'columns',
				'title'      => esc_html__( 'No of Columns', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'columns_number' )
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
				'field_type' => 'text',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'size',
				'title'      => esc_html__( 'Image Size', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'link_posts',
				'title'      => esc_html__( 'Link Players', 'topscorer-core' ),
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
			$html = qode_framework_call_shortcode( 'topscorer_core_sportspress_player_gallery', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                                                              = $this->get_atts();
			$atts['holder_classes']                                            = $this->get_holder_classes( $atts );
			$atts['shortcode']                                                 = 'player_gallery';
			$atts[ TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'itemtag' ]    = 'div';
			$atts[ TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'icontag' ]    = 'div';
			$atts[ TOPSCORER_CORE_SPORTSPRESS_SHORTCODE_PREFIX . 'captiontag' ] = 'p';
			$atts['shortcode_atts']                                            = topscorer_core_sportspress_get_shortcode_atts( $atts );

			return topscorer_core_get_template_part( 'sportspress/shortcodes/', 'sportspress-shortcodes-content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-sportspress-player-gallery';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
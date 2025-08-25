<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_trophy_list_shortcode' ) ) {
	/**
	 * function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_add_trophy_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreSportsPressTrophyListShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_trophy_list_shortcode' );
}

if ( class_exists( 'TopScorerCoreListShortcode' ) ) {
	class TopScorerCoreSportsPressTrophyListShortcode extends TopScorerCoreListShortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'topscorer_core_filter_sportspress_trophy_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'topscorer_core_filter_sportspress_trophy_list_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/trophy-list' );
			$this->set_base( 'topscorer_core_sportspress_trophy_list' );
			$this->set_name( esc_html__( 'Trophy List', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays a list of trophies', 'topscorer-core' ) );
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
			$this->map_list_options( array(
				'exclude_behavior' => array( 'masonry', 'justified-gallery' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'team_id',
				'title'      => esc_html__( 'Team', 'topscorer-core' ),
				'options'    => topscorer_core_sportspress_get_teams(),
				'group'      => esc_html__( 'Query', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'posts_per_page',
				'title'      => esc_html__( 'Number of Trophies', 'topscorer-core' ),
				'group'      => esc_html__( 'Query', 'topscorer-core' )
			) );
			$this->map_layout_options( array(
				'layouts' => $this->get_layouts(),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'counter',
				'title'      => esc_html__( 'Show Counter', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'yes_no' ),
				'dependency' => array(
					'hide' => array(
						'behavior' => array(
							'values'        => 'slider',
							'default_value' => ''
						)
					)
				),
				'group'      => esc_html__( 'Layout', 'topscorer-core' )
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_sportspress_trophy_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                    = $this->get_atts();
			$atts['holder_classes']  = $this->get_holder_classes( $atts );
			$atts['item_classes']    = $this->get_item_classes( $atts );
			$atts['image_dimension'] = $this->get_list_item_image_dimension( $atts );
			$atts['unique']          = wp_rand( 1000, 9999 );
			$atts['slider_attr']     = $this->get_slider_data( $atts, array(
				'unique'            => $atts['unique'],
				'outsideNavigation' => 'yes'
			) );
			$atts['this_shortcode']  = $this;

			return topscorer_core_get_template_part( 'sportspress/shortcodes/trophy-list', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-sportspress-trophy-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			$holder_classes[] = ( $atts['slider_pagination'] === 'yes' ) ? 'qodef-swiper-container--pagination-outside' : '';
			$holder_classes[] = ( $atts['counter'] === 'yes' ) ? 'qodef-counter--show' : '';

			$list_classes = $this->get_list_classes( $atts );

			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes      = $this->init_item_classes();
			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			return $styles;
		}

		public function get_player_ids( $atts ) {
			$player_ids = array();

			if ( ! empty( $atts['player_list'] ) ) {
				$player_ids = array_keys( (array) get_post_meta( $atts['player_list'], 'sp_players', true ) );
			}

			if ( ! empty( $atts['order'] ) ) {
				if ( $atts['order'] === 'ASC' ) {
					sort( $player_ids );
				}

				if ( $atts['order'] === 'DESC' ) {
					rsort( $player_ids );
				}
			}

			if ( ! empty( $atts['posts_per_page'] ) ) {
				$player_ids = array_slice( $player_ids, 0, intval( $atts['posts_per_page'] ) );
			}

			return $player_ids;
		}
	}
}
<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_advanced_player_list_shortcode' ) ) {
	/**
	 * function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_add_advanced_player_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreSportsPressAdvancedPlayerListShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_advanced_player_list_shortcode' );
}

if ( class_exists( 'TopScorerCoreListShortcode' ) ) {
	class TopScorerCoreSportsPressAdvancedPlayerListShortcode extends TopScorerCoreListShortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'topscorer_core_filter_sportspress_advanced_player_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'topscorer_core_filter_sportspress_advanced_player_list_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'topscorer_core_filter_sportspress_advanced_player_list_hover_animation_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/advanced-player-list' );
			$this->set_base( 'topscorer_core_sportspress_advanced_player_list' );
			$this->set_name( esc_html__( 'Advanced Player List', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays a list of players', 'topscorer-core' ) );
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
				'name'       => 'player_list',
				'title'      => esc_html__( 'Player List', 'topscorer-core' ),
				'options'    => topscorer_core_sportspress_get_player_lists(),
				'group'      => esc_html__( 'Query', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'select',
				'name'        => 'order',
				'title'       => esc_html__( 'Order', 'topscorer-core' ),
				'options'     => topscorer_core_get_select_type_options_pool( 'order' ),
				'description' => esc_html__( 'Default players order is by their unique ID', 'topscorer-core' ),
				'group'       => esc_html__( 'Query', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'posts_per_page',
				'title'      => esc_html__( 'Number of Players', 'topscorer-core' ),
				'group'      => esc_html__( 'Query', 'topscorer-core' )
			) );
			$this->map_layout_options( array(
				'layouts'          => $this->get_layouts(),
				'hover_animations' => $this->get_hover_animation_options()
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'show_player_position',
				'title'      => esc_html__( 'Show player position', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'yes_no', false ),
				'group'      => esc_html__( 'Layout', 'topscorer-core' )
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_sportspress_advanced_player_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['unique']         = wp_rand( 1000, 9999 );
			$atts['slider_attr']    = $this->get_slider_data( $atts, array(
				'unique'            => $atts['unique'],
				'outsideNavigation' => 'yes'
			) );
			$atts['player_ids']     = $this->get_player_ids( $atts );
			$atts['this_shortcode'] = $this;

			return topscorer_core_get_template_part( 'sportspress/shortcodes/advanced-player-list', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-sportspress-advanced-player-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-skin--' . $atts['skin'] : '';
			$holder_classes[] = ( $atts['slider_pagination'] === 'yes' ) ? 'qodef-swiper-container--pagination-outside' : '';

			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );

			$holder_classes = array_merge( $holder_classes, $list_classes, $hover_animation_classes );

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
<?php

if ( ! function_exists( 'topscorer_core_sportspress_add_advanced_event_list_shortcode' ) ) {
	/**
	 * function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_sportspress_add_advanced_event_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreSportsPressAdvancedEventListShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_sportspress_add_advanced_event_list_shortcode' );
}

if ( class_exists( 'TopScorerCoreListShortcode' ) ) {
	class TopScorerCoreSportsPressAdvancedEventListShortcode extends TopScorerCoreListShortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'topscorer_core_filter_sportspress_advanced_event_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'topscorer_core_filter_sportspress_advanced_event_list_extra_options', array() ) );

			parent ::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/sportspress/shortcodes/advanced-event-list' );
			$this->set_base( 'topscorer_core_sportspress_advanced_event_list' );
			$this->set_name( esc_html__( 'Advanced Event List', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays a list of events', 'topscorer-core' ) );
			$this->set_category( esc_html__( 'TopScorer Core SportsPress', 'topscorer-core' ) );
			$this->set_option( array (
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'topscorer-core' ),
			) );
			$this->set_option( array (
				'field_type' => 'select',
				'name'       => 'skin',
				'title'      => esc_html__( 'Skin', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'skin' ),
			) );
			$this->map_list_options( array (
				'exclude_behavior' => array ( 'slider', 'masonry', 'justified-gallery' ),
				'exclude_option'   => array ( 'images_proportion' ),
			) );
			$this->set_option( array (
				'field_type' => 'select',
				'name'       => 'post_status',
				'title'      => esc_html__( 'Time', 'topscorer-core' ),
				'options'    => array (
					'any'     => esc_html__( 'All', 'topscorer-core' ),
					'future'  => esc_html__( 'Upcoming', 'topscorer-core' ),
					'publish' => esc_html__( 'Archived', 'topscorer-core' ),
				),
				'group'      => esc_html__( 'Query', 'topscorer-core' ),
			) );
			$this->set_option( array (
				'field_type' => 'select',
				'name'       => 'order',
				'title'      => esc_html__( 'Order', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'order' ),
				'group'      => esc_html__( 'Query', 'topscorer-core' ),
			) );
			$this->set_option( array (
				'field_type' => 'text',
				'name'       => 'posts_per_page',
				'title'      => esc_html__( 'Number of Events', 'topscorer-core' ),
				'group'      => esc_html__( 'Query', 'topscorer-core' ),
			) );
			$this->map_layout_options( array (
				'layouts' => $this->get_layouts(),
			) );
			$this->set_option( array (
				'field_type' => 'text',
				'name'       => 'excerpt_length',
				'title'      => esc_html__( 'Excerpt Length', 'topscorer-core' ),
				'group'      => esc_html__( 'Layout', 'topscorer-core' ),
				'dependency' => array (
					'show' => array (
						'layout' => array (
							'values'        => 'table',
							'default_value' => 'table',
						),
					),
				),
			) );
			$this->set_option( array (
				'field_type' => 'select',
				'name'       => 'show_details_link',
				'title'      => esc_html__( 'Show Details Link', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'no_yes', false ),
				'group'      => esc_html__( 'Layout', 'topscorer-core' ),
			) );
			$this->set_option( array (
				'field_type' => 'select',
				'name'       => 'details_link_target',
				'title'      => esc_html__( 'Details Link Target', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'link_target', false ),
				'group'      => esc_html__( 'Layout', 'topscorer-core' ),
			) );
			$this->set_option( array (
				'field_type' => 'select',
				'name'       => 'show_tickets_link',
				'title'      => esc_html__( 'Show Ticket Link', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'no_yes', false ),
				'group'      => esc_html__( 'Layout', 'topscorer-core' ),
			) );
			$this->set_option( array (
				'field_type' => 'select',
				'name'       => 'tickets_link_target',
				'title'      => esc_html__( 'Ticket Link Target', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'link_target', false ),
				'group'      => esc_html__( 'Layout', 'topscorer-core' ),
			) );
			$this->set_option( array (
				'field_type' => 'select',
				'name'       => 'show_stream_link',
				'title'      => esc_html__( 'Show Live Stream Link', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'no_yes', false ),
				'group'      => esc_html__( 'Layout', 'topscorer-core' ),
			) );
			$this->set_option( array (
				'field_type' => 'select',
				'name'       => 'stream_link_target',
				'title'      => esc_html__( 'Live Stream Link Target', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'link_target', false ),
				'group'      => esc_html__( 'Layout', 'topscorer-core' ),
			) );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_sportspress_advanced_event_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent ::render( $options );

			$atts                     = $this->get_atts();
			$atts[ 'columns' ]        = 'table' === $atts[ 'layout' ] ? '1' : $atts[ 'columns' ];
			$atts[ 'space' ]          = 'table' === $atts[ 'layout' ] ? 'no' : $atts[ 'space' ];
			$atts[ 'holder_classes' ] = $this->get_holder_classes( $atts );
			$atts[ 'event_ids' ]      = $this->get_event_ids( $atts );
			$atts[ 'button_params' ]  = $this->get_button_params( $atts );
			$atts[ 'this_shortcode' ] = $this;

			return topscorer_core_get_template_part( 'sportspress/shortcodes/advanced-event-list', 'templates/content', $atts[ 'behavior' ], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-sportspress-advanced-event-list';
			$holder_classes[] = ! empty( $atts[ 'layout' ] ) ? 'qodef-item-layout--' . $atts[ 'layout' ] : '';
			$holder_classes[] = ! empty( $atts[ 'skin' ] ) ? 'qodef-skin--' . $atts[ 'skin' ] : '';

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

			if ( ! empty( $atts[ 'text_transform' ] ) ) {
				$styles[] = 'text-transform: ' . $atts[ 'text_transform' ];
			}

			return $styles;
		}

		public function get_event_ids( $atts ) {
			$event_ids = array();

			$args = array (
				'post_type'   => 'sp_event',
				'numberposts' => $atts[ 'posts_per_page' ],
				'orderby'     => 'date',
				'order'       => $atts[ 'order' ],
				'post_status' => $atts[ 'post_status' ],
				'fields'      => 'ids',
			);

			$events = get_posts( $args );

			if ( ! empty( $events ) ) {
				$event_ids = $events;
			}

			return $event_ids;
		}

		public function get_team_ids( $atts ) {
			$team_ids = array();

			if ( ! empty( $atts[ 'event_id' ] ) ) {
				$team_ids = get_post_meta( $atts[ 'event_id' ], 'sp_team', false );
			}

			return $team_ids;
		}

		public function get_button_params( $atts ) {
			$button_params = array();

			$button_params[ 'button_layout' ] = 'outlined';

			if ( 'light' === $atts[ 'skin' ] ) {
				$button_params[ 'color' ]              = '#ffffff';
				$button_params[ 'border_color' ]       = '#bbbbbb';
				$button_params[ 'hover_border_color' ] = '#fe5900';
			}

			return $button_params;
		}
	}
}
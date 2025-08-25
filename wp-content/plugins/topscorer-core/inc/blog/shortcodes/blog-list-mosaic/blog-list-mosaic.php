<?php

if ( ! function_exists( 'topscorer_core_add_blog_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_add_blog_list_mosaic_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreBlogListMosaicShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_add_blog_list_mosaic_shortcode' );
}

if ( class_exists( 'TopScorerCoreListShortcode' ) ) {
	class TopScorerCoreBlogListMosaicShortcode extends TopScorerCoreListShortcode {

		public function __construct() {
			$this->set_post_type( 'post' );
			$this->set_post_type_taxonomy( 'category' );
			$this->set_post_type_additional_taxonomies( array( 'post_tag', 'trending' ) );
			$this->set_layouts( apply_filters( 'topscorer_core_filter_blog_list_mosaic_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'topscorer_core_filter_blog_list_mosaic_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_INC_URL_PATH . '/blog/shortcodes/blog-list-mosaic' );
			$this->set_base( 'topscorer_core_blog_list_mosaic' );
			$this->set_name( esc_html__( 'Blog List Mosaic', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of blog posts', 'topscorer-core' ) );
			$this->set_category( esc_html__( 'TopScorer Core', 'topscorer-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'excerpt_length',
				'title'      => esc_html__( 'Excerpt Length', 'topscorer-core' ),
				'group'      => esc_html__( 'Layout', 'topscorer-core' ),
			) );

			$this->map_query_options();
			$this->map_layout_options( array(
				'layouts' => $this->get_layouts()
			) );
			$this->map_additional_options( array(
					'exclude_filter' => true
				)
			);
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_blog_list_mosaic', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}


		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_taxonomy();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );


			$atts['space']              = 'no';
			$atts['images_proportion']  = 'topscorer_image_size_square';
			$atts['columns']            = '2';
			$atts['behavior']           = 'columns';
			$atts['columns_responsive'] = 'custom';
			$atts['columns_1440']       = '2';
			$atts['columns_1366']       = '2';
			$atts['columns_1024']       = '1';
			$atts['columns_768']        = '1';
			$atts['columns_680']        = '1';
			$atts['columns_480']        = '1';


			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['query_result']   = new \WP_Query( topscorer_core_get_query_params( $atts ) );

			$atts['data_attr'] = topscorer_core_get_pagination_data( TOPSCORER_CORE_REL_PATH, 'blog/shortcodes', 'blog-list-mosaic', 'post', $atts );

			$atts['this_shortcode'] = $this;

			return topscorer_core_get_template_part( 'blog/shortcodes/blog-list-mosaic', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-blog';
			$holder_classes[] = 'qodef--list-mosaic';

			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';

			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

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

	}
}
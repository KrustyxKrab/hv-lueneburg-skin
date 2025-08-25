<?php

if ( ! function_exists( 'topscorer_core_add_dual_image_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function topscorer_core_add_dual_image_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreDualImageWithTextShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_add_dual_image_with_text_shortcode' );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerCoreDualImageWithTextShortcode extends TopScorerCoreShortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'topscorer_core_filter_dual_image_with_text_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'topscorer_core_filter_dual_image_with_text_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_SHORTCODES_URL_PATH . '/dual-image-with-text' );
			$this->set_base( 'topscorer_core_dual_image_with_text' );
			$this->set_name( esc_html__( 'Dual Image With Text', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds two images with text element', 'topscorer-core' ) );
			$this->set_category( esc_html__( 'TopScorer Core', 'topscorer-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'topscorer-core' ),
			) );
			$options_map = topscorer_core_get_variations_options_map( $this->get_layouts() );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'topscorer-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image_one',
				'title'      => esc_html__( 'Image', 'topscorer-core' ),
				'group'      => esc_html__( 'Image One', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'image_one_size',
				'title'       => esc_html__( 'Image Size', 'topscorer-core' ),
				'description' => esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'topscorer-core' ),
				'group'       => esc_html__( 'Image One', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_one_border',
				'title'         => esc_html__( 'Image Border', 'topscorer-core' ),
				'options'       => topscorer_core_get_select_type_options_pool( 'no_yes' ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Image One', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image_two',
				'title'      => esc_html__( 'Image', 'topscorer-core' ),
				'group'      => esc_html__( 'Image Two', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'image_two_size',
				'title'       => esc_html__( 'Image Size', 'topscorer-core' ),
				'description' => esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'topscorer-core' ),
				'group'       => esc_html__( 'Image Two', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_two_shadow',
				'title'         => esc_html__( 'Image Shadow', 'topscorer-core' ),
				'options'       => topscorer_core_get_select_type_options_pool( 'no_yes' ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Image Two', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_two_dots',
				'title'         => esc_html__( 'Image Background Dots', 'topscorer-core' ),
				'options'       => topscorer_core_get_select_type_options_pool( 'no_yes' ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Image Two', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Custom Link', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'topscorer-core' ),
				'options'       => topscorer_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
			) );

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'tagline',
				'title'      => esc_html__( 'Tagline', 'topscorer-core' ),
				'group'      => esc_html__( 'Content', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'tagline_color',
				'title'      => esc_html__( 'Tagline Color', 'topscorer-core' ),
				'group'      => esc_html__( 'Content', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'tagline_margin_top',
				'title'      => esc_html__( 'Tagline Margin Top', 'topscorer-core' ),
				'group'      => esc_html__( 'Content', 'topscorer-core' ),
			) );

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'topscorer-core' ),
				'group'      => esc_html__( 'Content', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'topscorer-core' ),
				'options'       => topscorer_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h4',
				'group'         => esc_html__( 'Content', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'topscorer-core' ),
				'group'      => esc_html__( 'Content', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'topscorer-core' ),
				'group'      => esc_html__( 'Content', 'topscorer-core' ),
			) );
			$this->map_extra_options();
		}
		
		public function load_assets () {
			wp_enqueue_script ( 'countdown', TOPSCORER_CORE_INC_URL_PATH . '/shortcodes/dual-image-with-text/assets/js/plugins/jquery.parallax-scroll.js', array ( 'jquery' ), true );
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_dual_image_with_text', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']   = $this->get_holder_classes( $atts );
			$atts['tagline_styles']   = $this->get_tagline_styles( $atts );
			$atts['title_styles']     = $this->get_title_styles( $atts );
			$atts['image_one_params'] = $this->generate_image_params( 'one', $atts );
			$atts['image_two_params'] = $this->generate_image_params( 'two', $atts );
			$atts['parallax_levels_one']  = $this->getParallaxData(-25,20);
			$atts['parallax_levels_two']  = $this->getParallaxData(-47,20);
			$atts['parallax_levels_three']  = $this->getParallaxData(-100,20);

			return topscorer_core_get_template_part( 'shortcodes/dual-image-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-dual-image-with-text qodef--has-appear';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = $atts['image_one_border'] === 'yes' ? 'qodef-has-border' : '';
			$holder_classes[] = $atts['image_two_shadow'] === 'yes' ? 'qodef-has-shadow' : '';
			/*$holder_classes[] = $atts['image_two_dots'] === 'yes' ? 'qodef-has-dots' : '';*/

			return implode( ' ', $holder_classes );
		}

		private function get_tagline_styles( $atts ) {
			$styles = array();

			if ( $atts['tagline_margin_top'] !== '' ) {
				$styles[] = 'margin-top: ' . intval( $atts['tagline_margin_top'] ) . 'px';
			}

			if ( ! empty( $atts['tagline_color'] ) ) {
				$styles[] = 'color: ' . $atts['tagline_color'];
			}

			return $styles;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( $atts['title_margin_top'] !== '' ) {
				$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
			}

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}

		private function generate_image_params( $current, $atts ) {
			$image = array();

			if ( ! empty( $atts[ 'image_' . $current ] ) ) {
				$id = $atts[ 'image_' . $current ];

				$image['image_id'] = intval( $id );
				$image_original    = wp_get_attachment_image_src( $id, 'full' );
				$image['url']      = $image_original[0];
				$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );

				$image_size = trim( $atts[ 'image_' . $current . '_size' ] );
				preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
				if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
					$image['image_size'] = $image_size;
				} elseif ( ! empty( $matches[0] ) ) {
					$image['image_size'] = array(
						$matches[0][0],
						$matches[0][1],
					);
				} else {
					$image['image_size'] = 'full';
				}
			}

			return $image;
		}
		
		public function getParallaxData($y_absolute, $smoothness) {
			$parallaxDataOne = array();
			
			/*$y_absolute = rand(-27, -75);
			$smoothness = 20; //1 is for linear, non-animated parallax
			
			$parallaxDataOne['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';*/
			/*$y_absolute = rand($rand1, $rand2);*/
			
			$parallaxDataOne['data-parallax']= '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
			
			return $parallaxDataOne;
		}
	}
}
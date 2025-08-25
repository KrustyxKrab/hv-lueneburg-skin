<?php

if ( ! function_exists( 'topscorer_core_add_button_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function topscorer_core_add_button_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreButtonShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_add_button_shortcode', 9 );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerCoreButtonShortcode extends TopScorerCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'topscorer_core_filter_button_layouts', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_SHORTCODES_URL_PATH . '/button' );
			$this->set_base( 'topscorer_core_button' );
			$this->set_name( esc_html__( 'Button', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays button with provided parameters', 'topscorer-core' ) );
			$this->set_category( esc_html__( 'TopScorer Core', 'topscorer-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'topscorer-core' )
			) );
			
			$options_map = topscorer_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'button_layout',
				'title'         => esc_html__( 'Layout', 'topscorer-core' ),
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array(
					'map_for_page_builder' => $options_map['visibility'],
					'map_for_widget' => $options_map['visibility']
				)
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'size',
				'title'      => esc_html__( 'Size', 'topscorer-core' ),
				'options'    => array(
					''      => esc_html__( 'Normal', 'topscorer-core' ),
					'small' => esc_html__( 'Small', 'topscorer-core' ),
					'large' => esc_html__( 'Large', 'topscorer-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text',
				'title'      => esc_html__( 'Button Text', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Button Link', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Target', 'topscorer-core' ),
				'options'       => topscorer_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'color',
				'title'      => esc_html__( 'Text Color', 'topscorer-core' ),
				'group'      => esc_html__( 'Style', 'topscorer-core' )
			) );
			$this->set_option( array(
				'name'       => 'hover_color',
				'field_type' => 'color',
				'title'      => esc_html__( 'Text Hover Color', 'topscorer-core' ),
				'group'      => esc_html__( 'Style', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'background_color',
				'title'      => esc_html__( 'Background Color', 'topscorer-core' ),
				'group'      => esc_html__( 'Style', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'hover_background_color',
				'title'      => esc_html__( 'Background Hover Color', 'topscorer-core' ),
				'group'      => esc_html__( 'Style', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'border_color',
				'title'      => esc_html__( 'Border Color', 'topscorer-core' ),
				'group'      => esc_html__( 'Style', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'margin',
				'title'      => esc_html__( 'Margin', 'topscorer-core' ),
				'group'      => esc_html__( 'Style', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'padding',
				'title'      => esc_html__( 'Padding', 'topscorer-core' ),
				'group'      => esc_html__( 'Style', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'font_size',
				'title'      => esc_html__( 'Font Size', 'topscorer-core' ),
				'group'      => esc_html__( 'Typography', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'font_weight',
				'title'      => esc_html__( 'Font Weight', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'font_weight' ),
				'group'      => esc_html__( 'Typography', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'text_transform',
				'title'      => esc_html__( 'Text Transform', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'text_transform' ),
				'group'      => esc_html__( 'Typography', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'html_type',
				'title'         => esc_html__( 'HTML Type', 'topscorer-core' ),
				'options'       => array(
					'default' => esc_html__( 'Default', 'topscorer-core' ),
					'input'   => esc_html__( 'Input', 'topscorer-core' ),
					'submit'  => esc_html__( 'Submit', 'topscorer-core' )
				),
				'default_value' => 'default',
				'visibility'    => array(
					'map_for_page_builder'    => false
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'input_name',
				'title'      => esc_html__( 'Input Name', 'topscorer-core' ),
				'visibility'    => array(
					'map_for_page_builder'    => false
				)
			) );
			$this->set_option( array(
				'field_type' => 'array',
				'name'       => 'custom_attrs',
				'title'      => esc_html__( 'Custom Data Attributes', 'topscorer-core' ),
				'visibility'    => array(
					'map_for_page_builder'    => false
				)
			) );
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'topscorer_core_button', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']          = $this->get_holder_classes( $atts );
			$atts['data_attrs']              = $this->get_data_attrs( $atts );
			$atts['styles']                  = $this->get_styles( $atts );
			$atts['hover_background_styles'] = $this->get_hover_background_styles( $atts );

			return topscorer_core_get_template_part( 'shortcodes/button', 'variations/'.$atts['button_layout'].'/templates/' . $atts['html_type'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-button';
			$holder_classes[] = ! empty( $atts['button_layout'] ) ? 'qodef-layout--' . $atts['button_layout'] : '';
			$holder_classes[] = ! empty( $atts['size'] ) ? 'qodef-size--' . $atts['size'] : '';
			$holder_classes[] = $atts['html_type'] === 'default' ? 'qodef-html--link' : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_data_attrs( $atts ) {
			$data = array();
			
			if ( ! empty( $atts['hover_color'] ) ) {
				$data['data-hover-color'] = $atts['hover_color'];
			}
			
			if ( ! empty( $atts['custom_attrs'] ) && is_array( $atts['custom_attrs'] ) ) {
				$data = array_merge( $data, $atts['custom_attrs'] );
			}
			
			return $data;
		}
		
		private function get_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['color'] ) ) {
				$styles[] = 'color: ' . $atts['color'];
			}
			
			if ( ! empty( $atts['background_color'] ) && $atts['button_layout'] !== 'outlined' && $atts['button_layout'] !== 'textual' ) {
				$styles[] = 'background-color: ' . $atts['background_color'];
			}
			
			if ( ! empty( $atts['border_color'] ) && $atts['button_layout'] !== 'textual' ) {
				$styles[] = 'border-color: ' . $atts['border_color'];
			}
			
			if ( ! empty( $atts['font_size'] ) ) {
				$styles[] = 'font-size: ' . intval( $atts['font_size'] ) . 'px';
			}
			
			if ( ! empty( $atts['font_weight'] ) ) {
				$styles[] = 'font-weight: ' . $atts['font_weight'];
			}
			
			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}
			
			if ( $atts['margin'] !== '' ) {
				$styles[] = 'margin: ' . $atts['margin'];
			}
			
			if ( $atts['padding'] !== '' ) {
				$styles[] = 'padding: ' . $atts['padding'];
			}
			
			return $styles;
		}
		
		private function get_hover_background_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['hover_background_color'] ) && $atts['button_layout'] !== 'textual' ) {
				$styles[] = 'background-color: ' . $atts['hover_background_color'];
			}
			
			return $styles;
		}
	}
}
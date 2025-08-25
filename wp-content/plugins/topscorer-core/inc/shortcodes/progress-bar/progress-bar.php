<?php

if ( ! function_exists( 'topscorer_core_add_progress_bar_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function topscorer_core_add_progress_bar_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerCoreProgressBarShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_add_progress_bar_shortcode' );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerCoreProgressBarShortcode extends TopScorerCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_SHORTCODES_URL_PATH . '/progress-bar' );
			$this->set_base( 'topscorer_core_progress_bar' );
			$this->set_name( esc_html__( 'Progress Bar', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays progress bar with provided parameters', 'topscorer-core' ) );
			$this->set_category( esc_html__( 'TopScorer Core', 'topscorer-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'topscorer-core' ),
				'options'       => array(
					'circle'      => esc_html__( 'Circle', 'topscorer-core' ),
					'semi-circle' => esc_html__( 'Semi Circle', 'topscorer-core' ),
					'line'        => esc_html__( 'Line', 'topscorer-core' ),
					'custom'      => esc_html__( 'Custom', 'topscorer-core' )
				),
				'default_value' => 'circle'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'circle_width',
				'title'      => esc_html__( 'Circle Width (px or %)', 'topscorer-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'circle',
							'default_value' => 'circle'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'custom_shape',
				'title'      => esc_html__( 'Custom Shape (SVG code)', 'topscorer-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'custom',
							'default_value' => '_self'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_shape_id',
				'title'      => esc_html__( 'Custom Shape ID', 'topscorer-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'custom',
							'default_value' => 'circle'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'active_line_color',
				'title'      => esc_html__( 'Active Line Color', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'active_line_width',
				'title'       => esc_html__( 'Active Line Width', 'topscorer-core' ),
				'description' => esc_html__( 'Enter width for active line without unit. Default value is 4 (1 is equal 3.59px for circle and custom type)', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'inactive_line_color',
				'title'      => esc_html__( 'Inactive Color', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'inactive_line_width',
				'title'       => esc_html__( 'Inactive Line Width', 'topscorer-core' ),
				'description' => esc_html__( 'Enter width for inactive line without unit. Default value is 4 (1 is equal 3.59px for circle and custom type)', 'topscorer-core' ),
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'number',
				'title'       => esc_html__( 'Percentage Number', 'topscorer-core' ),
				'description' => esc_html__( 'Enter percentage number for progress bar', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'number_color',
				'title'      => esc_html__( 'Number Color', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'title_on_bar',
				'title'      => esc_html__( 'Display Text over Bar', 'topscorer-core' ),
				'options'    => topscorer_core_get_select_type_options_pool( 'yes_no' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values' => 'line'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'bar_margin_bottom',
				'title'       => esc_html__( 'Margin bottom', 'topscorer-core' ),
				'description' => esc_html__( 'When line layout is selected and when text is displayed over bar', 'topscorer-core' ),
				'dependency'  => array(
					'show' => array(
						'title_on_bar' => array(
							'values' => 'yes'
						)
					)
				)
			) );

			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'topscorer-core' ),
				'options'       => topscorer_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h6'
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'topscorer-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'title_margin',
				'title'       => esc_html__( 'Title Margin', 'topscorer-core' ),
				'description' => esc_html__( 'If you selected a progress bar layout other than line this option corresponds to the margin top; in the event line layout type is selected, the option corresponds to the margin bottom.', 'topscorer-core' ),
				'dependency'  => array(
					'hide' => array(
						'title_on_bar' => array(
							'values' => 'yes'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'topscorer-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values' => array( 'circle', 'semi-circle' )
						)
					)
				)
			) );
		}

		public function load_assets() {
			$atts = $this->get_atts();
			if ( $atts['layout'] == 'line' ) {
				wp_enqueue_script( 'progress-bar-line', TOPSCORER_CORE_INC_URL_PATH . '/shortcodes/progress-bar/assets/js/plugins/jquery.lineProgressbar.js', array( 'jquery' ), true );
			} else {
				wp_enqueue_script( 'progress-bar-circle', TOPSCORER_CORE_INC_URL_PATH . '/shortcodes/progress-bar/assets/js/plugins/progressbar.min.js', array( 'jquery' ), true );
			}
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']      = $this->get_holder_classes( $atts );
			$atts['title_styles']        = $this->get_title_styles( $atts );
			$atts['progress_bar_styles'] = $this->get_progress_bar_styles( $atts );
			$atts['canvas_styles'] = $this->get_canvas_styles( $atts );
			$atts['rand_number']         = rand( 0, 1000 );
			$atts['data_attrs']          = $this->get_data_attrs( $atts );

			return topscorer_core_get_template_part( 'shortcodes/progress-bar', 'templates/progress-bar', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-progress-bar';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = $atts['title_on_bar'] === 'yes' ? 'qodef-title-on-bar--' . $atts['title_on_bar'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_data_attrs( $atts ) {
			$data = array();

			if ( ! empty( $atts['layout'] ) ) {
				$data['data-layout'] = $atts['layout'];
			}

			$data['data-active-line-color'] = ! empty( $atts['active_line_color'] ) ? $atts['active_line_color'] : '#000';
			$data['data-active-line-width'] = ! empty( $atts['active_line_width'] ) ? $atts['active_line_width'] : 4;

			$data['data-inactive-line-color'] = ! empty( $atts['inactive_line_color'] ) ? $atts['inactive_line_color'] : '#fff';
			$data['data-inactive-line-width'] = ! empty( $atts['inactive_line_width'] ) ? $atts['inactive_line_width'] : 4;

			$data['data-text-color'] = ! empty( $atts['number_color'] ) ? $atts['number_color'] : '#000';

			$data['data-number']          = ! empty( $atts['number'] ) ? $atts['number'] : '';
			$data['data-rand-number']     = ! empty( $atts['rand_number'] ) ? $atts['rand_number'] : 100;
			$data['data-custom-shape-id'] = ! empty( $atts['custom_shape_id'] ) ? $atts['custom_shape_id'] : '';

			return $data;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( $atts['title_margin'] !== '' ) {
				if ( $atts['layout'] === 'line' ) {
					$styles[] = 'margin-bottom: ' . intval( $atts['title_margin'] ) . 'px';
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin'] ) . 'px';
				}
			}

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}

		private function get_progress_bar_styles( $atts ) {
			$styles = array();
			if ( $atts['bar_margin_bottom'] !== '' ) {
				if ( $atts['title_on_bar'] === 'yes' ) {
					$styles[] = 'margin-bottom: ' . intval( $atts['bar_margin_bottom'] ) . 'px';
				}
			}

			return $styles;
		}

		private function get_canvas_styles( $atts ) {
			$styles = array();

			$circle_width = $atts['circle_width'];
			if ( !empty($circle_width ) ) {
				if ( qode_framework_string_ends_with_space_units( $circle_width ) ) {
					$styles[] = 'max-width: ' . $circle_width;
				} else {
					$styles[] = 'max-width: ' . intval( $circle_width ) . 'px';
				}
			}

			return $styles;
		}


	}
}
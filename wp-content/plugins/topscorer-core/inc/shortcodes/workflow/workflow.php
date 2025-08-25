<?php

if ( ! function_exists( 'topscorer_core_add_workflow_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function topscorer_core_add_workflow_shortcode( $shortcodes ) {
		$shortcodes[] = 'TopScorerWorkflowShortcode';

		return $shortcodes;
	}

	add_filter( 'topscorer_core_filter_register_shortcodes', 'topscorer_core_add_workflow_shortcode' );
}

if ( class_exists( 'TopScorerCoreShortcode' ) ) {
	class TopScorerWorkflowShortcode extends TopScorerCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( TOPSCORER_CORE_SHORTCODES_URL_PATH . '/workflow' );
			$this->set_base( 'topscorer_workflow_gallery' );
			$this->set_name( esc_html__( 'Workflow', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds workflow holder', 'topscorer-core' ) );
			$this->set_category( esc_html__( 'TopScorer Core', 'topscorer-core' ) );
			$this->set_option( array (
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Workflow Items', 'topscorer-core' ),
				'items'      => array (
					array (
						'field_type'    => 'text',
						'name'          => 'date',
						'title'         => esc_html__( 'Date', 'topscorer-core' ),
						'default_value' => '',
					),
					array (
						'field_type'    => 'text',
						'name'          => 'title',
						'title'         => esc_html__( 'Title', 'topscorer-core' ),
						'default_value' => '',
					),
					array (
						'field_type'    => 'text',
						'name'          => 'text',
						'title'         => esc_html__( 'Text', 'topscorer-core' ),
						'default_value' => '',
					),
				),
			) );
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent ::render( $options );

			$atts                     = $this->get_atts();
			$atts[ 'holder_classes' ] = $this->get_holder_classes( $atts );
			$atts[ 'this_object' ]    = $this;
			$atts[ 'items' ]          = $this->parse_repeater_items( $atts[ 'children' ] );

			return topscorer_core_get_template_part( 'shortcodes/workflow', 'templates/workflow', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-workflow';

			return implode( ' ', $holder_classes );
		}
	}
}
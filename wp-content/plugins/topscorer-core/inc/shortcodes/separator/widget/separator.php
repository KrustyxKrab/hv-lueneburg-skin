<?php

if ( ! function_exists( 'topscorer_core_add_separator_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function topscorer_core_add_separator_widget( $widgets ) {
		$widgets[] = 'TopScorerCoreSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'topscorer_core_filter_register_widgets', 'topscorer_core_add_separator_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TopScorerCoreSeparatorWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'topscorer_core_separator'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'topscorer_core_separator' );
				$this->set_name( esc_html__( 'TopScorer Separator', 'topscorer-core' ) );
				$this->set_description( esc_html__( 'Add a separator element into widget areas', 'topscorer-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[topscorer_core_separator $params]" ); // XSS OK
		}
	}
}
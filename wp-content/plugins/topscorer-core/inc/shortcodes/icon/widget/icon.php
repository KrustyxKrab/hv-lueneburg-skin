<?php

if ( ! function_exists( 'topscorer_core_add_icon_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function topscorer_core_add_icon_widget( $widgets ) {
		$widgets[] = 'TopScorerCoreIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'topscorer_core_filter_register_widgets', 'topscorer_core_add_icon_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TopScorerCoreIconWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'topscorer_core_icon'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'topscorer_core_icon' );
				$this->set_name( esc_html__( 'TopScorer Icon', 'topscorer-core' ) );
				$this->set_description( esc_html__( 'Add a icon element into widget areas', 'topscorer-core' ) );
			}
		}
		
		public function render( $atts ) {
			
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[topscorer_core_icon $params]" ); // XSS OK
		}
	}
}

<?php

if ( ! function_exists( 'topscorer_core_add_icon_list_item_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function topscorer_core_add_icon_list_item_widget( $widgets ) {
		$widgets[] = 'TopScorerCoreIconListItemWidget';
		
		return $widgets;
	}
	
	add_filter( 'topscorer_core_filter_register_widgets', 'topscorer_core_add_icon_list_item_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TopScorerCoreIconListItemWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'topscorer_core_icon_list_item',
//				'exclude'   => array(
//					'icon_type', 'custom_icon'
//				)
			) );
			if( $widget_mapped ) {
				$this->set_base( 'topscorer_core_icon_list_item' );
				$this->set_name( esc_html__( 'TopScorer Icon List Item', 'topscorer-core' ) );
				$this->set_description( esc_html__( 'Add a icon list item element into widget areas', 'topscorer-core' ) );
			}
		}
		
//		public function render( $atts ) {
//
//			$params = $this->generate_string_params( $atts );
//
//			echo do_shortcode( "[topscorer_core_icon_list_item $params]" ); // XSS OK
//		}

        public function render( $atts ) {
            echo TopScorerCoreIconListItemShortcode::call_shortcode( $atts ); // XSS OK
        }
	}
}

<?php

if ( ! function_exists( 'topscorer_core_add_woo_dropdown_cart_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function topscorer_core_add_woo_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'TopScorerCoreWooDropDownCartWidget';
		
		return $widgets;
	}
	
	add_filter( 'topscorer_core_filter_register_widgets', 'topscorer_core_add_woo_dropdown_cart_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TopScorerCoreWooDropDownCartWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'topscorer_core_woo_dropdown_cart' );
			$this->set_name( esc_html__( 'TopScorer WooCommerce DropDown Cart', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Display a shop cart icon with a dropdown that shows products that are in the cart', 'topscorer-core' ) );
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'widget_padding',
					'title'       => esc_html__( 'Widget Padding', 'topscorer-core' ),
					'description' => esc_html__( 'Insert padding in format: top right bottom left', 'topscorer-core' )
				)
			);
		}
		
		public function render( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['widget_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['widget_padding'];
			}
			?>
			<div class="qodef-woo-dropdown-cart qodef-m" <?php qode_framework_inline_style( $styles ) ?>>
				<div class="qodef-woo-dropdown-cart-inner qodef-m-inner">
					<?php topscorer_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/content' ); ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'topscorer_core_woo_dropdown_cart_add_to_cart_fragment' ) ) {
	function topscorer_core_woo_dropdown_cart_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<div class="qodef-woo-dropdown-cart-inner qodef-m-inner">
			<?php topscorer_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/content' ); ?>
		</div>
		
		<?php
		$fragments['.qodef-woo-dropdown-cart-inner'] = ob_get_clean();
		
		return $fragments;
	}
	
	add_filter( 'woocommerce_add_to_cart_fragments', 'topscorer_core_woo_dropdown_cart_add_to_cart_fragment' );
}

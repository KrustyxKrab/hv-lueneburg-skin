<?php

if ( ! function_exists( 'topscorer_core_add_search_opener_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 **/
	function topscorer_core_add_search_opener_widget( $widgets ) {
		$widgets[] = 'TopScorerCoreSearchOpener';

		return $widgets;
	}

	add_filter( 'topscorer_core_filter_register_widgets', 'topscorer_core_add_search_opener_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TopScorerCoreSearchOpener extends QodeFrameworkWidget {

		public function __construct() {
			add_filter( 'topscorer_filter_add_inline_style', array ( $this, 'set_inline_search_opener_styles' ) );
			parent ::__construct();
		}

		public function map_widget() {
			$this->set_base( 'topscorer_core_search_opener' );
			$this->set_name( esc_html__( 'TopScorer Search Opener', 'topscorer-core' ) );
			$this->set_description( esc_html__( 'Display a "search" icon that opens the search form', 'topscorer-core' ) );
			$this->set_widget_option(
				array (
					'field_type' => 'color',
					'name'       => 'search_icon_color',
					'title'      => esc_html__( 'Icon Color', 'topscorer-core' ),
				)
			);
			$this->set_widget_option(
				array (
					'field_type' => 'color',
					'name'       => 'search_icon_hover_color',
					'title'      => esc_html__( 'Icon Hover Color', 'topscorer-core' ),
				)
			);
			$this->set_widget_option(
				array (
					'field_type'  => 'text',
					'name'        => 'search_icon_margin',
					'title'       => esc_html__( 'Icon Margin', 'topscorer-core' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'topscorer-core' ),
				)
			);
			$this->set_widget_option(
				array (
					'field_type' => 'select',
					'name'       => 'search_icon_label',
					'title'      => esc_html__( 'Enable Search Icon Label', 'topscorer-core' ),
					'options'    => topscorer_core_get_select_type_options_pool( 'no_yes' ),
				)
			);
			$this->set_widget_option(
				array (
					'field_type' => 'text',
					'name'       => 'search_icon_size',
					'title'      => esc_html__( 'Icon Size (px)', 'topscorer-core' ),
				)
			);
		}

		public function render( $atts ) {
			$enable_search_icon_text = topscorer_core_get_option_value( 'admin', 'qodef_search_icon_label' );

			$styles           = array();
			$show_search_text = $atts[ 'search_icon_label' ] == 'yes' || $enable_search_icon_text == 'yes';

			if ( ! empty( $atts[ 'search_icon_size' ] ) ) {
				$styles[] = 'font-size: ' . intval( $atts[ 'search_icon_size' ] ) . 'px';
			}

			if ( ! empty( $atts[ 'search_icon_color' ] ) ) {
				$styles[] = 'color: ' . $atts[ 'search_icon_color' ] . ';';
			}

			if ( ! empty( $atts[ 'search_icon_margin' ] ) ) {
				$styles[] = 'margin: ' . $atts[ 'search_icon_margin' ] . ';';
			}
			?>
            <a <?php qode_framework_inline_attr( $atts[ 'search_icon_hover_color' ], 'data-hover-color' ); ?> <?php qode_framework_inline_style( $styles ); ?>
                    class="qodef-search-opener <?php echo topscorer_core_get_open_close_icon_class( 'qodef_search_icon_source', 'qodef-search-opener' ) ?>"
                    href="javascript:void(0)">
                <span class="qodef-search-opener-inner">
                    <?php echo topscorer_core_get_search_icon_html(); ?>
	                <?php if ( $show_search_text ) : ?>
                        <span class="qodef-search-opener-text"><?php esc_html_e( 'Search', 'topscorer-core' ); ?></span>
	                <?php endif; ?>
                </span>
            </a>
		<?php }

		public function set_inline_search_opener_styles( $style ) {
			$styles       = array();
			$hover_styles = array();

			$color       = topscorer_core_get_option_value( 'admin', 'qodef_search_icon_color' );
			$hover_color = topscorer_core_get_option_value( 'admin', 'qodef_search_icon_hover_color' );
			$font_size   = topscorer_core_get_option_value( 'admin', 'qodef_search_icon_size' );

			if ( ! empty( $color ) ) {
				$styles[ 'color' ] = $color;
			}

			if ( ! empty( $font_size ) ) {
				$styles[ 'font-size' ] = $font_size;
			}

			if ( ! empty( $hover_color ) ) {
				$hover_styles[ 'color' ] = $hover_color;
			}

			if ( ! empty( $styles ) ) {
				$style .= qode_framework_dynamic_style( '.qodef-search-opener', $styles );
			}

			if ( ! empty( $hover_styles ) ) {
				$style .= qode_framework_dynamic_style( '.qodef-search-opener:hover', $hover_styles );
			}

			return $style;
		}
	}
}
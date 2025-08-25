<?php

if ( ! class_exists( 'TopScorerCore_Maps' ) ) {
	class TopScorerCore_Maps {
		private static $instance;

		public function __construct() {
			// Include Google map scripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'include_google_scripts' ) );

			// Include Google map scripts for framework.
			add_action( 'qode_framework_before_dashboard_scripts', array( $this, 'include_google_scripts' ) );

			// Set google map api key dependency.
			add_filter( 'topscorer_core_filter_script_dependencies', array( $this, 'set_scripts_dependency' ) );
			add_filter( 'qode_framework_filter_address_field_type_api_key_is_set', array( $this, 'enable_maps_for_framework_fields' ) );

			// Load global maps variables.
			add_action( 'wp_enqueue_scripts', array( $this, 'set_global_map_variables' ), 20 );
		}

		/**
		 * Instance of module class
		 *
		 * @return TopScorerCore_Maps
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function include_google_scripts() {

			if ( topscorer_core_get_google_maps_api_key( 'is_enabled' ) ) {
				$google_maps_extensions       = '';
				$google_maps_extensions_array = array_unique( (array) apply_filters( 'topscorer_core_filter_google_maps_extensions', array( 'marker' ) ) );

				if ( ! empty( $google_maps_extensions_array ) ) {
					$google_maps_extensions .= '&libraries=';
					$google_maps_extensions .= implode( ',', $google_maps_extensions_array );
				}

				// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
				wp_register_script( 'google-map-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( topscorer_core_get_google_maps_api_key() ) . '&loading=async&callback=qodefGoogleMapsCallback' . $google_maps_extensions, array(), false, true );
				wp_add_inline_script( 'google-map-api', 'window.qodefGoogleMapsCallback = function () { jQuery( document ).trigger( "qodefGoogleMapsCallbackEvent" ); };', 'before' );

				// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
				wp_register_script( 'topscorer-core-map-custom-marker', TOPSCORER_CORE_INC_URL_PATH . '/maps/assets/js/custom-marker.js', array( 'google-map-api', 'underscore', 'jquery' ), false, true );

				// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
				wp_register_script( 'markerclusterer', TOPSCORER_CORE_INC_URL_PATH . '/maps/assets/js/markerclusterer.js', array( 'google-map-api', 'jquery' ), false, true );

				// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
				wp_register_script( 'topscorer-core-google-map', TOPSCORER_CORE_INC_URL_PATH . '/maps/assets/js/google-map.js', array( 'google-map-api', 'topscorer-core-map-custom-marker', 'markerclusterer', 'jquery' ), false, true );

				wp_register_script( 'nouislider', TOPSCORER_CORE_INC_URL_PATH . '/maps/assets/js/nouislider.min.js', array(), '11.1.0', true );
			}
		}

		public function set_scripts_dependency( $dependencies ) {

			if ( topscorer_core_get_google_maps_api_key( 'is_enabled' ) ) {
				$dependencies[] = 'topscorer-core-google-map';
			}

			return $dependencies;
		}

		public function enable_maps_for_framework_fields( $is_enabled ) {

			if ( topscorer_core_get_google_maps_api_key( 'is_enabled' ) ) {
				return true;
			}

			return $is_enabled;
		}

		public function set_global_map_variables() {

			if ( topscorer_core_get_google_maps_api_key( 'is_enabled' ) ) {
				$map_zoom  = topscorer_core_get_post_value_through_levels( 'qodef_map_zoom' );
				$map_style = json_decode( topscorer_core_get_post_value_through_levels( 'qodef_map_style' ) );

				$js_map_variables['mapStyle']          = ! empty( $map_style ) ? $map_style : '';
				$js_map_variables['mapZoom']           = ! empty( $map_zoom ) ? $map_zoom : 12;
				$js_map_variables['mapScrollable']     = 'yes' === topscorer_core_get_post_value_through_levels( 'qodef_enable_map_scroll' );
				$js_map_variables['mapDraggable']      = 'yes' === topscorer_core_get_post_value_through_levels( 'qodef_enable_map_drag' );
				$js_map_variables['streetViewControl'] = 'yes' === topscorer_core_get_post_value_through_levels( 'qodef_enable_map_street_view_control' );
				$js_map_variables['zoomControl']       = 'yes' === topscorer_core_get_post_value_through_levels( 'qodef_enable_map_zoom_control' );
				$js_map_variables['mapTypeControl']    = 'yes' === topscorer_core_get_post_value_through_levels( 'qodef_enable_map_type_control' );
				$js_map_variables['fullscreenControl'] = 'yes' === topscorer_core_get_post_value_through_levels( 'qodef_enable_map_full_screen_control' );
				$js_map_variables['geolocationTitle']  = esc_html__( 'Your location is here', 'topscorer-core' );

				$js_map_variables = apply_filters( 'topscorer_core_filter_js_map_variables', $js_map_variables );

				wp_localize_script(
					'topscorer-core-google-map',
					'qodefMapsVariables',
					array(
						'global'   => $js_map_variables,
						'multiple' => array(),
					)
				);
			}
		}
	}
}

TopScorerCore_Maps::get_instance();

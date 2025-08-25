<?php
/*
Plugin Name: TopScorer Core
Description: Plugin that adds portfolio post type, shortcodes and other modules
Author: Qode Themes
Version: 1.2
*/
if ( ! class_exists( 'TopScorerCore' ) ) {
	class TopScorerCore {
		private static $instance;

		function __construct() {
			// Include plugin core files.
			require_once __DIR__ . '/constants.php';

			// Permission 3 is set to be initialized before the qode-framework at priority 5.
			add_action( 'after_setup_theme', array( $this, 'require_core' ), 3 );

			add_filter( 'qode_framework_filter_register_admin_options', array( $this, 'create_core_options' ) );

			add_action( 'qode_framework_action_before_options_init_' . TOPSCORER_CORE_OPTIONS_NAME, array( $this, 'init_core_options' ) );

			add_action( 'qode_framework_action_populate_meta_box', array( $this, 'init_core_meta_boxes' ) );

			// Include plugin assets
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

			// Make plugin available for translation
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) ); // permission 15 is set in order to be after the qode-framework initialization

			// Add plugin's body classes
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );

			// Hook to include additional modules when plugin loaded
			do_action( 'topscorer_core_action_plugin_loaded' );
		}

        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

		function require_core() {
			
			require_once TOPSCORER_CORE_ABS_PATH . '/helpers/helper.php';

			// Hook to include additional files before modules inclusion
			do_action( 'topscorer_core_action_before_include_modules' );

			foreach ( glob( TOPSCORER_CORE_INC_PATH . '/*/include.php' ) as $module ) {
				include_once $module;
			}

			// Hook to include additional files after modules inclusion
			do_action( 'topscorer_core_action_after_include_modules' );
		}

		function create_core_options( $options ) {
			$topscorer_core_options_admin = new QodeFrameworkOptionsAdmin(
				TOPSCORER_CORE_MENU_NAME,
				TOPSCORER_CORE_OPTIONS_NAME,
				array(
					'label' => esc_html__( 'TopScorer Core Options', 'topscorer-core' ),
					'code'  => TopScorerCoreDashboard::get_instance()->get_code()
				)
			);
			$options[] = $topscorer_core_options_admin;

			return $options;
		}

		function init_core_options() {
			$qode_framework = qode_framework_get_framework_root();

			if ( ! empty( $qode_framework ) ) {
				$page = $qode_framework->add_options_page(
					array(
						'scope'       => TOPSCORER_CORE_OPTIONS_NAME,
						'type'        => 'admin',
						'slug'        => 'general',
						'title'       => esc_html__( 'General', 'topscorer-core' ),
						'description' => esc_html__( 'General Core Options', 'topscorer-core' ),
						'icon'        => 'fa fa-cog'
					)
				);

				// Hook to include additional options after default options
				do_action( 'topscorer_core_action_default_options_init', $page );
			}
		}

		function init_core_meta_boxes() {
			do_action( 'topscorer_core_action_default_meta_boxes_init' );
		}

		function enqueue_assets() {
			// CSS and JS dependency variables
			$style_dependency_array  = apply_filters( 'topscorer_core_filter_style_dependencies', array( 'topscorer-main' ) );
			$script_dependency_array = apply_filters( 'topscorer_core_filter_script_dependencies', array( 'topscorer-main-js' ) );

			// Hook to include additional scripts before plugin's main style
			do_action( 'topscorer_core_action_before_main_css' );

			// Enqueue plugin's main style
			wp_enqueue_style( 'topscorer-core-style', TOPSCORER_CORE_URL_PATH . 'assets/css/topscorer-core.min.css', $style_dependency_array );

			// Enqueue plugin's 3rd party scripts
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-easing-1.3', TOPSCORER_CORE_URL_PATH . 'assets/plugins/jquery/jquery.easing.1.3.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'modernizr', TOPSCORER_CORE_URL_PATH . 'assets/plugins/modernizr/modernizr.js', array( 'jquery' ), false, true );

			// Hook to include additional scripts before plugin's main script
			do_action( 'topscorer_core_action_before_main_js' );

			// Enqueue plugin's main script
			wp_enqueue_script( 'topscorer-core-script', TOPSCORER_CORE_URL_PATH . 'assets/js/topscorer-core.min.js', $script_dependency_array, false, true );
		}

		function load_plugin_textdomain() {
			load_plugin_textdomain( 'topscorer-core', false, TOPSCORER_CORE_REL_PATH . '/languages' );
		}

		function add_body_classes( $classes ) {
			$classes[] = 'topscorer-core-' . TOPSCORER_CORE_VERSION;

			return $classes;
		}
	}
}

if ( ! function_exists( 'topscorer_core_instantiate_plugin' ) ) {
	function topscorer_core_instantiate_plugin() {
		TopScorerCore::get_instance();
	}

	add_action( 'qode_framework_action_load_dependent_plugins', 'topscorer_core_instantiate_plugin' );
}

if ( ! function_exists( 'topscorer_core_activation_trigger' ) ) {
	function topscorer_core_activation_trigger() {
		// Hook to add additional code on plugin activation
		do_action( 'topscorer_core_action_on_activation' );
	}

	register_activation_hook( __FILE__, 'topscorer_core_activation_trigger' );
}

if ( ! function_exists( 'topscorer_core_deactivation_trigger' ) ) {
	function topscorer_core_deactivation_trigger() {
		// Hook to add additional code on plugin deactivation
		do_action( 'topscorer_core_action_on_deactivation' );
	}

	register_deactivation_hook( __FILE__, 'topscorer_core_deactivation_trigger' );
}

if( ! function_exists( 'topscorer_core_check_requirements' ) ) {
	function topscorer_core_check_requirements() {
		if ( ! defined( 'QODE_FRAMEWORK_VERSION' ) ) {
			add_action( 'admin_notices', 'topscorer_core_admin_notice_content' );
		}
	}

	add_action( 'plugins_loaded', 'topscorer_core_check_requirements' );
}

if( ! function_exists( 'topscorer_core_admin_notice_content' ) ) {
	function topscorer_core_admin_notice_content() {
		echo sprintf( '<div class="notice notice-error"><p>%s</p></div>', esc_html__( 'Qode Framework plugin is required for TopScorer Core plugin to work properly. Please install/activate it first.', 'topscorer-core' ) );

		if ( function_exists( 'deactivate_plugins' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
	}
}


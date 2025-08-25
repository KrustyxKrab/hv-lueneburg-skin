<?php

if ( ! class_exists ( 'TopScorerCoreSportsPress' ) ) {
    class TopScorerCoreSportsPress
    {
        private static $instance;

        public function __construct () {
            if ( class_exists ( 'SportsPress' ) ) {
                // include files
                $this->include_files();

                // init
                add_action ( 'after_setup_theme', array ( $this, 'init' ) );

                // add our classname to shortcodes
                add_action ( 'sportspress_shortcode_wrapper', array ( $this, 'set_shortcode_class' ) );

                // include module assets
                add_action ( 'wp_enqueue_scripts', array ( $this, 'enqueue_assets' ) );
            }
        }

        public static function get_instance () {
            if ( is_null ( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        function include_files () {
            // include helper
            include_once TOPSCORER_CORE_INC_PATH . '/sportspress/helper.php';

            // include options
            foreach ( glob ( TOPSCORER_CORE_INC_PATH . '/sportspress/dashboard/admin/*.php' ) as $module ) {
                include_once $module;
            }

            // include meta boxes
            foreach ( glob ( TOPSCORER_CORE_INC_PATH . '/sportspress/dashboard/meta-box/*.php' ) as $module ) {
                include_once $module;
            }

            // include shortcodes
            add_action ( 'qode_framework_action_before_shortcodes_register', array ( $this, 'include_shortcodes' ) );
        }

        /**
         * function that initialize module support for sportspress plugin
         *
         * @hooked on 'sportspress_loaded' action
         */
        function init () {
            // add theme support
            add_theme_support ( 'sportspress' );
        }

        /**
         * function that include all module shortcodes
         *
         * @hooked on 'qode_framework_action_before_shortcodes_register' action
         */
        function include_shortcodes () {
            include_once TOPSCORER_CORE_INC_PATH . '/sportspress/shortcodes/include.php';
        }

        /**
         * function that enqueue select2 script
         *
         * @hooked on 'wp_enqueue_script' action
         */
        function enqueue_assets () {
            wp_enqueue_script ( 'select2', TOPSCORER_CORE_URL_PATH . 'inc/sportspress/assets/plugins/select2/select2.min.js', array ( 'jquery' ), false, true );
        }

        /**
         * function that add our class name to sportspress shortcodes
         *
         * @hooked on 'sportspress_shortcode_wrapper' action
         * @see    SP_Shortcodes::shortcode_wrapper()
         */
        function set_shortcode_class ( $wrapper ) {
            $wrapper[ 'class' ] .= ' qodef-sportspress';

            return $wrapper;
        }
    }

    TopScorerCoreSportsPress::get_instance();
}
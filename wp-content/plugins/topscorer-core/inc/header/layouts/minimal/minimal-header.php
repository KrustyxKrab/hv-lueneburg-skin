<?php

class MinimalHeader extends TopScorerCoreHeader {
	private static $instance;

	public function __construct() {
		$this->slug                  = 'minimal';
		$this->search_layout         = 'covers-header';
		$this->default_header_height = 70;

		add_action( 'topscorer_action_before_wrapper_close_tag', array( $this, 'fullscreen_menu_template' ) );

		parent::__construct();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function fullscreen_menu_template() {
		$parameters = array(
			'fullscreen_menu_in_grid' => topscorer_core_get_post_value_through_levels( 'qodef_fullscreen_menu_in_grid' ) === 'yes'
		);

		topscorer_core_template_part( 'fullscreen-menu', 'templates/full-screen-menu', '', $parameters );
	}
}
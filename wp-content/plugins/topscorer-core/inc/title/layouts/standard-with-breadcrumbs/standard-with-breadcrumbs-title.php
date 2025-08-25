<?php

class TopScorerCoreStandardWithBreadcrumbsTitle extends TopScorerCoreTitle {
	private static $instance;
	
	public function __construct() {
		$this->slug = 'standard-with-breadcrumbs';
	}

    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
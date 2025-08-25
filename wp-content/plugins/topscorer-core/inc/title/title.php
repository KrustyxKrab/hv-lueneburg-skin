<?php

abstract class TopScorerCoreTitle {
	protected $slug;
	public $overriding_whole_title = false;
	
	public function load_template( $parameters = array() ) {
		return topscorer_core_get_template_part( 'title/layouts/' . $this->slug, 'templates/' . $this->slug, '', $parameters );
	}
}
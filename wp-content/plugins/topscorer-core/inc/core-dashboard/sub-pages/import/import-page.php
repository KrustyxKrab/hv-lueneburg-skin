<?php

if ( ! function_exists( 'topscorer_core_add_import_sub_page_to_list' ) ) {
	/**
	 * Function that add additional sub page item into welcome page list
	 *
	 * @param array $sub_pages
	 *
	 * @return array
	 */
	function topscorer_core_add_import_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'TopScorerCoreImportPage';
		
		return $sub_pages;
	}
	
	add_filter( 'topscorer_core_filter_add_welcome_sub_page', 'topscorer_core_add_import_sub_page_to_list', 11 );
}

if ( class_exists( 'TopScorerCoreSubPage' ) ) {
	class TopScorerCoreImportPage extends TopScorerCoreSubPage {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_title( esc_html__( 'Import', 'topscorer-core' ) );
			$this->set_atts( $this->set_atributtes() );
		}
		
		public function set_atributtes() {
			$params = array();
			
			$iparams = TopScorerCoreDashboard::get_instance()->get_import_params();
			if ( is_array( $iparams ) && isset( $iparams['submit'] ) ) {
				$params['submit'] = $iparams['submit'];
			}
			
			return $params;
		}
	}
}
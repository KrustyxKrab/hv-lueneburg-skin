<?php if ( class_exists( 'TopScorerCoreSocialShareShortcode' ) ) { ?>
	<div class="qodef-woo-product-social-share">
		<?php
		$params = array();
		$params['title'] = esc_html__( 'Share:', 'topscorer-core' );
		
		echo TopScorerCoreSocialShareShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>
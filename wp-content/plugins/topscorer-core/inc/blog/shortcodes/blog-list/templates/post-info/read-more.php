<?php if ( ! post_password_required() ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
			'link' => get_the_permalink(),
			'text' => esc_html__( 'Read More', 'topscorer-core' ),
			'button_layout' => 'textual'
		);
		
		echo TopScorerCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>
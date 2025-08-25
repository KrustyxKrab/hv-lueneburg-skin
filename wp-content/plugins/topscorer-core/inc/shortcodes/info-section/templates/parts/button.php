<?php
if( ! empty( $button_params ) && ! empty ( $button_params['text'] ) ) { ?>
	<div class="qodef-m-button">
		<?php echo TopScorerCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php }
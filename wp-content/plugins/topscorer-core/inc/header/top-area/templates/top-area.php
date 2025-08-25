<?php if ( $show_header_area ) { ?>
	<div id="qodef-top-area">
		<div class="qodef-top-area-left">
			<?php topscorer_core_get_header_widget_area( 'top-area-left' ); ?>
		</div>
		<div class="qodef-top-area-right">
			<?php topscorer_core_get_header_widget_area( 'top-area-right' ); ?>
		</div>
		<?php do_action( 'topscorer_core_action_after_top_area' ); ?>
	</div>
<?php } ?>
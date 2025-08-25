<<?php echo topscorer_core_escape_title_tag( $title_tag ); ?> class="qodef-accordion-title">
	<span class="qodef-tab-title">
		<?php echo esc_html( $title ); ?>
	</span>
	<span class="qodef-accordion-mark">
		<span class="qodef-icon--plus icon_plus"></span>
		<span class="qodef-icon--minus icon_minus-06"></span>
	</span>
</<?php echo topscorer_core_escape_title_tag( $title_tag ); ?>>
<div class="qodef-accordion-content">
	<div class="qodef-accordion-content-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>
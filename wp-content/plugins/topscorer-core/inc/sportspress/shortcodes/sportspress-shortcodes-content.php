<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php
	// call shortcode
	echo do_shortcode( '[' . $shortcode . ' ' . $shortcode_atts . ']' );
	?>
</div>
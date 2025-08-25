<div class="qodef-m-image qodef-image--two" <?php echo qode_framework_get_inline_attrs($parallax_levels_two, true); ?>>
	<div class="qodef-m-image-inner">
		<?php if ( is_array ( $image_two_params[ 'image_size' ] ) && count ( $image_two_params[ 'image_size' ] ) ) : ?>
			<?php echo qode_framework_generate_thumbnail ( $image_two_params[ 'image_id' ], $image_two_params[ 'image_size' ][ 0 ], $image_two_params[ 'image_size' ][ 1 ] ); ?>
		<?php else: ?>
			<?php echo wp_get_attachment_image ( $image_two_params[ 'image_id' ], $image_two_params[ 'image_size' ] ); ?>
		<?php endif; ?>
	</div>
</div>
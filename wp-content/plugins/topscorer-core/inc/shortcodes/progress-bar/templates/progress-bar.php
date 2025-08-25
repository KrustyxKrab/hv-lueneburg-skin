<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $progress_bar_styles ) ?> <?php qode_framework_inline_attrs( $data_attrs ); ?> >
    <div class="qodef-m-inner">
        <div class="qodef-m-canvas" id="qodef-m-canvas-<?php echo esc_attr( $rand_number ); ?>" <?php qode_framework_inline_style( $canvas_styles ) ?>></div>
		<?php if ( isset( $layout ) && $layout === 'custom' && ! empty( $custom_shape ) ) { ?>
            <div id="qodef-m-custom-canvas">
				<?php echo qode_framework_wp_kses_html( 'svg', $custom_shape ); ?>
            </div>
		<?php } ?>
        <div class="qodef-m-content">
			<?php if ( ! empty( $title ) ) { ?>
            <<?php echo topscorer_core_escape_title_tag( $title_tag ); ?>
            class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
			<?php echo esc_html( $title ); ?>
        </<?php echo topscorer_core_escape_title_tag( $title_tag ); ?>>
	<?php } ?>
		<?php if ( ! empty( $text ) ) { ?>
            <p class="qodef-m-text"><?php echo wp_kses( $text, array( 'br' => array() ) ) ?></p>
		<?php } ?>
    </div>
</div>
</div>
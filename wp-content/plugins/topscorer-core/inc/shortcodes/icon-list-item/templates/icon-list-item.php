<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php /*qode_framework_inline_style( $holder_styles ); */ ?>>
	<?php if ( ! empty( $number ) ): ?>
        <span class="qodef-e-number"<?php qode_framework_inline_style( $number_styles ); ?> ><?php echo esc_html( $number ); ?></span>
	<?php endif; ?>
    <<?php echo topscorer_core_escape_title_tag( $title_tag ); ?> class="qodef-e-title" <?php qode_framework_inline_style( $title_styles ); ?>>
	<?php if ( ! empty( $link ) ) : ?>
    <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php endif; ?>
        <span class="qodef-e-title-inner">
				<?php topscorer_core_template_part( 'shortcodes/icon-list-item', 'templates/parts/' . $icon_type, '', $params ) ?>
            <span class="qodef-e-title-text" <?php qode_framework_inline_style( $title_text_styles ); ?>><?php echo esc_html( $title ); ?></span>
			</span>
		<?php if ( ! empty( $link ) ) : ?>
    </a>
<?php endif; ?>
</<?php echo topscorer_core_escape_title_tag( $title_tag ); ?>>
</div>
<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
    <a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
        <div class="qodef-m-icon-wrapper">
			<?php topscorer_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/' . $icon_type, '', $params ) ?>
        </div>
        <div class="qodef-m-content">
			<?php topscorer_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/subtitle', '', $params ) ?>
			<?php topscorer_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/title', '', $params ) ?>
			<?php topscorer_core_template_part( 'shortcodes/icon-with-text', 'templates/parts/text', '', $params ) ?>
        </div>
    </a>
</div>
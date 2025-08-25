<div <?php qode_framework_class_attribute ( $holder_classes ); ?>>
    <div class="qodef-m-media">
        <?php topscorer_core_template_part ( 'shortcodes/dual-image-with-text', 'templates/parts/image-one', '', $params ) ?>
        <?php topscorer_core_template_part ( 'shortcodes/dual-image-with-text', 'templates/parts/image-two', '', $params ) ?>
        <?php topscorer_core_template_part ( 'shortcodes/dual-image-with-text', 'templates/parts/dots', '', $params ) ?>
    </div>
    <div class="qodef-m-content">
        <?php topscorer_core_template_part ( 'shortcodes/dual-image-with-text', 'templates/parts/tagline', '', $params ) ?>
        <?php topscorer_core_template_part ( 'shortcodes/dual-image-with-text', 'templates/parts/title', '', $params ) ?>
    </div>
    <?php topscorer_core_template_part ( 'shortcodes/dual-image-with-text', 'templates/parts/link', '', $params ) ?>
</div>
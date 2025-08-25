<div <?php qode_framework_class_attribute ( $item_classes ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-e-quote-icon">
            <?php topscorer_core_list_sc_template_part ( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/quote-icon', '', $params ); ?>
        </div>
        <div class="qodef-e-content">
            <?php topscorer_core_list_sc_template_part ( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/text', '', $params ); ?>
            <?php topscorer_core_list_sc_template_part ( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/author', '', $params ); ?>
        </div>
    </div>
</div>
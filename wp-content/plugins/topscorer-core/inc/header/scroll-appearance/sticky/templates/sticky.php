<div class="qodef-header-sticky">
    <div class="qodef-header-sticky-inner <?php echo apply_filters( 'topscorer_filter_header_inner_class', '' ); ?>">
        <?php
        topscorer_core_get_header_logo_image();
        topscorer_core_template_part( 'header', 'templates/parts/navigation', '', array( 'menu_id' => 'qodef-sticky-navigation-menu' ) );
        ?>
        <div class="qodef-widget-holder">
            <?php topscorer_core_get_header_widget_area( 'sticky' ); ?>
        </div>

        <?php do_action('topscorer_core_action_after_sticky_header'); ?>
    </div>
</div>
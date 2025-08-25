<div class="<?php echo esc_attr ( $item_classes ); ?>">

    <?php if ( has_post_thumbnail ( $player_id ) ) : ?>
        <div class="qodef-e-image">
            <?php topscorer_core_template_part ( 'sportspress/shortcodes/advanced-player-details', 'templates/post-info/image', '', $params ); ?>
        </div>
    <?php endif; ?>

    <div class="qodef-e-content">
        <?php topscorer_core_template_part ( 'sportspress/shortcodes/advanced-player-details', 'templates/post-info/position', '', $params ); ?>
        <?php topscorer_core_template_part ( 'sportspress/shortcodes/advanced-player-details', 'templates/post-info/name', '', $params ); ?>
        <?php topscorer_core_template_part ( 'sportspress/shortcodes/advanced-player-details', 'templates/post-info/details', '', $params ); ?>
        <?php topscorer_core_template_part ( 'sportspress/shortcodes/advanced-player-details', 'templates/post-info/excerpt', '', $params ); ?>
        <?php topscorer_core_template_part ( 'sportspress/shortcodes/advanced-player-details', 'templates/post-info/link', '', $params ); ?>
    </div>

</div>
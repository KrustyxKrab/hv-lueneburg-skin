<div class="<?php echo esc_attr ( $item_classes ); ?>">

    <div class="qodef-e-images">
        <div class="qodef-e-background-image" <?php echo qode_framework_get_inline_style ( $background_image_styles ); ?>>
            <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/background-image', '', $params ); ?>
        </div>
        <div class="qodef-e-images-inner">
            <?php if ( ! empty( $team_ids[ 0 ] ) && ! empty( $team_ids[ 1 ] ) ) : ?>
                <?php if ( ! empty( $team_ids[ 0 ] ) ): ?>
                    <?php $params[ 'team_id' ] = $team_ids[ 0 ]; ?>
                    <?php if ( has_post_thumbnail ( $team_ids[ 0 ] ) ) : ?>
                        <div class="qodef-e-image qodef-team--home">
                            <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/team-image', '', $params ); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="qodef-e-delimiter" <?php echo qode_framework_get_inline_style ( $delimiter_styles ); ?>>
                    <?php echo get_option ( 'sportspress_event_teams_delimiter', 'vs' ); ?>
                </div>
                <?php if ( ! empty( $team_ids[ 1 ] ) ): ?>
                    <?php $params[ 'team_id' ] = $team_ids[ 1 ]; ?>
                    <?php if ( has_post_thumbnail ( $team_ids[ 1 ] ) ) : ?>
                        <div class="qodef-e-image qodef-team--away">
                            <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/team-image', '', $params ); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="qodef-e-image">
                    <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/event-image', '', $params ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="qodef-e-content">
        <?php if ( ! empty( $tickets ) ): ?>
            <?php foreach ( $tickets as $ticket ): ?>

                <div class="qodef-e-content-inner">

                    <?php
                    $params[ 'price' ]       = ! empty( $ticket[ 'qodef_sportspress_event_single_ticket_price' ] ) ? $ticket[ 'qodef_sportspress_event_single_ticket_price' ] : '';
                    $params[ 'description' ] = ! empty( $ticket[ 'qodef_sportspress_event_single_ticket_description' ] ) ? $ticket[ 'qodef_sportspress_event_single_ticket_description' ] : '';
                    ?>

                    <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/price', '', $params ); ?>

                    <div class="qodef-e-details">
                        <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/title', '', $params ); ?>
                        <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/description', '', $params ); ?>

                        <?php if ( 'future' === get_post_status ( $params[ 'event_id' ] ) ): ?>
                            <div class="qodef-e-date">
                                <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/date', '', $params ); ?>
                            </div>
                        <?php else: ?>
                            <div class="qodef-e-result">
                                <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/result', '', $params ); ?>
                            </div>
                        <?php endif; ?>
                        <?php ?>
                    </div>

                    <?php if ( ! empty( $show_details_link ) || ! empty( $show_tickets_link ) ): ?>
                        <div class="qodef-e-links">
                            <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/details-link', '', $params ); ?>
                            <?php topscorer_core_template_part ( 'sportspress/shortcodes/event-tickets', 'templates/post-info/tickets-link', '', $params ); ?>
                        </div>
                    <?php endif; ?>

                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <?php topscorer_core_theme_template_part ( 'content', 'templates/parts/posts-not-found' ); ?>
        <?php endif; ?>
    </div>

</div>
<?php
$is_enabled      = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_player_single_enable_related_players' );
$player_list_id  = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_player_single_related_players_list' );
$tagline         = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_player_single_related_players_tagline' );
$title           = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_player_single_related_players_title' );
$background_text = topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_player_single_related_players_background_text' );

if ( $is_enabled === 'yes' ) : ?>
    <div class="qodef-sportspress-related-players qodef-m qodef-background-dots qodef-background-dots-position--center">

        <?php if ( ! empty( $tagline ) || ! empty( $title ) ): ?>

            <div class="qodef-m-text">

                <?php if ( ! empty( $tagline ) ): ?>
                    <div class="qodef-m-tagline">
                        <?php echo esc_html ( $tagline ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $title ) ): ?>
                    <h2 class="qodef-m-title">
                        <?php echo esc_html ( $title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( ! empty( $background_text ) ): ?>
                    <div class="qodef-m-background-text">
                        <?php echo esc_html ( $background_text ); ?>
                    </div>
                <?php endif; ?>

            </div>

            <div class="qodef-m-background-dots-holder">
                <div class="qodef-m-background-dots-holder-full-width"></div>
            </div>

        <?php endif; ?>

        <div class="qodef-m-gallery">

            <div class="qodef-m-gallery">

                <?php
                $params = array (
                    'behavior'             => 'columns',
                    'images_proportion'    => 'full',
                    'columns'              => '4',
                    'columns_responsive'   => 'custom',
                    'columns_1440'         => '4',
                    'columns_1366'         => '4',
                    'columns_1024'         => '2',
                    'columns_768'          => '2',
                    'columns_680'          => '1',
                    'columns_480'          => '1',
                    'player_list'          => $player_list_id,
                    'show_player_position' => 'yes',
                    'posts_per_page'       => 4,
                );

                if ( class_exists ( 'TopScorerCoreSportsPressAdvancedPlayerListShortcode' ) ) {
                    echo TopScorerCoreSportsPressAdvancedPlayerListShortcode ::call_shortcode ( $params );
                }
                ?>

            </div>

        </div>

    </div>
<?php endif; ?>
<?php
$is_enabled = topscorer_core_get_post_value_through_levels ( 'qodef_blog_single_enable_single_post_navigation' );

if ( $is_enabled === 'yes' ) {
    $through_same_category = topscorer_core_get_post_value_through_levels ( 'qodef_blog_single_post_navigation_through_same_category' ) === 'yes';
    $prev_arrow            = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px" width="26px" height="51px" viewBox="0 0 26 51" style="enable-background:new 0 0 26 51;" xml:space="preserve">
                                <g>
                                <polygon points="25,0 26,0 1,25.5 26,51 25,51 0,25.5"/>
                                <polygon points="26,0 25,0 0,25.5 25,51 26,51 1,25.5 26,0"/>
                                </g>
                                </svg>';
    $next_arrow            = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px" width="26px" height="51px" viewBox="0 0 26 51" style="enable-background:new 0 0 26 51;" xml:space="preserve">
                                <g>
                                <polygon points="1,0 0,0 25,25.5 0,51 1,51 26,25.5"/>
                                <polygon points="1,0 0,0 25,25.5 0,51 1,51 26,25.5 1,0"/>
                                </g>
                                </svg>';
    ?>
    <div id="qodef-single-post-navigation" class="qodef-m">
        <div class="qodef-m-inner">
            <?php
            $post_navigation = array (
                'prev' => array (
                    'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Previous', 'topscorer-core' ) . '</span>',
                    'icon'  => '<span class="qodef-m-nav-arrow">' . $prev_arrow . '</span>',
                ),
                'next' => array (
                    'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Next', 'topscorer-core' ) . '</span>',
                    'icon'  => '<span class="qodef-m-nav-arrow">' . $next_arrow . '</span>',
                ),
            );

            if ( $through_same_category ) {
                if ( get_previous_post ( true ) !== '' ) {
                    $post_navigation[ 'prev' ][ 'post' ] = get_previous_post ( true );
                }
                if ( get_next_post ( true ) !== '' ) {
                    $post_navigation[ 'next' ][ 'post' ] = get_next_post ( true );
                }
            } else {
                if ( get_previous_post() !== '' ) {
                    $post_navigation[ 'prev' ][ 'post' ] = get_previous_post();
                }
                if ( get_next_post() !== '' ) {
                    $post_navigation[ 'next' ][ 'post' ] = get_next_post();
                }
            }

            foreach ( $post_navigation as $key => $value ) {
                if ( isset( $post_navigation[ $key ][ 'post' ] ) ) {
                    $current_post = $value[ 'post' ];
                    $post_id      = $current_post->ID;
                    ?>
                    <a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr ( $key ); ?>"
                            href="<?php echo get_permalink ( $post_id ); ?>">
                        <?php echo qode_framework_wp_kses_html ( 'svg', $value[ 'icon' ] ); ?>
                        <?php echo wp_kses ( $value[ 'label' ], array ( 'span' => array ( 'class' => true ) ) ); ?>
                    </a>
                <?php }
            }
            ?>
        </div>
    </div>
<?php } ?>
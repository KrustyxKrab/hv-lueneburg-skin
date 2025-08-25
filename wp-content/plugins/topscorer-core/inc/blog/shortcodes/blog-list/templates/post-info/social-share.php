<?php
if ( class_exists ( 'TopScorerCoreSocialShareShortcode' ) ) : ?>

    <?php if ( ! empty( $enable_share_on_blog_list ) && ( 'yes' === $$enable_share_on_blog_list ) ): ?>

        <div class="qodef-e-info-item qodef-e-info-social-share">

            <?php
            $params                = array();
            $params[ 'layout' ]    = 'list';
            $params[ 'icon_font' ] = 'elegant-icons';

            echo TopScorerCoreSocialShareShortcode ::call_shortcode ( $params );
            ?>

            <a href="javascript:void(0)">
            	<span class="qodef-e-title">
		            <?php echo esc_html__( 'Share', 'topscorer-core' ) ?>
            	</span>
            </a>
        </div>

    <?php endif; ?>
<?php endif; ?>
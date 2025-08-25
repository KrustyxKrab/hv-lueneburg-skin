<div id="qodef-page-banner">
    <div class="qodef-page-banner-image">
		<?php
		$link = topscorer_core_get_post_value_through_levels( 'qodef_banner_link' );
		if ( ! empty( $link ) ):?>
            <a class="qodef-page-banner-link" itemprop="url" href="<?php echo esc_url( $link ); ?>"
               target="_blank"></a>
		<?php endif; ?>
    </div>
</div>


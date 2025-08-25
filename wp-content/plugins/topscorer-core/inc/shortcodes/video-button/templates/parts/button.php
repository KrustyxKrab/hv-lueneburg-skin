<?php if ( ! empty( $video_link ) ) : ?>
    <a itemprop="url" class="qodef-m-play qodef-magnific-popup qodef-popup-item" href="<?php echo esc_url ( $video_link ); ?>" data-type="iframe">
		<span class="qodef-m-play-inner">
			<?php echo topscorer_core_get_svg ( 'play-button' ); ?>
			<span class="qodef-m-play-inner-background"></span>
		</span>
    </a>
<?php endif; ?>
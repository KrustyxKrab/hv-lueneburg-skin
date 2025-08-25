<article <?php post_class( $item_classes ); ?>>
    <div class="qodef-e-inner">
		<?php topscorer_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', 'background', $params ); ?>
        <div class="qodef-e-content">
	        <?php if ( $enable_counter == 'yes'){ ?>
	            <div class="qodef-e-counter"></div>
	        <?php } ?>
            <div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				topscorer_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/category' );
				?>
            </div>
			<?php topscorer_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params ); ?>

			<?php topscorer_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/read-more', '', $params ); ?>
	
	        <?php topscorer_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/link' ); ?>
        </div>
    </div>
</article>
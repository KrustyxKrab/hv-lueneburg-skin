<article <?php post_class ( $item_classes ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-e-media">
            <?php
            // Include post info image
            topscorer_core_template_part ( 'blog/shortcodes/blog-list', 'templates/post-info/image', '', $params );

            // Include post info icon
            topscorer_core_template_part ( 'blog/shortcodes/blog-list', 'templates/post-info/media-icon', '', $params );
            ?>
        </div>
        <div class="qodef-e-content">
            <div class="qodef-e-info qodef-info--top">
                <?php
                // Include post category info
                topscorer_core_template_part ( 'blog/shortcodes/blog-list', 'templates/post-info/category' );

                // Include post date info
                topscorer_core_template_part ( 'blog/shortcodes/blog-list', 'templates/post-info/date' );
                ?>
            </div>
            <div class="qodef-e-text">
                <?php
                // Include post info title
                topscorer_core_template_part ( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );

                // Include post excerpt
                topscorer_core_template_part ( 'blog/shortcodes/blog-list', 'templates/post-info/excerpt', '', $params );
                ?>
            </div>
            <div class="qodef-e-info qodef-info--bottom">
                <?php
                // Include post read more
                topscorer_core_template_part ( 'blog/shortcodes/blog-list', 'templates/post-info/read-more' );
                ?>
            </div>
        </div>
    </div>
</article>
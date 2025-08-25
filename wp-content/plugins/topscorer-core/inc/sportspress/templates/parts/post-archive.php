<article <?php post_class ( 'qodef-grid-item qodef-e' ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-e-media">
            <?php
            // include post media
            topscorer_core_template_part ( 'sportspress', 'templates/parts/post-info/image' );
            ?>
        </div>
        <div class="qodef-e-content">
            <div class="qodef-e-text">
                <?php
                // include post title
                topscorer_core_template_part ( 'sportspress', 'templates/parts/post-info/title' );

                // include post excerpt
                topscorer_core_template_part ( 'sportspress', 'templates/parts/post-info/excerpt' );
                ?>
            </div>
            <div class="qodef-e-info qodef-info--bottom">
                <?php
                // include post read more
                topscorer_core_template_part ( 'sportspress', 'templates/parts/post-info/read-more' );
                ?>
            </div>
        </div>
    </div>
</article>
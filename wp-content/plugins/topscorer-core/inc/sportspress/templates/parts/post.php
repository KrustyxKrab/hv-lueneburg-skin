<article <?php post_class( 'qodef-sportspress-item qodef-e' ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-e-content">
			<?php

			// include post content
			the_content();

			// hook to include additional content after sportspress content
			do_action( 'topscorer_action_after_sportspress_content' );

			?>
        </div>
    </div>
</article>
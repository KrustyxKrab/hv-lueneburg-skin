<article <?php post_class( 'qodef-sportspress-item qodef-e' ); ?>>
    <div class="qodef-e-inner">
        <div class="qodef-e-intro">
			<?php
			// hook to include additional content before sportspress content
			do_action( 'topscorer_action_before_sportspress_player_single_content' );
			?>
        </div>
        <div class="qodef-e-content">
			<?php

			// include post content
			the_content();

			?>
        </div>
        <div class="qodef-e-additional-content">
			<?php
			// hook to include additional content after sportspress content
			do_action( 'topscorer_action_after_sportspress_player_single_content' );
			?>
        </div>
    </div>
</article>
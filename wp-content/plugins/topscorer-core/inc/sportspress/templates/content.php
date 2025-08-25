<?php

$params = array( 'slug' => $slug );

// hook to include additional content before page content holder
do_action( 'topscorer_core_action_before_sportspress_content_holder' );
?>
    <main id="qodef-page-content" class="qodef-grid qodef-layout--template <?php echo esc_attr( topscorer_core_get_grid_gutter_classes() ); ?>">
        <div class="qodef-grid-inner clear">
			<?php
			// include sportspress template
			topscorer_core_template_part( 'sportspress', 'templates/sportspress', '', $params );

			// include page content sidebar
			topscorer_core_theme_template_part( 'sidebar', 'templates/sidebar' );
			?>
        </div>
    </main>
<?php
// hook to include additional content after main page content holder
do_action( 'topscorer_core_action_after_sportspress_content_holder' );
?>
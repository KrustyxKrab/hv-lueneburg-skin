<?php

$params = array( 'slug' => $slug );

?>

<div class="qodef-grid-item <?php echo esc_attr( topscorer_core_get_page_content_sidebar_classes() ); ?>">
    <div class="qodef-sportspress qodef-m">
		<?php
		// include sportspress posts loop
		topscorer_core_template_part( 'sportspress', 'templates/parts/loop', '', $params );
		?>
    </div>
</div>
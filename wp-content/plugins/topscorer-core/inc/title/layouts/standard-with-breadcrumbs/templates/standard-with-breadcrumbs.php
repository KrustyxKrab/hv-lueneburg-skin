<?php
// Load title image template
topscorer_core_get_page_title_image(); ?>
<div class="qodef-m-content <?php echo esc_attr( topscorer_core_get_page_title_content_classes() ); ?>">
	<?php
	// Load breadcrumbs template
	topscorer_core_breadcrumbs();
	?>
    <h1 class="qodef-m-title entry-title">
		<?php if ( qode_framework_is_installed( 'theme' ) ) {
			echo esc_html( topscorer_get_page_title_text() );
		} else {
			echo get_option( 'blogname' );
		} ?>
    </h1>
</div>
<div class="<?php echo esc_attr( $item_classes ); ?>">
    <div class="qodef-e-content">

        <div class="qodef-e-details">
			<?php topscorer_core_template_part( 'sportspress/shortcodes/trophy-list', 'templates/post-info/tagline', '', $params ); ?>
			<?php topscorer_core_template_part( 'sportspress/shortcodes/trophy-list', 'templates/post-info/title', '', $params ); ?>
        </div>

		<?php if ( $trophy_image )  : ?>
            <div class="qodef-e-image">
				<?php topscorer_core_template_part( 'sportspress/shortcodes/trophy-list', 'templates/post-info/image', '', $params ); ?>
            </div>
		<?php endif; ?>

		<?php topscorer_core_template_part( 'sportspress/shortcodes/trophy-list', 'templates/post-info/link', '', $params ); ?>

    </div>
</div>
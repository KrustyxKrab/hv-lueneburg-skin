<div class="<?php echo esc_attr( $item_classes ); ?>">

	<?php if ( has_post_thumbnail( $player_id ) ) : ?>
        <div class="qodef-e-image">
			<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-player-list', 'templates/post-info/image', '', $params ); ?>
			<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-player-list', 'templates/post-info/link', '', $params ); ?>
        </div>
	<?php endif; ?>

    <div class="qodef-e-details">
		<?php if ( $show_player_position === 'yes' ): ?>
			<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-player-list', 'templates/post-info/position', '', $params ); ?>
		<?php endif; ?>
		<?php topscorer_core_template_part( 'sportspress/shortcodes/advanced-player-list', 'templates/post-info/name', '', $params ); ?>
    </div>
    
</div>
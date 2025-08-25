<div <?php qode_framework_class_attribute( $holder_classes ); ?>>

	<?php if ( ! empty( $title ) ) : ?>
        <span class="qodef-m-title"  <?php qode_framework_inline_style( $title_styles ); ?>>
            <?php echo esc_html( $title ); ?>
        </span>
	<?php endif; ?>

    <ul class="qodef-m-networks">
		<?php $social_networks = get_post_meta( $player_id, 'qodef_sportspress_player_single_social_icons', true ); ?>

		<?php if ( ! empty( $social_networks ) ) : ?>
			<?php foreach ( $social_networks as $social_network ) : ?>

				<?php
				$icon_pack           = $social_network['qodef_sportspress_player_single_social_icon'];
				$icon_pack_formatted = str_replace( '-', '_', $icon_pack );
				$icon_pack_icon      = isset( $social_network[ 'qodef_sportspress_player_single_social_icon-' . $icon_pack ] ) ? $social_network[ 'qodef_sportspress_player_single_social_icon-' . $icon_pack ] : '';
				?>

				<?php if ( ! empty( $icon_pack ) && ! empty( $icon_pack_icon ) ): ?>
                    <li class="qodef-m-network">
						<?php
						$icon_params['main_icon']                           = $icon_pack;
						$icon_params[ 'main_icon_' . $icon_pack_formatted ] = $icon_pack_icon;
						$icon_params['target']                              = $social_network['qodef_sportspress_player_single_social_icon_target'];
						$icon_params['link']                                = $social_network['qodef_sportspress_player_single_social_icon_link'];
						$icon_params['color']                               = ! empty( $icon_color ) ? $icon_color : '';
						$icon_params['hover_color']                         = ! empty( $icon_hover_color ) ? $icon_hover_color : '';
						$icon_params['size']                                = 'default';
						$icon_params['icon_layout']                         = 'normal';

						topscorer_core_template_part( 'sportspress/shortcodes/player-social-networks', 'templates/parts/icon', '', $icon_params );
						?>
                    </li>
				<?php endif; ?>

			<?php endforeach; ?>

		<?php endif; ?>

    </ul>

</div>
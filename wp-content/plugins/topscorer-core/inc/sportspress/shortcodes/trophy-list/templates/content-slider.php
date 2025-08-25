<?php if ( $slider_navigation !== 'no' ) { ?>
    <div class="qodef-swiper-container-outer">
<?php } ?>
    <div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
        <div class="swiper-wrapper">
			<?php
			// include items
			topscorer_core_template_part( 'sportspress/shortcodes/trophy-list', 'templates/loop', '', $params );
			?>
        </div>
		<?php if ( $slider_pagination !== 'no' ) : ?>
            <div class="swiper-pagination"></div>
		<?php endif; ?>
    </div>
<?php if ( $slider_navigation !== 'no' ) { ?>
    <div class="swiper-button-next swiper-button-outside swiper-button-next-<?php echo esc_attr( $unique ); ?>"></div>
    <div class="swiper-button-prev swiper-button-outside swiper-button-prev-<?php echo esc_attr( $unique ); ?>"></div>
    </div>
<?php } ?>
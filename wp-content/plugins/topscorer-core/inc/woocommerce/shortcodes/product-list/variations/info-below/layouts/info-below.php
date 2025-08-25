<div <?php wc_product_class( $item_classes ); ?>>
    <div class="qodef-woo-product-inner">
		<?php if ( has_post_thumbnail() ) { ?>
            <div class="qodef-woo-product-image">
				<?php topscorer_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/on-sale' ); ?>
				<?php topscorer_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/image', '', $params ); ?>
                <div class="qodef-woo-product-image-inner">
					<?php topscorer_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/add-to-cart' ); ?>
                </div>
            </div>
		<?php } ?>
        <div class="qodef-woo-product-content">
			<?php topscorer_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/category', '', $params ); ?>
			<?php topscorer_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/title', '', $params ); ?>
			<?php topscorer_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/price', '', $params ); ?>
        </div>
		<?php topscorer_core_template_part( 'woocommerce/shortcodes/product-list', 'templates/post-info/link' ); ?>
    </div>
</div>


<?php if ( is_object( WC()->cart ) ) { ?>
	<?php topscorer_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/parts/opener' ); ?>
	<div class="qodef-m-dropdown">
		<div class="qodef-m-dropdown-inner">
			<?php if ( ! WC()->cart->is_empty() ) {
				topscorer_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/parts/loop' );
				
				topscorer_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/parts/order-details' );
				
				topscorer_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/parts/button' );
			} else {
				topscorer_core_template_part( 'woocommerce/widgets/dropdown-cart', 'templates/posts-not-found' );
			} ?>
		</div>
	</div>
<?php } ?>
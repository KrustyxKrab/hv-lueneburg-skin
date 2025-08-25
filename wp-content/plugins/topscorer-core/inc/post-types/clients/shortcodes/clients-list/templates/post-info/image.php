<?php
$item_id            = get_the_ID();
$client_image       = get_post_meta( $item_id, 'qodef_logo_image', true );
$link               = get_post_meta( $item_id, 'qodef_client_link', true );
$link_target        = get_post_meta( $item_id, 'qodef_client_link_target', true );
$link_target        = ! empty( $link_target ) ? $link_target : '_blank';

if ( ! empty ( $client_image ) ) { ?>
	<span class="qodef-e-image">
		<?php if( ! empty( $link ) ) { ?>
			<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
		<?php } ?>
		<?php if( ! empty( $client_image ) ) { ?>
			<span class="qodef-e-logo">
				<?php echo wp_get_attachment_image( $client_image, 'full' ); ?>
			</span>
		<?php } ?>
		<?php if( ! empty( $link ) ) { ?>
			</a>
		<?php } ?>
	</span>
<?php } ?>
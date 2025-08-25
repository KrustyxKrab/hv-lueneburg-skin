<?php
	$spinner_text = topscorer_core_get_post_value_through_levels( 'qodef_page_spinner_text' );

	if ( ! function_exists( 'topscorer_str_split_unicode' ) ) {
		function topscorer_str_split_unicode( $str ) {
			return preg_split( '~~u', html_entity_decode( $str ), - 1, PREG_SPLIT_NO_EMPTY );
		}
	}
	
	if ( ! function_exists( 'topscorer_get_split_text' ) ) {
		function topscorer_get_split_text( $text ) {
			if ( ! empty( $text ) ) {
				$split_text = topscorer_str_split_unicode( $text );
				
				foreach ( $split_text as $key => $value ) {
					$split_text[ $key ] = '<span class="qodef-e-character">' . $value . '</span>';
				}
				
				return implode( ' ', $split_text );
			}
			
			return $text;
		}
	}

	$split_spinner_text = topscorer_get_split_text($spinner_text);

	$spinner_background_image = topscorer_core_get_post_value_through_levels( 'qodef_page_spinner_background_image' );

	$spinner_background_style = '';

	if ( ! empty( $spinner_background_image ) ) {
		$spinner_background_style .= 'background-image:url(' . esc_url( wp_get_attachment_image_url( $spinner_background_image, 'full' ) ) . ');';
	}
?>

<div class="qodef-m-predefined" <?php qode_framework_inline_style( $spinner_background_style ); ?>>
	<div class="qodef-predefined-spinner-text">
		<?php echo $split_spinner_text; ?>
	</div>
</div>
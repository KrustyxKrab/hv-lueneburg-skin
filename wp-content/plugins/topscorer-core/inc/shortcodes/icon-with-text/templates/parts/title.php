<?php if ( ! empty( $title ) ) { ?>
    <<?php echo topscorer_core_escape_title_tag( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>

    <span class="qodef-m-title-text"><?php echo wp_kses( $title, array( 'br' => array() ) ); ?></span>


    </<?php echo topscorer_core_escape_title_tag( $title_tag ); ?>>
<?php } ?>
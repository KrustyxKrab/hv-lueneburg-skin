<?php if ( ! post_password_required() ) : ?>

    <div class="qodef-e-read-more">
        <?php

        $button_params = array (
            'link'          => get_the_permalink(),
            'button_layout' => 'textual',
            'text'          => esc_html__( 'Read More', 'topscorer-core' ),
        );

        topscorer_render_button_element ( $button_params );

        ?>

    </div>

<?php endif; ?>
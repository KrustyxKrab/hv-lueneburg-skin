<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php foreach ( $items as $key => $item ) : ?>
        <div class="qodef-e-workflow-item">
            <div class="qodef-e-workflow-text">
                <h4 class="qodef-e-title"><?php echo esc_html( $item['title'] ); ?></h4>
				<?php if ( isset( $item['text'] ) && ! empty( $item['text'] ) ) : ?>
                    <p class="qodef-e-text"><?php echo wp_kses_post( $item['text'] ); ?></p>
				<?php endif; ?>
            </div>
            <div class="qodef-e-workflow-date">
				<?php if ( isset( $item['date'] ) && ! empty( $item['date'] ) ) : ?>
                    <p class="qodef-e-date"><?php echo esc_html( $item['date'] ); ?></p>
				<?php endif; ?>
            </div>
        </div>
	<?php endforeach; ?>
</div>
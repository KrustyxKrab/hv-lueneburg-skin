<?php

$columns       = ! empty( topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_archive_columns' ) ) ? topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_archive_columns' ) : 3;
$columns_space = ! empty( topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_archive_columns_space' ) ) ? topscorer_core_get_post_value_through_levels ( 'qodef_sportspress_archive_columns_space' ) : 'normal';

$params[ 'slug' ] = 'archive';

$grid_classes = '';
$grid_classes .= ' qodef-grid';
$grid_classes .= ' qodef-layout--columns';
$grid_classes .= ' qodef-gutter--' . $columns_space;
$grid_classes .= ' qodef-col-num--' . $columns;
$grid_classes .= ' qodef-responsive--predefined';

?>

<div class="qodef-grid-item <?php echo esc_attr ( topscorer_core_get_page_content_sidebar_classes() ); ?>">
    <div class="qodef-sportspress qodef-sportspress-archive qodef-m <?php echo esc_attr ( $grid_classes ); ?>">
        <div class="qodef-grid-inner clear">
            <?php
            // include sportspress posts loop
            topscorer_core_template_part ( 'sportspress', 'templates/parts/loop', '', $params );

            // include pagination
            topscorer_template_part ( 'pagination', 'templates/pagination-wp' );
            ?>
        </div>
    </div>
</div>
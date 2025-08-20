```php
<?php
/** Template Name: Teams (Übersicht) */
get_header(); ?>
<div class="container section">
  <div class="breadcrumbs"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Start','handball-club'); ?></a> › <?php esc_html_e('Teams','handball-club'); ?></div>
  <h1><?php esc_html_e('Alle Mannschaften','handball-club'); ?></h1>

  <?php
    // Group by team category taxonomy if used; otherwise simple list.
    $terms = get_terms(['taxonomy'=>'hc_team_category','hide_empty'=>false]);
    if (!is_wp_error($terms) && $terms):
      foreach ($terms as $term):
        echo '<h2 style="margin-top:2rem">'.esc_html($term->name).'</h2>';
        $teams = new WP_Query([
          'post_type'=>'hc_team','posts_per_page'=>-1,
          'tax_query'=>[[ 'taxonomy'=>'hc_team_category','terms'=>[$term->term_id] ]],
          'orderby'=>'menu_order','order'=>'ASC'
        ]);
        echo '<div class="grid cols-3">';
        if ($teams->have_posts()): while ($teams->have_posts()): $teams->the_post();
          echo '<article class="card">';
          if (has_post_thumbnail()) the_post_thumbnail('large');
          echo '<div class="card-body">';
          echo '<a href="'.esc_url(get_permalink()).'"><h3>'.esc_html(get_the_title()).'</h3></a>';
          echo '</div></article>';
        endwhile; wp_reset_postdata(); else: echo '<p>'.esc_html__('Keine Teams in dieser Kategorie.','handball-club').'</p>'; endif;
        echo '</div>';
      endforeach;
    else:
      // Fallback without taxonomy
      $teams = new WP_Query(['post_type'=>'hc_team','posts_per_page'=>-1,'orderby'=>'menu_order','order'=>'ASC']);
      echo '<div class="grid cols-3">';
      if ($teams->have_posts()): while ($teams->have_posts()): $teams->the_post();
        echo '<article class="card">';
        if (has_post_thumbnail()) the_post_thumbnail('large');
        echo '<div class="card-body">';
        echo '<a href="'.esc_url(get_permalink()).'"><h3>'.esc_html(get_the_title()).'</h3></a>';
        echo '</div></article>';
      endwhile; wp_reset_postdata(); else: echo '<p>'.esc_html__('Keine Teams verfügbar.','handball-club').'</p>'; endif;
      echo '</div>';
    endif;
  ?>
</div>
<?php get_footer(); ?>
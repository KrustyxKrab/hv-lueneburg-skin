<?php
/** Players Overview */
get_header(); ?>
<div class="container section">
  <div class="breadcrumbs"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Start','handball-club'); ?></a> › <?php esc_html_e('Spieler','handball-club'); ?></div>
  <h1><?php esc_html_e('Spielerkader','handball-club'); ?></h1>
  <div class="grid cols-4">
    <?php if (have_posts()): while (have_posts()): the_post();
      $nr = get_post_meta(get_the_ID(),'_hc_player_jersey_number', true);
      $goals = get_post_meta(get_the_ID(),'_hc_player_goals', true);
      $games = get_post_meta(get_the_ID(),'_hc_player_games', true);
    ?>
      <article class="card">
        <a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?></a>
        <div class="card-body">
          <div class="badge">#<?php echo esc_html($nr ?: '–'); ?></div>
          <a href="<?php the_permalink(); ?>"><h2 style="margin:.25rem 0"><?php the_title(); ?></h2></a>
          <p class="muted"><?php echo esc_html(sprintf(__('Spiele: %s · Tore: %s','handball-club'), $games ?: 0, $goals ?: 0)); ?></p>
        </div>
      </article>
    <?php endwhile; else: echo '<p>'.esc_html__('Keine Spieler gefunden.','handball-club').'</p>'; endif; ?>
  </div>
</div>
<?php get_footer(); ?>
<?php
/** Teams Overview */
get_header(); ?>
<div class="container section">
  <div class="breadcrumbs"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Start','handball-club'); ?></a> › <?php esc_html_e('Teams','handball-club'); ?></div>
  <h1><?php esc_html_e('Unsere Teams','handball-club'); ?></h1>
  <div class="grid cols-3">
  <?php if (have_posts()): while (have_posts()): the_post();
    $league = get_post_meta(get_the_ID(), '_hc_team_league', true);
    $coach  = get_post_meta(get_the_ID(), '_hc_team_coach', true);
  ?>
    <article class="card">
      <a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?></a>
      <div class="card-body">
        <a href="<?php the_permalink(); ?>"><h2 style="margin:.25rem 0"><?php the_title(); ?></h2></a>
        <p class="muted"><?php echo esc_html($league); ?></p>
        <p><?php if ($coach) echo esc_html__('Trainer: ','handball-club').esc_html($coach); ?></p>
        <a class="btn" href="<?php the_permalink(); ?>"><?php esc_html_e('Zur Teamseite','handball-club'); ?></a>
      </div>
    </article>
  <?php endwhile; else: echo '<p>'.esc_html__('Keine Teams gefunden.','handball-club').'</p>'; endif; ?>
  </div>
</div>
<?php get_footer(); ?>
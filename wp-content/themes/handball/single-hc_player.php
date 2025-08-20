<?php
/** Single Player */
get_header();
$nr   = get_post_meta(get_the_ID(),'_hc_player_jersey_number', true);
$team = get_post_meta(get_the_ID(),'_hc_player_team', true);
$goals= get_post_meta(get_the_ID(),'_hc_player_goals', true);
$games= get_post_meta(get_the_ID(),'_hc_player_games', true);
?>
<div class="container section">
  <div class="breadcrumbs"><a href="<?php echo esc_url(get_post_type_archive_link('hc_player')); ?>"><?php esc_html_e('Spieler','handball-club'); ?></a> › <?php the_title(); ?></div>
  <article class="grid cols-2">
    <div>
      <?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?>
    </div>
    <div>
      <h1><?php the_title(); ?> <span class="badge">#<?php echo esc_html($nr ?: '–'); ?></span></h1>
      <?php if ($team): ?>
        <p><?php esc_html_e('Team:','handball-club'); ?> <a href="<?php echo esc_url(get_permalink($team)); ?>"><?php echo esc_html(get_the_title($team)); ?></a></p>
      <?php endif; ?>
      <p><?php echo esc_html(sprintf(__('Spiele: %s · Tore: %s','handball-club'), $games ?: 0, $goals ?: 0)); ?></p>
      <div><?php the_content(); ?></div>
    </div>
  </article>
</div>
<?php get_footer(); ?>
```php
<?php
/** Single Match */
get_header();
$team_id = get_post_meta(get_the_ID(),'_hc_match_team',true);
$opp  = get_post_meta(get_the_ID(),'_hc_match_opponent',true);
$date = get_post_meta(get_the_ID(),'_hc_match_date',true);
$st   = get_post_meta(get_the_ID(),'_hc_match_status',true);
$hs   = get_post_meta(get_the_ID(),'_hc_match_home_score',true);
$as   = get_post_meta(get_the_ID(),'_hc_match_away_score',true);
?>
<div class="container section">
  <div class="breadcrumbs"><a href="<?php echo esc_url(get_post_type_archive_link('hc_match')); ?>"><?php esc_html_e('Spielplan','handball-club'); ?></a> › <?php the_title(); ?></div>
  <article class="card">
    <div class="card-body">
      <h1 style="margin-top:0"><?php the_title(); ?></h1>
      <p class="muted"><?php echo esc_html($date); ?> · <?php echo esc_html($st); ?></p>
      <p>
        <?php if ($team_id): ?><a class="badge" href="<?php echo esc_url(get_permalink($team_id)); ?>"><?php echo esc_html(get_the_title($team_id)); ?></a><?php endif; ?>
        <span style="margin:0 .5rem">vs.</span>
        <strong><?php echo esc_html($opp); ?></strong>
      </p>
      <div class="live-ticker" id="ticker-<?php echo esc_attr(get_the_ID()); ?>" data-live-ticker="<?php echo esc_attr(get_the_ID()); ?>">
        <?php echo esc_html($hs).' : '.esc_html($as); ?>
      </div>
      <div><?php the_content(); ?></div>
    </div>
  </article>
</div>
<?php get_footer(); ?>
<?php
/** Single Team */
get_header();
$team_id = get_the_ID();
$color   = get_post_meta($team_id,'_hc_team_color', true);
$league  = get_post_meta($team_id,'_hc_team_league', true);
$coach   = get_post_meta($team_id,'_hc_team_coach', true);
$times   = get_post_meta($team_id,'_hc_team_training_times', true);
?>
<div class="section" style="<?php if ($color) echo '--brand:'.esc_attr($color).';'; ?>">
  <div class="container">
    <div class="breadcrumbs"><a href="<?php echo esc_url(get_post_type_archive_link('hc_team')); ?>"><?php esc_html_e('Teams','handball-club'); ?></a> › <?php the_title(); ?></div>
    <header style="display:flex;gap:2rem;align-items:flex-start;flex-wrap:wrap;">
      <div style="flex:1 1 320px">
        <h1><?php the_title(); ?></h1>
        <p class="muted"><?php echo esc_html($league); ?></p>
        <p><?php if ($coach) echo esc_html__('Trainer: ','handball-club').esc_html($coach); ?></p>
        <?php if ($times): ?><div class="widget"><h3><?php esc_html_e('Trainingszeiten','handball-club'); ?></h3><p><?php echo nl2br(esc_html($times)); ?></p></div><?php endif; ?>
      </div>
      <div style="flex:1 1 320px">
        <?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?>
      </div>
    </header>

    <section class="section">
      <h2><?php esc_html_e('Kader','handball-club'); ?></h2>
      <div class="grid cols-3">
        <?php
          $players = new WP_Query([
            'post_type'      => 'hc_player',
            'posts_per_page' => -1,
            'meta_query'     => [[
              'key'   => '_hc_player_team',
              'value' => $team_id,
            ]],
            'orderby'        => 'meta_value_num',
            'meta_key'       => '_hc_player_jersey_number',
            'order'          => 'ASC',
          ]);
          if ($players->have_posts()):
            while ($players->have_posts()): $players->the_post();
              $nr   = get_post_meta(get_the_ID(),'_hc_player_jersey_number', true);
              $goals= get_post_meta(get_the_ID(),'_hc_player_goals', true);
              $games= get_post_meta(get_the_ID(),'_hc_player_games', true);
        ?>
          <article class="card">
            <a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?></a>
            <div class="card-body">
              <div class="badge">#<?php echo esc_html($nr ?: '–'); ?></div>
              <a href="<?php the_permalink(); ?>"><h3 style="margin:.25rem 0"><?php the_title(); ?></h3></a>
              <p class="muted"><?php echo esc_html(sprintf(__('Spiele: %s · Tore: %s','handball-club'), $games ?: 0, $goals ?: 0)); ?></p>
            </div>
          </article>
        <?php
            endwhile; wp_reset_postdata();
          else:
            echo '<p>'.esc_html__('Noch keine Spieler gepflegt.','handball-club').'</p>';
          endif;
        ?>
      </div>
    </section>

    <section class="section">
      <h2><?php esc_html_e('Spielplan','handball-club'); ?></h2>
      <div class="widget">
        <table class="table">
          <thead><tr><th><?php esc_html_e('Datum','handball-club'); ?></th><th><?php esc_html_e('Gegner','handball-club'); ?></th><th><?php esc_html_e('Status','handball-club'); ?></th><th><?php esc_html_e('Ergebnis','handball-club'); ?></th></tr></thead>
          <tbody>
          <?php
            $matches = new WP_Query([
              'post_type'      => 'hc_match',
              'posts_per_page' => 10,
              'meta_query'     => [[ 'key'=>'_hc_match_team','value'=>$team_id ]],
              'orderby'        => 'meta_value',
              'meta_key'       => '_hc_match_date',
              'order'          => 'DESC',
            ]);
            if ($matches->have_posts()):
              while ($matches->have_posts()): $matches->the_post();
                $date = get_post_meta(get_the_ID(),'_hc_match_date',true);
                $opp  = get_post_meta(get_the_ID(),'_hc_match_opponent',true);
                $st   = get_post_meta(get_the_ID(),'_hc_match_status',true);
                $hs   = get_post_meta(get_the_ID(),'_hc_match_home_score',true);
                $as   = get_post_meta(get_the_ID(),'_hc_match_away_score',true);
                echo '<tr><td>'.esc_html($date).'</td><td>'.esc_html($opp).'</td><td>'.esc_html($st).'</td><td>'.esc_html($hs).' : '.esc_html($as).'</td></tr>';
              endwhile; wp_reset_postdata();
            else:
              echo '<tr><td colspan="4">'.esc_html__('Kein Spielplan vorhanden.','handball-club').'</td></tr>';
            endif;
          ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
<?php get_footer(); ?>
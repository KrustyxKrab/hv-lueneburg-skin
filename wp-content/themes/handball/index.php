<?php
/**
 * Homepage Template (fallback index)
 * @package handball-club
 */
get_header();
?>
<section class="hero">
  <div class="container">
    <h1><?php echo esc_html(get_theme_mod('hc_hero_title', get_bloginfo('name'))); ?></h1>
    <p><?php echo esc_html(get_theme_mod('hc_hero_subtitle', __('Handball für alle: Herren, Damen & Jugend – Spielpläne, Ergebnisse, News.', 'handball-club'))); ?></p>
  </div>
</section>

<section class="section">
  <div class="container grid cols-3">
    <div class="widget">
      <h3><?php esc_html_e('Live-Spiele','handball-club'); ?></h3>
      <div id="hc-live-matches">
        <?php
          $live = new WP_Query([
            'post_type'      => 'hc_match',
            'posts_per_page' => 5,
            'meta_query'     => [[
              'key'     => '_hc_match_status',
              'value'   => 'live',
              'compare' => '=',
            ]],
            'orderby'        => 'meta_value',
            'meta_key'       => '_hc_match_date',
            'order'          => 'ASC',
          ]);
          if ($live->have_posts()):
            while ($live->have_posts()): $live->the_post();
              $team_id   = get_post_meta(get_the_ID(), '_hc_match_team', true);
              $opponent  = get_post_meta(get_the_ID(), '_hc_match_opponent', true);
              $home_score= get_post_meta(get_the_ID(), '_hc_match_home_score', true);
              $away_score= get_post_meta(get_the_ID(), '_hc_match_away_score', true);
              echo '<div class="card" data-live-ticker="'.esc_attr(get_the_ID()).'">';
              echo '<div class="card-body">';
              echo '<strong>'.esc_html(get_the_title()).'</strong><br />';
              if ($team_id) echo '<span class="badge">'.esc_html(get_the_title($team_id)).'</span> ';
              echo esc_html($opponent ? 'vs. '.$opponent : '');
              echo '<div class="live-ticker" id="ticker-'.esc_attr(get_the_ID()).'">'.esc_html($home_score).' : '.esc_html($away_score).'</div>';
              echo '<a class="btn" href="'.esc_url(get_permalink()).'">'.esc_html__('Zum Live-Ticker','handball-club').'</a>';
              echo '</div></div>';
            endwhile; wp_reset_postdata();
          else:
            echo '<p>'.esc_html__('Aktuell keine Live-Spiele.', 'handball-club').'</p>';
          endif;
        ?>
      </div>
    </div>
    <div class="widget">
      <h3><?php esc_html_e('Nächste Spiele','handball-club'); ?></h3>
      <?php
        $now = current_time('Y-m-d H:i');
        $next = new WP_Query([
          'post_type'      => 'hc_match',
          'posts_per_page' => 6,
          'meta_query'     => [[
            'key'     => '_hc_match_date',
            'value'   => $now,
            'compare' => '>=',
            'type'    => 'CHAR',
          ]],
          'orderby'        => 'meta_value',
          'meta_key'       => '_hc_match_date',
          'order'          => 'ASC',
        ]);
        if ($next->have_posts()):
          echo '<ul class="list">';
          while ($next->have_posts()): $next->the_post();
            $date = get_post_meta(get_the_ID(), '_hc_match_date', true);
            $team_id = get_post_meta(get_the_ID(), '_hc_match_team', true);
            echo '<li style="margin-bottom:.6rem">';
            echo '<a href="'.esc_url(get_permalink()).'"><strong>'.esc_html(get_the_title()).'</strong></a><br />';
            echo '<span class="badge">'.esc_html($date).'</span> ';
            if ($team_id) echo '<span class="badge">'.esc_html(get_the_title($team_id)).'</span>';
            echo '</li>';
          endwhile; echo '</ul>'; wp_reset_postdata();
        else:
          echo '<p>'.esc_html__('Keine anstehenden Spiele gefunden.','handball-club').'</p>';
        endif;
      ?>
    </div>
    <div class="widget">
      <h3><?php esc_html_e('Tabellen – Hauptteams','handball-club'); ?></h3>
      <p class="muted"><?php esc_html_e('Liga-Tabellen werden hier eingebunden (API/Shortcode).','handball-club'); ?></p>
      <?php if (function_exists('hc_render_league_tables')) { hc_render_league_tables(['teams'=>['Herren 1','Damen']]); } ?>
    </div>
  </div>
</section>

<section class="section" aria-labelledby="news-title">
  <div class="container">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
      <h2 id="news-title"><?php esc_html_e('News & Berichte','handball-club'); ?></h2>
      <div>
        <label for="news-team-filter" class="screen-reader-text"><?php esc_html_e('Team filtern','handball-club'); ?></label>
        <select id="news-team-filter" data-ajax="hc_filter_news">
          <option value="">— <?php esc_html_e('Alle Teams','handball-club'); ?> —</option>
          <?php
            $teams = new WP_Query(['post_type'=>'hc_team','posts_per_page'=>-1,'orderby'=>'menu_order','order'=>'ASC']);
            while ($teams->have_posts()): $teams->the_post();
              echo '<option value="'.esc_attr(get_the_ID()).'">'.esc_html(get_the_title()).'</option>';
            endwhile; wp_reset_postdata();
          ?>
        </select>
      </div>
    </div>
    <div id="news-feed" class="grid cols-3" data-endpoint="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
      <?php
        // Default: latest posts (could be mapped via taxonomy hc_news_team inside your functions.php)
        $news = new WP_Query(['post_type'=>'post','posts_per_page'=>6]);
        if ($news->have_posts()):
          while ($news->have_posts()): $news->the_post();
            echo '<article class="card">';
            if (has_post_thumbnail()) echo get_the_post_thumbnail(null,'large');
            echo '<div class="card-body">';
            echo '<a href="'.esc_url(get_permalink()).'"><h3 style="margin:.25rem 0">'.esc_html(get_the_title()).'</h3></a>';
            echo '<p style="color:var(--muted);font-size:.95rem">'.esc_html(get_the_date()).'</p>';
            echo '<p>'.esc_html(wp_trim_words(get_the_excerpt(), 20)).'</p>';
            echo '</div></article>';
          endwhile; wp_reset_postdata();
        else:
          echo '<p>'.esc_html__('Noch keine News.','handball-club').'</p>';
        endif;
      ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
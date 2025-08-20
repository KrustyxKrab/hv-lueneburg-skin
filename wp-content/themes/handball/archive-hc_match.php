<?php
/** Matches (Schedule & Results) */
get_header();
$selected_team = isset($_GET['team']) ? intval($_GET['team']) : 0;
$selected_status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
?>
<div class="container section">
  <div class="breadcrumbs"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Start','handball-club'); ?></a> › <?php esc_html_e('Spielplan & Ergebnisse','handball-club'); ?></div>
  <h1><?php esc_html_e('Spielplan & Ergebnisse','handball-club'); ?></h1>

  <form method="get" class="card" style="padding:1rem;margin-bottom:1rem;display:flex;gap:1rem;flex-wrap:wrap;align-items:end;">
    <div>
      <label for="team"><?php esc_html_e('Team','handball-club'); ?></label><br />
      <select id="team" name="team">
        <option value="">— <?php esc_html_e('Alle','handball-club'); ?> —</option>
        <?php
          $teams = get_posts(['post_type'=>'hc_team','numberposts'=>-1,'orderby'=>'title','order'=>'ASC']);
          foreach ($teams as $t) {
            printf('<option value="%1$d" %2$s>%3$s</option>', $t->ID, selected($selected_team,$t->ID,false), esc_html($t->post_title));
          }
        ?>
      </select>
    </div>
    <div>
      <label for="status"><?php esc_html_e('Status','handball-club'); ?></label><br />
      <select id="status" name="status">
        <option value="">— <?php esc_html_e('Alle','handball-club'); ?> —</option>
        <?php foreach (['scheduled','live','finished'] as $st) {
          printf('<option value="%1$s" %2$s>%1$s</option>', esc_attr($st), selected($selected_status,$st,false));
        } ?>
      </select>
    </div>
    <div>
      <button class="btn" type="submit"><?php esc_html_e('Filtern','handball-club'); ?></button>
    </div>
  </form>

  <div class="widget">
    <table class="table">
      <thead><tr><th><?php esc_html_e('Datum','handball-club'); ?></th><th><?php esc_html_e('Team','handball-club'); ?></th><th><?php esc_html_e('Gegner','handball-club'); ?></th><th><?php esc_html_e('Status','handball-club'); ?></th><th><?php esc_html_e('Ergebnis','handball-club'); ?></th></tr></thead>
      <tbody>
      <?php
        $args = [
          'post_type'      => 'hc_match',
          'posts_per_page' => 20,
          'orderby'        => 'meta_value',
          'meta_key'       => '_hc_match_date',
          'order'          => 'DESC',
        ];
        $meta_query = [];
        if ($selected_team) $meta_query[] = ['key'=>'_hc_match_team','value'=>$selected_team];
        if ($selected_status) $meta_query[] = ['key'=>'_hc_match_status','value'=>$selected_status];
        if ($meta_query) $args['meta_query'] = $meta_query;
        $q = new WP_Query($args);
        if ($q->have_posts()):
          while ($q->have_posts()): $q->the_post();
            $date = get_post_meta(get_the_ID(),'_hc_match_date',true);
            $team_id = get_post_meta(get_the_ID(),'_hc_match_team',true);
            $opp  = get_post_meta(get_the_ID(),'_hc_match_opponent',true);
            $st   = get_post_meta(get_the_ID(),'_hc_match_status',true);
            $hs   = get_post_meta(get_the_ID(),'_hc_match_home_score',true);
            $as   = get_post_meta(get_the_ID(),'_hc_match_away_score',true);
            echo '<tr>';
            echo '<td>'.esc_html($date).'</td>';
            echo '<td>'.($team_id?'<a href="'.esc_url(get_permalink($team_id)).'">'.esc_html(get_the_title($team_id)).'</a>':'').'</td>';
            echo '<td>'.esc_html($opp).'</td>';
            echo '<td>'.esc_html($st).'</td>';
            echo '<td>'.esc_html($hs).' : '.esc_html($as).'</td>';
            echo '</tr>';
          endwhile; wp_reset_postdata();
        else:
          echo '<tr><td colspan="5">'.esc_html__('Keine Spiele gefunden.','handball-club').'</td></tr>';
        endif;
      ?>
      </tbody>
    </table>
  </div>
</div>
<?php get_footer(); ?>
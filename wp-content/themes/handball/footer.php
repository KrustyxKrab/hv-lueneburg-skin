<?php
/**
 * Theme Footer
 * @package handball-club
 */
?>
</main>
<footer class="site-footer" role="contentinfo">
  <div class="container">
    <div class="grid cols-3">
      <div>
        <h4><?php esc_html_e('About the Club','handball-club'); ?></h4>
        <p><?php echo esc_html(get_theme_mod('hc_footer_about', __('Wir sind ein Handball-Verein mit Teams von Minis bis Herren/Damen.', 'handball-club'))); ?></p>
      </div>
      <div>
        <h4><?php esc_html_e('Quick Links','handball-club'); ?></h4>
        <?php
          wp_nav_menu([
            'theme_location' => 'footer',
            'container'      => false,
            'menu_class'     => 'menu',
            'fallback_cb'    => '__return_empty_string',
          ]);
        ?>
      </div>
      <div>
        <h4><?php esc_html_e('Our Sponsors','handball-club'); ?></h4>
        <div class="sponsors">
          <?php
            // Basic sponsor strip (first 8 sponsors)
            $sponsors = new WP_Query([
              'post_type'      => 'hc_sponsor',
              'posts_per_page' => 8,
              'orderby'        => 'menu_order',
              'order'          => 'ASC',
            ]);
            if ($sponsors->have_posts()):
              while ($sponsors->have_posts()): $sponsors->the_post();
                $logo = get_the_post_thumbnail_url(get_the_ID(),'medium');
                if ($logo):
                  echo '<img src="'.esc_url($logo).'" alt="'.esc_attr(get_the_title()).'" loading="lazy" />';
                else:
                  echo '<span class="badge">'.esc_html(get_the_title()).'</span>';
                endif;
              endwhile; wp_reset_postdata();
            else:
              echo '<p class="muted">'.esc_html__('Sponsoren folgen.', 'handball-club').'</p>';
            endif;
          ?>
        </div>
      </div>
    </div>
    <div style="margin-top:1rem;font-size:.85rem;color:var(--muted)">
      &copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?> · <?php esc_html_e('All rights reserved.','handball-club'); ?>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
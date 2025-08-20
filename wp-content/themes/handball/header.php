<?php
/**
 * Theme Header
 * @package handball-club
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>
<body <?php body_class('team-theme'); ?>>
<a class="screen-reader-text" href="#content"><?php esc_html_e('Skip to content','handball-club'); ?></a>
<header class="header">
  <div class="container" style="display:flex;align-items:center;justify-content:space-between;gap:1rem;">
    <div class="branding" style="display:flex;align-items:center;gap:.75rem;">
      <?php if (has_custom_logo()) { the_custom_logo(); } ?>
      <div>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title" style="font-weight:700;font-size:1.2rem;">
          <?php bloginfo('name'); ?>
        </a>
        <div class="site-tagline" style="font-size:.9rem;color:var(--muted)"><?php bloginfo('description'); ?></div>
      </div>
    </div>
    <nav class="nav" aria-label="Primary">
      <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'menu',
          'fallback_cb'    => '__return_empty_string',
          'link_before'    => '<span>',
          'link_after'     => '</span>',
        ]);
      ?>
    </nav>
  </div>
</header>
<main id="content">
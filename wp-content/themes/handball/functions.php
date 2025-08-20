<?php
/**
 * Handball Club WordPress Theme
 * Professional multi-team handball club template
 * 
 * Theme Name: Handball Club Pro
 * Description: Professional WordPress theme for handball clubs with multi-team support
 * Version: 1.0.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup and Configuration
 */
class HandballClubTheme {
    
    public function __construct() {
        add_action('after_setup_theme', array($this, 'theme_setup'));
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('widgets_init', array($this, 'register_sidebars'));
        add_action('admin_menu', array($this, 'add_admin_pages'));
        
        // AJAX Actions
        add_action('wp_ajax_load_team_fixtures', array($this, 'load_team_fixtures'));
        add_action('wp_ajax_nopriv_load_team_fixtures', array($this, 'load_team_fixtures'));
        add_action('wp_ajax_load_team_news', array($this, 'load_team_news'));
        add_action('wp_ajax_nopriv_load_team_news', array($this, 'load_team_news'));
        
        // Custom Fields
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_boxes'));
    }
    
    /**
     * Theme Setup
     */
    public function theme_setup() {
        // Theme support
        add_theme_support('post-thumbnails');
        add_theme_support('custom-logo');
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
        add_theme_support('customize-selective-refresh-widgets');
        
        // Image sizes
        add_image_size('player-portrait', 300, 400, true);
        add_image_size('team-hero', 1200, 600, true);
        add_image_size('news-thumbnail', 400, 250, true);
        add_image_size('sponsor-logo', 200, 100, true);
        
        // Navigation menus
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'handball-club'),
            'footer' => __('Footer Menu', 'handball-club'),
            'teams' => __('Teams Menu', 'handball-club')
        ));
    }
    
    /**
     * Register Custom Post Types
     */
    public function register_post_types() {
        
        // Teams Post Type
        register_post_type('hc_team', array(
            'labels' => array(
                'name' => __('Teams', 'handball-club'),
                'singular_name' => __('Team', 'handball-club'),
                'add_new' => __('Add New Team', 'handball-club'),
                'add_new_item' => __('Add New Team', 'handball-club'),
                'edit_item' => __('Edit Team', 'handball-club'),
                'new_item' => __('New Team', 'handball-club'),
                'view_item' => __('View Team', 'handball-club'),
                'search_items' => __('Search Teams', 'handball-club'),
                'not_found' => __('No teams found', 'handball-club'),
                'not_found_in_trash' => __('No teams found in trash', 'handball-club')
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'teams'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-groups',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'show_in_rest' => true
        ));
        
        // Players Post Type
        register_post_type('hc_player', array(
            'labels' => array(
                'name' => __('Players', 'handball-club'),
                'singular_name' => __('Player', 'handball-club'),
                'add_new' => __('Add New Player', 'handball-club'),
                'add_new_item' => __('Add New Player', 'handball-club'),
                'edit_item' => __('Edit Player', 'handball-club'),
                'new_item' => __('New Player', 'handball-club'),
                'view_item' => __('View Player', 'handball-club'),
                'search_items' => __('Search Players', 'handball-club'),
                'not_found' => __('No players found', 'handball-club'),
                'not_found_in_trash' => __('No players found in trash', 'handball-club')
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'players'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-admin-users',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'show_in_rest' => true
        ));
        
        // Matches Post Type
        register_post_type('hc_match', array(
            'labels' => array(
                'name' => __('Matches', 'handball-club'),
                'singular_name' => __('Match', 'handball-club'),
                'add_new' => __('Add New Match', 'handball-club'),
                'add_new_item' => __('Add New Match', 'handball-club'),
                'edit_item' => __('Edit Match', 'handball-club'),
                'new_item' => __('New Match', 'handball-club'),
                'view_item' => __('View Match', 'handball-club'),
                'search_items' => __('Search Matches', 'handball-club'),
                'not_found' => __('No matches found', 'handball-club'),
                'not_found_in_trash' => __('No matches found in trash', 'handball-club')
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'matches'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 7,
            'menu_icon' => 'dashicons-calendar-alt',
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'show_in_rest' => true
        ));
        
        // Sponsors Post Type
        register_post_type('hc_sponsor', array(
            'labels' => array(
                'name' => __('Sponsors', 'handball-club'),
                'singular_name' => __('Sponsor', 'handball-club'),
                'add_new' => __('Add New Sponsor', 'handball-club'),
                'add_new_item' => __('Add New Sponsor', 'handball-club'),
                'edit_item' => __('Edit Sponsor', 'handball-club'),
                'new_item' => __('New Sponsor', 'handball-club'),
                'view_item' => __('View Sponsor', 'handball-club'),
                'search_items' => __('Search Sponsors', 'handball-club'),
                'not_found' => __('No sponsors found', 'handball-club'),
                'not_found_in_trash' => __('No sponsors found in trash', 'handball-club')
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'sponsors'),
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => 8,
            'menu_icon' => 'dashicons-businessman',
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'show_in_rest' => true
        ));
    }

    /**
     * Register Taxonomies
     */
    public function register_taxonomies() {
        
        // Team Categories (Age Groups)
        register_taxonomy('hc_team_category', 'hc_team', array(
            'labels' => array(
                'name' => __('Team Categories', 'handball-club'),
                'singular_name' => __('Team Category', 'handball-club'),
                'search_items' => __('Search Team Categories', 'handball-club'),
                'all_items' => __('All Team Categories', 'handball-club'),
                'parent_item' => __('Parent Category', 'handball-club'),
                'parent_item_colon' => __('Parent Category:', 'handball-club'),
                'edit_item' => __('Edit Team Category', 'handball-club'),
                'update_item' => __('Update Team Category', 'handball-club'),
                'add_new_item' => __('Add New Team Category', 'handball-club'),
                'new_item_name' => __('New Team Category Name', 'handball-club'),
                'menu_name' => __('Team Categories', 'handball-club')
            ),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => false,
            'rewrite' => array('slug' => 'team-category'),
            'show_in_rest' => true
        ));
        
        // Player Positions
        register_taxonomy('hc_player_position', 'hc_player', array(
            'labels' => array(
                'name' => __('Player Positions', 'handball-club'),
                'singular_name' => __('Position', 'handball-club'),
                'search_items' => __('Search Positions', 'handball-club'),
                'all_items' => __('All Positions', 'handball-club'),
                'edit_item' => __('Edit Position', 'handball-club'),
                'update_item' => __('Update Position', 'handball-club'),
                'add_new_item' => __('Add New Position', 'handball-club'),
                'new_item_name' => __('New Position Name', 'handball-club'),
                'menu_name' => __('Positions', 'handball-club')
            ),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => false,
            'show_tagcloud' => false,
            'rewrite' => array('slug' => 'position'),
            'show_in_rest' => true
        ));
        
        // News Categories with Team Assignment
        register_taxonomy('hc_news_team', 'post', array(
            'labels' => array(
                'name' => __('Team News', 'handball-club'),
                'singular_name' => __('Team', 'handball-club'),
                'search_items' => __('Search Teams', 'handball-club'),
                'all_items' => __('All Teams', 'handball-club'),
                'edit_item' => __('Edit Team', 'handball-club'),
                'update_item' => __('Update Team', 'handball-club'),
                'add_new_item' => __('Add New Team', 'handball-club'),
                'new_item_name' => __('New Team Name', 'handball-club'),
                'menu_name' => __('News Teams', 'handball-club')
            ),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => false,
            'rewrite' => array('slug' => 'team-news'),
            'show_in_rest' => true
        ));
    }
    
    /**
     * Enqueue Scripts and Styles
     */
    public function enqueue_scripts() {

    // 0) Vendor zuerst (damit DEIN CSS zuletzt dominiert)
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        [],
        '5.3.0'
    );

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        [],
        '6.4.0'
    );

    // 1) Theme-Haupt-CSS (style.css) mit Cache-Busting
    wp_enqueue_style(
        'handball-club-style',
        get_stylesheet_uri(),
        ['bootstrap', 'font-awesome'],
        file_exists(get_stylesheet_directory() . '/style.css') ? filemtime(get_stylesheet_directory() . '/style.css') : '1.0.0'
    );

    // 2) Optionales Custom CSS – NACH style.css laden
    $custom = get_template_directory() . '/assets/css/custom.css';
    if (file_exists($custom)) {
        wp_enqueue_style(
            'handball-club-custom',
            get_template_directory_uri() . '/assets/css/custom.css',
            ['handball-club-style'],
            filemtime($custom)
        );
    }

    // JS
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.0',
        true
    );

    $main_js = get_template_directory() . '/assets/js/main.js';
    wp_enqueue_script(
        'handball-club-main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['jquery'],
        file_exists($main_js) ? filemtime($main_js) : '1.0.0',
        true
    );

    wp_localize_script('handball-club-main', 'hc_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('hc_nonce')
    ]);

    // Handball.net Widgets – Script einmalig laden (async)
wp_enqueue_script(
  'handball-net-widgets',
  'https://www.handball.net/widgets/widget.js',
  [],
  null,
  true
);
}

/**
 * [hb_widget type="spielplan" club="nuliga.hvn.681"]
 * [hb_widget type="spielplan" team="nuliga.hvn.1410770"]
 * [hb_widget type="tabelle"  tournament="nuliga.hvn.155358"]
 */
add_shortcode('hb_widget', function($atts){
    $a = shortcode_atts([
        'type' => 'spielplan',  // spielplan|tabelle|ergebnisse|tagesuebersicht (abhängig von handball.net)
        'club' => '',
        'team' => '',
        'tournament' => '',
        'height' => '',         // optional feste Höhe
        'class' => '',          // optionale CSS-Klasse
    ], $atts, 'hb_widget');

    // Eindeutige Container-ID
    $id = 'hbw_' . wp_generate_uuid4();

    // Container
    $style = $a['height'] ? 'style="min-height:'.esc_attr($a['height']).';"' : '';
    $out  = '<div id="'.esc_attr($id).'" class="hb-widget '.esc_attr($a['class']).'" '.$style.'></div>';

    // Parameter-Aufbau
    $params = [
        "widget"   => $a['type'],
        "container"=> $id,
    ];
    if ($a['club'])       $params['clubId']       = $a['club'];
    if ($a['team'])       $params['teamId']       = $a['team'];
    if ($a['tournament']) $params['tournamentId'] = $a['tournament'];

    // JS-Init
    $out .= '<script>(function(){ if (typeof _hb !== "function") { console.warn("handball.net widget.js not loaded"); return; } _hb('
          . wp_json_encode($params)
          . '); })();</script>';

    return $out;
});
    
    /**
     * Register Sidebars
     */
    public function register_sidebars() {
        register_sidebar(array(
            'name' => __('Main Sidebar', 'handball-club'),
            'id' => 'sidebar-main',
            'description' => __('Main sidebar for blog and pages', 'handball-club'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));
        
        register_sidebar(array(
            'name' => __('Footer Sidebar 1', 'handball-club'),
            'id' => 'footer-1',
            'description' => __('Footer area 1', 'handball-club'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>'
        ));
        
        register_sidebar(array(
            'name' => __('Footer Sidebar 2', 'handball-club'),
            'id' => 'footer-2',
            'description' => __('Footer area 2', 'handball-club'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>'
        ));
        
        register_sidebar(array(
            'name' => __('Footer Sidebar 3', 'handball-club'),
            'id' => 'footer-3',
            'description' => __('Footer area 3', 'handball-club'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>'
        ));
    }
    
    /**
     * Add Meta Boxes
     */
    public function add_meta_boxes() {
        // Team Meta Box
        add_meta_box(
            'hc_team_meta',
            __('Team Information', 'handball-club'),
            array($this, 'team_meta_box_callback'),
            'hc_team',
            'normal',
            'high'
        );
        
        // Player Meta Box
        add_meta_box(
            'hc_player_meta',
            __('Player Information', 'handball-club'),
            array($this, 'player_meta_box_callback'),
            'hc_player',
            'normal',
            'high'
        );
        
        // Match Meta Box
        add_meta_box(
            'hc_match_meta',
            __('Match Information', 'handball-club'),
            array($this, 'match_meta_box_callback'),
            'hc_match',
            'normal',
            'high'
        );
        
        // Sponsor Meta Box
        add_meta_box(
            'hc_sponsor_meta',
            __('Sponsor Information', 'handball-club'),
            array($this, 'sponsor_meta_box_callback'),
            'hc_sponsor',
            'normal',
            'high'
        );
    }
    
    /**
     * Team Meta Box Callback
     */
    public function team_meta_box_callback($post) {
        wp_nonce_field('hc_team_meta_nonce', 'hc_team_meta_nonce');
        
        $league = get_post_meta($post->ID, '_hc_team_league', true);
        $coach = get_post_meta($post->ID, '_hc_team_coach', true);
        $training_times = get_post_meta($post->ID, '_hc_team_training_times', true);
        $contact_email = get_post_meta($post->ID, '_hc_team_contact_email', true);
        $team_color = get_post_meta($post->ID, '_hc_team_color', true);
        $founded_year = get_post_meta($post->ID, '_hc_team_founded_year', true);
        ?>
        <table class="form-table">
            <tr>
                <th><label for="hc_team_league"><?php _e('League', 'handball-club'); ?></label></th>
                <td><input type="text" id="hc_team_league" name="hc_team_league" value="<?php echo esc_attr($league); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="hc_team_coach"><?php _e('Coach', 'handball-club'); ?></label></th>
                <td><input type="text" id="hc_team_coach" name="hc_team_coach" value="<?php echo esc_attr($coach); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="hc_team_training_times"><?php _e('Training Times', 'handball-club'); ?></label></th>
                <td><textarea id="hc_team_training_times" name="hc_team_training_times" rows="3" class="large-text"><?php echo esc_textarea($training_times); ?></textarea></td>
            </tr>
            <tr>
                <th><label for="hc_team_contact_email"><?php _e('Contact Email', 'handball-club'); ?></label></th>
                <td><input type="email" id="hc_team_contact_email" name="hc_team_contact_email" value="<?php echo esc_attr($contact_email); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="hc_team_color"><?php _e('Team Color', 'handball-club'); ?></label></th>
                <td><input type="color" id="hc_team_color" name="hc_team_color" value="<?php echo esc_attr($team_color ?: '#ff6b35'); ?>" /></td>
            </tr>
            <tr>
                <th><label for="hc_team_founded_year"><?php _e('Founded Year', 'handball-club'); ?></label></th>
                <td><input type="number" id="hc_team_founded_year" name="hc_team_founded_year" value="<?php echo esc_attr($founded_year); ?>" min="1900" max="<?php echo date('Y'); ?>" /></td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * Player Meta Box Callback
     */
    public function player_meta_box_callback($post) {
        wp_nonce_field('hc_player_meta_nonce', 'hc_player_meta_nonce');
        
        $jersey_number = get_post_meta($post->ID, '_hc_player_jersey_number', true);
        $team_id = get_post_meta($post->ID, '_hc_player_team', true);
        $birth_date = get_post_meta($post->ID, '_hc_player_birth_date', true);
        $height = get_post_meta($post->ID, '_hc_player_height', true);
        $weight = get_post_meta($post->ID, '_hc_player_weight', true);
        $goals = get_post_meta($post->ID, '_hc_player_goals', true);
        $games = get_post_meta($post->ID, '_hc_player_games', true);
        $assists = get_post_meta($post->ID, '_hc_player_assists', true);
        
        $teams = get_posts(array('post_type' => 'hc_team', 'numberposts' => -1));
        ?>
        <table class="form-table">
            <tr>
                <th><label for="hc_player_jersey_number"><?php _e('Jersey Number', 'handball-club'); ?></label></th>
                <td><input type="number" id="hc_player_jersey_number" name="hc_player_jersey_number" value="<?php echo esc_attr($jersey_number); ?>" min="1" max="99" /></td>
            </tr>
            <tr>
                <th><label for="hc_player_team"><?php _e('Team', 'handball-club'); ?></label></th>
                <td>
                    <select id="hc_player_team" name="hc_player_team">
                        <option value=""><?php _e('Select Team', 'handball-club'); ?></option>
                        <?php foreach($teams as $team): ?>
                            <option value="<?php echo $team->ID; ?>" <?php selected($team_id, $team->ID); ?>><?php echo $team->post_title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="hc_player_birth_date"><?php _e('Birth Date', 'handball-club'); ?></label></th>
                <td><input type="date" id="hc_player_birth_date" name="hc_player_birth_date" value="<?php echo esc_attr($birth_date); ?>" /></td>
            </tr>
            <tr>
                <th><label for="hc_player_height"><?php _e('Height (cm)', 'handball-club'); ?></label></th>
                <td><input type="number" id="hc_player_height" name="hc_player_height" value="<?php echo esc_attr($height); ?>" min="150" max="220" /></td>
            </tr>
            <tr>
                <th><label for="hc_player_weight"><?php _e('Weight (kg)', 'handball-club'); ?></label></th>
                <td><input type="number" id="hc_player_weight" name="hc_player_weight" value="<?php echo esc_attr($weight); ?>" min="50" max="150" /></td>
            </tr>
            <tr>
                <th><label for="hc_player_goals"><?php _e('Goals This Season', 'handball-club'); ?></label></th>
                <td><input type="number" id="hc_player_goals" name="hc_player_goals" value="<?php echo esc_attr($goals); ?>" min="0" /></td>
            </tr>
            <tr>
                <th><label for="hc_player_games"><?php _e('Games Played', 'handball-club'); ?></label></th>
                <td><input type="number" id="hc_player_games" name="hc_player_games" value="<?php echo esc_attr($games); ?>" min="0" /></td>
            </tr>
            <tr>
                <th><label for="hc_player_assists"><?php _e('Assists', 'handball-club'); ?></label></th>
                <td><input type="number" id="hc_player_assists" name="hc_player_assists" value="<?php echo esc_attr($assists); ?>" min="0" /></td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * Match Meta Box Callback
     */
    public function match_meta_box_callback($post) {
        wp_nonce_field('hc_match_meta_nonce', 'hc_match_meta_nonce');
        
        $team_id = get_post_meta($post->ID, '_hc_match_team', true);
        $opponent = get_post_meta($post->ID, '_hc_match_opponent', true);
        $match_date = get_post_meta($post->ID, '_hc_match_date', true);
        $match_time = get_post_meta($post->ID, '_hc_match_time', true);
        $venue = get_post_meta($post->ID, '_hc_match_venue', true);
        $is_home = get_post_meta($post->ID, '_hc_match_is_home', true);
        $home_score = get_post_meta($post->ID, '_hc_match_home_score', true);
        $away_score = get_post_meta($post->ID, '_hc_match_away_score', true);
        $status = get_post_meta($post->ID, '_hc_match_status', true);
        
        $teams = get_posts(array('post_type' => 'hc_team', 'numberposts' => -1));
        ?>
        <table class="form-table">
            <tr>
                <th><label for="hc_match_team"><?php _e('Our Team', 'handball-club'); ?></label></th>
                <td>
                    <select id="hc_match_team" name="hc_match_team">
                        <option value=""><?php _e('Select Team', 'handball-club'); ?></option>
                        <?php foreach($teams as $team): ?>
                            <option value="<?php echo $team->ID; ?>" <?php selected($team_id, $team->ID); ?>><?php echo $team->post_title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="hc_match_opponent"><?php _e('Opponent', 'handball-club'); ?></label></th>
                <td><input type="text" id="hc_match_opponent" name="hc_match_opponent" value="<?php echo esc_attr($opponent); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="hc_match_date"><?php _e('Match Date', 'handball-club'); ?></label></th>
                <td><input type="date" id="hc_match_date" name="hc_match_date" value="<?php echo esc_attr($match_date); ?>" /></td>
            </tr>
            <tr>
                <th><label for="hc_match_time"><?php _e('Match Time', 'handball-club'); ?></label></th>
                <td><input type="time" id="hc_match_time" name="hc_match_time" value="<?php echo esc_attr($match_time); ?>" /></td>
            </tr>
            <tr>
                <th><label for="hc_match_venue"><?php _e('Venue', 'handball-club'); ?></label></th>
                <td><input type="text" id="hc_match_venue" name="hc_match_venue" value="<?php echo esc_attr($venue); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="hc_match_is_home"><?php _e('Home Game', 'handball-club'); ?></label></th>
                <td><input type="checkbox" id="hc_match_is_home" name="hc_match_is_home" value="1" <?php checked($is_home, '1'); ?> /></td>
            </tr>
            <tr>
                <th><label for="hc_match_status"><?php _e('Status', 'handball-club'); ?></label></th>
                <td>
                    <select id="hc_match_status" name="hc_match_status">
                        <option value="scheduled" <?php selected($status, 'scheduled'); ?>><?php _e('Scheduled', 'handball-club'); ?></option>
                        <option value="live" <?php selected($status, 'live'); ?>><?php _e('Live', 'handball-club'); ?></option>
                        <option value="finished" <?php selected($status, 'finished'); ?>><?php _e('Finished', 'handball-club'); ?></option>
                        <option value="postponed" <?php selected($status, 'postponed'); ?>><?php _e('Postponed', 'handball-club'); ?></option>
                        <option value="cancelled" <?php selected($status, 'cancelled'); ?>><?php _e('Cancelled', 'handball-club'); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="hc_match_home_score"><?php _e('Home Score', 'handball-club'); ?></label></th>
                <td><input type="number" id="hc_match_home_score" name="hc_match_home_score" value="<?php echo esc_attr($home_score); ?>" min="0" /></td>
            </tr>
            <tr>
                <th><label for="hc_match_away_score"><?php _e('Away Score', 'handball-club'); ?></label></th>
                <td><input type="number" id="hc_match_away_score" name="hc_match_away_score" value="<?php echo esc_attr($away_score); ?>" min="0" /></td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * Sponsor Meta Box Callback
     */
    public function sponsor_meta_box_callback($post) {
        wp_nonce_field('hc_sponsor_meta_nonce', 'hc_sponsor_meta_nonce');
        
        $website = get_post_meta($post->ID, '_hc_sponsor_website', true);
        $level = get_post_meta($post->ID, '_hc_sponsor_level', true);
        $contact_person = get_post_meta($post->ID, '_hc_sponsor_contact_person', true);
        $contact_email = get_post_meta($post->ID, '_hc_sponsor_contact_email', true);
        $contract_start = get_post_meta($post->ID, '_hc_sponsor_contract_start', true);
        $contract_end = get_post_meta($post->ID, '_hc_sponsor_contract_end', true);
        ?>
        <table class="form-table">
            <tr>
                <th><label for="hc_sponsor_website"><?php _e('Website', 'handball-club'); ?></label></th>
                <td><input type="url" id="hc_sponsor_website" name="hc_sponsor_website" value="<?php echo esc_attr($website); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="hc_sponsor_level"><?php _e('Sponsorship Level', 'handball-club'); ?></label></th>
                <td>
                    <select id="hc_sponsor_level" name="hc_sponsor_level">
                        <option value="main" <?php selected($level, 'main'); ?>><?php _e('Main Sponsor', 'handball-club'); ?></option>
                        <option value="premium" <?php selected($level, 'premium'); ?>><?php _e('Premium Partner', 'handball-club'); ?></option>
                        <option value="standard" <?php selected($level, 'standard'); ?>><?php _e('Partner', 'handball-club'); ?></option>
                        <option value="supporter" <?php selected($level, 'supporter'); ?>><?php _e('Supporter', 'handball-club'); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="hc_sponsor_contact_person"><?php _e('Contact Person', 'handball-club'); ?></label></th>
                <td><input type="text" id="hc_sponsor_contact_person" name="hc_sponsor_contact_person" value="<?php echo esc_attr($contact_person); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="hc_sponsor_contact_email"><?php _e('Contact Email', 'handball-club'); ?></label></th>
                <td><input type="email" id="hc_sponsor_contact_email" name="hc_sponsor_contact_email" value="<?php echo esc_attr($contact_email); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="hc_sponsor_contract_start"><?php _e('Contract Start', 'handball-club'); ?></label></th>
                <td><input type="date" id="hc_sponsor_contract_start" name="hc_sponsor_contract_start" value="<?php echo esc_attr($contract_start); ?>" /></td>
            </tr>
            <tr>
                <th><label for="hc_sponsor_contract_end"><?php _e('Contract End', 'handball-club'); ?></label></th>
                <td><input type="date" id="hc_sponsor_contract_end" name="hc_sponsor_contract_end" value="<?php echo esc_attr($contract_end); ?>" /></td>
            </tr>
        </table>
        <?php
    }
    
    /**
     * Save Meta Boxes
     */
    public function save_meta_boxes($post_id) {
        // Check if autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        
        // Check user permissions
        if (!current_user_can('edit_post', $post_id)) return;
        
        // Save Team Meta
        if (isset($_POST['hc_team_meta_nonce']) && wp_verify_nonce($_POST['hc_team_meta_nonce'], 'hc_team_meta_nonce')) {
            $fields = array('league', 'coach', 'training_times', 'contact_email', 'color', 'founded_year');
            foreach ($fields as $field) {
                if (isset($_POST['hc_team_' . $field])) {
                    update_post_meta($post_id, '_hc_team_' . $field, sanitize_text_field($_POST['hc_team_' . $field]));
                }
            }
        }
        
        // Save Player Meta
        if (isset($_POST['hc_player_meta_nonce']) && wp_verify_nonce($_POST['hc_player_meta_nonce'], 'hc_player_meta_nonce')) {
            $fields = array('jersey_number', 'team', 'birth_date', 'height', 'weight', 'goals', 'games', 'assists');
            foreach ($fields as $field) {
                if (isset($_POST['hc_player_' . $field])) {
                    update_post_meta($post_id, '_hc_player_' . $field, sanitize_text_field($_POST['hc_player_' . $field]));
                }
            }
        }
        
        // Save Match Meta
        if (isset($_POST['hc_match_meta_nonce']) && wp_verify_nonce($_POST['hc_match_meta_nonce'], 'hc_match_meta_nonce')) {
            $fields = array('team', 'opponent', 'date', 'time', 'venue', 'status', 'home_score', 'away_score');
            foreach ($fields as $field) {
                if (isset($_POST['hc_match_' . $field])) {
                    update_post_meta($post_id, '_hc_match_' . $field, sanitize_text_field($_POST['hc_match_' . $field]));
                }
            }
            
            // Handle checkbox
            update_post_meta($post_id, '_hc_match_is_home', isset($_POST['hc_match_is_home']) ? '1' : '0');
        }
        
        // Save Sponsor Meta
        if (isset($_POST['hc_sponsor_meta_nonce']) && wp_verify_nonce($_POST['hc_sponsor_meta_nonce'], 'hc_sponsor_meta_nonce')) {
            $fields = array('website', 'level', 'contact_person', 'contact_email', 'contract_start', 'contract_end');
            foreach ($fields as $field) {
                if (isset($_POST['hc_sponsor_' . $field])) {
                    update_post_meta($post_id, '_hc_sponsor_' . $field, sanitize_text_field($_POST['hc_sponsor_' . $field]));
                }
            }
        }
    }
    
    /**
     * AJAX: Load Team Fixtures
     */
    public function load_team_fixtures() {
        check_ajax_referer('hc_nonce', 'nonce');
        
        $team_id = isset($_POST['team_id']) ? intval($_POST['team_id']) : 0;
        $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 5;
        
        $args = array(
            'post_type' => 'hc_match',
            'posts_per_page' => $limit,
            'meta_query' => array(
                array(
                    'key' => '_hc_match_team',
                    'value' => $team_id,
                    'compare' => '='
                )
            ),
            'meta_key' => '_hc_match_date',
            'orderby' => 'meta_value',
            'order' => 'ASC'
        );
        
        if ($team_id === 0) {
            // All teams
            unset($args['meta_query']);
        }
        
        $matches = get_posts($args);
        
        ob_start();
        foreach ($matches as $match) {
            $this->render_match_card($match);
        }
        $output = ob_get_clean();
        
        wp_send_json_success($output);
    }
    
    /**
     * AJAX: Load Team News
     */
    public function load_team_news() {
        check_ajax_referer('hc_nonce', 'nonce');
        
        $team_slug = isset($_POST['team_slug']) ? sanitize_text_field($_POST['team_slug']) : '';
        $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 5;
        
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $limit,
            'post_status' => 'publish'
        );
        
        if (!empty($team_slug) && $team_slug !== 'all') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'hc_news_team',
                    'field' => 'slug',
                    'terms' => $team_slug
                )
            );
        }
        
        $posts = get_posts($args);
        
        ob_start();
        foreach ($posts as $post) {
            setup_postdata($post);
            $this->render_news_card($post);
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        
        wp_send_json_success($output);
    }
    
    /**
     * Render Match Card
     */
    private function render_match_card($match) {
        $team_id = get_post_meta($match->ID, '_hc_match_team', true);
        $opponent = get_post_meta($match->ID, '_hc_match_opponent', true);
        $match_date = get_post_meta($match->ID, '_hc_match_date', true);
        $match_time = get_post_meta($match->ID, '_hc_match_time', true);
        $venue = get_post_meta($match->ID, '_hc_match_venue', true);
        $is_home = get_post_meta($match->ID, '_hc_match_is_home', true);
        $home_score = get_post_meta($match->ID, '_hc_match_home_score', true);
        $away_score = get_post_meta($match->ID, '_hc_match_away_score', true);
        $status = get_post_meta($match->ID, '_hc_match_status', true);
        
        $team = get_post($team_id);
        $team_name = $team ? $team->post_title : '';
        $team_color = get_post_meta($team_id, '_hc_team_color', true);
        
        $formatted_date = $match_date ? date('d.m.Y', strtotime($match_date)) : '';
        $formatted_time = $match_time ? date('H:i', strtotime($match_time)) : '';
        ?>
        <div class="match-card" data-match-id="<?php echo $match->ID; ?>" style="border-left: 4px solid <?php echo esc_attr($team_color ?: '#ff6b35'); ?>">
            <div class="match-header">
                <div class="match-teams">
                    <?php if ($is_home): ?>
                        <span class="home-team"><?php echo esc_html($team_name); ?></span>
                        <span class="vs">vs</span>
                        <span class="away-team"><?php echo esc_html($opponent); ?></span>
                    <?php else: ?>
                        <span class="away-team"><?php echo esc_html($opponent); ?></span>
                        <span class="vs">vs</span>
                        <span class="home-team"><?php echo esc_html($team_name); ?></span>
                    <?php endif; ?>
                </div>
                <div class="match-status status-<?php echo esc_attr($status); ?>">
                    <?php echo esc_html(ucfirst($status)); ?>
                </div>
            </div>
            
            <?php if ($status === 'finished' && ($home_score !== '' || $away_score !== '')): ?>
                <div class="match-score">
                    <span class="score"><?php echo esc_html($home_score . ' : ' . $away_score); ?></span>
                </div>
            <?php endif; ?>
            
            <div class="match-details">
                <div class="match-datetime">
                    <i class="fas fa-calendar"></i>
                    <?php echo esc_html($formatted_date); ?>
                    <?php if ($formatted_time): ?>
                        <i class="fas fa-clock"></i>
                        <?php echo esc_html($formatted_time); ?>
                    <?php endif; ?>
                </div>
                <div class="match-venue">
                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo esc_html($venue); ?>
                    <?php if ($is_home): ?>
                        <span class="home-indicator">(Heim)</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * Render News Card
     */
    private function render_news_card($post) {
        $team_terms = get_the_terms($post->ID, 'hc_news_team');
        $team_name = $team_terms && !is_wp_error($team_terms) ? $team_terms[0]->name : '';
        ?>
        <article class="news-card">
            <?php if (has_post_thumbnail($post->ID)): ?>
                <div class="news-image">
                    <a href="<?php echo get_permalink($post->ID); ?>">
                        <?php echo get_the_post_thumbnail($post->ID, 'news-thumbnail'); ?>
                    </a>
                </div>
            <?php endif; ?>
            
            <div class="news-content">
                <?php if ($team_name): ?>
                    <span class="news-team-badge"><?php echo esc_html($team_name); ?></span>
                <?php endif; ?>
                
                <h3 class="news-title">
                    <a href="<?php echo get_permalink($post->ID); ?>">
                        <?php echo get_the_title($post->ID); ?>
                    </a>
                </h3>
                
                <div class="news-meta">
                    <span class="news-date">
                        <i class="fas fa-calendar"></i>
                        <?php echo get_the_date('d.m.Y', $post->ID); ?>
                    </span>
                    <span class="news-author">
                        <i class="fas fa-user"></i>
                        <?php echo get_the_author_meta('display_name', $post->post_author); ?>
                    </span>
                </div>
                
                <div class="news-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt($post->ID), 20); ?>
                </div>
                
                <a href="<?php echo get_permalink($post->ID); ?>" class="news-read-more">
                    <?php _e('Read More', 'handball-club'); ?>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </article>
        <?php
    }
    
    /**
     * Add Admin Pages
     */
    public function add_admin_pages() {
        add_menu_page(
            __('Handball Club', 'handball-club'),
            __('Handball Club', 'handball-club'),
            'manage_options',
            'handball-club',
            array($this, 'admin_dashboard'),
            'dashicons-admin-home',
            2
        );
        
        add_submenu_page(
            'handball-club',
            __('Dashboard', 'handball-club'),
            __('Dashboard', 'handball-club'),
            'manage_options',
            'handball-club',
            array($this, 'admin_dashboard')
        );
        
        add_submenu_page(
            'handball-club',
            __('Quick Actions', 'handball-club'),
            __('Quick Actions', 'handball-club'),
            'manage_options',
            'handball-club-actions',
            array($this, 'admin_quick_actions')
        );
        
        add_submenu_page(
            'handball-club',
            __('Import/Export', 'handball-club'),
            __('Import/Export', 'handball-club'),
            'manage_options',
            'handball-club-import',
            array($this, 'admin_import_export')
        );
        
        add_submenu_page(
            'handball-club',
            __('Settings', 'handball-club'),
            __('Settings', 'handball-club'),
            'manage_options',
            'handball-club-settings',
            array($this, 'admin_settings')
        );
    }
    
    /**
     * Admin Dashboard
     */
    public function admin_dashboard() {
        $total_teams = wp_count_posts('hc_team')->publish;
        $total_players = wp_count_posts('hc_player')->publish;
        $total_matches = wp_count_posts('hc_match')->publish;
        $total_sponsors = wp_count_posts('hc_sponsor')->publish;
        
        // Upcoming matches
        $upcoming_matches = get_posts(array(
            'post_type' => 'hc_match',
            'posts_per_page' => 5,
            'meta_query' => array(
                array(
                    'key' => '_hc_match_date',
                    'value' => date('Y-m-d'),
                    'compare' => '>='
                )
            ),
            'meta_key' => '_hc_match_date',
            'orderby' => 'meta_value',
            'order' => 'ASC'
        ));
        ?>
        <div class="wrap">
            <h1><?php _e('Handball Club Dashboard', 'handball-club'); ?></h1>
            
            <div class="hc-dashboard-stats">
                <div class="hc-stat-box">
                    <h3><?php echo $total_teams; ?></h3>
                    <p><?php _e('Teams', 'handball-club'); ?></p>
                    <a href="<?php echo admin_url('edit.php?post_type=hc_team'); ?>" class="button"><?php _e('Manage', 'handball-club'); ?></a>
                </div>
                
                <div class="hc-stat-box">
                    <h3><?php echo $total_players; ?></h3>
                    <p><?php _e('Players', 'handball-club'); ?></p>
                    <a href="<?php echo admin_url('edit.php?post_type=hc_player'); ?>" class="button"><?php _e('Manage', 'handball-club'); ?></a>
                </div>
                
                <div class="hc-stat-box">
                    <h3><?php echo $total_matches; ?></h3>
                    <p><?php _e('Matches', 'handball-club'); ?></p>
                    <a href="<?php echo admin_url('edit.php?post_type=hc_match'); ?>" class="button"><?php _e('Manage', 'handball-club'); ?></a>
                </div>
                
                <div class="hc-stat-box">
                    <h3><?php echo $total_sponsors; ?></h3>
                    <p><?php _e('Sponsors', 'handball-club'); ?></p>
                    <a href="<?php echo admin_url('edit.php?post_type=hc_sponsor'); ?>" class="button"><?php _e('Manage', 'handball-club'); ?></a>
                </div>
            </div>
            
            <div class="hc-dashboard-content">
                <div class="hc-upcoming-matches">
                    <h2><?php _e('Upcoming Matches', 'handball-club'); ?></h2>
                    <?php if ($upcoming_matches): ?>
                        <table class="wp-list-table widefat fixed striped">
                            <thead>
                                <tr>
                                    <th><?php _e('Date', 'handball-club'); ?></th>
                                    <th><?php _e('Team', 'handball-club'); ?></th>
                                    <th><?php _e('Opponent', 'handball-club'); ?></th>
                                    <th><?php _e('Venue', 'handball-club'); ?></th>
                                    <th><?php _e('Status', 'handball-club'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($upcoming_matches as $match): 
                                    $team_id = get_post_meta($match->ID, '_hc_match_team', true);
                                    $team = get_post($team_id);
                                    $opponent = get_post_meta($match->ID, '_hc_match_opponent', true);
                                    $match_date = get_post_meta($match->ID, '_hc_match_date', true);
                                    $venue = get_post_meta($match->ID, '_hc_match_venue', true);
                                    $status = get_post_meta($match->ID, '_hc_match_status', true);
                                ?>
                                    <tr>
                                        <td><?php echo date('d.m.Y', strtotime($match_date)); ?></td>
                                        <td><?php echo $team ? $team->post_title : ''; ?></td>
                                        <td><?php echo esc_html($opponent); ?></td>
                                        <td><?php echo esc_html($venue); ?></td>
                                        <td><?php echo esc_html(ucfirst($status)); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p><?php _e('No upcoming matches found.', 'handball-club'); ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="hc-quick-actions">
                    <h2><?php _e('Quick Actions', 'handball-club'); ?></h2>
                    <div class="hc-action-buttons">
                        <a href="<?php echo admin_url('post-new.php?post_type=hc_team'); ?>" class="button button-primary">
                            <i class="dashicons dashicons-plus"></i>
                            <?php _e('Add New Team', 'handball-club'); ?>
                        </a>
                        <a href="<?php echo admin_url('post-new.php?post_type=hc_player'); ?>" class="button button-primary">
                            <i class="dashicons dashicons-plus"></i>
                            <?php _e('Add New Player', 'handball-club'); ?>
                        </a>
                        <a href="<?php echo admin_url('post-new.php?post_type=hc_match'); ?>" class="button button-primary">
                            <i class="dashicons dashicons-plus"></i>
                            <?php _e('Add New Match', 'handball-club'); ?>
                        </a>
                        <a href="<?php echo admin_url('post-new.php'); ?>" class="button button-secondary">
                            <i class="dashicons dashicons-plus"></i>
                            <?php _e('Add News Article', 'handball-club'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <style>
        .hc-dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        
        .hc-stat-box {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        
        .hc-stat-box h3 {
            font-size: 2.5em;
            margin: 0 0 10px 0;
            color: #0073aa;
        }
        
        .hc-stat-box p {
            margin: 0 0 15px 0;
            font-weight: 600;
        }
        
        .hc-dashboard-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-top: 30px;
        }
        
        .hc-upcoming-matches,
        .hc-quick-actions {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            padding: 20px;
        }
        
        .hc-action-buttons {
            display: grid;
            gap: 10px;
        }
        
        .hc-action-buttons .button {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
            padding: 10px 15px;
        }
        </style>
        <?php
    }
    
    /**
     * Admin Quick Actions
     */
    public function admin_quick_actions() {
        // Handle form submissions
        if (isset($_POST['hc_create_sample_data']) && wp_verify_nonce($_POST['hc_nonce'], 'hc_sample_data')) {
            $this->create_sample_data();
            echo '<div class="notice notice-success"><p>' . __('Sample data created successfully!', 'handball-club') . '</p></div>';
        }
        
        if (isset($_POST['hc_reset_data']) && wp_verify_nonce($_POST['hc_nonce'], 'hc_reset_data')) {
            $this->reset_all_data();
            echo '<div class="notice notice-success"><p>' . __('All data has been reset!', 'handball-club') . '</p></div>';
        }
        ?>
        <div class="wrap">
            <h1><?php _e('Quick Actions', 'handball-club'); ?></h1>
            
            <div class="hc-quick-actions-grid">
                <div class="hc-action-card">
                    <h2><?php _e('Create Sample Data', 'handball-club'); ?></h2>
                    <p><?php _e('Generate sample teams, players, matches, and content to get started quickly.', 'handball-club'); ?></p>
                    <form method="post">
                        <?php wp_nonce_field('hc_sample_data', 'hc_nonce'); ?>
                        <button type="submit" name="hc_create_sample_data" class="button button-primary">
                            <?php _e('Create Sample Data', 'handball-club'); ?>
                        </button>
                    </form>
                </div>
                
                <div class="hc-action-card">
                    <h2><?php _e('Import Team Data', 'handball-club'); ?></h2>
                    <p><?php _e('Import team rosters, match schedules, and player statistics from CSV files.', 'handball-club'); ?></p>
                    <a href="<?php echo admin_url('admin.php?page=handball-club-import'); ?>" class="button button-secondary">
                        <?php _e('Go to Import', 'handball-club'); ?>
                    </a>
                </div>
                
                <div class="hc-action-card">
                    <h2><?php _e('Bulk Actions', 'handball-club'); ?></h2>
                    <p><?php _e('Perform bulk operations on players, matches, and teams.', 'handball-club'); ?></p>
                    <div class="hc-bulk-actions">
                        <a href="<?php echo admin_url('edit.php?post_type=hc_player'); ?>" class="button"><?php _e('Bulk Edit Players', 'handball-club'); ?></a>
                        <a href="<?php echo admin_url('edit.php?post_type=hc_match'); ?>" class="button"><?php _e('Bulk Edit Matches', 'handball-club'); ?></a>
                    </div>
                </div>
                
                <div class="hc-action-card hc-danger-zone">
                    <h2><?php _e('Danger Zone', 'handball-club'); ?></h2>
                    <p><?php _e('Reset all data. This action cannot be undone!', 'handball-club'); ?></p>
                    <form method="post" onsubmit="return confirm('<?php _e('Are you sure? This will delete ALL data!', 'handball-club'); ?>');">
                        <?php wp_nonce_field('hc_reset_data', 'hc_nonce'); ?>
                        <button type="submit" name="hc_reset_data" class="button button-delete">
                            <?php _e('Reset All Data', 'handball-club'); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <style>
        .hc-quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .hc-action-card {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        
        .hc-action-card h2 {
            margin-top: 0;
        }
        
        .hc-danger-zone {
            border-color: #dc3232;
        }
        
        .hc-danger-zone h2 {
            color: #dc3232;
        }
        
        .button-delete {
            background: #dc3232;
            color: #fff;
            border-color: #dc3232;
        }
        
        .hc-bulk-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        </style>
        <?php
    }
    
    /**
     * Admin Import/Export
     */
    public function admin_import_export() {
        ?>
        <div class="wrap">
            <h1><?php _e('Import/Export', 'handball-club'); ?></h1>
            
            <div class="hc-import-export-grid">
                <div class="hc-import-section">
                    <h2><?php _e('Import Data', 'handball-club'); ?></h2>
                    
                    <div class="hc-import-card">
                        <h3><?php _e('Import Players', 'handball-club'); ?></h3>
                        <p><?php _e('Import player data from CSV file. Required columns: name, team, jersey_number, position', 'handball-club'); ?></p>
                        <form method="post" enctype="multipart/form-data">
                            <?php wp_nonce_field('hc_import_players', 'hc_nonce'); ?>
                            <input type="file" name="players_csv" accept=".csv" required>
                            <button type="submit" name="import_players" class="button button-primary">
                                <?php _e('Import Players', 'handball-club'); ?>
                            </button>
                        </form>
                    </div>
                    
                    <div class="hc-import-card">
                        <h3><?php _e('Import Matches', 'handball-club'); ?></h3>
                        <p><?php _e('Import match schedule from CSV file. Required columns: team, opponent, date, time, venue, is_home', 'handball-club'); ?></p>
                        <form method="post" enctype="multipart/form-data">
                            <?php wp_nonce_field('hc_import_matches', 'hc_nonce'); ?>
                            <input type="file" name="matches_csv" accept=".csv" required>
                            <button type="submit" name="import_matches" class="button button-primary">
                                <?php _e('Import Matches', 'handball-club'); ?>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="hc-export-section">
                    <h2><?php _e('Export Data', 'handball-club'); ?></h2>
                    
                    <div class="hc-export-card">
                        <h3><?php _e('Export Players', 'handball-club'); ?></h3>
                        <p><?php _e('Export all player data to CSV file for backup or external use.', 'handball-club'); ?></p>
                        <a href="<?php echo admin_url('admin.php?page=handball-club-import&action=export_players'); ?>" class="button button-secondary">
                            <?php _e('Export Players CSV', 'handball-club'); ?>
                        </a>
                    </div>
                    
                    <div class="hc-export-card">
                        <h3><?php _e('Export Matches', 'handball-club'); ?></h3>
                        <p><?php _e('Export all match data to CSV file for backup or external use.', 'handball-club'); ?></p>
                        <a href="<?php echo admin_url('admin.php?page=handball-club-import&action=export_matches'); ?>" class="button button-secondary">
                            <?php _e('Export Matches CSV', 'handball-club'); ?>
                        </a>
                    </div>
                    
                    <div class="hc-export-card">
                        <h3><?php _e('Full Backup', 'handball-club'); ?></h3>
                        <p><?php _e('Export all handball club data including teams, players, matches, and settings.', 'handball-club'); ?></p>
                        <a href="<?php echo admin_url('admin.php?page=handball-club-import&action=full_backup'); ?>" class="button button-primary">
                            <?php _e('Create Full Backup', 'handball-club'); ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="hc-import-templates">
                <h2><?php _e('CSV Templates', 'handball-club'); ?></h2>
                <p><?php _e('Download these templates to ensure your CSV files have the correct format:', 'handball-club'); ?></p>
                <div class="hc-template-links">
                    <a href="<?php echo admin_url('admin.php?page=handball-club-import&action=download_template&type=players'); ?>" class="button">
                        <?php _e('Download Players Template', 'handball-club'); ?>
                    </a>
                    <a href="<?php echo admin_url('admin.php?page=handball-club-import&action=download_template&type=matches'); ?>" class="button">
                        <?php _e('Download Matches Template', 'handball-club'); ?>
                    </a>
                </div>
            </div>
        </div>
        
        <style>
        .hc-import-export-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 20px;
        }
        
        .hc-import-card,
        .hc-export-card {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
        }
        
        .hc-import-card h3,
        .hc-export-card h3 {
            margin-top: 0;
        }
        
        .hc-import-card form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .hc-import-templates {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            padding: 20px;
            margin-top: 30px;
        }
        
        .hc-template-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        </style>
        <?php
    }
    
    /**
     * Admin Settings
     */
    public function admin_settings() {
        // Handle form submission
        if (isset($_POST['save_settings']) && wp_verify_nonce($_POST['hc_nonce'], 'hc_settings')) {
            $this->save_settings($_POST);
            echo '<div class="notice notice-success"><p>' . __('Settings saved successfully!', 'handball-club') . '</p></div>';
        }
        
        $settings = $this->get_settings();
        ?>
        <div class="wrap">
            <h1><?php _e('Handball Club Settings', 'handball-club'); ?></h1>
            
            <form method="post">
                <?php wp_nonce_field('hc_settings', 'hc_nonce'); ?>
                
                <div class="hc-settings-tabs">
                    <nav class="nav-tab-wrapper">
                        <a href="#general" class="nav-tab nav-tab-active"><?php _e('General', 'handball-club'); ?></a>
                        <a href="#team-settings" class="nav-tab"><?php _e('Team Settings', 'handball-club'); ?></a>
                        <a href="#match-settings" class="nav-tab"><?php _e('Match Settings', 'handball-club'); ?></a>
                        <a href="#appearance" class="nav-tab"><?php _e('Appearance', 'handball-club'); ?></a>
                    </nav>
                    
                    <div id="general" class="tab-content active">
                        <h2><?php _e('General Settings', 'handball-club'); ?></h2>
                        <table class="form-table">
                            <tr>
                                <th><label for="club_name"><?php _e('Club Name', 'handball-club'); ?></label></th>
                                <td><input type="text" id="club_name" name="club_name" value="<?php echo esc_attr($settings['club_name'] ?? ''); ?>" class="regular-text" /></td>
                            </tr>
                            <tr>
                                <th><label for="club_founded"><?php _e('Founded Year', 'handball-club'); ?></label></th>
                                <td><input type="number" id="club_founded" name="club_founded" value="<?php echo esc_attr($settings['club_founded'] ?? ''); ?>" min="1800" max="<?php echo date('Y'); ?>" /></td>
                            </tr>
                            <tr>
                                <th><label for="club_address"><?php _e('Club Address', 'handball-club'); ?></label></th>
                                <td><textarea id="club_address" name="club_address" rows="3" class="large-text"><?php echo esc_textarea($settings['club_address'] ?? ''); ?></textarea></td>
                            </tr>
                            <tr>
                                <th><label for="club_email"><?php _e('Contact Email', 'handball-club'); ?></label></th>
                                <td><input type="email" id="club_email" name="club_email" value="<?php echo esc_attr($settings['club_email'] ?? ''); ?>" class="regular-text" /></td>
                            </tr>
                            <tr>
                                <th><label for="club_phone"><?php _e('Phone Number', 'handball-club'); ?></label></th>
                                <td><input type="tel" id="club_phone" name="club_phone" value="<?php echo esc_attr($settings['club_phone'] ?? ''); ?>" class="regular-text" /></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div id="team-settings" class="tab-content">
                        <h2><?php _e('Team Settings', 'handball-club'); ?></h2>
                        <table class="form-table">
                            <tr>
                                <th><label for="default_team_color"><?php _e('Default Team Color', 'handball-club'); ?></label></th>
                                <td><input type="color" id="default_team_color" name="default_team_color" value="<?php echo esc_attr($settings['default_team_color'] ?? '#ff6b35'); ?>" /></td>
                            </tr>
                            <tr>
                                <th><label for="show_player_stats"><?php _e('Show Player Statistics', 'handball-club'); ?></label></th>
                                <td><input type="checkbox" id="show_player_stats" name="show_player_stats" value="1" <?php checked($settings['show_player_stats'] ?? '1', '1'); ?> /></td>
                            </tr>
                            <tr>
                                <th><label for="players_per_page"><?php _e('Players per Page', 'handball-club'); ?></label></th>
                                <td><input type="number" id="players_per_page" name="players_per_page" value="<?php echo esc_attr($settings['players_per_page'] ?? '12'); ?>" min="1" max="50" /></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div id="match-settings" class="tab-content">
                        <h2><?php _e('Match Settings', 'handball-club'); ?></h2>
                        <table class="form-table">
                            <tr>
                                <th><label for="default_venue"><?php _e('Default Venue', 'handball-club'); ?></label></th>
                                <td><input type="text" id="default_venue" name="default_venue" value="<?php echo esc_attr($settings['default_venue'] ?? ''); ?>" class="regular-text" /></td>
                            </tr>
                            <tr>
                                <th><label for="show_upcoming_matches"><?php _e('Show Upcoming Matches on Homepage', 'handball-club'); ?></label></th>
                                <td><input type="checkbox" id="show_upcoming_matches" name="show_upcoming_matches" value="1" <?php checked($settings['show_upcoming_matches'] ?? '1', '1'); ?> /></td>
                            </tr>
                            <tr>
                                <th><label for="matches_per_page"><?php _e('Matches per Page', 'handball-club'); ?></label></th>
                                <td><input type="number" id="matches_per_page" name="matches_per_page" value="<?php echo esc_attr($settings['matches_per_page'] ?? '10'); ?>" min="1" max="50" /></td>
                            </tr>
                            <tr>
                                <th><label for="enable_live_ticker"><?php _e('Enable Live Ticker', 'handball-club'); ?></label></th>
                                <td><input type="checkbox" id="enable_live_ticker" name="enable_live_ticker" value="1" <?php checked($settings['enable_live_ticker'] ?? '0', '1'); ?> /></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div id="appearance" class="tab-content">
                        <h2><?php _e('Appearance Settings', 'handball-club'); ?></h2>
                        <table class="form-table">
                            <tr>
                                <th><label for="primary_color"><?php _e('Primary Color', 'handball-club'); ?></label></th>
                                <td><input type="color" id="primary_color" name="primary_color" value="<?php echo esc_attr($settings['primary_color'] ?? '#ff6b35'); ?>" /></td>
                            </tr>
                            <tr>
                                <th><label for="secondary_color"><?php _e('Secondary Color', 'handball-club'); ?></label></th>
                                <td><input type="color" id="secondary_color" name="secondary_color" value="<?php echo esc_attr($settings['secondary_color'] ?? '#2c3e50'); ?>" /></td>
                            </tr>
                            <tr>
                                <th><label for="hero_background"><?php _e('Hero Background Image', 'handball-club'); ?></label></th>
                                <td>
                                    <input type="url" id="hero_background" name="hero_background" value="<?php echo esc_attr($settings['hero_background'] ?? ''); ?>" class="regular-text" />
                                    <button type="button" class="button" onclick="uploadImage('hero_background')"><?php _e('Upload Image', 'handball-club'); ?></button>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="show_breadcrumbs"><?php _e('Show Breadcrumbs', 'handball-club'); ?></label></th>
                                <td><input type="checkbox" id="show_breadcrumbs" name="show_breadcrumbs" value="1" <?php checked($settings['show_breadcrumbs'] ?? '1', '1'); ?> /></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <p class="submit">
                    <input type="submit" name="save_settings" class="button-primary" value="<?php _e('Save Settings', 'handball-club'); ?>" />
                </p>
            </form>
        </div>
        
        <style>
        .hc-settings-tabs {
            background: #fff;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            margin-top: 20px;
        }
        
        .nav-tab-wrapper {
            border-bottom: 1px solid #ccd0d4;
            margin: 0;
        }
        
        .tab-content {
            padding: 20px;
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .tab-content h2 {
            margin-top: 0;
        }
        </style>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.nav-tab');
            const contents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('nav-tab-active'));
                    contents.forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked tab
                    this.classList.add('nav-tab-active');
                    
                    // Show corresponding content
                    const target = this.getAttribute('href').substring(1);
                    document.getElementById(target).classList.add('active');
                });
            });
        });
        
        function uploadImage(inputId) {
            const frame = wp.media({
                title: '<?php _e('Select Image', 'handball-club'); ?>',
                button: {
                    text: '<?php _e('Use this image', 'handball-club'); ?>'
                },
                multiple: false
            });
            
            frame.on('select', function() {
                const attachment = frame.state().get('selection').first().toJSON();
                document.getElementById(inputId).value = attachment.url;
            });
            
            frame.open();
        }
        </script>
        <?php
    }
    
    /**
     * Get Settings
     */
    private function get_settings() {
        return get_option('handball_club_settings', array());
    }
    
    /**
     * Save Settings
     */
    private function save_settings($data) {
        $settings = array();
        
        // General settings
        $settings['club_name'] = sanitize_text_field($data['club_name'] ?? '');
        $settings['club_founded'] = sanitize_text_field($data['club_founded'] ?? '');
        $settings['club_address'] = sanitize_textarea_field($data['club_address'] ?? '');
        $settings['club_email'] = sanitize_email($data['club_email'] ?? '');
        $settings['club_phone'] = sanitize_text_field($data['club_phone'] ?? '');
        
        // Team settings
        $settings['default_team_color'] = sanitize_text_field($data['default_team_color'] ?? '#ff6b35');
        $settings['show_player_stats'] = isset($data['show_player_stats']) ? '1' : '0';
        $settings['players_per_page'] = intval($data['players_per_page'] ?? 12);
        
        // Match settings
        $settings['default_venue'] = sanitize_text_field($data['default_venue'] ?? '');
        $settings['show_upcoming_matches'] = isset($data['show_upcoming_matches']) ? '1' : '0';
        $settings['matches_per_page'] = intval($data['matches_per_page'] ?? 10);
        $settings['enable_live_ticker'] = isset($data['enable_live_ticker']) ? '1' : '0';
        
        // Appearance settings
        $settings['primary_color'] = sanitize_text_field($data['primary_color'] ?? '#ff6b35');
        $settings['secondary_color'] = sanitize_text_field($data['secondary_color'] ?? '#2c3e50');
        $settings['hero_background'] = sanitize_url($data['hero_background'] ?? '');
        $settings['show_breadcrumbs'] = isset($data['show_breadcrumbs']) ? '1' : '0';
        
        update_option('handball_club_settings', $settings);
    }
    
    /**
     * Create Sample Data
     */
    private function create_sample_data() {
        // Create sample teams
        $teams_data = array(
            array(
                'title' => 'Herren 1',
                'league' => 'Verbandsliga',
                'coach' => 'Max Mustermann',
                'color' => '#ff6b35'
            ),
            array(
                'title' => 'Herren 2',
                'league' => 'Landesliga',
                'coach' => 'Peter Schmidt',
                'color' => '#3498db'
            ),
            array(
                'title' => 'Damen',
                'league' => 'Oberliga',
                'coach' => 'Anna Müller',
                'color' => '#e74c3c'
            ),
            array(
                'title' => 'A-Jugend',
                'league' => 'A-Jugend Liga',
                'coach' => 'Tim Weber',
                'color' => '#f39c12'
            )
        );
        
        $team_ids = array();
        foreach ($teams_data as $team_data) {
            $team_id = wp_insert_post(array(
                'post_title' => $team_data['title'],
                'post_type' => 'hc_team',
                'post_status' => 'publish',
                'post_content' => 'Sample team created for demonstration purposes.'
            ));
            
            if ($team_id) {
                update_post_meta($team_id, '_hc_team_league', $team_data['league']);
                update_post_meta($team_id, '_hc_team_coach', $team_data['coach']);
                update_post_meta($team_id, '_hc_team_color', $team_data['color']);
                update_post_meta($team_id, '_hc_team_training_times', 'Dienstag 19:00-21:00\nDonnerstag 19:00-21:00');
                update_post_meta($team_id, '_hc_team_contact_email', 'team@handball-club.de');
                
                $team_ids[] = $team_id;
            }
        }
        
        // Create sample players
        $player_names = array(
            'Alexander Schmidt', 'Maximilian Müller', 'Sebastian Weber', 'Christian Fischer',
            'Daniel Wagner', 'Michael Bauer', 'Andreas Schneider', 'Thomas Meyer',
            'Stefan Schulz', 'Markus Hoffmann', 'Julia Becker', 'Sarah Klein',
            'Lisa Neumann', 'Anna Richter', 'Marie Schmitt', 'Laura Zimmermann'
        );
        
        $positions = array('Torwart', 'Linksaußen', 'Rückraum links', 'Rückraum Mitte', 'Rückraum rechts', 'Rechtsaußen', 'Kreis');
        
        foreach ($team_ids as $index => $team_id) {
            for ($i = 0; $i < 4; $i++) {
                $player_name = $player_names[($index * 4) + $i];
                $player_id = wp_insert_post(array(
                    'post_title' => $player_name,
                    'post_type' => 'hc_player',
                    'post_status' => 'publish',
                    'post_content' => 'Sample player profile.'
                ));
                
                if ($player_id) {
                    update_post_meta($player_id, '_hc_player_team', $team_id);
                    update_post_meta($player_id, '_hc_player_jersey_number', ($i + 1) + ($index * 10));
                    update_post_meta($player_id, '_hc_player_birth_date', '1995-0' . (($i + 1) + 4) . '-15');
                    update_post_meta($player_id, '_hc_player_height', rand(170, 195));
                    update_post_meta($player_id, '_hc_player_weight', rand(70, 95));
                    update_post_meta($player_id, '_hc_player_goals', rand(0, 25));
                    update_post_meta($player_id, '_hc_player_games', rand(5, 20));
                    update_post_meta($player_id, '_hc_player_assists', rand(0, 15));
                    
                    // Assign position
                    wp_set_post_terms($player_id, array($positions[array_rand($positions)]), 'hc_player_position');
                }
            }
        }
        
        // Create sample matches
        foreach ($team_ids as $team_id) {
            for ($i = 0; $i < 3; $i++) {
                $match_date = date('Y-m-d', strtotime('+' . ($i + 1) . ' weeks'));
                $match_id = wp_insert_post(array(
                    'post_title' => 'Match against Opponent ' . ($i + 1),
                    'post_type' => 'hc_match',
                    'post_status' => 'publish',
                    'post_content' => 'Upcoming match details.'
                ));
                
                if ($match_id) {
                    update_post_meta($match_id, '_hc_match_team', $team_id);
                    update_post_meta($match_id, '_hc_match_opponent', 'Gegner Team ' . ($i + 1));
                    update_post_meta($match_id, '_hc_match_date', $match_date);
                    update_post_meta($match_id, '_hc_match_time', '19:00');
                    update_post_meta($match_id, '_hc_match_venue', $i % 2 == 0 ? 'Heimhalle' : 'Auswärtshalle');
                    update_post_meta($match_id, '_hc_match_is_home', $i % 2 == 0 ? '1' : '0');
                    update_post_meta($match_id, '_hc_match_status', 'scheduled');
                }
            }
        }
        
        // Create sample sponsors
        $sponsors = array(
            array('title' => 'Hauptsponsor GmbH', 'level' => 'main'),
            array('title' => 'Premium Partner AG', 'level' => 'premium'),
            array('title' => 'Lokaler Supporter', 'level' => 'supporter')
        );
        
        foreach ($sponsors as $sponsor_data) {
            $sponsor_id = wp_insert_post(array(
                'post_title' => $sponsor_data['title'],
                'post_type' => 'hc_sponsor',
                'post_status' => 'publish',
                'post_content' => 'Sponsor description and partnership details.'
            ));
            
            if ($sponsor_id) {
                update_post_meta($sponsor_id, '_hc_sponsor_level', $sponsor_data['level']);
                update_post_meta($sponsor_id, '_hc_sponsor_website', 'https://example.com');
                update_post_meta($sponsor_id, '_hc_sponsor_contact_person', 'Kontakt Person');
                update_post_meta($sponsor_id, '_hc_sponsor_contact_email', 'sponsor@example.com');
            }
        }
    }
    
    /**
     * Reset All Data
     */
    private function reset_all_data() {
        $post_types = array('hc_team', 'hc_player', 'hc_match', 'hc_sponsor');
        
        foreach ($post_types as $post_type) {
            $posts = get_posts(array(
                'post_type' => $post_type,
                'numberposts' => -1,
                'post_status' => 'any'
            ));
            
            foreach ($posts as $post) {
                wp_delete_post($post->ID, true);
            }
        }
        
        // Reset settings
        delete_option('handball_club_settings');
    }
    
    /**
     * Utility Functions
     */
    
    /**
     * Get upcoming matches for a team
     */
    public static function get_upcoming_matches($team_id = 0, $limit = 5) {
        $args = array(
            'post_type' => 'hc_match',
            'posts_per_page' => $limit,
            'meta_query' => array(
                array(
                    'key' => '_hc_match_date',
                    'value' => date('Y-m-d'),
                    'compare' => '>='
                )
            ),
            'meta_key' => '_hc_match_date',
            'orderby' => 'meta_value',
            'order' => 'ASC'
        );
        
        if ($team_id > 0) {
            $args['meta_query'][] = array(
                'key' => '_hc_match_team',
                'value' => $team_id,
                'compare' => '='
            );
        }
        
        return get_posts($args);
    }
    
    /**
     * Get team players
     */
    public static function get_team_players($team_id, $limit = -1) {
        $args = array(
            'post_type' => 'hc_player',
            'posts_per_page' => $limit,
            'meta_query' => array(
                array(
                    'key' => '_hc_player_team',
                    'value' => $team_id,
                    'compare' => '='
                )
            ),
            'meta_key' => '_hc_player_jersey_number',
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        );
        
        return get_posts($args);
    }
    
    /**
     * Get team statistics
     */
    public static function get_team_stats($team_id) {
        $players = self::get_team_players($team_id);
        $total_goals = 0;
        $total_games = 0;
        $total_assists = 0;
        
        foreach ($players as $player) {
            $total_goals += intval(get_post_meta($player->ID, '_hc_player_goals', true));
            $total_games += intval(get_post_meta($player->ID, '_hc_player_games', true));
            $total_assists += intval(get_post_meta($player->ID, '_hc_player_assists', true));
        }
        
        return array(
            'total_players' => count($players),
            'total_goals' => $total_goals,
            'total_games' => $total_games,
            'total_assists' => $total_assists,
            'avg_goals_per_game' => $total_games > 0 ? round($total_goals / $total_games, 2) : 0
        );
    }
    
    /**
     * Get match result
     */
    public static function get_match_result($match_id) {
        $home_score = get_post_meta($match_id, '_hc_match_home_score', true);
        $away_score = get_post_meta($match_id, '_hc_match_away_score', true);
        $status = get_post_meta($match_id, '_hc_match_status', true);
        
        if ($status !== 'finished' || $home_score === '' || $away_score === '') {
            return null;
        }
        
        return array(
            'home_score' => intval($home_score),
            'away_score' => intval($away_score),
            'result' => $home_score > $away_score ? 'win' : ($home_score < $away_score ? 'loss' : 'draw')
        );
    }
    
    /**
     * Format player age
     */
    public static function get_player_age($birth_date) {
        if (empty($birth_date)) {
            return '';
        }
        
        $birth = new DateTime($birth_date);
        $today = new DateTime('today');
        $age = $birth->diff($today)->y;
        
        return $age;
    }
    
    /**
     * Get recent team news
     */
    public static function get_team_news($team_slug = '', $limit = 5) {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $limit,
            'post_status' => 'publish'
        );
        
        if (!empty($team_slug)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'hc_news_team',
                    'field' => 'slug',
                    'terms' => $team_slug
                )
            );
        }
        
        return get_posts($args);
    }
    
    /**
     * Generate team color CSS variables
     */
    public static function generate_team_colors() {
        $teams = get_posts(array(
            'post_type' => 'hc_team',
            'numberposts' => -1
        ));
        
        $css = '';
        foreach ($teams as $team) {
            $color = get_post_meta($team->ID, '_hc_team_color', true);
            if ($color) {
                $team_slug = sanitize_title($team->post_title);
                $css .= ".team-{$team_slug} { --team-color: {$color}; }\n";
            }
        }
        
        return $css;
    }
}

// Initialize the theme
new HandballClubTheme();

/**
 * Helper functions for templates
 */

/**
 * Display team badge
 */
function hc_team_badge($team_id, $size = 'small') {
    $team = get_post($team_id);
    if (!$team) return '';
    
    $color = get_post_meta($team_id, '_hc_team_color', true) ?: '#ff6b35';
    $class = 'hc-team-badge hc-team-badge-' . $size;
    
    return sprintf(
        '<span class="%s" style="background-color: %s;">%s</span>',
        esc_attr($class),
        esc_attr($color),
        esc_html($team->post_title)
    );
}

/**
 * Display match status badge
 */
function hc_match_status_badge($status) {
    $statuses = array(
        'scheduled' => array('label' => __('Scheduled', 'handball-club'), 'class' => 'scheduled'),
        'live' => array('label' => __('Live', 'handball-club'), 'class' => 'live'),
        'finished' => array('label' => __('Finished', 'handball-club'), 'class' => 'finished'),
        'postponed' => array('label' => __('Postponed', 'handball-club'), 'class' => 'postponed'),
        'cancelled' => array('label' => __('Cancelled', 'handball-club'), 'class' => 'cancelled')
    );
    
    $status_info = $statuses[$status] ?? $statuses['scheduled'];
    
    return sprintf(
        '<span class="hc-match-status hc-match-status-%s">%s</span>',
        esc_attr($status_info['class']),
        esc_html($status_info['label'])
    );
}

/**
 * Display player position
 */
function hc_player_position($player_id) {
    $positions = get_the_terms($player_id, 'hc_player_position');
    if ($positions && !is_wp_error($positions)) {
        return esc_html($positions[0]->name);
    }
    return '';
}

/**
 * Format handball score
 */
function hc_format_score($home_score, $away_score) {
    if ($home_score === '' || $away_score === '') {
        return '-:-';
    }
    return sprintf('%d:%d', intval($home_score), intval($away_score));
}

/**
 * Get club settings
 */
function hc_get_setting($key, $default = '') {
    $settings = get_option('handball_club_settings', array());
    return $settings[$key] ?? $default;
}

/**
 * Display breadcrumbs
 */
function hc_breadcrumbs() {
    if (!hc_get_setting('show_breadcrumbs', '1')) {
        return;
    }
    
    echo '<nav class="hc-breadcrumbs" aria-label="Breadcrumb">';
    echo '<ol class="breadcrumb-list">';
    
    // Home
    echo '<li class="breadcrumb-item">';
    echo '<a href="' . home_url('/') . '">' . __('Home', 'handball-club') . '</a>';
    echo '</li>';
    
    if (is_singular('hc_team')) {
        echo '<li class="breadcrumb-item">';
        echo '<a href="' . get_post_type_archive_link('hc_team') . '">' . __('Teams', 'handball-club') . '</a>';
        echo '</li>';
        echo '<li class="breadcrumb-item active" aria-current="page">';
        echo get_the_title();
        echo '</li>';
    } elseif (is_singular('hc_player')) {
        $team_id = get_post_meta(get_the_ID(), '_hc_player_team', true);
        if ($team_id) {
            $team = get_post($team_id);
            echo '<li class="breadcrumb-item">';
            echo '<a href="' . get_post_type_archive_link('hc_team') . '">' . __('Teams', 'handball-club') . '</a>';
            echo '</li>';
            echo '<li class="breadcrumb-item">';
            echo '<a href="' . get_permalink($team_id) . '">' . $team->post_title . '</a>';
            echo '</li>';
        }
        echo '<li class="breadcrumb-item">';
        echo '<a href="' . get_post_type_archive_link('hc_player') . '">' . __('Players', 'handball-club') . '</a>';
        echo '</li>';
        echo '<li class="breadcrumb-item active" aria-current="page">';
        echo get_the_title();
        echo '</li>';
    } elseif (is_singular('hc_match')) {
        echo '<li class="breadcrumb-item">';
        echo '<a href="' . get_post_type_archive_link('hc_match') . '">' . __('Matches', 'handball-club') . '</a>';
        echo '</li>';
        echo '<li class="breadcrumb-item active" aria-current="page">';
        echo get_the_title();
        echo '</li>';
    } elseif (is_post_type_archive()) {
        $post_type = get_post_type_object(get_post_type());
        echo '<li class="breadcrumb-item active" aria-current="page">';
        echo $post_type->labels->name;
        echo '</li>';
    } elseif (is_single()) {
        if (has_category()) {
            $category = get_the_category();
            echo '<li class="breadcrumb-item">';
            echo '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a>';
            echo '</li>';
        }
        echo '<li class="breadcrumb-item active" aria-current="page">';
        echo get_the_title();
        echo '</li>';
    } elseif (is_page()) {
        if (wp_get_post_parent_id(get_the_ID())) {
            $ancestors = get_post_ancestors(get_the_ID());
            $ancestors = array_reverse($ancestors);
            
            foreach ($ancestors as $ancestor) {
                echo '<li class="breadcrumb-item">';
                echo '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>';
                echo '</li>';
            }
        }
        echo '<li class="breadcrumb-item active" aria-current="page">';
        echo get_the_title();
        echo '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}

/**
 * Display team selector
 */
function hc_team_selector($current_team = 0, $show_all = true) {
    $teams = get_posts(array(
        'post_type' => 'hc_team',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ));
    
    if (empty($teams)) {
        return;
    }
    
    echo '<div class="hc-team-selector">';
    echo '<select class="team-filter" data-target="team-content">';
    
    if ($show_all) {
        echo '<option value="all"' . selected($current_team, 0, false) . '>' . __('All Teams', 'handball-club') . '</option>';
    }
    
    foreach ($teams as $team) {
        echo '<option value="' . $team->ID . '"' . selected($current_team, $team->ID, false) . '>';
        echo esc_html($team->post_title);
        echo '</option>';
    }
    
    echo '</select>';
    echo '</div>';
}

/**
 * Display upcoming matches widget
 */
function hc_upcoming_matches_widget($team_id = 0, $limit = 3) {
    $matches = HandballClubTheme::get_upcoming_matches($team_id, $limit);
    
    if (empty($matches)) {
        echo '<p>' . __('No upcoming matches found.', 'handball-club') . '</p>';
        return;
    }
    
    echo '<div class="hc-upcoming-matches-widget">';
    
    foreach ($matches as $match) {
        $team_id = get_post_meta($match->ID, '_hc_match_team', true);
        $opponent = get_post_meta($match->ID, '_hc_match_opponent', true);
        $match_date = get_post_meta($match->ID, '_hc_match_date', true);
        $match_time = get_post_meta($match->ID, '_hc_match_time', true);
        $is_home = get_post_meta($match->ID, '_hc_match_is_home', true);
        $status = get_post_meta($match->ID, '_hc_match_status', true);
        
        $team = get_post($team_id);
        $formatted_date = $match_date ? date('d.m.Y', strtotime($match_date)) : '';
        $formatted_time = $match_time ? date('H:i', strtotime($match_time)) : '';
        
        echo '<div class="match-widget-item">';
        echo '<div class="match-teams">';
        
        if ($is_home) {
            echo '<span class="home-team">' . esc_html($team->post_title) . '</span>';
            echo ' <span class="vs">vs</span> ';
            echo '<span class="away-team">' . esc_html($opponent) . '</span>';
        } else {
            echo '<span class="away-team">' . esc_html($opponent) . '</span>';
            echo ' <span class="vs">vs</span> ';
            echo '<span class="home-team">' . esc_html($team->post_title) . '</span>';
        }
        
        echo '</div>';
        echo '<div class="match-datetime">';
        echo '<span class="date">' . esc_html($formatted_date) . '</span>';
        if ($formatted_time) {
            echo ' <span class="time">' . esc_html($formatted_time) . '</span>';
        }
        echo '</div>';
        echo hc_match_status_badge($status);
        echo '</div>';
    }
    
    echo '</div>';
}

/**
 * Display player statistics
 */
function hc_player_stats_table($player_id) {
    if (!hc_get_setting('show_player_stats', '1')) {
        return;
    }
    
    $goals = get_post_meta($player_id, '_hc_player_goals', true);
    $games = get_post_meta($player_id, '_hc_player_games', true);
    $assists = get_post_meta($player_id, '_hc_player_assists', true);
    $jersey_number = get_post_meta($player_id, '_hc_player_jersey_number', true);
    $height = get_post_meta($player_id, '_hc_player_height', true);
    $weight = get_post_meta($player_id, '_hc_player_weight', true);
    $birth_date = get_post_meta($player_id, '_hc_player_birth_date', true);
    
    echo '<div class="hc-player-stats">';
    echo '<h3>' . __('Player Statistics', 'handball-club') . '</h3>';
    echo '<table class="player-stats-table">';
    
    if ($jersey_number) {
        echo '<tr><td>' . __('Jersey Number', 'handball-club') . '</td><td>' . esc_html($jersey_number) . '</td></tr>';
    }
    
    if ($birth_date) {
        $age = HandballClubTheme::get_player_age($birth_date);
        echo '<tr><td>' . __('Age', 'handball-club') . '</td><td>' . esc_html($age) . '</td></tr>';
    }
    
    if ($height) {
        echo '<tr><td>' . __('Height', 'handball-club') . '</td><td>' . esc_html($height) . ' cm</td></tr>';
    }
    
    if ($weight) {
        echo '<tr><td>' . __('Weight', 'handball-club') . '</td><td>' . esc_html($weight) . ' kg</td></tr>';
    }
    
    $position = hc_player_position($player_id);
    if ($position) {
        echo '<tr><td>' . __('Position', 'handball-club') . '</td><td>' . esc_html($position) . '</td></tr>';
    }
    
    if ($games) {
        echo '<tr><td>' . __('Games Played', 'handball-club') . '</td><td>' . esc_html($games) . '</td></tr>';
    }
    
    if ($goals) {
        echo '<tr><td>' . __('Goals', 'handball-club') . '</td><td>' . esc_html($goals) . '</td></tr>';
    }
    
    if ($assists) {
        echo '<tr><td>' . __('Assists', 'handball-club') . '</td><td>' . esc_html($assists) . '</td></tr>';
    }
    
    if ($goals && $games && $games > 0) {
        $avg_goals = round($goals / $games, 2);
        echo '<tr><td>' . __('Goals per Game', 'handball-club') . '</td><td>' . esc_html($avg_goals) . '</td></tr>';
    }
    
    echo '</table>';
    echo '</div>';
}

/**
 * Display sponsor logos
 */
function hc_sponsors_display($level = 'all', $limit = -1) {
    $args = array(
        'post_type' => 'hc_sponsor',
        'posts_per_page' => $limit,
        'post_status' => 'publish'
    );
    
    if ($level !== 'all') {
        $args['meta_query'] = array(
            array(
                'key' => '_hc_sponsor_level',
                'value' => $level,
                'compare' => '='
            )
        );
    }
    
    $sponsors = get_posts($args);
    
    if (empty($sponsors)) {
        return;
    }
    
    echo '<div class="hc-sponsors-display hc-sponsors-' . esc_attr($level) . '">';
    
    foreach ($sponsors as $sponsor) {
        $website = get_post_meta($sponsor->ID, '_hc_sponsor_website', true);
        $sponsor_level = get_post_meta($sponsor->ID, '_hc_sponsor_level', true);
        
        echo '<div class="sponsor-item sponsor-level-' . esc_attr($sponsor_level) . '">';
        
        if ($website) {
            echo '<a href="' . esc_url($website) . '" target="_blank" rel="nofollow">';
        }
        
        if (has_post_thumbnail($sponsor->ID)) {
            echo get_the_post_thumbnail($sponsor->ID, 'sponsor-logo', array(
                'alt' => get_the_title($sponsor->ID),
                'title' => get_the_title($sponsor->ID)
            ));
        } else {
            echo '<div class="sponsor-placeholder">' . esc_html($sponsor->post_title) . '</div>';
        }
        
        if ($website) {
            echo '</a>';
        }
        
        echo '</div>';
    }
    
    echo '</div>';
}

/**
 * Custom Walker for Team Navigation Menu
 */
class HC_Team_Nav_Walker extends Walker_Nav_Menu {
    
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';
        
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes .'>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

?>
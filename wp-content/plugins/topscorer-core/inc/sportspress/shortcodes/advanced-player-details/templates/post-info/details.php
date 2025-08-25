<?php

// @see wp-content/plugins/sportspress/templates/player-details.php

// check global option
if ( get_option ( 'sportspress_player_show_details', 'yes' ) === 'no' ) return;

$defaults = array (
    'show_age'               => 'yes' === get_option ( 'sportspress_player_show_age', 'no' ) ? true : false,
    'show_nationality'       => 'yes' === get_option ( 'sportspress_player_show_nationality', 'yes' ) ? true : false,
    'show_current_teams'     => 'yes' === get_option ( 'sportspress_player_show_current_teams', 'yes' ) ? true : false,
    'show_past_teams'        => 'yes' === get_option ( 'sportspress_player_show_past_teams', 'yes' ) ? true : false,
    'show_leagues'           => 'yes' === get_option ( 'sportspress_player_show_leagues', 'no' ) ? true : false,
    'show_seasons'           => 'yes' === get_option ( 'sportspress_player_show_seasons', 'no' ) ? true : false,
    'show_nationality_flags' => 'yes' === get_option ( 'sportspress_player_show_flags', 'yes' ) ? true : false,
    'link_teams'             => 'yes' === get_option ( 'sportspress_link_teams', 'no' ) ? true : false,
);

extract ( $defaults, EXTR_SKIP );

$countries = SP()->countries->countries;

// player instance
$player = new SP_Player( $player_id );

$data = array();

if ( $show_age ) {
    $data[ 'age' ] = SportsPress_Birthdays ::get_age ( get_the_date ( 'm-d-Y', $player_id ) );
}

if ( $show_nationality ) {
    $nationalities = $player->nationalities();

    if ( $nationalities && is_array ( $nationalities ) ) {
        $values = array();

        foreach ( $nationalities as $nationality ) {
            $country_name = sp_array_value ( $countries, $nationality, null );
            $values[]     = $country_name ? ( $show_nationality_flags ? '<img src="' . plugin_dir_url ( SP_PLUGIN_FILE ) . 'assets/images/flags/' . strtolower ( $nationality ) . '.png" alt="' . $nationality . '"> ' : '' ) . $country_name : '&mdash;';
        };

        $data[ 'nationality' ] = implode ( '<br>', $values );
    };
}

if ( $show_current_teams ) {
    $current_teams = array_filter ( $player->current_teams() );

    if ( $current_teams ) {
        $teams = array();

        foreach ( $current_teams as $team ) {
            $team_name = sp_team_short_name ( $team );

            if ( $link_teams ) {
                $team_name = '<a href="' . get_post_permalink ( $team ) . '">' . $team_name . '</a>';
            }

            $teams[] = $team_name;
        };

        $data[ 'current_teams' ] = implode ( ', ', $teams );
    };
};

if ( $show_past_teams ) {
    $past_teams = array_filter ( $player->past_teams() );

    if ( $past_teams ) {
        $teams = array();

        foreach ( $past_teams as $team ) {
            $team_name = sp_team_short_name ( $team );

            if ( $link_teams ) {
                $team_name = '<a href="' . get_post_permalink ( $team ) . '">' . $team_name . '</a>';
            }

            $teams[] = $team_name;
        };

        $data[ 'past_teams' ] = implode ( ', ', $teams );
    };
};

if ( $show_leagues ) {
    $leagues = $player->leagues();

    if ( $leagues && ! is_wp_error ( $leagues ) ) {
        $terms = array();

        foreach ( $leagues as $league ) {
            $terms[] = $league->name;
        }

        $data[ 'leagues' ] = implode ( ', ', $terms );
    };
};

if ( $show_seasons ) {
    $seasons = $player->seasons();

    if ( $seasons && ! is_wp_error ( $seasons ) ) {
        $terms = array();

        foreach ( $seasons as $season ) {
            $terms[] = $season->name;
        }

        $data[ 'seasons' ] = implode ( ', ', $terms );
    };
};

$metrics_after = $player->metrics ( false );

$data = array_merge ( $data, $metrics_after );

if ( empty( $data ) )
    return;

$html = '<div class="qodef-e-details">';

foreach ( $data as $label => $value ) {

    $html .= '<span class="qodef-e-details-item">';

    if ( 'age' === $label ) {
        $html .= esc_html__( 'Age: ', 'topscorer-core' );
    }

    $html .= $value;
    $html .= '</span>';

    if ( false !== next ( $data ) ) {
        $html .= '<span class="qodef-e-details-separator"> | </span>';
    }

};

$html .= '</div>';

echo wp_kses_post ( $html );
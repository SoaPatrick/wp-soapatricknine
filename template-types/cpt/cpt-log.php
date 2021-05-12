<?php
/**
 * Custom post type Log
 *
 * @link https://generatewp.com/post-type/
 *
 * @package soapatricknine
 */

function soapatricknine_add_cpt_log() {

  $labels = array(
    'name'                  => _x( 'Log', 'Post Type General Name', 'soapatricknine' ),
    'singular_name'         => _x( 'Log', 'Post Type Singular Name', 'soapatricknine' ),
    'menu_name'             => __( 'Log', 'soapatricknine' ),
  );
  $args = array(
    'label'                 => __( 'Log', 'soapatricknine' ),
    'description'           => __( 'Changelogs', 'soapatricknine' ),
    'labels'                => $labels,
    'supports'              => array( 'title' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 6,
    'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M304 192c-38 0-69.8 26.5-77.9 62-23.9-3.5-58-12.9-83.9-37.6-16.6-15.9-27.9-36.5-33.7-61.6C138.6 143.3 160 114.1 160 80c0-44.2-35.8-80-80-80S0 35.8 0 80c0 35.8 23.5 66.1 56 76.3v199.3C23.5 365.9 0 396.2 0 432c0 44.2 35.8 80 80 80s80-35.8 80-80c0-35.8-23.5-66.1-56-76.3V246.1c1.6 1.7 3.3 3.4 5 5 39.3 37.5 90.4 48.6 121.2 51.8 12.1 28.9 40.6 49.2 73.8 49.2 44.2 0 80-35.8 80-80S348.2 192 304 192zM80 64c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16 7.2-16 16-16zm0 384c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16zm224-160c-8.8 0-16-7.2-16-16s7.2-16 16-16 16 7.2 16 16-7.2 16-16 16z"></path></svg>'),
    'show_in_admin_bar'     => false,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    "rewrite"               => array( "slug" => "log", "with_front" => false ),
    'capability_type'       => 'post',
    'show_in_rest'          => false,
  );
  register_post_type( 'log', $args );

}
add_action( 'init', 'soapatricknine_add_cpt_log', 0 );

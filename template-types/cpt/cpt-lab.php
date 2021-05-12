<?php
/**
 * Custom post type Lab
 *
 * @link https://generatewp.com/post-type/
 *
 * @package soapatricknine
 */

function soapatricknine_add_cpt_lab() {

  $labels = array(
    'name'                  => _x( 'Lab', 'Post Type General Name', 'soapatricknine' ),
    'singular_name'         => _x( 'Lab', 'Post Type Singular Name', 'soapatricknine' ),
    'menu_name'             => __( 'Lab', 'soapatricknine' ),
    'name_admin_bar'        => __( 'Lab Item', 'soapatricknine' ),
    'view_items'            => __( 'View Lab', 'soapatricknine' ),
    'view_item'             => __( 'View Lab Item', 'soapatricknine' ),
    'search_items'          => __( 'Search Lab', 'soapatricknine' ),
  );
  $args = array(
    'label'                 => __( 'Lab', 'soapatricknine' ),
    'description'           => __( 'Lab Items', 'soapatricknine' ),
    'labels'                => $labels,
    'supports'              => array( 'title','thumbnail' ),
    'taxonomies'            => array( '' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M437.2 403.5L320 215V64h8c13.3 0 24-10.7 24-24V24c0-13.3-10.7-24-24-24H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h8v151L10.8 403.5C-18.5 450.6 15.3 512 70.9 512h306.2c55.7 0 89.4-61.5 60.1-108.5zM137.9 320l48.2-77.6c3.7-5.2 5.8-11.6 5.8-18.4V64h64v160c0 6.9 2.2 13.2 5.8 18.4l48.2 77.6h-172z"></path></svg>'),
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    "rewrite"               => array( "slug" => "lab", "with_front" => false ),
    'capability_type'       => 'post',
    'show_in_rest'          => false,
  );
  register_post_type( 'lab', $args );

}
add_action( 'init', 'soapatricknine_add_cpt_lab', 0 );

<?php
/**
 * Custom post type Factory
 *
 * @link https://generatewp.com/post-type/
 *
 * @package soapatricknine
 */

function soapatricknine_add_cpt_factory() {

  $labels = array(
    'name'                  => 'Factory',
    'singular_name'         => 'Factory',
    'menu_name'             => 'Factory',
    'name_admin_bar'        => 'Factory Item',
    'view_items'            => 'View Factory',
    'view_item'             => 'View Factory Item',
    'search_items'          => 'Search Factory',
  );
  $args = array(
    'label'                 => 'Factory',
    'description'           => 'Factory Items',
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
    'taxonomies'            => array( 'factory_tags' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M475.115 163.781L336 252.309v-68.28c0-18.916-20.931-30.399-36.885-20.248L160 252.309V56c0-13.255-10.745-24-24-24H24C10.745 32 0 42.745 0 56v400c0 13.255 10.745 24 24 24h464c13.255 0 24-10.745 24-24V184.029c0-18.917-20.931-30.399-36.885-20.248zM404 384h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm-128 0h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm-128 0h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12z"></path></svg>'),
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    "rewrite"               => array( "slug" => "factory", "with_front" => false ),
    'capability_type'       => 'post',
    'show_in_rest'          => true,
  );
  register_post_type( 'factory', $args );

}
add_action( 'init', 'soapatricknine_add_cpt_factory', 1 );

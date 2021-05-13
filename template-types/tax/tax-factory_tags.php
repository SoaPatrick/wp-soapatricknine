<?php
/**
 * Custom taxonomy Factory Tag
 *
 * @link https://generatewp.com/taxonomy/
 *
 * @package soapatricknine
 */

function soapatricknine_add_tax_factory_tags() {

  $labels = [
    'name'                       => 'Factory Tag',
    'singular_name'              => 'Factory Tag',
    'menu_name'                  => 'Factory Tag',
    'all_items'                  => 'All Factory Tags',
    'parent_item'                => 'Parent Factory Tag',
    'parent_item_colon'          => 'Parent Factory Tag:',
    'new_item_name'              => 'New Factory Tag Name',
    'add_new_item'               => 'Add New Factory Tag',
    'edit_item'                  => 'Edit Factory Tag',
    'update_item'                => 'Update Factory Tag',
    'view_item'                  => 'View Factory Tag',
    'separate_items_with_commas' => 'Separate Factory Tags with commas',
    'add_or_remove_items'        => 'Add or remove Factory Tags',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Factory Tags',
    'search_items'               => 'Search Factory Tags',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No Factory Tags',
    'items_list'                 => 'Factory Tags list',
    'items_list_navigation'      => 'Factory Tags list navigation',
  ];
  $args = [
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
    "rewrite"                     => array( 'slug' => 'factory-tag', 'with_front' => false, ),
    'show_in_rest'               => true,
    'publicly_queryable'         => true,
  ];
  register_taxonomy( "factory_tags", [ "factory" ], $args );

}
add_action( 'init', 'soapatricknine_add_tax_factory_tags' );

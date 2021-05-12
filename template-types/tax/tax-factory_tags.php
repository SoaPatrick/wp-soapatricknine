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
    'name'                       => _x( 'Factory Tag', 'Taxonomy General Name', 'soapatricknine' ),
    'singular_name'              => _x( 'Factory Tag', 'Taxonomy Singular Name', 'soapatricknine' ),
    'menu_name'                  => __( 'Factory Tag', 'soapatricknine' ),
    'all_items'                  => __( 'All Factory Tags', 'soapatricknine' ),
    'parent_item'                => __( 'Parent Factory Tag', 'soapatricknine' ),
    'parent_item_colon'          => __( 'Parent Factory Tag:', 'soapatricknine' ),
    'new_item_name'              => __( 'New Factory Tag Name', 'soapatricknine' ),
    'add_new_item'               => __( 'Add New Factory Tag', 'soapatricknine' ),
    'edit_item'                  => __( 'Edit Factory Tag', 'soapatricknine' ),
    'update_item'                => __( 'Update Factory Tag', 'soapatricknine' ),
    'view_item'                  => __( 'View Factory Tag', 'soapatricknine' ),
    'separate_items_with_commas' => __( 'Separate Factory Tags with commas', 'soapatricknine' ),
    'add_or_remove_items'        => __( 'Add or remove Factory Tags', 'soapatricknine' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'soapatricknine' ),
    'popular_items'              => __( 'Popular Factory Tags', 'soapatricknine' ),
    'search_items'               => __( 'Search Factory Tags', 'soapatricknine' ),
    'not_found'                  => __( 'Not Found', 'soapatricknine' ),
    'no_terms'                   => __( 'No Factory Tags', 'soapatricknine' ),
    'items_list'                 => __( 'Factory Tags list', 'soapatricknine' ),
    'items_list_navigation'      => __( 'Factory Tags list navigation', 'soapatricknine' ),
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

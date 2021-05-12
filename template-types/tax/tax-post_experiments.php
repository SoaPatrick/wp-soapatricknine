<?php
/**
 * Custom taxonomy Post Projects
 *
 * @link https://generatewp.com/taxonomy/
 *
 * @package soapatricknine
 */

function soapatricknine_add_tax_projects() {

  $labels = [
    'name'                       => _x( 'Project', 'Taxonomy General Name', 'soapatricknine' ),
    'singular_name'              => _x( 'Project', 'Taxonomy Singular Name', 'soapatricknine' ),
    'menu_name'                  => __( 'Projects', 'soapatricknine' ),
    'all_items'                  => __( 'All Projects', 'soapatricknine' ),
    'parent_item'                => __( 'Parent Project', 'soapatricknine' ),
    'parent_item_colon'          => __( 'Parent Project:', 'soapatricknine' ),
    'new_item_name'              => __( 'New Project Name', 'soapatricknine' ),
    'add_new_item'               => __( 'Add New Project', 'soapatricknine' ),
    'edit_item'                  => __( 'Edit Project', 'soapatricknine' ),
    'update_item'                => __( 'Update Project', 'soapatricknine' ),
    'view_item'                  => __( 'View Project', 'soapatricknine' ),
    'separate_items_with_commas' => __( 'Separate Projects with commas', 'soapatricknine' ),
    'add_or_remove_items'        => __( 'Add or remove Projects', 'soapatricknine' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'soapatricknine' ),
    'popular_items'              => __( 'Popular Projects', 'soapatricknine' ),
    'search_items'               => __( 'Search Projects', 'soapatricknine' ),
    'not_found'                  => __( 'Not Found', 'soapatricknine' ),
    'no_terms'                   => __( 'No Projects', 'soapatricknine' ),
    'items_list'                 => __( 'Projects list', 'soapatricknine' ),
    'items_list_navigation'      => __( 'Projects list navigation', 'soapatricknine' ),
  ];
  $args = [
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
    "rewrite"                     => array( 'slug' => 'projects', 'with_front' => false, ),
    'show_in_rest'               => true,
    'publicly_queryable'         => false,
  ];
  register_taxonomy( "projects", [ "post" ], $args );

}
add_action( 'init', 'soapatricknine_add_tax_projects' );

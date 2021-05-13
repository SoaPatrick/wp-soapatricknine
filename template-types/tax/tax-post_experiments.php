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
    'name'                       => 'Project',
    'singular_name'              => 'Project',
    'menu_name'                  => 'Projects',
    'all_items'                  => 'All Projects',
    'parent_item'                => 'Parent Project',
    'parent_item_colon'          => 'Parent Project:',
    'new_item_name'              => 'New Project Name',
    'add_new_item'               => 'Add New Project',
    'edit_item'                  => 'Edit Project',
    'update_item'                => 'Update Project',
    'view_item'                  => 'View Project',
    'separate_items_with_commas' => 'Separate Projects with commas',
    'add_or_remove_items'        => 'Add or remove Projects',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Projects',
    'search_items'               => 'Search Projects',
    'not_found'                  => 'Not Found',
    'no_terms'                   => 'No Projects',
    'items_list'                 => 'Projects list',
    'items_list_navigation'      => 'Projects list navigation',
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

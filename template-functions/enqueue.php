<?php
/**
 * Enqueue scripts and styles.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 *
 * @package soapatricknine
 */

function soapatricknine_scripts() {
  wp_dequeue_style( 'wp-block-library' );

  if ( 'local' === wp_get_environment_type() ) {
    wp_enqueue_style( 'soapatricknine-style', get_template_directory_uri() . '/assets/css/app.css', '', rand(1,10000) );
  } else {
    wp_enqueue_style( 'soapatricknine-style', get_template_directory_uri() . '/assets/css/app.css' );
  }
  wp_enqueue_script( 'soapatricknine-scripts', get_template_directory_uri() . '/assets/js/scripts.js', '','' , true );

  if( is_post_type_archive('log') ) {
    wp_enqueue_script( 'infinite-scroll', 'https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js', '','' , true );
  }


    wp_enqueue_script( 'fslightbox-scripts', get_template_directory_uri() . '/assets/fslightbox/fslightbox.js', '','' , true );

 
}
add_action( 'wp_enqueue_scripts', 'soapatricknine_scripts' );


function soapatricknine_admin_styles() {
  wp_register_style( 'soapatricknine-admin-styles', get_template_directory_uri() . '/style-admin.css', false, '1.0.0' );
  wp_enqueue_style( 'soapatricknine-admin-styles' );
}
add_action( 'admin_enqueue_scripts', 'soapatricknine_admin_styles' );

// Remove Emojiscript
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Deregister Embed script
 */
function soapatricknine_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'soapatricknine_deregister_scripts' );

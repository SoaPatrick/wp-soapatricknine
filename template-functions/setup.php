<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @package soapatricknine
 */

if ( ! function_exists( 'soapatricknine_setup' ) ) :
  function soapatricknine_setup() {

    // Make theme available for translation.
    load_theme_textdomain( 'soapatricknine', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // disable comments feed
    add_filter( 'feed_links_show_comments_feed', '__return_false' );     

    //Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Enable support for Post Formats
    add_theme_support( 'post-formats', array( 'status', 'link', 'quote', 'image', 'video' ) );

    // Add Theme Support for wide and full-width images.
    add_theme_support( 'align-wide' );

    // Disable all Gutenberg color options.
    add_theme_support( 'editor-color-palette' );
    add_theme_support( 'disable-custom-colors' );

    // change default image sizes
    update_option( 'thumbnail_size_w', 150 );
    update_option( 'thumbnail_size_h', 150 );
    update_option( 'thumbnail_crop', 1 );
    update_option( 'medium_size_w', 750 );
    update_option( 'medium_size_h', 0 );
    update_option( 'large_size_w', 1500 );
    update_option( 'large_size_h', 0 );

    // Switch default core markup for search form, comment form, and comments.
    add_theme_support( 'html5', array(
      'search-form',
      'gallery',
      'caption',
    ) );
  }
endif;
add_action( 'after_setup_theme', 'soapatricknine_setup' );

<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package soapatricknine
 */

/**
 * Allow only certain Gutenberg Blocks
 */
function soapatricknine_allowed_block_types( $allowed_blocks ) {

  return array(
    'core/paragraph',
    'core/image',
    'core/heading',
    'core/gallery',
    'core/list',
    'core/quote',
    'core/video',
    'core/code',
    'core/columns',
    'core-embed/youtube',
  );
}
add_filter( 'allowed_block_types', 'soapatricknine_allowed_block_types' );

/**
 * posted on functions for blog posts
 *
 */
if ( ! function_exists( 'soapatricknine_posted_on' ) ) :
  function soapatricknine_posted_on() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    $time_string = sprintf( $time_string, esc_attr( get_the_date( DATE_W3C ) ), esc_html( get_the_date() ) );
    $posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

    echo  '<div>' . $time_string .' </div>'; // WPCS: XSS OK.
  }
endif;


/**
 * tags function for blog posts and factory items
 *
 */
if ( ! function_exists( 'soapatricknine_tags' ) ) :
  function soapatricknine_tags() {

    if ( 'post' === get_post_type() ) {
      $tags_list = get_the_term_list( $post->ID , 'post_tag', '', '' );
    }

    if ( 'factory' === get_post_type() ) {
      $tags_list = get_the_term_list( $post->ID , 'factory_tags', '', '' );
    }

    if ( $tags_list ) {
      echo '<div class="tags">' . $tags_list . '</div>';
    }
  }
endif;


/**
 * Edit link for blog posts and factory items
 *
 */
if ( ! function_exists( 'soapatricknine_edit_post' ) ) :
  function soapatricknine_edit_post() {
    edit_post_link( '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M493.255 56.236l-37.49-37.49c-24.993-24.993-65.515-24.994-90.51 0L12.838 371.162.151 485.346c-1.698 15.286 11.22 28.203 26.504 26.504l114.184-12.687 352.417-352.417c24.992-24.994 24.992-65.517-.001-90.51zm-95.196 140.45L174 420.745V386h-48v-48H91.255l224.059-224.059 82.745 82.745zM126.147 468.598l-58.995 6.555-30.305-30.305 6.555-58.995L63.255 366H98v48h48v34.745l-19.853 19.853zm344.48-344.48l-49.941 49.941-82.745-82.745 49.941-49.941c12.505-12.505 32.748-12.507 45.255 0l37.49 37.49c12.506 12.506 12.507 32.747 0 45.255z"></path></svg>', '<div class="edit">', '</div>' );
  }
endif;


/**
 * function for single post navigation
 *
 */
if ( ! function_exists( 'soapatricknine_post_navigation' ) ) :
  function soapatricknine_post_navigation() {
    echo '<nav class="post-navigation post-navigation--single">';
    next_post_link( '%link', __( 'newer &rarr;', 'soapatricknine' ) );
    previous_post_link('%link', __( '&larr; older', 'soapatricknine' ) );
    echo '</nav>';
  }
endif;


/**
 * function for posts navigation
 *
 */
if ( ! function_exists( 'soapatricknine_posts_navigation' ) ) :
	function soapatricknine_posts_navigation() {
    echo '<nav class="post-navigation">';
    if ( 'post' === get_post_type() ) {
      posts_nav_link( ' ', __( 'newer &rarr;', 'soapatricknine' ), __( '&larr; older', 'soapatricknine' ) );
    }
    if ( 'factory' === get_post_type() || 'lab' === get_post_type() ) {
      posts_nav_link( ' ', __( 'newer &rarr;', 'soapatricknine' ), __( '&larr; older', 'soapatricknine' ) );
    }
    if ( 'log' === get_post_type() ) {
      next_posts_link( __( 'load more &darr;', 'soapatricknine' ) );
    }
    echo '</nav>';
	}
endif;


/**
 * add classes to next and previous Posts
 *
 */
add_filter('next_posts_link_attributes', 'soapatricknine_next_posts_link_class');
add_filter('previous_posts_link_attributes', 'soapatricknine_previous_posts_link_class');
function soapatricknine_next_posts_link_class() {
  return 'class="post-navigation__previous"';
}
function soapatricknine_previous_posts_link_class() {
  return 'class="post-navigation__next"';
}

/**
 * add classes to next and previous Post
 *
 */
add_filter('next_post_link', 'soapatricknine_next_post_link_class');
add_filter('previous_post_link', 'soapatricknine_previous_post_link_class');
function soapatricknine_next_post_link_class($format){
  $format = str_replace('href=', 'class="post-navigation__next" href=', $format);
  return $format;
}
function soapatricknine_previous_post_link_class($format) {
  $format = str_replace('href=', 'class="post-navigation__previous" href=', $format);
  return $format;
}


/**
 * Remove default image sizes from generating
 *
 */
function soapatricknine_remove_default_image_sizes( $sizes ) {
  unset( $sizes[ 'medium_large' ]);
  unset( $sizes[ '1536x1536' ]);
  unset( $sizes[ '2048x2048' ]);

  return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'soapatricknine_remove_default_image_sizes' );


/**
 * Attach a class to linked images' parent anchors
 * Works for existing content
 *
 */
function soapatricknine_give_linked_images_class($content) {
  $classes = 'img-link'; // separate classes by spaces - 'img image-link'
  // check if there are already a class property assigned to the anchor
  if ( preg_match('/<a.*? class=".*?"><img/', $content) ) {
    // If there is, simply add the class
    $content = preg_replace('/(<a.*? class=".*?)(".*?><img)/', '$1 ' . $classes . '$2', $content);
  } else {
    // If there is not an existing class, create a class property
    $content = preg_replace('/(<a.*?)><img/', '$1 class="' . $classes . '" ><img', $content);
  }
  return $content;
}
//add_filter('the_content','soapatricknine_give_linked_images_class');


/**
 * wrap all iframes within content with a div and class
 *
 */
function soapatricknine_iframe_wrapper($content) {
  $pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
  preg_match_all($pattern, $content, $matches);

  foreach ($matches[0] as $match) {
    $wrappedframe = '<div class="responsive-container">' . $match . '</div>';
    $content = str_replace($match, $wrappedframe, $content);
  }

  return $content;
}
//add_filter('the_content', 'soapatricknine_iframe_wrapper');

/**
 * Replace Youtube Videos with Preview Image instead
 * of embeded iFrame, play video on click
 *
 */
function soapatricknine_youtube_embeded($content){
  //youtube.com\^(?!href=)
  if (preg_match_all('#(?<!href\=\")https\:\/\/www.youtube.com\/watch\?([\\\&\;\=\w\d]+|)v\=[\w\d]{11}+([\\\&\;\=\w\d]+|)(?!\"\>)#', $content, $youtube_match)) {
    foreach ($youtube_match[0] as $youtube_url) {
      parse_str( parse_url( wp_specialchars_decode( $youtube_url ), PHP_URL_QUERY ), $youtube_video );
      if (isset($youtube_video['v'])){
        $content = str_replace($youtube_url, '<div class="youtube-wrapper"><div class="youtube-wrapper__video" data-id="'.$youtube_video['v'].'"></div></div>', $content);
      }
    }
  }
  //youtu.be
  if (preg_match_all('#(?<!href\=\")https\:\/\/youtu.be/([\\\&\;\=\w\d]+|)(?!\"\>)#', $content, $youtube_match)){
    foreach ($youtube_match[0] as $youtube_url) {
      $youtube_video = str_replace('https://youtu.be/', '', $youtube_url);
      if (isset($youtube_video)){
        $content = str_replace($youtube_url, '<div class="youtube-wrapper"><div class="youtube-wrapper__video" data-id="'.$youtube_video.'"></div></div>', $content);
      }
    }
  }
  return $content;
}
add_filter('the_content', 'soapatricknine_youtube_embeded',1);


/**
 * Remove archive title prefixes.
 *
 */
function soapatricknine_archive_title( $title ) {
  // Remove any HTML, words, digits, and spaces before the title.
  return preg_replace( '#^[\w\d\s]+:\s*#', '', strip_tags( $title ) );
}
add_filter( 'get_the_archive_title', 'soapatricknine_archive_title' );


/**
 * Adding simple page title to home page
 *
 */
function soapatricknine_home_page_title( $title ) {
  if ( is_home() ):
    return get_bloginfo('name');
  endif;
}
add_filter( 'pre_get_document_title', 'soapatricknine_home_page_title' );


/**
 * Adding noindex to specific pages that shouldn't be indexed
 *
 */
function soapatricknine_add_robots_noindes($output) {
  if($paged > 1 || is_author() || is_tag() || is_date() || is_attachment() || is_singular('log') || is_post_type_archive('lab') || is_singular('lab') || is_post_type_archive('log') || is_tax('factory_tags') || is_page('storage') || is_page('tags')) {
    echo '<meta name="robots" content="noindex">';
  }
}
add_action('wp_head', 'soapatricknine_add_robots_noindes', 1);


/**
 * Adding the Open Graph in the Language Attributes
 *
 */
function soapatricknine_add_opengraph_doctype($output) {
  return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_action('wp_head', 'soapatricknine_add_opengraph_doctype', 1);


/**
 * add Open Graph Meta Info
 *
 */
function soapatricknine_add_opengraph_infos() {

  global $post;
  $default_image = get_template_directory_uri().'/assets/favicon/android-chrome-512x512.png';

  // if page is not single
  if ( !is_singular() ) {
    echo '<meta name="description" content="' . get_bloginfo('description') . '"/>';
    echo '<meta property="og:type" content="article"/>';
    echo '<meta property="og:title" content="' . get_bloginfo('name') . '"/>';
    echo '<meta property="og:description" content="' . get_bloginfo('description') . '"/>';
    echo '<meta property="og:image" content="' . $default_image . '"/>';
    echo '<meta name="twitter:image" content="' . $default_image . '"/>';
    return;
  }

  // if post has excerpt or not
  if ($excerpt = $post->post_excerpt) {
    $excerpt = esc_html(strip_tags($post->post_excerpt));
  } else {
    $excerpt = esc_html(wp_trim_words($post->post_content,20));
  }

  // basic meta infos
  echo '<meta name="description" content="' . $excerpt . '"/>';
  echo '<meta property="og:type" content="article"/>';
  echo '<meta property="og:title" content="' . get_the_title() . '"/>';
  echo '<meta property="og:description" content="' . $excerpt . '"/>';
  echo '<meta property="og:url" content="' . get_permalink() . '"/>';
  echo '<meta property="og:site_name" content="' . get_bloginfo() . '"/>';

  // if post has featured image or not
  if ( !has_post_thumbnail($post->ID) ) {
    echo '<meta property="og:image" content="' . $default_image . '"/>';
  } else {
  $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
    echo '<meta property="og:image" content="' . esc_attr($thumbnail_src[0]) . '"/>';
  }

  echo '<meta name="twitter:title" content="' . get_the_title() . '"/>';
  echo '<meta name="twitter:card" content="summary" />';
  echo '<meta name="twitter:description" content="' . $excerpt . '" />';
  echo '<meta name="twitter:url" content="' . get_permalink() . '"/>';

  // if post has featured image or not
  if ( !has_post_thumbnail($post->ID) ) {
    echo '<meta name="twitter:image" content="' . $default_image . '"/>';
  } else {
    $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
    echo '<meta name="twitter:image" content="' . esc_attr($thumbnail_src[0]) . '"/>';
  }
}
add_action('wp_head', 'soapatricknine_add_opengraph_infos', 1);


/**
 * Strip body of unwanted classes
 *
 */
function soapatricknine_body_class( $wp_classes, $extra_classes ) {
  // List of the only WP generated classes allowed
  $whitelist = array( 'admin-bar', 'single' );

  // List of the only WP generated classes that are not allowed
  $blacklist = array( 'home', 'blog', 'archive', 'single', 'category', 'tag', 'error404', 'logged-in', 'admin-bar' );

  // Filter the body classes
  // Whitelist result: (comment if you want to blacklist classes)
  $wp_classes = array_intersect( $wp_classes, $whitelist );
  // Blacklist result: (uncomment if you want to blacklist classes)
  # $wp_classes = array_diff( $wp_classes, $blacklist );

  // Add the extra classes back untouched
  return array_merge( $wp_classes, (array) $extra_classes );
}
add_filter( 'body_class', 'soapatricknine_body_class', 10, 2 );


/**
 * output different svg icons
 *
 */
if ( ! function_exists( 'soapatricknine_svg_icons' ) ) :
  function soapatricknine_svg_icons($icon) {

    switch ($icon) {
      case 'added':
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M384 250v12c0 6.6-5.4 12-12 12h-98v98c0 6.6-5.4 12-12 12h-12c-6.6 0-12-5.4-12-12v-98h-98c-6.6 0-12-5.4-12-12v-12c0-6.6 5.4-12 12-12h98v-98c0-6.6 5.4-12 12-12h12c6.6 0 12 5.4 12 12v98h98c6.6 0 12 5.4 12 12zm120 6c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-32 0c0-119.9-97.3-216-216-216-119.9 0-216 97.3-216 216 0 119.9 97.3 216 216 216 119.9 0 216-97.3 216-216z"></path></svg>';
        break;
      case 'removed':
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M140 274c-6.6 0-12-5.4-12-12v-12c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v12c0 6.6-5.4 12-12 12H140zm364-18c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-32 0c0-119.9-97.3-216-216-216-119.9 0-216 97.3-216 216 0 119.9 97.3 216 216 216 119.9 0 216-97.3 216-216z"></path></svg>';
        break;
      case 'fixed':
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline"><path fill="currentColor" d="M544 272h-64V150.627l35.313-35.313c6.249-6.248 6.249-16.379 0-22.627-6.248-6.248-16.379-6.248-22.627 0L457.373 128H417C417 57.26 359.751 0 289 0c-70.74 0-128 57.249-128 128h-42.373L75.314 84.687c-6.249-6.248-16.379-6.248-22.628 0-6.248 6.248-6.248 16.379 0 22.627L96 150.627V272H32c-8.836 0-16 7.163-16 16s7.164 16 16 16h64v24c0 36.634 11.256 70.686 30.484 98.889l-57.797 57.797c-6.249 6.248-6.249 16.379 0 22.627 6.249 6.249 16.379 6.248 22.627 0l55.616-55.616C178.851 483.971 223.128 504 272 504h32c48.872 0 93.149-20.029 125.071-52.302l55.616 55.616c6.249 6.249 16.379 6.248 22.627 0 6.249-6.248 6.249-16.379 0-22.627l-57.797-57.797C468.744 398.686 480 364.634 480 328v-24h64c8.837 0 16-7.163 16-16s-7.163-16-16-16zM289 32c53.019 0 96 42.981 96 96H193c0-53.019 42.981-96 96-96zm15 440V236c0-6.627-5.373-12-12-12h-8c-6.627 0-12 5.373-12 12v236c-79.402 0-144-64.599-144-144V160h320v168c0 79.401-64.599 144-144 144z"></path></svg>';
        break;
      case 'changed':
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M507.42 114.49c-2.34-9.47-9.66-16.98-19.06-19.61-9.47-2.61-19.65 0-26.65 6.98l-63.87 63.87-44.25-7.36-7.38-44.24 63.87-63.87c6.94-6.92 9.62-17.09 7-26.54-2.62-9.47-10.19-16.83-19.75-19.2C345.6-8.31 291.95 6.54 254.14 44.3c-37.84 37.87-52.21 92.52-38.62 144.7L22.19 382.29c-29.59 29.63-29.59 77.83 0 107.45C36.54 504.09 55.63 512 75.94 512s39.37-7.91 53.71-22.26l193.14-193.11c52.03 13.73 106.8-.72 144.89-38.82 37.81-37.81 52.68-91.39 39.74-143.32zm-62.36 120.7c-31.87 31.81-78.43 42.63-121.77 28.23l-9.38-3.14-206.88 206.84c-16.62 16.62-45.59 16.62-62.21 0-17.12-17.14-17.12-45.06 0-62.21l207.01-206.98-3.09-9.34c-14.31-43.45-3.56-90.06 28.03-121.67C299.48 44.2 329.44 32 360.56 32c6.87 0 13.81.59 20.72 1.81l-69.31 69.35 13.81 83.02L408.84 200l69.3-69.35c6.72 38.25-5.34 76.79-33.08 104.54zM80 416c-8.84 0-16 7.16-16 16s7.16 16 16 16 16-7.16 16-16-7.16-16-16-16z"></path></svg>';
        break;
      case 'quote':
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M176 32H64C28.7 32 0 60.7 0 96v128c0 35.3 28.7 64 64 64h64v24c0 30.9-25.1 56-56 56H56c-22.1 0-40 17.9-40 40v32c0 22.1 17.9 40 40 40h16c92.6 0 168-75.4 168-168V96c0-35.3-28.7-64-64-64zm32 280c0 75.1-60.9 136-136 136H56c-4.4 0-8-3.6-8-8v-32c0-4.4 3.6-8 8-8h16c48.6 0 88-39.4 88-88v-56H64c-17.7 0-32-14.3-32-32V96c0-17.7 14.3-32 32-32h112c17.7 0 32 14.3 32 32v216zM448 32H336c-35.3 0-64 28.7-64 64v128c0 35.3 28.7 64 64 64h64v24c0 30.9-25.1 56-56 56h-16c-22.1 0-40 17.9-40 40v32c0 22.1 17.9 40 40 40h16c92.6 0 168-75.4 168-168V96c0-35.3-28.7-64-64-64zm32 280c0 75.1-60.9 136-136 136h-16c-4.4 0-8-3.6-8-8v-32c0-4.4 3.6-8 8-8h16c48.6 0 88-39.4 88-88v-56h-96c-17.7 0-32-14.3-32-32V96c0-17.7 14.3-32 32-32h112c17.7 0 32 14.3 32 32v216z"></path></svg>';
        break;
      case 'link':
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M301.148 394.702l-79.2 79.19c-50.778 50.799-133.037 50.824-183.84 0-50.799-50.778-50.824-133.037 0-183.84l79.19-79.2a132.833 132.833 0 0 1 3.532-3.403c7.55-7.005 19.795-2.004 20.208 8.286.193 4.807.598 9.607 1.216 14.384.481 3.717-.746 7.447-3.397 10.096-16.48 16.469-75.142 75.128-75.3 75.286-36.738 36.759-36.731 96.188 0 132.94 36.759 36.738 96.188 36.731 132.94 0l79.2-79.2.36-.36c36.301-36.672 36.14-96.07-.37-132.58-8.214-8.214-17.577-14.58-27.585-19.109-4.566-2.066-7.426-6.667-7.134-11.67a62.197 62.197 0 0 1 2.826-15.259c2.103-6.601 9.531-9.961 15.919-7.28 15.073 6.324 29.187 15.62 41.435 27.868 50.688 50.689 50.679 133.17 0 183.851zm-90.296-93.554c12.248 12.248 26.362 21.544 41.435 27.868 6.388 2.68 13.816-.68 15.919-7.28a62.197 62.197 0 0 0 2.826-15.259c.292-5.003-2.569-9.604-7.134-11.67-10.008-4.528-19.371-10.894-27.585-19.109-36.51-36.51-36.671-95.908-.37-132.58l.36-.36 79.2-79.2c36.752-36.731 96.181-36.738 132.94 0 36.731 36.752 36.738 96.181 0 132.94-.157.157-58.819 58.817-75.3 75.286-2.651 2.65-3.878 6.379-3.397 10.096a163.156 163.156 0 0 1 1.216 14.384c.413 10.291 12.659 15.291 20.208 8.286a131.324 131.324 0 0 0 3.532-3.403l79.19-79.2c50.824-50.803 50.799-133.062 0-183.84-50.802-50.824-133.062-50.799-183.84 0l-79.2 79.19c-50.679 50.682-50.688 133.163 0 183.851z"></path></svg>';
        break;
      case 'image':
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline"><path fill="currentColor" d="M112 192a48 48 0 1 0-48-48 48 48 0 0 0 48 48zm0-64a16 16 0 1 1-16 16 16 16 0 0 1 16-16zm304-96H32A32 32 0 0 0 0 64v384a32 32 0 0 0 32 32h384a32 32 0 0 0 32-32V64a32 32 0 0 0-32-32zm0 416H32v-80h384zM85.2 336l52-69.33 40 53.33-12 16zm120 0l76-101.33 76 101.33zm210.8 0h-18.8L294 198.41c-6.06-8.07-19.56-8.07-25.62 0l-71.19 94.91L150 230.41c-6.06-8.07-19.56-8.07-25.62 0L45.18 336H32V64h384z"></path></svg>';
        break;
      case 'video':
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M488 64h-8v20c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12V64H96v20c0 6.6-5.4 12-12 12H44c-6.6 0-12-5.4-12-12V64h-8C10.7 64 0 74.7 0 88v336c0 13.3 10.7 24 24 24h8v-20c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v20h320v-20c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v20h8c13.3 0 24-10.7 24-24V88c0-13.3-10.7-24-24-24zM96 372c0 6.6-5.4 12-12 12H44c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm0-96c0 6.6-5.4 12-12 12H44c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm0-96c0 6.6-5.4 12-12 12H44c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm288 224c0 6.6-5.4 12-12 12H140c-6.6 0-12-5.4-12-12V284c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v120zm0-176c0 6.6-5.4 12-12 12H140c-6.6 0-12-5.4-12-12V108c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v120zm96 144c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm0-96c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40zm0-96c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40z"></path></svg>';
        break;
      case 'status':
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline"><path fill="currentColor" d="M115.2 70.4v121.792c-12.189-5.437-27.01-9.791-44.8-9.791C29.922 182.4 0 214.687 0 256c0 48.546 53.853 57.8 76.315 71.683 17.761 11.062 57.069 42.869 67.144 60.919C134.194 394.208 128 404.38 128 416v64c0 17.673 14.327 32 32 32h224c17.673 0 32-14.327 32-32v-64c0-9.167-3.861-17.428-10.038-23.262C413.719 358.089 448 321.746 448 267.636V244.4c0-59.606-36.084-90.256-85.87-88.631-17.108-14.3-42.155-21.279-65.494-16.635-11.856-7.229-25.395-11.348-39.582-11.885a92.713 92.713 0 0 0-1.054-.033V70.4C256 32.063 224.084 0 185.6 0c-38.161 0-70.4 32.77-70.4 70.4zM160 480v-64h224v64H160zm64-409.6v99.301c16.003-14.004 46.718-15.726 66.6 5.4 21.431-12.247 49.771-1.841 58.5 14.1 42.685-7.116 66.9 10.993 66.9 55.201v23.236c0 44.337-31.267 76.684-40.861 116.364H176.462c-10.706-29.835-59.818-68.904-83.262-83.5C67.686 284.704 32 280 32 256s16-41.6 38.4-41.6c38.4 0 57.9 28.8 76.8 28.8V70.4c0-20.1 18-38.4 38.4-38.4 20.7 0 38.4 17.7 38.4 38.4zM352 428c11.046 0 20 8.954 20 20s-8.954 20-20 20-20-8.954-20-20 8.954-20 20-20z"></path></svg>';
        break;
      case 'lab';
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline"><path fill="currentColor" d="M434.9 410.7L288 218.6V32h26c3.3 0 6-2.7 6-6V6c0-3.3-2.7-6-6-6H134c-3.3 0-6 2.7-6 6v20c0 3.3 2.7 6 6 6h26v186.6L13.1 410.7C-18.6 452.2 11 512 63.1 512h321.8c52.2 0 81.7-59.8 50-101.3zm-50 69.3H63.1c-25.7 0-40.3-29.4-24.6-49.8l150.2-196.5c2.1-2.8 3.3-6.2 3.3-9.7V32h64v192c0 3.5 1.2 6.9 3.3 9.7l150.2 196.5c15.6 20.4 1.2 49.8-24.6 49.8z"></path></svg>';
        break;
      case 'lab-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">';
        $svgIcon .= '<path class="primary" d="M138.07 320h171.84l72.93 117.29a6.4 6.4 0 0 1 .09 7.12 6.11 6.11 0 0 1-5.88 3.52H70.89a6.08 6.08 0 0 1-5.89-3.46 6.45 6.45 0 0 1 .11-7.18z"></path>';
        $svgIcon .= '<path class="secondary" d="M112 64h224a16 16 0 0 0 16-16V16a16 16 0 0 0-16-16H112a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16zm325.19 339.5L320 215V96h-64v137.27l126.85 204a6.4 6.4 0 0 1 .09 7.12 6.11 6.11 0 0 1-5.88 3.52H70.89a6.08 6.08 0 0 1-5.89-3.44 6.45 6.45 0 0 1 .11-7.18L192 233.27V96h-64v119L10.79 403.5c-29.3 47.1 4.5 108.5 60.1 108.5h306.2c55.7 0 89.4-61.5 60.1-108.5z"></path>';
        $svgicon .= '</svg>';  
        break;        
      case 'factory';
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M404 384h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm-116-12v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12zm-128 0v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12zm352-188v272c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24h80c13.255 0 24 10.745 24 24v185.167l157.267-78.633C301.052 154.641 320 165.993 320 184v57.167l157.267-78.633C493.052 154.641 512 165.993 512 184zM96 280V64H32v384h448V196.944l-180.422 90.211C294.268 289.81 288 285.949 288 280v-83.056l-180.422 90.211C102.269 289.811 96 285.947 96 280z"></path></svg>';
        break;
      case 'factory-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">';
        $svgIcon .= '<path class="secondary" d="M512 184v272a24 24 0 0 1-24 24H136a24 24 0 0 0 24-24V252.31l139.12-88.53A24 24 0 0 1 336 184v68.28l139.12-88.53A24 24 0 0 1 512 184z"></path>';
        $svgIcon .= '<path class="primary" d="M136 480H24a24 24 0 0 1-24-24V56a24 24 0 0 1 24-24h112a24 24 0 0 1 24 24v400a24 24 0 0 1-24 24z"></path>';
        $svgicon .= '</svg>';  
        break;
      case 'box';
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 608 512"><path fill="currentColor" d="M606.4 143.8L557.5 41c-2.7-5.6-8.1-9-13.9-9C543 32 304 64 304 64S65 32 64.4 32c-5.8 0-11.2 3.5-13.9 9L1.6 143.8c-4.4 9.2.3 20.2 9.6 23l49.5 14.9V393c0 14.7 9.5 27.5 23 31l205.4 54.1c13 3.4 23.7 1.5 29.5 0L524.2 424c13.5-3.6 23-16.4 23-31V181.7l49.5-14.9c9.4-2.8 14-13.8 9.7-23zM73 65.3l180.9 24.3-57.1 99.8-159.9-48.1 36.1-76zm18.2 125.6C208.3 226.1 200.5 224 203.6 224c5.4 0 10.5-2.9 13.3-7.9l71.9-125.5V445L91.2 393V190.9zM516.8 393l-197.6 52V90.5L391.1 216c2.9 5 8 7.9 13.3 7.9 3.1 0-5 2.1 112.4-33.1V393zM411.3 189.3l-57.1-99.8L535 65.3l36.1 76-159.8 48z"></path></svg>';  
        break;
      case 'box-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">';
        $svgIcon .= '<path class="secondary"  d="M439 254.14L576 215v178a32.07 32.07 0 0 1-24.2 31l-216.4 54.1a65 65 0 0 1-31 0L88.24 424A31.9 31.9 0 0 1 64 393V215l137 39.2a46 46 0 0 0 13.3 1.9 48.64 48.64 0 0 0 41.5-23.5L320 126l64.3 106.6a48.47 48.47 0 0 0 41.4 23.4 46 46 0 0 0 13.3-1.86z"></path>';
        $svgIcon .= '<path class="primary" d="M638.34 143.84L586.84 41a16.33 16.33 0 0 0-16.7-8.9L320 64l91.7 152.1a16.44 16.44 0 0 0 18.5 7.3l197.9-56.5a16.47 16.47 0 0 0 10.24-23.06zM53.24 41L1.74 143.84a16.3 16.3 0 0 0 10.1 23l197.9 56.5a16.44 16.44 0 0 0 18.5-7.3L320 64 69.84 32.14A16.34 16.34 0 0 0 53.24 41z"></path>';
        $svgicon .= '</svg>';  
        break; 
      case 'box_2';
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M509.5 184.6L458.9 32.8C452.4 13.2 434.1 0 413.4 0H98.6c-20.7 0-39 13.2-45.5 32.8L2.5 184.6c-1.6 4.9-2.5 10-2.5 15.2V464c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V199.8c0-5.2-.8-10.3-2.5-15.2zM32 199.8c0-1.7.3-3.4.8-5.1L83.4 42.9C85.6 36.4 91.7 32 98.6 32H240v168H32v-.2zM480 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V232h448v232zm0-264H272V32h141.4c6.9 0 13 4.4 15.2 10.9l50.6 151.8c.5 1.6.8 3.3.8 5.1v.2z"></path></svg>';  
        break;             
      case 'box-dual_2';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">';
        $svgIcon .= '<path class="secondary" d="M512 224v240a48 48 0 0 1-48 48H48a48 48 0 0 1-48-48V224z"></path>';
        $svgIcon .= '<path class="primary" d="M53.1 32.8L2.5 184.6c-.8 2.4-.8 4.9-1.2 7.4H240V0H98.6a47.87 47.87 0 0 0-45.5 32.8zm456.4 151.8L458.9 32.8A47.87 47.87 0 0 0 413.4 0H272v192h238.7c-.4-2.5-.4-5-1.2-7.4z"></path>';
        $svgicon .= '</svg>';  
        break; 
      case 'storage';
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M624 224H480V16c0-8.8-7.2-16-16-16H176c-8.8 0-16 7.2-16 16v208H16c-8.8 0-16 7.2-16 16v256c0 8.8 7.2 16 16 16h608c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16zm-176 32h64v62.3l-32-10.7-32 10.7V256zM352 32v62.3l-32-10.7-32 10.7V32h64zm-160 0h64v106.7l64-21.3 64 21.3V32h64v192H192V32zm0 224v62.3l-32-10.7-32 10.7V256h64zm-160 0h64v106.7l64-21.3 64 21.3V256h80v224H32V256zm576 224H336V256h80v106.7l64-21.3 64 21.3V256h64v224z"></path></svg>';              
        break;
      case 'storage-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">';
        $svgIcon .= '<path class="primary" d="M320 0v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8V0zm160 288v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8v-88zm-320 0v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8v-88z"></path>';
        $svgIcon .= '<path class="secondary" d="M176 224h224a16 16 0 0 0 16-16V16a16 16 0 0 0-16-16h-80v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8V0h-80a16 16 0 0 0-16 16v192a16 16 0 0 0 16 16zm384 64h-80v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8v-88h-80a16 16 0 0 0-16 16v192a16 16 0 0 0 16 16h224a16 16 0 0 0 16-16V304a16 16 0 0 0-16-16zm-320 0h-80v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8v-88H16a16 16 0 0 0-16 16v192a16 16 0 0 0 16 16h224a16 16 0 0 0 16-16V304a16 16 0 0 0-16-16z"></path>';
        $svgicon .= '</svg>';  
        break; 
      case 'storage-dual_2';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">';
        $svgIcon .= '<path class="secondary" d="M624 0h-32a16 16 0 0 0-16 16v144H64V16A16 16 0 0 0 48 0H16A16 16 0 0 0 0 16v496h64v-32h512v32h64V16a16 16 0 0 0-16-16zm-48 416H64V224h512z"></path>';
        $svgIcon .= '<path class="primary" d="M208 256h-96a16 16 0 0 0-16 16v96a16 16 0 0 0 16 16h96a16 16 0 0 0 16-16v-96a16 16 0 0 0-16-16zM464 0h-96a16 16 0 0 0-16 16v96a16 16 0 0 0 16 16h96a16 16 0 0 0 16-16V16a16 16 0 0 0-16-16zm-96 256h-96a16 16 0 0 0-16 16v96a16 16 0 0 0 16 16h96a16 16 0 0 0 16-16v-96a16 16 0 0 0-16-16z"></path>';
        $svgicon .= '</svg>';  
        break;  
      case 'tags';
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M625.941 293.823L421.823 497.941c-18.746 18.746-49.138 18.745-67.882 0l-1.775-1.775 22.627-22.627 1.775 1.775c6.253 6.253 16.384 6.243 22.627 0l204.118-204.118c6.238-6.239 6.238-16.389 0-22.627L391.431 36.686A15.895 15.895 0 0 0 380.117 32h-19.549l-32-32h51.549a48 48 0 0 1 33.941 14.059L625.94 225.941c18.746 18.745 18.746 49.137.001 67.882zM252.118 32H48c-8.822 0-16 7.178-16 16v204.118c0 4.274 1.664 8.292 4.686 11.314l211.882 211.882c6.253 6.253 16.384 6.243 22.627 0l204.118-204.118c6.238-6.239 6.238-16.389 0-22.627L263.431 36.686A15.895 15.895 0 0 0 252.118 32m0-32a48 48 0 0 1 33.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882L293.823 497.941c-18.746 18.746-49.138 18.745-67.882 0L14.059 286.059A48 48 0 0 1 0 252.118V48C0 21.49 21.49 0 48 0h204.118zM144 124c-11.028 0-20 8.972-20 20s8.972 20 20 20 20-8.972 20-20-8.972-20-20-20m0-28c26.51 0 48 21.49 48 48s-21.49 48-48 48-48-21.49-48-48 21.49-48 48-48z"></path></svg>';
        break;                
      case 'tags-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">';
        $svgIcon .= '<path class="primary" d="M497.94 225.94L286.06 14.06A48 48 0 0 0 252.12 0H48A48 48 0 0 0 0 48v204.12a48 48 0 0 0 14.06 33.94l211.88 211.88a48 48 0 0 0 67.88 0l204.12-204.12a48 48 0 0 0 0-67.88zM112 160a48 48 0 1 1 48-48 48 48 0 0 1-48 48z"></path>';
        $svgIcon .= '<path class="secondary" d="M625.94 293.82L421.82 497.94a48 48 0 0 1-67.88 0l-.36-.36 174.06-174.06a90 90 0 0 0 0-127.28L331.4 0h48.72a48 48 0 0 1 33.94 14.06l211.88 211.88a48 48 0 0 1 0 67.88z"></path>';
        $svgicon .= '</svg>';  
        break;
      case 'patrick';
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M501.5 66.6l-71.7-26.1 9.5-23.2c1.7-4.1-.2-8.8-4.3-10.5L420.2.6c-4.1-1.7-8.8.2-10.5 4.3l-10 24.7L321.1 1c-8.9-3.2-18 2.7-20.5 9.6L264.1 111c-3 8.3 1.2 17.5 9.6 20.5l73.6 26.8-22.5 55.4c-3.7-1.8-7.3-3.9-11.5-4.8L253.6 197l-10.1-16.1c-11.9-19-28.8-33.5-48.4-42.5 12.8-13 20.7-30.8 20.7-50.4 0-39.7-32.3-72-72-72S72 48.3 72 88c0 20.8 9 39.4 23.1 52.6-22.8 11.3-41.9 29.7-53.8 53.5L5 266.5c-11.8 23.7-2.2 52.6 21.5 64.4.7.3 26.5 14.1 51-5L49.1 453.6c-5.7 25.8 10.6 51.5 36.4 57.3 3.6.8 7 1.1 10.4 1.1 22.3 0 42-15.8 46.8-37.6l17.2-77.5 15.9 19.9V464c0 26.5 21.5 48 48 48s48-21.5 48-48v-52.8c0-18.1-6.2-35.8-17.5-50l-46.5-58.1v-20.3c6.3 3.2 13.1 5.5 20.1 6.9l60.8 12.2-.3.8c-1.7 4.1.2 8.8 4.3 10.5l14.8 6.2c4.1 1.7 8.8-.2 10.5-4.3l6.7-16.6c13-6.4 23.1-18.1 26.2-33.1 1.8-8.8.9-17.8-2.1-26l28.6-70.2 76.6 27.9c8.9 3.3 18-2.8 20.5-9.6L511 87.1c3.1-8.3-1.2-17.4-9.5-20.5zM143.9 48c22.1 0 40 17.9 40 40s-17.9 40-40 40-40-17.9-40-40 17.9-40 40-40zm157.2 223.7h-.4l-66.4-13.3c-12.9-2.6-24.3-10.5-31.3-21.6-14.6-23.3-16.3-28-27.1-35.6v113.2l53.5 66.9c6.8 8.5 10.5 19.1 10.5 30V464c0 8.8-7.2 16-16 16s-16-7.2-16-16v-52.8c0-3.6-1.2-7.2-3.5-10L152.2 336h-11.5l-29.2 131.5c-1.7 7.7-9.6 14.2-19.1 12.2-8.6-1.9-14.1-10.5-12.2-19.1l31.6-142.3V206c-5.3 4.7-10.1 10-13.4 16.7l-36.2 72.5c-3.1 6.2-12.1 11.9-21.5 7.2-7.9-4-11.1-13.6-7.2-21.5l36.2-72.5c14.9-29.8 44.9-48.4 78.2-48.4 28 0 53.5 14.2 68.3 37.9l13.7 21.9c2.3 3.7 6.1 6.3 10.4 7.2l66.4 13.3c2.2.4 4.2 1.3 5.9 2.5l-11.5 28.9zm148.8-110.1l-150.3-54.7 25.6-70.4 150.3 54.7-25.6 70.4z"></path></svg>';
        break;        
      case 'patrick-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">';
        $svgIcon .= '<path class="primary" d="M144 0a48 48 0 1 0 48 48 48.08 48.08 0 0 0-48-48zm357.5 66.6L321.08 1a16 16 0 0 0-20.5 9.6l-43.8 120.3a16 16 0 0 0 9.6 20.5l180.5 65.6a16 16 0 0 0 20.5-9.6L511 87.1a15.93 15.93 0 0 0-9.52-20.5z"></path>';
        $svgIcon .= '<path class="secondary" d="M321 212l-47.8-16-49.3-49.3a63.47 63.47 0 0 0-45.2-18.8h-62.9a63.63 63.63 0 0 0-57.2 35.4L3.38 273.7a32 32 0 1 0 57.2 28.6L80 263.6v54.8L64.08 476.8a32 32 0 0 0 28.6 35c1.1.1 2.2.2 3.2.2a32.05 32.05 0 0 0 31.8-28.8l13.2-131.2h15.3L192 423.5V480a32 32 0 0 0 64 0v-56.5a64.27 64.27 0 0 0-6.7-28.6l-41.2-82.5v-91.2l20 20a65 65 0 0 0 25 15.5l46.1 15.4-11.2 30.8a16 16 0 0 0 9.6 20.5l15 5.5a16 16 0 0 0 20.5-9.6l46.19-126.87L334 176zM429.68 6.5l-15-5.5a16 16 0 0 0-20.5 9.6l-5.49 15 45.1 16.4 5.49-15a16 16 0 0 0-9.6-20.5z"></path>';
        $svgicon .= '</svg>';  
        break;
      case 'privacy';
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M383.9 308.3l23.9-62.6c4-10.5-3.7-21.7-15-21.7h-43.2c1.5-7.8 2.4-15.8 2.4-24 0-7.2-.9-14.2-2.2-21.1 40.5-9.8 66.2-24.2 66.2-40.2 0-16.5-27-31.2-69.3-41-8.9-33.6-27.4-67.9-41.3-85.4-6.3-8-15.7-12.3-25.3-12.3-9.5 0-12.3 2.4-41.8 17.2-12.8 6.4-24.3 2.1-28.6 0C179.9 2.3 177.3 0 167.9 0c-9.6 0-18.9 4.3-25.2 12.2-13.9 17.5-32.4 51.8-41.3 85.4C59 107.4 32 122.2 32 138.7c0 16.1 25.7 30.5 66.2 40.2-1.3 6.9-2.2 13.9-2.2 21.1 0 8.2.9 16.2 2.4 24H56.3c-11.5 0-19.2 11.7-14.7 22.3l25.8 60.2C27.3 329.8 0 372.7 0 422.4v44.8C0 491.9 20.1 512 44.8 512h358.4c24.7 0 44.8-20.1 44.8-44.8v-44.8c0-48.4-25.8-90.4-64.1-114.1zM128 200c0-2.7.3-5.3.6-7.9 1.3.8 5.1 3.3 5.8 5.4 3.9 11.9 7 24.6 16.5 33.4 8 7.4 47 25.1 64-25 2.8-8.4 15.4-8.4 18.3 0 16 47.4 53.9 34.4 64 25 9.5-8.8 12.7-21.5 16.5-33.4.7-2.1 4.4-4.6 5.8-5.4.3 2.6.6 5.2.6 7.9 0 52.9-43.1 96-96 96S128 252.9 128 200zm-.7-75.5c.7-2.7 12.3-57 40.5-92.5 28.7 14.4 37.7 20.5 56.2 20.5 18.6 0 27.7-6.3 56.2-20.5l.1.1c28.1 35.4 39.7 89.6 40.4 92.4 21.4 4.9 35.8 7.9 51 14.2-24.3 9.9-75.4 21.3-147.7 21.3s-123.4-11.4-147.7-21.3c15.2-6.3 29.9-9.3 51-14.2zM44.8 480c-7.1 0-12.8-5.7-12.8-12.8v-44.8c0-36.5 19.2-69.5 51.4-88.2L108 320l-27.4-64h28.9c4.7 9.6 64.3 108.5 64.3 108.5L142.9 480H44.8zm131.2 0l32-120-21.9-38.4c12.1 3.8 24.6 6.4 37.9 6.4s25.9-2.6 37.9-6.4L240 360l32 120h-96zm240-12.8c0 7.1-5.7 12.8-12.8 12.8h-98.1l-30.8-115.5s59.6-98.9 64.3-108.5h31l-25 65.6 22.5 13.9c30.6 18.9 48.9 51.4 48.9 86.9v44.8z"></path></svg>';
        break;
      case 'privacy-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">';
        $svgIcon .= '<path class="secondary" d="M255.38 421.22L224 480l-31.38-58.78L208 352l-17.79-35.58a161.25 161.25 0 0 0 67.58 0L240 352zM224 288a128 128 0 0 0 128-127.21c-7.49 1.54-15.51 3-24 4.2v6.59c-.11.11-6.07 3.47-6.93 6.28-4.23 12.9-7.59 26.65-17.88 36.19-10.94 10.07-52 24.26-69.33-27.09-3-9.1-16.69-9.1-19.83 0-18.41 54.39-60.66 35.1-69.33 27.09-10.29-9.54-13.76-23.29-17.88-36.19-.86-2.7-6.82-6.17-6.82-6.28V165c-8.48-1.25-16.5-2.66-24-4.2A128 128 0 0 0 224 288z"></path>';
        $svgIcon .= '<path class="primary" d="M120 165v6.59c0 .11 6 3.58 6.82 6.28 4.12 12.9 7.59 26.65 17.88 36.19 8.67 8 50.92 27.3 69.33-27.09 3.14-9.1 16.79-9.1 19.83 0 17.33 51.35 58.39 37.16 69.33 27.09 10.29-9.54 13.65-23.29 17.88-36.19.86-2.81 6.82-6.17 6.93-6.28V165c52.95-7.83 88-21.47 88-37 0-13.75-27.51-26-70.6-34.09-9.35-32.11-26.69-64.08-40-80.72a32.1 32.1 0 0 0-39.5-8.8l-27.6 13.8a32 32 0 0 1-28.6 0l-27.6-13.8a32.1 32.1 0 0 0-39.5 8.8c-13.22 16.64-30.6 48.61-40 80.72C59.51 102 32 114.25 32 128c0 15.52 35.05 29.16 88 37zm263.9 143.27l23.9-62.58a16 16 0 0 0-15-21.7h-32.12L224 480 87.32 224h-31a16 16 0 0 0-14.7 22.3l25.74 60.06A133.56 133.56 0 0 0 0 422.4V464a48 48 0 0 0 48 48h352a48 48 0 0 0 48-48v-41.6a133.5 133.5 0 0 0-64.1-114.13z"></path>';
        $svgicon .= '</svg>';  
        break;
      case 'search-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">';
        $svgIcon .= '<path class="primary" d="M208 80a128 128 0 1 1-90.51 37.49A127.15 127.15 0 0 1 208 80m0-80C93.12 0 0 93.12 0 208s93.12 208 208 208 208-93.12 208-208S322.88 0 208 0z"></path>';
        $svgIcon .= '<path class="secondary" d="M504.9 476.7L476.6 505a23.9 23.9 0 0 1-33.9 0L343 405.3a24 24 0 0 1-7-17V372l36-36h16.3a24 24 0 0 1 17 7l99.7 99.7a24.11 24.11 0 0 1-.1 34z"></path>';
        $svgicon .= '</svg>';  
        break;
      case 'tv-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">';
        $svgIcon .= '<path class="primary" d="M392 168.07s0-8-168-8c-152 0-152 8-152 8s-8 0-8 120 8 120 8 120 0 8 152 8c168 0 168-8 168-8s8 0 8-120-8-120-8-120zM173.14 96h165.72l35.64-41.32a32 32 0 1 0-45.3-45.3L256 94.27 182.8 9.48a32 32 0 0 0-45.3 45.29z"></path>';
        $svgIcon .= '<path class="secondary" d="M464 96.07H48a48 48 0 0 0-48 48v288a48 48 0 0 0 48 48h16v32h48l21.3-32h245.3l21.3 32h48v-32h16a48 48 0 0 0 48-48v-288a47.86 47.86 0 0 0-47.9-48zm-72 312s0 8-168 8c-152 0-152-8-152-8s-8 0-8-120 8-120 8-120 0-8 152-8c168 0 168 8 168 8s8 0 8 120-8 120-8 120zm72-100a12 12 0 0 1-12 12h-8a12 12 0 0 1-12-12v-8a12 12 0 0 1 12-12h8a12 12 0 0 1 12 12zm0-64a12 12 0 0 1-12 12h-8a12 12 0 0 1-12-12v-8a12 12 0 0 1 12-12h8a12 12 0 0 1 12 12z"></path>';
        $svgicon .= '</svg>';
        break;
      case 'popcorn-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">';
        $svgIcon .= '<path class="primary" d="M101.46,118a37.17,37.17,0,0,1,.33-37.43c9.11-16,28-23.66,45.57-20.12.34-16.64,11.46-32,29-37.43a43.36,43.36,0,0,1,38.82,6.08A41.63,41.63,0,0,1,242.5,2c22.27-6.78,46.23,4.42,53.33,25.54a4.22,4.22,0,0,1,.68,1.92A43.29,43.29,0,0,1,335.65,23c17.53,5.43,28.67,20.79,29,37.43C382.2,57,401.09,64.6,410.2,80.6a37.88,37.88,0,0,1,.33,37.43,42.7,42.7,0,0,1,33.09,20.79c3.91,6.75,4.76,14,4.24,21.12H64.13c-.5-7.12.35-14.38,4.27-21.12C75.14,126.67,88,119.31,101.46,118Z"></path>';
        $svgIcon .= '<path class="secondary" d="M64,192h81.56l28,256h45.05L197.05,192H315L293.39,448h45l28-256H448L404.09,484.73A32,32,0,0,1,372.44,512H139.56a32,32,0,0,1-31.65-27.25Z"></path>';
        $svgicon .= '</svg>';      
        break;
      case 'git-dual';
        $svgIcon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">';
        $svgIcon .= '<path class="secondary" d="M328 220.33V224c0 32-6.69 47.26-20 63.8-28.2 35-76 39.5-118.2 43.4-25.7 2.4-49.9 4.6-66.1 12.8-3.82 1.94-9.25 6.44-13.44 13.94A80.16 80.16 0 0 0 56 355.67V156.33a80.31 80.31 0 0 0 48 0v144c23.9-11.5 53.1-14.3 81.3-16.9 35.9-3.3 69.8-6.5 85.2-25.7 6.34-7.83 9.5-17.7 9.5-33.7v-3.67a80.31 80.31 0 0 0 48 0z"></path>';
        $svgIcon .= '<path class="primary" d="M80 0a80 80 0 1 0 80 80A80 80 0 0 0 80 0zm0 96a16 16 0 1 1 16-16 16 16 0 0 1-16 16zm0 256a80 80 0 1 0 80 80 80 80 0 0 0-80-80zm0 96a16 16 0 1 1 16-16 16 16 0 0 1-16 16zM304 64a80 80 0 1 0 80 80 80 80 0 0 0-80-80zm0 96a16 16 0 1 1 16-16 16 16 0 0 1-16 16z"></path>';
        $svgicon .= '</svg>';      
        break;        
      case 'sp-logo';
        $svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 894.28 1024">';
        $svgIcon .= '<path fill="currentColor" d="M323.6,1023.67,572.31,197.44h177.1c51.76,0,89.85,6.51,112.64,19.54,21.81,12.37,32.23,34.83,32.23,68.36,0,27-6.19,60.23-18.23,99L828.52,542.52c-11.4,37.11-23.77,68.36-37.11,92.78-13,23.76-28.65,43-46.88,57-17.91,14-39.72,24.09-64.46,30-25.07,6.19-56,9.12-91.8,9.12H553.11L465.21,1024h0l-141.61-.33ZM636.45,582.89A51.51,51.51,0,0,0,658.91,578c7.16-3.25,13.35-9.44,19.21-18.23,5.2-8.13,10.74-19.2,16.27-33.2q8.31-20.51,17.58-53.72c8.47-26.69,14.65-48.83,18.56-65.43,3.91-16.93,5.86-29.63,5.86-38.74,0-11.07-3.58-17.91-10.42-20.84-4.88-1.95-11.39-2.93-20.18-2.93l-38.09.33-66.41,221-4.89,16.28Z"></path>';
        $svgIcon .= '<path fill="currentColor" d="M130.56,856.83c-6.84,0-15.63-.32-16.28-.32-33.21-1.63-59.9-9.12-79.43-22.47C12.06,818.42.67,792.7,0,754.94c-.32-25.39,4.89-57.3,15.63-94.41L34.2,596.07H170.27l-12.69,41.67c-4.56,17.58-6.84,30.28-6.84,39.72.33,19.86,11.4,31.25,30.28,31.25h1a73.18,73.18,0,0,0,15.3-1.63l.66-.32a50.68,50.68,0,0,0,22.13-15c9.12-11.07,17.26-27.67,24.74-51.43,4.89-17.91,7.17-33.54,7.17-47.53,0-24.42-5.86-45.91-17.58-63.16-11.07-16.28-23.12-32.88-36.46-49.16-8.47-9.76-16.93-20.51-25.4-31.57a206.37,206.37,0,0,1-21.81-35.81,213.32,213.32,0,0,1-15.62-42.65,207.61,207.61,0,0,1-6.19-52.09c0-30.92,6.19-67.06,18.23-108.08,11.39-37.11,24.42-69.66,38.74-96.68,14.32-26.37,31.25-48.51,50.46-65.11a185.79,185.79,0,0,1,67.39-36.79C329.47,3.91,359.74,0,393.92,0,440.15,0,475,8.14,498.1,24.09c22.46,15.63,33.53,41.67,33.53,79.76,0,25.39-5.86,57-16.93,94.08l-19.53,64.13H357.79l14.65-43.62c4.88-17.25,7.48-30.28,7.48-39.39,0-20.18-11.06-31.58-30.6-31.58-15.3,0-28.32,5.86-38.09,17.58-9.44,11.07-16.92,28-23.43,52.41A155.66,155.66,0,0,0,282.91,237a100.72,100.72,0,0,0-1.3,17.25c0,21.49,5.53,40.37,16.28,56.32,10.09,15,22.13,30.28,35.16,45.9,8.13,9.77,16.6,20.51,25.39,31.58a246.34,246.34,0,0,1,22.46,36.46c6.84,13.35,12.37,28.65,16.93,44.93s6.84,34.83,6.84,55a347.36,347.36,0,0,1-3.91,49.48c-2.6,17.91-7.16,37.12-13,57.63-13,43.62-27,80.08-41.67,109.05C331.42,768.94,314.16,792.38,295,810a167.1,167.1,0,0,1-67.06,36.79c-26.05,7.16-56.65,10.74-91.48,10.74A18.09,18.09,0,0,0,130.56,856.83Z"></path>';
        $svgicon .= '</svg>';      
        break;                                                                                                    
      default:
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M493.255 56.236l-37.49-37.49c-24.993-24.993-65.515-24.994-90.51 0L12.838 371.162.151 485.346c-1.698 15.286 11.22 28.203 26.504 26.504l114.184-12.687 352.417-352.417c24.992-24.994 24.992-65.517-.001-90.51zm-95.196 140.45L174 420.745V386h-48v-48H91.255l224.059-224.059 82.745 82.745zM126.147 468.598l-58.995 6.555-30.305-30.305 6.555-58.995L63.255 366H98v48h48v34.745l-19.853 19.853zm344.48-344.48l-49.941 49.941-82.745-82.745 49.941-49.941c12.505-12.505 32.748-12.507 45.255 0l37.49 37.49c12.506 12.506 12.507 32.747 0 45.255z"></path></svg>';
    }

    echo $svgIcon;
  }
endif;



/**
 * Use Wordpress build in Sitemap generator and modify results
 *
 */
function soapatricknine_sitemap_remove_cpt($post_types) {
  unset( $post_types['log'] );
  unset( $post_types['lab'] );
  return $post_types;
}
add_filter('wp_sitemaps_post_types', 'soapatricknine_sitemap_remove_cpt');


function soapatricknine_sitemap_remove_tax($taxonomies) {
  unset( $taxonomies['post_tag'] );
  unset( $taxonomies['category'] );
  unset( $taxonomies['post_format'] );
  unset( $taxonomies['factory_tags'] );
  return $taxonomies;
}
add_filter('wp_sitemaps_taxonomies', 'soapatricknine_sitemap_remove_tax');


function soapatricknine_sitemap_remove_users($provider, $name) {
  if ( 'users' === $name ) {
      return false;
  }
  return $provider;
}
add_filter('wp_sitemaps_add_provider', 'soapatricknine_sitemap_remove_users', 10, 2);


function soapatricknine_sitemap_remove_pages($args, $post_type) {
  if ( 'page' !== $post_type ) {
      return $args;
  }

  $args['post__not_in'] = isset( $args['post__not_in'] ) ? $args['post__not_in'] : array();
  $args['post__not_in'][] = 2823; // Log Archive
  $args['post__not_in'][] = 1397; // Post Archive (Storage)
  $args['post__not_in'][] = 1402; // Tags Archive
  return $args;
}
add_filter('wp_sitemaps_posts_query_args', 'soapatricknine_sitemap_remove_pages', 10, 2);


/**
 * Add more link to post excerpt
 *
 */
function soapatricknine_excerpt_more( $more ) {
  return ' ... <a href="'.get_the_permalink().'" rel="nofollow" class="more-link">more &rarr;</a>';
}
add_filter( 'excerpt_more', 'soapatricknine_excerpt_more' );


/**
 * add lightbox attribute to gallery image with links
 *
 */
function soapatricknine_gallery_block_lightbox( $block_content, $block ) {
  if ( 'core/gallery' !== $block['blockName'] ) {
      return $block_content;
  }
  $block_content = str_replace( 'a href', 'a data-fslightbox="gallery-'. implode('-', $block['attrs']['ids']) .'" href', $block_content );
  return $block_content;
}
add_filter( 'render_block', 'soapatricknine_gallery_block_lightbox', 10, 2 );


/**
 * output only first block for Factory list on frontpage
 *
 */
function soapatricknine_one_factory_block_frontpage($content) {
  if( is_front_page() && has_blocks( $content ) && get_post_type() === 'factory') {
    $blocks = parse_blocks( $content );
    if ( !empty($blocks) ) {
      return $blocks[0]['innerHTML'];
    }
  }
  return $content;
}
add_filter( 'the_content','soapatricknine_one_factory_block_frontpage', 0 );
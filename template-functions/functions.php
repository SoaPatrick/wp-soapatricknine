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
//add_filter( 'allowed_block_types', 'soapatricknine_allowed_block_types' );

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
      case 'factory';
        $svgIcon = '<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline"><path fill="currentColor" d="M404 384h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm-116-12v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12zm-128 0v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12zm352-188v272c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24h80c13.255 0 24 10.745 24 24v185.167l157.267-78.633C301.052 154.641 320 165.993 320 184v57.167l157.267-78.633C493.052 154.641 512 165.993 512 184zM96 280V64H32v384h448V196.944l-180.422 90.211C294.268 289.81 288 285.949 288 280v-83.056l-180.422 90.211C102.269 289.811 96 285.947 96 280z"></path></svg>';
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
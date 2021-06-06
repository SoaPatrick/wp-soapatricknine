<?php
/**
 * The single template
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricknine
 */

get_header();

  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      get_template_part( 'template-partials/content/content-single', get_post_type() );
    endwhile;

    if ( 'post' === get_post_type() ):
      soapatricknine_post_navigation();
    endif;
    
  else :

    get_template_part( 'template-partials/content/content', 'none' );

  endif;

get_footer();

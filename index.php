<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricknine
 */

get_header();

  if ( have_posts() ) :
    
    if(is_home()):
      get_template_part( 'template-partials/layout/header','box' );
    endif;

    while ( have_posts() ) : the_post();
      if (is_front_page()):
        get_template_part( 'template-partials/content/content-home', get_post_type() );
      elseif (is_single() || is_page() ):
        get_template_part( 'template-partials/content/content-single', get_post_type() );
      else:
        get_template_part( 'template-partials/content/content-list', get_post_type() );
      endif;

    endwhile;

    if (is_single()):
      if ( 'post' === get_post_type() ):
        soapatricknine_post_navigation();
      endif;
    elseif (!is_front_page()):
      soapatricknine_posts_navigation();
    endif;
    ?>
  <?php else :

    get_template_part( 'template-partials/content/content', 'none' );

  endif;

get_footer();

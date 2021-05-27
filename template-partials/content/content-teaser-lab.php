<?php
/**
 * Template part for displaying lab teaser
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatricknine
 */

?>            
<?php the_title( '<h1 class="hidden">', '</h1>' ); ?>
<a aria-label="<?php the_title(); ?>" data-fslightbox
  <?php 
    if(get_field('is_video')) : 
      echo 'href="'. get_field('video') .'" class="video-link"';
    else : 
      echo 'href="'. get_the_post_thumbnail_url(get_the_ID(),'large') .'"';
    endif ;
  ?>
>
  <?php the_post_thumbnail('medium'); ?>
</a>
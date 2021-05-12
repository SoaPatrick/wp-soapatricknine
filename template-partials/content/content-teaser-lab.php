<?php
/**
 * Template part for displaying lab teaser
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatricknine
 */

?>            
            
            
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if(get_field('is_video')) : ?>
    <a data-fslightbox="video" href="<?php the_field('video'); ?>" aria-label="<?php the_title() ?>">
  <?php else: ?>
    <a data-fslightbox href="<?php echo get_the_post_thumbnail_url(get_the_ID(),'large'); ?>" aria-label="<?php the_title() ?>">
  <?php endif; 
    the_post_thumbnail( 'medium');
  ?>
  </a>
</article>
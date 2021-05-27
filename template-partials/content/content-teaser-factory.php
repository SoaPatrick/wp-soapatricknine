<?php
/**
 * Template part for displaying featured image full
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatricknine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if( has_post_thumbnail() ) : ?>
    <?php the_title( '<h1 class="hidden">', '</h1>' ); ?>
    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>" class="img-link"><?php the_post_thumbnail(); ?></a>
  <?php endif; ?>
</article>

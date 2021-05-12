<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricknine
 */

get_header();

  if ( have_posts() ) : ?>

    <nav aria-label="breadcrumb" class="breadcrumbs">
      <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
      <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post');?>">Box</a></span>
      <?php if( is_tag() ) : ?>
        <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post');?>/tags/">Tags</a></span>
      <?php else : ?>
        <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post'); ?>/storage/">Storage</a></span>
      <?php endif; ?>      
      <span class="breadcrumbs__item breadcrumbs__item--last"><?php the_archive_title();?></span>
    </nav>  

    <header>   
      <?php the_archive_title( '<h1>', '</h1>' ); ?>
    </header>
    <div class="site__content">
      <?php
        while ( have_posts() ) :
          the_post();
          get_template_part( 'template-partials/content/content', 'list' );
        endwhile;
      ?>
    </div>
    <?php
    soapatricknine_posts_navigation();

  endif;

get_footer();

<?php
/**
 * Template part for displaying labs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricknine
 */

?>
  <nav class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
    <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('lab'); ?>">Lab</a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last"><?php the_title() ?></span>
  </nav>

  <article id="post-<?php the_ID(); ?>" <?php post_class('post post--list'); ?>>
    <header>
      <div class="marginal-icon">
        <?php soapatricknine_svg_icons('lab'); ?>
      </div>      
      <div class="post__meta">
        <?php
          soapatricknine_posted_on();
          soapatricknine_edit_post();
        ?>
      </div>
    </header>
    <?php if(!$format): ?>
      <div class="post__content">
        <figure class="wp-block-image">
            <?php get_template_part( 'template-partials/content/content', 'teaser-lab' ); ?>
            <figcaption>
              <?php the_post_thumbnail_caption(); ?>
            </figcaption>                     
        </figure>
      </div>
    <?php endif; ?>
  </article>

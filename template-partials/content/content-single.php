<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricknine
 */


$format = get_post_format();

?>
  <nav class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
    <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post'); ?>">Box</a></span>
    <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post'); ?>storage/">Storage</a></span>
    <span class="breadcrumbs__item"><a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><?php echo get_the_date('F Y'); ?></a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last"><?php the_title() ?></span>
  </nav>

  <article id="post-<?php the_ID(); ?>" <?php post_class('post post--single'); ?>>
    <header>
      <div class="marginal-icon">
        <?php soapatricknine_svg_icons($format); ?>
      </div>
      <div class="post__meta">
        <?php
          soapatricknine_posted_on();
          soapatricknine_edit_post();
        ?>
      </div>
      <?php 
        if ($format === 'quote' || $format === 'link' || $format === 'status'):
          the_title( '<h1 class="hidden">', '</h1>' );
          the_content();
        else:
          the_title( '<h1>', '</h1>' );
        endif;
      ?>
    </header>
    <?php if ($format != 'quote' xor $format != 'link' xor $format != 'status'): ?>
      <div class="post__content">
        <?php the_content(); ?>
      </div>
    <?php endif; ?>

    <footer>
      <?php soapatricknine_tags(); ?>
    </footer>
  </article>

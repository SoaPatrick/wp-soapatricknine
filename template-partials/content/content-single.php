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
    <?php if(is_front_page()): ?>
    <?php elseif(is_page()): ?>
      <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'soapatricknine' ) ?></a></span>
      <span class="breadcrumbs__item breadcrumbs__item--last"><?php the_title() ?></span>
    <?php else: ?>
      <?php if (is_single() ): ?>
        <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'soapatricknine' ) ?></a></span>
        <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post'); ?>"><?php esc_html_e( 'Box', 'soapatricknine' ) ?></a></span>
        <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post'); ?>/storage/"><?php esc_html_e( 'Storage', 'soapatricknine' ) ?></a></span>
        <span class="breadcrumbs__item"><a href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><?php echo get_the_date('F Y'); ?></a></span>
        <span class="breadcrumbs__item breadcrumbs__item--last"><?php the_title() ?></span>
      <?php else: ?>
        <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'SoaPatrick', 'soapatricknine' ) ?></a></span>
        <span class="breadcrumbs__item breadcrumbs__item--last"><?php esc_html_e( 'Box', 'soapatricknine' ) ?></span>
      <?php endif; ?>
    <?php endif; ?>
  </nav>

  <article id="post-<?php the_ID(); ?>" <?php post_class('post post--single'); ?>>
    <header>
      <div class="marginal-icon">
        <?php
          if($format === 'status') :
            soapatricknine_svg_icons('status');
          elseif ($format === 'quote') :
            soapatricknine_svg_icons('quote');
          elseif ($format === 'link') :
            soapatricknine_svg_icons('link');
          else:
            soapatricknine_svg_icons('pencil');
          endif ;
        ?>
      </div>      
      <div class="post__meta">
        <?php
          soapatricknine_posted_on();
          soapatricknine_edit_post();
        ?>
      </div>
      <?php 
        if ($format === 'quote' || $format === 'link' || $format === 'status'):
          the_content();
        else:
          the_title( '<h1>', '</h1>' );
        endif;
      ?>
    </header>

    <div class="post__content">
      <?php 
        if(!$format):
          the_content(); 
        endif;
      ?>
    </div>

    <footer>
      <?php soapatricknine_tags(); ?>
    </footer>
  </article>

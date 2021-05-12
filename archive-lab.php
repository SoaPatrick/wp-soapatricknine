<?php
/**
 * The template for displaying lab archive items
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatricknine
 */

get_header(); ?>

  <nav aria-label="breadcrumb" class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'soapatricknine' ) ?></a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last"><?php esc_html_e( 'Lab', 'soapatricknine' ) ?></span>
  </nav>

  <header>
    <div class="marginal-icon marginal-icon--section">
      <?php soapatricknine_svg_icons('lab-dual'); ?>           
    </div>        
    <h1><?php esc_html_e( 'Lab', 'soapatricknine' ) ?></h1>
  </header>
  <div class="site__content">
    <div class="masonry-grid">
      <?php
        if ( have_posts() ) :
          while ( have_posts() ) : the_post();
            ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php get_template_part( 'template-partials/content/content', 'teaser-lab' ); ?>
              </article>
            <?php
          endwhile;
        endif;
      ?>
    </div>

    <?php soapatricknine_posts_navigation(); ?>
  </div>


<?php
get_footer();

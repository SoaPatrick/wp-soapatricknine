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
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last">Lab</span>
  </nav>

  <header>
    <?php if( !is_paged() ) : ?>   
      <div class="marginal-icon marginal-icon--section">
        <?php soapatricknine_svg_icons('lab-dual'); ?>                     
      </div>
    <?php endif ; ?>               
    <h1>SoapLab</h1>
  </header>
  <div class="site__content">
    <?php if( !is_paged() ) : ?>    
      <p class="lead">
        Sometimes I just like to experiment on something without any idea where it might lead.
      </p>
    <?php endif ; ?>
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

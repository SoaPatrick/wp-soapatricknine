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
    <div class="marginal-icon marginal-icon--section">
      <?php soapatricknine_svg_icons('lab-dual'); ?>           
    </div>        
    <h1>SoapLab</h1>
  </header>
  <div class="site__content">
    <p class="lead">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dictum, magna nec venenatis mollis, lacus nisi fringilla neque, id porta nisi lorem in risus. Phasellus sit amet accumsan augue, ut rhoncus purus. Cras aliquet.
    </p>
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

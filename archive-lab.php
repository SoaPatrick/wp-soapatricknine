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
      <!-- <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path fill="currentColor" d="M434.9 410.7L288 218.6V32h26c3.3 0 6-2.7 6-6V6c0-3.3-2.7-6-6-6H134c-3.3 0-6 2.7-6 6v20c0 3.3 2.7 6 6 6h26v186.6L13.1 410.7C-18.6 452.2 11 512 63.1 512h321.8c52.2 0 81.7-59.8 50-101.3zm-50 69.3H63.1c-25.7 0-40.3-29.4-24.6-49.8l150.2-196.5c2.1-2.8 3.3-6.2 3.3-9.7V32h64v192c0 3.5 1.2 6.9 3.3 9.7l150.2 196.5c15.6 20.4 1.2 49.8-24.6 49.8z"></path>
      </svg>    -->
      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path class="primary" d="M138.07 320h171.84l72.93 117.29a6.4 6.4 0 0 1 .09 7.12 6.11 6.11 0 0 1-5.88 3.52H70.89a6.08 6.08 0 0 1-5.89-3.46 6.45 6.45 0 0 1 .11-7.18z"></path>
        <path class="secondary" d="M112 64h224a16 16 0 0 0 16-16V16a16 16 0 0 0-16-16H112a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16zm325.19 339.5L320 215V96h-64v137.27l126.85 204a6.4 6.4 0 0 1 .09 7.12 6.11 6.11 0 0 1-5.88 3.52H70.89a6.08 6.08 0 0 1-5.89-3.44 6.45 6.45 0 0 1 .11-7.18L192 233.27V96h-64v119L10.79 403.5c-29.3 47.1 4.5 108.5 60.1 108.5h306.2c55.7 0 89.4-61.5 60.1-108.5z"></path>
      </svg>            
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

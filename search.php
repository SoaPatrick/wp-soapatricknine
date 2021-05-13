<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package soapatricknine
 */

get_header();

  if ( have_posts() ) : 
    ?>

      <nav aria-label="breadcrumb" class="breadcrumbs">
        <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
        <span class="breadcrumbs__item breadcrumbs__item--last">Search</span>
      </nav>  

      <header>
  		  <h1><?php printf( esc_html'Search: %s', get_search_query() ); ?></h1>
      </header>
      <div class="site__content">
        <?php
          while ( have_posts() ) :
            the_post();
            get_template_part( 'template-partials/content/content', 'list' );
          endwhile;

          soapatricknine_posts_navigation();
        ?>
      </div>
      
    <?php
  else :

    get_template_part( 'template-partials/content/content', 'none' );

  endif;

get_footer();

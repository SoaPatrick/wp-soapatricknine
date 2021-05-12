<?php
/**
 * The home template
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricknine
 */

get_header();

  if ( have_posts() ) :
    ?>
      <nav aria-label="breadcrumb" class="breadcrumbs">
        <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'soapatricknine' ) ?></a></span>
        <span class="breadcrumbs__item breadcrumbs__item--last"><?php esc_html_e( 'Box', 'soapatricknine' ) ?></span>
      </nav>

      <header>
        <div class="marginal-icon marginal-icon--section">
          <?php soapatricknine_svg_icons('box-dual'); ?>
        </div>  
        <h1>Box</h1>
      </header>
      <div class="site__content">
        <?php
          while ( have_posts() ) : the_post();
            get_template_part( 'template-partials/content/content-list', get_post_type() );
          endwhile;

          soapatricknine_posts_navigation();
        ?>
      </div>  
    <?php
  else :

    get_template_part( 'template-partials/content/content', 'none' );

  endif;

get_footer();

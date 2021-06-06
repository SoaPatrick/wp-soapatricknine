<?php
/**
 * The template for displaying factory archive items
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatricknine
 */

get_header(); ?>


  <nav aria-label="breadcrumb" class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last">Factory</span>
  </nav>

  <header>
    <?php if( !is_paged() ) : ?>
      <div class="marginal-icon marginal-icon--section">
        <?php soapatricknine_svg_icons('factory-dual'); ?>
      </div>
    <?php endif ; ?>
    <h1>SoapFactory<?php soapatricknine_rss_feed_button('factory'); ?></h1>
  </header>
  <div class="site__content">
    <?php if( !is_paged() ) : ?>
      <p class="lead">
        Some projects that took quite some time to finish and had a clear goal and purpose.
      </p>
    <?php endif ; ?>
    <div class="tags">
      <?php
        $args = array(
          'orderby'    => 'name',
          'order'      => 'ASC',
          'hide_empty' => TRUE,
          'fields'     => 'all',
        );
        $terms = get_terms( 'factory_tags', $args);
        foreach ( $terms as $term ) {
          $url = get_term_link( $term );
          if ( is_wp_error( $url ) ) {
            continue;
          }
          printf(
            '<a href="%s">%s</a>',
            $url,
            $term->name
          );
        }
      ?>
    </div>

    <div class="tiles-grid">
      <?php
        if ( have_posts() ) :
          while ( have_posts() ) : the_post();
            get_template_part( 'template-partials/content/content', 'teaser-factory' );
          endwhile;
        endif;
      ?>
    </div>

    <?php soapatricknine_posts_navigation(); ?>
  </div>


<?php
get_footer();

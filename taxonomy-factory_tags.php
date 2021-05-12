<?php
/**
 * The template for displaying factory tag items
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatricknine
 */

get_header(); ?>
  <nav aria-label="breadcrumb" class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
    <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link( 'factory' ) ?>">Factory</a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last"><?php echo single_term_title(); ?></span>
  </nav>

  <header> 
    <h1><?php echo single_term_title(); ?></h1>
  </header>
  <div class="site__content">
    <div class="tags">
      <?php
        $args = array(
          'orderby'    => 'name',
          'order'      => 'ASC',
          'hide_empty' => TRUE,
          'fields'     => 'all',
        );
        $terms = get_terms( 'factory_tags', $args);
        $currentTerm = $wp_query->get_queried_object();
          foreach ( $terms as $term ) {
            if ($currentTerm->term_id === $term->term_id)
              echo '<a href="'. get_term_link( $term ) .'" class="active">'. $term->name .'</a>';
            else {
              echo '<a href="'. get_term_link( $term ) .'">'. $term->name .'</a>';
            }
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



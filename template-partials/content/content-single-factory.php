<?php
/**
 * Template part for displaying single factory item
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricksix
 */

?>

  <nav class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'soapatricknine' ) ?></a></span>
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>/factory/"><?php esc_html_e( 'Factory', 'soapatricknine' ) ?></a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last"><?php the_title() ?></span>
  </nav>

  <article id="factory-<?php the_ID(); ?>" <?php post_class('post'); ?>>    
    <header>
      <div class="marginal-icon">
        <?php soapatricknine_svg_icons('factory'); ?>                   
      </div>
      <div class="post__meta">          
        <?php
          soapatricknine_posted_on();
          soapatricknine_edit_post();
        ?>
      </div>
      <?php the_title( '<h1>', '</h1>' ); ?>
    </header>

    <div class="post__content">
      <?php the_content(); ?>
    </div>

    <footer>
      <?php soapatricknine_tags(); ?>
    </footer>


  <?php
    $term = get_field('project');
    if( $term ):
      $args = array(
      'post_type'         => 'post',
      'posts_per_page'    => 20,
      'order'             => 'ASC',
      'tax_query'         => array(
          array(
          'taxonomy'  => 'projects',
          'field'     => 'term_id',
          'terms'     => $term
          )
        )
      );
      $projects = new WP_Query( $args );
      if( $projects->have_posts() ) :
        ?>
          <aside class="section">
            <header>
              <h1>Related Posts</h1>
            </header>
            <?php
              while( $projects->have_posts() ) : $projects->the_post();
                get_template_part( 'template-partials/content/content', 'list' );
              endwhile;
            ?>
          </aside>
        <?php
        wp_reset_postdata();
      endif;
    endif;
  ?>

</article>

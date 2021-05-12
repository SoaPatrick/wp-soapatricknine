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
        <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <path fill="currentColor" d="M404 384h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm-116-12v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12zm-128 0v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12zm352-188v272c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24h80c13.255 0 24 10.745 24 24v185.167l157.267-78.633C301.052 154.641 320 165.993 320 184v57.167l157.267-78.633C493.052 154.641 512 165.993 512 184zM96 280V64H32v384h448V196.944l-180.422 90.211C294.268 289.81 288 285.949 288 280v-83.056l-180.422 90.211C102.269 289.811 96 285.947 96 280z"></path>
        </svg>                  
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

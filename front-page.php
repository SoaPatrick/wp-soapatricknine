<?php
/**
 * The front-page template
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricknine
 */

get_header();

$args = array(
  'post_type'           => array('post','factory','lab'),
  'post_status'         => 'publish',
  'posts_per_page'      => 5,
);

$home_items = new WP_Query( $args );
  ?>

  <header>
    <div class="marginal-icon marginal-icon--image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/patrick1.jpg?_t=20210513" alt="Patrick">         
    </div>    
    <h1>SoaPatrick</h1>
  </header>
  <div class="site__content">
    <p class="lead">
      Welcome to my small nook of <strong>space-consuming</strong> bullshit where I babble about all kinds of stuff that interests me.
    </p>    

    <?php
      if ($home_items->have_posts()) :
        while ( $home_items->have_posts() ) : $home_items->the_post(); 
          get_template_part( 'template-partials/content/content', 'list' );
        endwhile;
      endif;
      wp_reset_postdata();

      get_template_part( 'template-partials/layout/letterboxd-feed' ); 
    ?>
    
  </div>

<?php
get_footer();
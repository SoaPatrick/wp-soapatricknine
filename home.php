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
        <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
        <span class="breadcrumbs__item breadcrumbs__item--last">Box</span>
      </nav>
      <header>
        <?php if( !is_paged() ) : ?>
          <div class="marginal-icon marginal-icon--section">
            <?php soapatricknine_svg_icons('box-dual'); ?>
          </div>
        <?php endif; ?>
        <h1>SoapBox<?php soapatricknine_rss_feed_button('post'); ?></h1>
      </header>
      <div class="site__content">
        <?php if( !is_paged() ) : ?>
          <p class="lead">
            All my thoughts, my work, and some stuff I thought would be interesting to share from over 20 years!
          </p>
          <nav class="sub-navigation">
            <a href="<?php echo get_post_type_archive_link('post'); ?>storage/">Storage &rarr;</a>
            <a href="<?php echo get_post_type_archive_link('post'); ?>tags/">Tags &rarr;</a>
          </nav>
        <?php endif; ?>
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

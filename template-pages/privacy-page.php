<?php
/**
 * Template Name: Privacy Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatricknine
 */

get_header();
?>

  <nav aria-label="breadcrumb" class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last">Privacy</span>
  </nav>

  <header>
    <div class="marginal-icon marginal-icon--section">
      <?php soapatricknine_svg_icons('privacy-dual'); ?>
    </div>
    <div class="post__meta">
      <?php
        soapatricknine_posted_on();
        soapatricknine_edit_post();
      ?>
    </div>
    <h1><?php the_title() ?></h1>
  </header>
  <div class="site__content">
    <?php the_content() ?>
  </div>
  <footer>
    <div class="post__meta post__meta--footer">
      <?php soapatricknine_modified_on(); ?>
    </div>
  </footer>

<?php
get_footer();

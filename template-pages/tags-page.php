<?php
/**
 * Template Name: Tags Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatricknine
 */

get_header();
?>

  <nav aria-label="breadcrumb" class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'soapatricknine' ) ?></a></span>
    <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post'); ?>"><?php esc_html_e( 'Box', 'soapatricknine' ) ?></a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last"><?php esc_html_e( 'Tags', 'soapatricknine' ) ?></span>
  </nav>    

  <header>
    <div class="marginal-icon marginal-icon--section">
      <?php soapatricknine_svg_icons('tags-dual'); ?>         
    </div>       
    <h1><?php esc_html_e( 'Tags', 'soapatricknine' ) ?></h1>
  </header>
  <div class="site__content">
    <nav class="tags tags--cloud alignwide">
      <?php
        $args = array(
          'smallest'                  => .63,
          'largest'                   => 2.5,
          'unit'                      => 'rem'
        );

        wp_tag_cloud( $args );
      ?>
    </nav>
  </div>

<?php
get_footer();

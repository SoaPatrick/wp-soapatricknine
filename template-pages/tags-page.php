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
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
    <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post'); ?>">Box</a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last">Tags</span>
  </nav>    

  <header>     
    <h1>Tags</h1>
  </header>
  <div class="site__content">
    <nav class="tags tags--cloud alignwide">
      <?php
        $args = array(
          'smallest'                  => .63,
          'largest'                   => 2.3,
          'unit'                      => 'rem'
        );

        wp_tag_cloud( $args );
      ?>
    </nav>
  </div>

<?php
get_footer();

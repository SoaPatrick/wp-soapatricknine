<?php
/**
 * Template Name: Storage Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatrickeight
 */

get_header();
?>

  <nav aria-label="breadcrumb" class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>
    <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post'); ?>">Box</a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last">Storage</span>
  </nav>

  <header>        
    <h1>Storage</h1>
  </header>
  <div class="site__content">
    <div class="storage-grid">
      <?php
        while ( have_posts() ) : the_post();

          $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date)
            FROM $wpdb->posts WHERE post_status = 'publish'
            AND post_type = 'post' ORDER BY post_date DESC");

          foreach($years as $year):
            ?>
              <div>
                <h2><?php echo $year; ?></h2>
                <nav>
                  <?php
                    $months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date)
                      FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'
                      AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC");

                    foreach($months as $month): ?>
                      <a href="<?php echo get_month_link($year, $month); ?>"><?php echo date('F', strtotime("2012-$month-01"));?></a>
                    <?php endforeach;
                  ?>
                </nav>
              </div>
            <?php
          endforeach;
        endwhile;
      ?>
    </div>
  </div>

<?php
get_footer();

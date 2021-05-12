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
    <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'soapatrickeight' ) ?></a></span>
    <span class="breadcrumbs__item"><a href="<?php echo get_post_type_archive_link('post'); ?>"><?php esc_html_e( 'Box', 'soapatrickeight' ) ?></a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last"><?php esc_html_e( 'Storage', 'soapatrickeight' ) ?></span>
  </nav>

  <header>
    <div class="marginal-icon marginal-icon--section">
      <!-- <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
        <path fill="currentColor" d="M624 224H480V16c0-8.8-7.2-16-16-16H176c-8.8 0-16 7.2-16 16v208H16c-8.8 0-16 7.2-16 16v256c0 8.8 7.2 16 16 16h608c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16zm-176 32h64v62.3l-32-10.7-32 10.7V256zM352 32v62.3l-32-10.7-32 10.7V32h64zm-160 0h64v106.7l64-21.3 64 21.3V32h64v192H192V32zm0 224v62.3l-32-10.7-32 10.7V256h64zm-160 0h64v106.7l64-21.3 64 21.3V256h80v224H32V256zm576 224H336V256h80v106.7l64-21.3 64 21.3V256h64v224z"></path>
      </svg>  -->
      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path class="primary" d="M320 0v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8V0zm160 288v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8v-88zm-320 0v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8v-88z"></path>
        <path class="secondary" d="M176 224h224a16 16 0 0 0 16-16V16a16 16 0 0 0-16-16h-80v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8V0h-80a16 16 0 0 0-16 16v192a16 16 0 0 0 16 16zm384 64h-80v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8v-88h-80a16 16 0 0 0-16 16v192a16 16 0 0 0 16 16h224a16 16 0 0 0 16-16V304a16 16 0 0 0-16-16zm-320 0h-80v88a8 8 0 0 1-8 8h-48a8 8 0 0 1-8-8v-88H16a16 16 0 0 0-16 16v192a16 16 0 0 0 16 16h224a16 16 0 0 0 16-16V304a16 16 0 0 0-16-16z"></path>
      </svg>     
      <!-- <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
        <path class="secondary" d="M624 0h-32a16 16 0 0 0-16 16v144H64V16A16 16 0 0 0 48 0H16A16 16 0 0 0 0 16v496h64v-32h512v32h64V16a16 16 0 0 0-16-16zm-48 416H64V224h512z"></path>
        <path class="primary" d="M208 256h-96a16 16 0 0 0-16 16v96a16 16 0 0 0 16 16h96a16 16 0 0 0 16-16v-96a16 16 0 0 0-16-16zM464 0h-96a16 16 0 0 0-16 16v96a16 16 0 0 0 16 16h96a16 16 0 0 0 16-16V16a16 16 0 0 0-16-16zm-96 256h-96a16 16 0 0 0-16 16v96a16 16 0 0 0 16 16h96a16 16 0 0 0 16-16v-96a16 16 0 0 0-16-16z"></path>
      </svg>                -->
    </div>         
    <h1><?php esc_html_e( 'Storage', 'soapatrickeight' ) ?></h1>
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
  </article>

<?php
get_footer();

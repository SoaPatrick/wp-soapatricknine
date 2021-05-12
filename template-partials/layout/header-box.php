<?php
/**
 * Layout part for displaying the search
 *
 * @package soapatricknine
 */

?>

<nav aria-label="breadcrumb" class="breadcrumbs">
  <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'soapatricknine' ) ?></a></span>
  <span class="breadcrumbs__item breadcrumbs__item--last"><?php esc_html_e( 'Box', 'soapatricknine' ) ?></span>
</nav>


<header>
  <div class="marginal-icon marginal-icon--section">
    <?php soapatricknine_svg_icons('box-dual'); ?>
  </div>  
  <h1>Box</h1>
</header>


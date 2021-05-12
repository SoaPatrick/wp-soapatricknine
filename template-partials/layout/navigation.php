<?php
/**
 * Layout part for displaying the navigation
 *
 * @package soapatricknine
 */

?>

<header class="global-header">
  <nav class="navigation">
    <a href="<?php echo esc_url( home_url() ); ?>" aria-label="Home" class="navigation__link navigation__link--sp">
      <?php soapatricknine_svg_icons('sp-logo'); ?>
    </a>
    <a href="<?php echo get_post_type_archive_link( 'post' ) ?>" aria-label="<?php esc_html_e( 'Box', 'soapatricknine' ); ?>" class="navigation__link navigation__link--hover<?php if(is_home() || is_singular('post') || is_page_template('template-pages/storage-page.php') || is_page_template('template-pages/tags-page.php') || is_month() || is_tag()) : ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('box-dual'); ?>    
      <span><?php esc_html_e( 'Box', 'soapatricknine' ); ?></span>
    </a>
    <a href="<?php echo get_post_type_archive_link( 'lab' ) ?>" aria-label="<?php esc_html_e( 'Lab', 'soapatricknine' ); ?>" class="navigation__link navigation__link--hover<?php if(is_post_type_archive('lab') || is_singular('lab')) : ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('lab-dual'); ?>          
      <span><?php esc_html_e( 'Lab', 'soapatricknine' ); ?></span>
    </a>
    <a href="<?php echo get_post_type_archive_link( 'factory' ) ?>" aria-label="<?php esc_html_e( 'Factory', 'soapatricknine' ); ?>" class="navigation__link navigation__link--hover<?php if(is_post_type_archive('factory') || is_singular('factory') || is_tax('factory_tags')) : ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('factory-dual'); ?>         
      <span><?php esc_html_e( 'Factory', 'soapatricknine' ); ?></span>
    </a>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>patrick" aria-label="<?php esc_html_e( 'Patrick', 'soapatricknine' ); ?>" class="navigation__link navigation__link--hover navigation__link--hover__short<?php if(is_page_template('template-pages/patrick-page.php')): ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('patrick-dual'); ?>          
      <span><?php esc_html_e( 'Patrick', 'soapatricknine' ); ?></span>
    </a>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>privacy" aria-label="<?php esc_html_e( 'Privacy', 'soapatricknine' ); ?>" class="navigation__link navigation__link--hover navigation__link--hover__short<?php if(is_page_template('template-pages/privacy-page.php')): ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('privacy-dual'); ?>         
      <span><?php esc_html_e( 'Privacy', 'soapatricknine' ); ?></span>
    </a>
    <button type="button" id="toggle-search-collapse" aria-label="<?php esc_html_e( 'Search', 'soapatricknine' ); ?>" class="navigation__link navigation__link--hover<?php if(is_search()): ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('search-dual'); ?>
      <span><?php esc_html_e( 'Search', 'soapatricknine' ); ?></span>
    </button>
  </nav>
</header>


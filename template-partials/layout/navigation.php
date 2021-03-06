<?php
/**
 * Layout part for displaying the navigation
 *
 * @package soapatricknine
 */


if(is_home() || is_singular('post') || is_page_template('template-pages/storage-page.php') || is_page_template('template-pages/tags-page.php') || is_month() || is_tag()) {
  $isBox = true;
}
if(is_post_type_archive('lab') || is_singular('lab')) {
  $isLab = true;
}
if(is_post_type_archive('factory') || is_singular('factory') || is_tax('factory_tags')) {
  $isFactory = true;
}
if(is_page_template('template-pages/patrick-page.php')) {
  $isPatrick = true;
}
if(is_page_template('template-pages/privacy-page.php')) {
  $isPrivacy = true;
}

?>

<header class="global-header">
  <nav class="navigation">
    <a href="<?php echo esc_url( home_url() ); ?>" aria-label="Home" class="navigation__link navigation__link--sp">
      <?php soapatricknine_svg_icons('sp-logo'); ?>
    </a>
    <a href="<?php echo get_post_type_archive_link( 'post' ) ?>" aria-label="Box" class="navigation__link navigation__link--hover<?php if($isBox): ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('box-dual'); ?>
      <span>Box</span>
    </a>
    <a href="<?php echo get_post_type_archive_link( 'lab' ) ?>" aria-label="Lab" class="navigation__link navigation__link--hover<?php if($isLab) : ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('lab-dual'); ?>
      <span>Lab</span>
    </a>
    <a href="<?php echo get_post_type_archive_link( 'factory' ) ?>" aria-label="Factory" class="navigation__link navigation__link--hover<?php if($isFactory) : ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('factory-dual'); ?>
      <span>Factory</span>
    </a>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>patrick" aria-label="Patrick" class="navigation__link navigation__link--hover navigation__link--hover__short<?php if($isPatrick): ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('patrick-dual'); ?>
      <span>Patrick</span>
    </a>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>privacy" aria-label="Privacy" class="navigation__link navigation__link--hover navigation__link--hover__short<?php if($isPrivacy): ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('privacy-dual'); ?>
      <span>Privacy</span>
    </a>
    <button type="button" id="toggle-search-collapse" aria-label="Search" class="navigation__link navigation__link--hover<?php if(is_search()): ?> active<?php endif; ?>">
      <?php soapatricknine_svg_icons('search-dual'); ?>
      <span>Search</span>
    </button>
  </nav>
</header>


<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package soapatricknine
 */

?>

<!doctype html>
<html <?php language_attributes(); ?> data-color="pink" data-theme="dark" data-nav="left">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php
    wp_head();
    get_template_part( 'template-partials/head/favicon');

    if(is_post_type_archive('lab') || is_front_page()):
      ?>
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
        <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script> -->
      <?php
    endif;    
  ?>
</head>

<body <?php body_class(); ?> 
<?php 
  if(is_post_type_archive('lab')):
    echo 'data-theme="darkpink"';
  elseif(is_page_template('template-pages/patrick-page.php')):
    echo 'data-theme="red"';
  elseif(is_page_template('template-pages/privacy-page.php')):
    echo 'data-theme="black"';    
  endif;
?>
>

  <?php
    get_template_part( 'template-partials/layout/search');
    get_template_part( 'template-partials/layout/navigation'); 
  ?>

  <div class="wrapper">
    <main class="global-main site">


<?php
/**
 * Head part for loading the favicons
 *
 * @package soapatricknine
 */

?>

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/site.webmanifest">
<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/safari-pinned-tab.svg" color="#cf3c3b">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon.ico">
<meta name="apple-mobile-web-app-title" content="SoaPatrick">
<meta name="application-name" content="SoaPatrick">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/favicon/browserconfig.xml">
<meta name="theme-color"
<?php 
  if(is_post_type_archive('lab') || is_singular('lab')):
    echo 'content="#ec407a"';
  elseif(is_page_template('template-pages/patrick-page.php')):
    echo 'content="#1c1c1c"';
  elseif(is_page_template('template-pages/privacy-page.php')):
    echo 'content="#666666"';
  else:
    echo 'content="#cf3a3a"';
  endif;
?>
"/>

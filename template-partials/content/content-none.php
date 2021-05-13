<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricknine
 */

?>

<header>
  <h1>
    <?php
      if ( is_search() ) :
        echo 'I found nothing!';
      else :
        echo 'Something went wrong!';
      endif;
    ?>
  </h1>
</header>

<div class="site__content">
  <?php
    if ( is_search() ) :
        echo '<p>' . 'Sorry, but I can&rsquo;t find what you&rsquo;re looking for. Please try again with other words.' . '</p>';
    else :
        echo '<p>' . 'It seems I can&rsquo;t find what you&rsquo;re looking for. Try finding it?' . '</p>';
    endif;
    get_search_form();
    the_widget( 'WP_Widget_Recent_Posts' );
  ?>
</div>

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
        esc_html_e( 'I found nothing!', 'soapatricknine' );
      else :
        esc_html_e( 'Something went wrong!', 'soapatricknine' );
      endif;
    ?>
  </h1>
</header>

<div class="site__content">
  <?php
    if ( is_search() ) :
        echo '<p>' . __( 'Sorry, but I can&rsquo;t find what you&rsquo;re looking for. Please try again with other words.', 'soapatricknine' ) . '</p>';
    else :
        echo '<p>' . __( 'It seems I can&rsquo;t find what you&rsquo;re looking for. Try finding it?', 'soapatricknine' ) . '</p>';
    endif;
    get_search_form();
    the_widget( 'WP_Widget_Recent_Posts' );
  ?>
</div>

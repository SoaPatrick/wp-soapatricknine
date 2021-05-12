<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package soapatricknine
 */

?>
    </main>
    <footer class="global-footer">
      <p>
        <?php echo sprintf( __( 'Stuff from 2000 to %s by SoaPatrick<a href="%s">Eight</a>', 'soapatricknine' ), date('Y'), esc_url( home_url( '/log' )) ); ?></a>
      </p>
    </footer>

  </div>

<?php 
  wp_footer(); 
  ?>
</body>
</html>

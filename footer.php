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
      <p>Stuff from 2000 to <?php echo date('Y'); ?> by SoaPatrick<a href="<?php echo esc_url( home_url( '/log' ) ); ?>">Eight</a></p>
    </footer>

  </div>

<?php 
  wp_footer(); 
  ?>
</body>
</html>

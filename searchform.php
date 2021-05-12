<?php
/**
 * Searchform
 *
 * @package soapatricknine
 */

?>

<form action="<?php echo home_url( '/' ); ?>" method="get" class="search-form">
  <label for="search-collapse__input">
    <input type="text" name="s" id="search-collapse__input" value="<?php the_search_query(); ?>" placeholder="<?php esc_html_e( 'Find Stuff...', 'soapatricknine' ); ?>" aria-label="<?php esc_html_e( 'Find Stuff...', 'soapatricknine' ); ?>" tabindex="-1">
  </label>
</form>



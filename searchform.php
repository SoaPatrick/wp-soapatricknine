<?php
/**
 * Searchform
 *
 * @package soapatricknine
 */

?>

<form action="<?php echo home_url( '/' ); ?>" method="get" class="search-form">
  <label for="search-collapse__input">
    <input type="text" name="s" id="search-collapse__input" value="<?php the_search_query(); ?>" placeholder="Find Stuff..." aria-label="Find Stuff..." tabindex="-1">
  </label>
</form>

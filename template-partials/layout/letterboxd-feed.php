<?php
/**
 * Layout part for displaying letterboxd feed
 *
 * @package soapatricknine
 */

?>
    
<section class="section">   
  <header>
    <div class="marginal-icon marginal-icon--section">
      <?php soapatricknine_svg_icons('tv-dual'); ?>
    </div>       
    <h1>Last seen Movies</h1>
  </header>
  <div class="section__content letterboxd-rss">
    <div class="four-grid alignwide">  
      <?php
        include_once(ABSPATH . WPINC . '/feed.php');
        if(function_exists('fetch_feed')) {
          $feed = fetch_feed('https://letterboxd.com/soapatrick/rss/'); // this is the external website's RSS feed URL
            if (!is_wp_error($feed)) : $feed->init();
            $feed->set_output_encoding('UTF-8'); // this is the encoding parameter, and can be left unchanged in almost every case
            $feed->handle_content_type(); // this double-checks the encoding type
            $feed->set_cache_duration(21600); // 21,600 seconds is six hours
            $limit = $feed->get_item_quantity(4); // fetches the 18 most recent RSS feed stories
            $items = $feed->get_items(0, $limit); // this sets the limit and array for parsing the feed
          endif;
        }

        foreach ($items as $item) { 
          $description = $item->get_description();
          $title = $item->get_title();
          $permalink = $item->get_permalink();

          $description = str_replace( '<img ', '<img alt="'.$title.'" height="750px" width="500px"', $description );
          $titleParts = explode( ' ', $title );
          $titlePartsLength = sizeof($titleParts);
          $rating = $titleParts[$titlePartsLength - 1];
          ?>
            <div class="letterboxd-rss__item">
              <a href="<?php echo $permalink; ?>" class="img-link" target="_blank" rel="noreferrer" aria-label="<?php echo $title; ?>">
                <div class="letterboxd-rss__description"><?php echo $description; ?></div>
                <span class="letterboxd-rss__rating"><?php echo $rating; ?></span>                
              </a>
            </div>
          <?php 
        }
      ?>
    </div>
    <div class="letterboxd-rss__more alignwide">
      <a href="https://letterboxd.com/soapatrick/"  target="_blank" class="more-link" rel="noreferrer">more &rarr;</a>
    </div>
  </div>
</section>  
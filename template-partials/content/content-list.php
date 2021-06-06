<?php
/**
 * Template part for displaying posts in list form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatricknine
 */

$format = get_post_format();
$postType = get_post_type();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post post--list' ); ?>>
  <header>
    <div class="marginal-icon<?php if (has_post_thumbnail() && $postType === 'post'): echo ' marginal-icon--image'; endif; ?>">
      <?php
        if ($postType === 'post') :
          if (has_post_thumbnail()) :
            the_post_thumbnail( 'thumbnail' );
          else :
            soapatricknine_svg_icons($format);
          endif;
        else :
          soapatricknine_svg_icons($postType);
        endif;
      ?>
    </div>
    <div class="post__meta">
      <?php
        soapatricknine_posted_on();
        soapatricknine_edit_post();
      ?>
    </div>
    <?php
      if ($format === 'quote' || $format === 'link' || $format === 'status') :
        the_title( '<h1 class="hidden">', '</h1>' );
        the_content();
      else:
        if($postType === 'lab') : 
          the_title( '<h1 class="hidden">', '</h1>' );
          ?>
            <figure class="wp-block-image">
                <?php get_template_part( 'template-partials/content/content', 'teaser-lab' ); ?>
                <figcaption>
                  <?php the_post_thumbnail_caption(); ?>
                </figcaption>
            </figure>
          <?php
        elseif($postType === 'factory') : 
          the_title( '<h1><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
          the_content();
        else :
          the_title( '<h1><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); 
          the_excerpt();
        endif;
      endif;
    ?>
  </header>
  <footer>
    <?php soapatricknine_tags(); ?>
  </footer>
</article>

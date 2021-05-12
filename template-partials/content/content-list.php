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
        if ($postType === 'factory') :
          soapatricknine_svg_icons('factory');
        elseif ($postType === 'lab') :
          soapatricknine_svg_icons('lab');
        else :
          if (has_post_thumbnail()) :
            the_post_thumbnail( 'thumbnail' );
          else :        
            if ($format === 'quote') :
              soapatricknine_svg_icons('quote');
            elseif ($format === 'link') :
              soapatricknine_svg_icons('link');
            elseif ($format === 'image') :
              soapatricknine_svg_icons('image');
            elseif ($format === 'video') :
              soapatricknine_svg_icons('video');
            elseif ($format === 'status') :
              soapatricknine_svg_icons('status');
            else :
              soapatricknine_svg_icons('pencil');
            endif;
          endif;
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
        the_content();
      else:
        if($postType === 'lab') : 
          ?>
            <figure class="wp-block-image">
              <?php if(get_field('is_video')) : ?>
                <a data-fslightbox="video" href="<?php the_field('video'); ?>" aria-label="<?php the_title() ?>" class="video-link">
              <?php else: ?>
                <a data-fslightbox href="<?php echo get_the_post_thumbnail_url(get_the_ID(),'large'); ?>" aria-label="<?php the_title() ?>">
              <?php endif; 
                the_post_thumbnail( 'medium');
              ?>         
                </a>
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

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
                <a data-fslightbox href="<?php the_field('video'); ?>" aria-label="<?php the_title() ?>" class="glightbox img-link video-link"<?php if(get_the_post_thumbnail_caption()): ?> data-glightbox="title:<?php the_post_thumbnail_caption() ?>"<?php endif; ?>>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="video-link__icon"><path d="M336.2 64H47.8C21.4 64 0 85.4 0 111.8v288.4C0 426.6 21.4 448 47.8 448h288.4c26.4 0 47.8-21.4 47.8-47.8V111.8c0-26.4-21.4-47.8-47.8-47.8zm189.4 37.7L416 177.3v157.4l109.6 75.5c21.2 14.6 50.4-.3 50.4-25.8V127.5c0-25.4-29.1-40.4-50.4-25.8z"></path></svg>
              <?php else: ?>
                <a data-fslightbox href="<?php echo get_the_post_thumbnail_url(get_the_ID(),'large'); ?>" aria-label="<?php the_title() ?>" class="glightbox img-link"<?php if(get_the_post_thumbnail_caption()): ?> data-glightbox="title:<?php the_post_thumbnail_caption() ?>"<?php endif; ?>>
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

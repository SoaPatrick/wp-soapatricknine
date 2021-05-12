<?php
/**
 * The template for displaying change lot archive items
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatricknine
 */

get_header(); ?>

  <nav aria-label="breadcrumb" class="breadcrumbs">
    <span class="breadcrumbs__item"><a href="home.php">Home</a></span>
    <span class="breadcrumbs__item breadcrumbs__item--last">Log</span>
  </nav>

  <header>
    <div class="marginal-icon marginal-icon--section">
      <?php soapatricknine_svg_icons('git-dual'); ?>            
    </div>       
    <h1><?php esc_html_e( 'Change Log', 'soapatricknine' ) ?></h1>
  </header>
  <div class="site__content">
    <div class="changelog" data-infinite-scroll='{ "path": ".post-navigation__previous", "append": ".changelog__day", "history": false, "scrollThreshold": false, "button" : ".post-navigation__previous" }'>
      <?php
        if( have_posts() ) :
          $day_check = '';
          while( have_posts() ) : the_post();

            $day = get_the_date('j');
            if ($day != $day_check) {
              if ($day_check != '') {
                echo '</ul></div>';
              }
              echo '<div class="changelog__day"><h2>' . get_the_date() . '</h2><ul>';
            }
            $field = get_field_object('changelog_type');
            $value = $field['value'];
            $label = $field['choices'][ $value ];
            ?>
              <li>
                <?php
                  if($value == 'added'):
                    soapatricknine_svg_icons('added');
                  elseif($value == 'removed'):
                    soapatricknine_svg_icons('removed');
                  elseif($value == 'changed'):
                    soapatricknine_svg_icons('changed');
                  elseif($value == 'fixed'):
                    soapatricknine_svg_icons('fixed');
                  endif;
                ?>
                <strong><?php echo $label ?></strong>
                <?php the_title(); ?>
              </li>
            <?php
            $day_check = $day;

          endwhile;
        endif;
      ?>
    </div>
  </div>

  <?php soapatricknine_posts_navigation(); ?>

<?php
get_footer();

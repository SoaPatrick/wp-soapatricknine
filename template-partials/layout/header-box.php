<?php
/**
 * Layout part for displaying the search
 *
 * @package soapatricknine
 */

?>

<nav aria-label="breadcrumb" class="breadcrumbs">
  <span class="breadcrumbs__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'soapatricknine' ) ?></a></span>
  <span class="breadcrumbs__item breadcrumbs__item--last"><?php esc_html_e( 'Box', 'soapatricknine' ) ?></span>
</nav>


<header>
  <div class="marginal-icon marginal-icon--section">
    <!-- <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
      <path fill="currentColor" d="M509.5 184.6L458.9 32.8C452.4 13.2 434.1 0 413.4 0H98.6c-20.7 0-39 13.2-45.5 32.8L2.5 184.6c-1.6 4.9-2.5 10-2.5 15.2V464c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V199.8c0-5.2-.8-10.3-2.5-15.2zM32 199.8c0-1.7.3-3.4.8-5.1L83.4 42.9C85.6 36.4 91.7 32 98.6 32H240v168H32v-.2zM480 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V232h448v232zm0-264H272V32h141.4c6.9 0 13 4.4 15.2 10.9l50.6 151.8c.5 1.6.8 3.3.8 5.1v.2z"></path>
    </svg>       -->
    <!-- <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 608 512">
      <path fill="currentColor" d="M606.4 143.8L557.5 41c-2.7-5.6-8.1-9-13.9-9C543 32 304 64 304 64S65 32 64.4 32c-5.8 0-11.2 3.5-13.9 9L1.6 143.8c-4.4 9.2.3 20.2 9.6 23l49.5 14.9V393c0 14.7 9.5 27.5 23 31l205.4 54.1c13 3.4 23.7 1.5 29.5 0L524.2 424c13.5-3.6 23-16.4 23-31V181.7l49.5-14.9c9.4-2.8 14-13.8 9.7-23zM73 65.3l180.9 24.3-57.1 99.8-159.9-48.1 36.1-76zm18.2 125.6C208.3 226.1 200.5 224 203.6 224c5.4 0 10.5-2.9 13.3-7.9l71.9-125.5V445L91.2 393V190.9zM516.8 393l-197.6 52V90.5L391.1 216c2.9 5 8 7.9 13.3 7.9 3.1 0-5 2.1 112.4-33.1V393zM411.3 189.3l-57.1-99.8L535 65.3l36.1 76-159.8 48z"></path>
    </svg>       -->
    <!-- <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
      <path class="secondary" d="M512 224v240a48 48 0 0 1-48 48H48a48 48 0 0 1-48-48V224z"></path>
      <path class="primary" d="M53.1 32.8L2.5 184.6c-.8 2.4-.8 4.9-1.2 7.4H240V0H98.6a47.87 47.87 0 0 0-45.5 32.8zm456.4 151.8L458.9 32.8A47.87 47.87 0 0 0 413.4 0H272v192h238.7c-.4-2.5-.4-5-1.2-7.4z"></path>
    </svg> -->
    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
      <path class="secondary" d="M439 254.14L576 215v178a32.07 32.07 0 0 1-24.2 31l-216.4 54.1a65 65 0 0 1-31 0L88.24 424A31.9 31.9 0 0 1 64 393V215l137 39.2a46 46 0 0 0 13.3 1.9 48.64 48.64 0 0 0 41.5-23.5L320 126l64.3 106.6a48.47 48.47 0 0 0 41.4 23.4 46 46 0 0 0 13.3-1.86z"></path>
      <path class="primary" d="M638.34 143.84L586.84 41a16.33 16.33 0 0 0-16.7-8.9L320 64l91.7 152.1a16.44 16.44 0 0 0 18.5 7.3l197.9-56.5a16.47 16.47 0 0 0 10.24-23.06zM53.24 41L1.74 143.84a16.3 16.3 0 0 0 10.1 23l197.9 56.5a16.44 16.44 0 0 0 18.5-7.3L320 64 69.84 32.14A16.34 16.34 0 0 0 53.24 41z"></path>
    </svg>             
  </div>  
  <h1>Box</h1>
</header>


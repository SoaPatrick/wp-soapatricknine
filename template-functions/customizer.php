<?php
/**
 * Customizer Settings.
 *
 * @package soapatricknine
 */

function soapatricknine_remove_settings() {
  global $wp_customize;
  $wp_customize->remove_panel( 'nav_menus' );
  $wp_customize->remove_panel( 'widgets' );
  $wp_customize->remove_section( 'title_tagline' );
  $wp_customize->remove_section( 'static_front_page');
  $wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'soapatricknine_remove_settings',999,1);

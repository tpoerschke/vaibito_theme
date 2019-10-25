<?php
/**
* Child theme stylesheet einbinden in Abhängigkeit vom Original-Stylesheet
*/

function child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));
}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );


// Fügt die nötigen Bootstrap-Klassen in die Menu-Iems ein
function bootstrap_nav_class($classes, $item) {
    if(in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
	if(in_array('menu-item', $classes)) {
        $classes[] = 'nav-item';
    }
    return $classes;
}
function add_bootstrap_atts($atts, $item, $args) {
    // Bootstrap-Klassen zum NavbarMenu hinzufügen
    if($args->theme_location == 'menu-1') {
      $atts['class'] = 'nav-link';
    }
    return $atts;
}
// Funktionen für Bootstrap (s.o.) bekannt machen
add_filter('nav_menu_css_class' , 'bootstrap_nav_class' , 10 , 2);
add_filter('nav_menu_link_attributes', 'add_bootstrap_atts', 10, 3);
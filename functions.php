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
        $atts['class'] = 'nav-link d-block';

        if($atts["aria-current"] == "page") {
            $atts['class'] .= ' active';
        }
    }

    return $atts;
}
// Funktionen für Bootstrap (s.o.) bekannt machen
add_filter('nav_menu_css_class' , 'bootstrap_nav_class' , 10 , 2);
add_filter('nav_menu_link_attributes', 'add_bootstrap_atts', 10, 3);


// Logo Support des Parent Themes überschreiben
// (durch Änderung der Priorität)
function override_customlogo() {
    //remove_theme_support('custom-logo');
    add_theme_support('custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ]);
}
add_action('after_setup_theme', 'override_customlogo', 20);

// Register Custom Post Type
function register_post_type_tours() {

	$labels = [
		'name'                  => 'Touren',
		'singular_name'         => 'Tour',
		'menu_name'             => 'Touren',
		'name_admin_bar'        => 'Tour',
		'archives'              => 'Touren-Archiv',
		'attributes'            => 'Touren-Attribute',
		'parent_item_colon'     => 'Parent Item:',
		'all_items'             => 'Alle Touren',
		'add_new_item'          => 'Tour erstellen',
		'add_new'               => 'Hinzufügen',
		'new_item'              => 'Neue Tour',
		'edit_item'             => 'Tour bearbeiten',
		'update_item'           => 'Tour aktualisieren',
		'view_item'             => 'Tour ansehen',
		'view_items'            => 'Touren ansehen',
		'search_items'          => 'Suche Tour',
		'not_found'             => 'Keine Tour gefunden',
		'not_found_in_trash'    => 'Keine Tour im Papierkorb gefunden',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into item',
		'uploaded_to_this_item' => 'Uploaded to this item',
		'items_list'            => 'Touren-Übersicht',
		'items_list_navigation' => 'Touren-Übersicht Navigation',
		'filter_items_list'     => 'Filter Touren-Übersicht',
    ];
	$args = [
		'label'                 => 'Tour',
		'description'           => 'Stellt eine Tour dar',
		'labels'                => $labels,
		'supports'              => ['title', 'editor'],
		'taxonomies'            => ['post_tag'],
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
        'show_in_rest'          => true,
        // todo: weitere einfügen
        // todo: Zugriffsbeschränkung
        'template' => [
            ['core/paragraph', [
                'placeholder' => 'Kurzbeschreibung',
            ]],
        ],
    ];
	register_post_type('tours', $args);

}
add_action('init', 'register_post_type_tours', 0);
<?php
function my_theme_enqueue_styles() {
	$parent_style = 'site-css';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/assets/css/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


// The Sidebar Menu
function joints_sidebar_nav() {
     wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical accordion-menu menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>', // add data-attributes here
        'theme_location' => 'main-nav',                 // Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Sidebar_Menu_Walker()
    ));
} 

class Sidebar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu vertical nested\">\n";
    }
}

// The Top Menu
function joints_top_nav_dropdown_depth2() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'dropdown menu',       // Adding custom nav class
        'items_wrap'     => '<ul id="%1$s" class="%2$s show-for-medium" data-dropdown-menu>%3$s</ul>',
        'theme_location' => 'main-nav',        			// Where it's located in the theme
        'depth' => 2,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Topbar_Menu_Walker()
    ));
} /* End Top Menu */

add_post_type_support( 'page', 'excerpt' );    
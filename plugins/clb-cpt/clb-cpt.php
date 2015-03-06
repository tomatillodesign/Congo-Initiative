<?php
/* 
Plugin Name: Newsletter & Testimonial Custom Post Types
Description: Site specific code changes for firstucctroy.org 
Author: Chris Liu-Beers | Tomatillo Design
Author URI: http://www.tomatillodesign.com
*/
/* Start Adding Functions Below this Line */

//* Add a custom post type: People
//* Ref: http://codex.wordpress.org/Function_Reference/register_post_type
add_action( 'init', 'clb_post_type' );
function clb_post_type() {

    register_post_type( 'people',
        array(
            'labels' => array(
                'name' => __( 'People' ),
                'singular_name' => __( 'Person' ),
                'add_new' => _x('Add new Person', 'People'),
                'add_new_item' => __('Add new Person'),
                'edit_item' => __('Edit Person'),
                'new_item' => __('New Person'),
                'view_item' => __('View Person'),
            ),
            'has_archive' => true,
            'public' => true,
            'menu_icon' => 'dashicons-groups', // see full list of dashicons here: http://www.kevinleary.net/dashicons-custom-post-type/
            'show_ui' => true, // defaults to true so don't have to include
            'show_in_menu' => true, // defaults to true so don't have to include
            'menu_position' => 20, // set default position in left-hand WP menu
            'rewrite' => array( 'slug' => 'people' ),
            'supports' => array( 'title', 'editor', 'thumbnail', 'genesis-cpt-archives-settings', 'page-attributes' ),
        )
    );

}

//* Change default from "Add New Title" to "Title of Resource" in WP title bar
function clb_change_default_title( $title ){
     $screen = get_current_screen();
 
     if  ( 'people' == $screen->post_type ) {
          $title = 'Name (First Last)';
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'clb_change_default_title' );

// Create custom taxonomies: http://codex.wordpress.org/Function_Reference/register_taxonomy
// hook into the init action and call create_resource_taxonomies when it fires
add_action( 'init', 'clb_create_resource_taxonomies', 0 );

function clb_create_resource_taxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __( 'Roles' ),
    'singular_name'     => __( 'Role' ),
    'search_items'      => __( 'Search Roles' ),
    'all_items'         => __( 'All Roles' ),
    'parent_item'       => __( 'Parent Roles' ),
    'parent_item_colon' => __( 'Parent Role:' ),
    'edit_item'         => __( 'Edit Roles' ),
    'update_item'       => __( 'Update Role' ),
    'add_new_item'      => __( 'Add New Role' ),
    'new_item_name'     => __( 'New Role' ),
    'menu_name'         => __( 'Roles' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'role' ),
  );

  register_taxonomy( 'role', array( 'people' ), $args );

}

//CLB Standard Site Customizations

//Add a new custom widget to the WordPress Dashboard
function clb_register_my_dashboard_widget() {
    global $wp_meta_boxes;

    $site_title = get_bloginfo();
    $welcome = 'Welcome to ' . $site_title;

    wp_add_dashboard_widget(
        'my_dashboard_widget',
        $welcome,
        'clb_my_dashboard_widget_display'
    );

    $dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

    $my_widget = array( 'my_dashboard_widget' => $dashboard['my_dashboard_widget'] );
    unset( $dashboard['my_dashboard_widget'] );

    $sorted_dashboard = array_merge( $my_widget, $dashboard );
    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action( 'wp_dashboard_setup', 'clb_register_my_dashboard_widget' );

function clb_my_dashboard_widget_display() {
    ?>
 
    <p>Congratulations on launching your new website. There are videos and a training manual for common tasks in the upper left, under the "Manual" tab.</p>
    <p>Please don't hesitate to contact me if you have any questions:<br/>
<a href="http://www.tomatillodesign.com" title="Beautiful, Affordable Websites for Nonprofits" target="_blank"><img src="http://www.tomatillodesign.com/wp-content/uploads/2011/03/tomatillo_only_190.jpg" style="float:right"></a><a href="mailto:chris@tomatillodesign.com" target="_blank">chris@tomatillodesign.com</a> | 919.576.0180</p>

<p>Thanks for choosing to work with <a href="http://www.tomatillodesign.com" title="Beautiful, Affordable Websites for Nonprofits" target="_blank">Tomatillo Design</a>.</p>
 
    <?php
}


//Set Default Image Link to "None"
update_option('image_default_link_type','file');














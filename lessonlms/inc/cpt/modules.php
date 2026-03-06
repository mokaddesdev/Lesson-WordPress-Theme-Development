<?php
/**
 * Register Custom Post Type Modules
 * 
 * @package  lessonlms
 */
function lessonlms_custome_modules_register(){
    $labels = array(
        'name'                  => __( 'Modules', 'lessonlms' ),
        'singular_name'         => __( 'Module', 'lessonlms' ),
        'menu_name'             => __( 'Modules', 'lessonlms' ),
        'name_admin_bar'        => __( 'Module', 'lessonlms' ),
        'add_new'               => __( 'Add New', 'lessonlms' ),
        'add_new_item'          => __( 'Add New Module', 'lessonlms' ),
        'new_item'              => __( 'New Module', 'lessonlms' ),
        'edit_item'             => __( 'Edit Module', 'lessonlms' ),
        'view_item'             => __( 'View Module', 'lessonlms' ),
        'all_items'             => __( 'All Modules', 'lessonlms' ),
        'search_items'          => __( 'Search Modules', 'lessonlms' ),
        'parent_item_colon'     => __( 'Parent Modules:', 'lessonlms' ),
        'not_found'             => __( 'No Modules found.', 'lessonlms' ),
        'not_found_in_trash'    => __( 'No Modules found in Trash.', 'lessonlms' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'Modules custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
         'rewrite'           => array( 'slug' => 'modules_slug' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'menu_position'      => 50,
        'supports'           => array( 'title', 'author' ),
        'show_in_rest'       => false,
    );
  
    register_post_type( 'modules', $args );
}
add_action( 'init', 'lessonlms_custome_modules_register' );

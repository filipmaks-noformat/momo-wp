<?php 
/**
 * Custom post types
 *
 * @package nf_wp_theme
 */


// Custom post type Pertners
function create_partners_cpt(){
    $labels = array(
        'name'                  => __('Partners'),
        'singular_name'         => __('Partners'),
        'add_new'               => __('Add Partner'),
        'add_new_item'          => __('Add New Partner'),
        'edit_item'             => __('Edit Partner'),
        'new_item'              => __('New Partner'),
        'all_items'             => __('All Partners'),
        'view_item'             => __('View Partners'),
        'search_items'          => __('Search Partners'),
        'not_found'             => __('No Partners found'),
        'not_found_in_trash'    => __('No Partners found in the Trash'),
        'menu_name'             => 'Partners',
        );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'menu_position' => 24,
        'menu_icon'     => __( 'dashicons-admin-site' ),
        'supports'      => array('title', 'editor', 'thumbnail'),
		'show_in_rest' 	=> true,
        'exclude_from_search' => false
        );
    register_post_type('partners', $args);
}
add_action('init', 'create_partners_cpt');
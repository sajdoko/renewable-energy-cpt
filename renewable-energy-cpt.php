<?php
/*
Plugin Name: Renewable Energy CPT
Plugin URI: https://github.com/sajdoko/renewable-energy
Description: Adds the Slides Post Type + Projects Post Type with the 'type' taxonomy
Author: Sajmir Doko
Version: 1.0.0
Author URI: https://www.linkedin.com/in/sajmirdoko
Contributors: sajdoko
Tags: Renewable, Energy
Requires at least: 4.0
Tested up to: 4.8
Stable tag: trunk
Requires PHP: 5.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Create Slides Post Type
function register_slides_posttype_init() {
    /**
     * add the projects custom post type
     * https://codex.wordpress.org/Function_Reference/register_post_type
     */
    $labels = array(
        'name' => _x('Slides', 'post type general name', 'renewable-energy-cpt'),
        'singular_name' => _x('Slide', 'post type singular name', 'renewable-energy-cpt'),
        'add_new' => __('Add New Slide', 'renewable-energy-cpt'),
        'add_new_item' => __('Add New Slide', 'renewable-energy-cpt'),
        'edit_item' => __('Edit Slide', 'renewable-energy-cpt'),
        'new_item' => __('New Slide', 'renewable-energy-cpt'),
        'view_item' => __('View Slide', 'renewable-energy-cpt'),
        'search_items' => __('Search Slides', 'renewable-energy-cpt'),
        'not_found' => __('Slide', 'renewable-energy-cpt'),
        'not_found_in_trash' => __('Slide', 'renewable-energy-cpt'),
        'parent_item_colon' => __('Slide', 'renewable-energy-cpt'),
        'menu_name' => __('Slides', 'renewable-energy-cpt'),
    );

    $taxonomies = array();

    $supports = array('editor', 'title', 'thumbnail');

    $post_type_args = array(
        'labels' => $labels,
        'singular_label' => _x('Slide', 'post type singular label', 'renewable-energy-cpt'),
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'slides', 'with_front' => false),
        'supports' => $supports,
        'menu_position' => 7, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
        'menu_icon' => 'dashicons-image-flip-horizontal',
        'taxonomies' => $taxonomies,
    );
    register_post_type('slides', $post_type_args);
}
add_action('init', 'register_slides_posttype_init');

// Create Projects Post Type
function register_projects_posttype_init() {
    /**
     * add the projects custom post type
     * https://codex.wordpress.org/Function_Reference/register_post_type
     */
    $labels = array(
        'name' => _x('Projects', 'post type general name', 'renewable-energy-cpt'),
        'singular_name' => _x('Project', 'post type singular name', 'renewable-energy-cpt'),
        'add_new' => __('Add New Project', 'renewable-energy-cpt'),
        'add_new_item' => __('Add New Project', 'renewable-energy-cpt'),
        'edit_item' => __('Edit Project', 'renewable-energy-cpt'),
        'new_item' => __('New Project', 'renewable-energy-cpt'),
        'view_item' => __('View Project', 'renewable-energy-cpt'),
        'search_items' => __('Search Projects', 'renewable-energy-cpt'),
        'not_found' => __('Project', 'renewable-energy-cpt'),
        'not_found_in_trash' => __('Project', 'renewable-energy-cpt'),
        'parent_item_colon' => __('Project', 'renewable-energy-cpt'),
        'menu_name' => __('Projects', 'renewable-energy-cpt'),
    );

    $taxonomies = array();

    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'excerpt',
    );

    $post_type_args = array(
        'labels' => $labels,
        'singular_label' => _x('Project', 'post type singular label', 'renewable-energy-cpt'),
        'public' => true,
        'show_ui' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'projects', 'with_front' => false),
        'supports' => $supports,
        'menu_position' => 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
        'menu_icon' => 'dashicons-portfolio',
        'taxonomies' => $taxonomies,
    );
    register_post_type('projects', $post_type_args);

    /**
     * Add new taxonomy, type, make it hierarchical (like categories) and associate it to the projects Custom Post Type
     * https://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    $labels = array(
        'name' => _x('Types', 'taxonomy general name', 'renewable-energy-cpt'),
        'singular_name' => _x('Type', 'taxonomy singular name', 'renewable-energy-cpt'),
        'search_items' => __('Search Types', 'renewable-energy-cpt'),
        'all_items' => __('All Types', 'renewable-energy-cpt'),
        'parent_item' => __('Parent Type', 'renewable-energy-cpt'),
        'parent_item_colon' => __('Parent Type:', 'renewable-energy-cpt'),
        'edit_item' => __('Edit Type', 'renewable-energy-cpt'),
        'update_item' => __('Update Type', 'renewable-energy-cpt'),
        'add_new_item' => __('Add New Type', 'renewable-energy-cpt'),
        'new_item_name' => __('New Type Name', 'renewable-energy-cpt'),
        'menu_name' => __('Type', 'renewable-energy-cpt'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'type'),
    );

    register_taxonomy('type', array('projects'), $args);

}
add_action('init', 'register_projects_posttype_init');

/**
 * this hook will regenerate the permalinks when the plugin is activated.
 */
function renewable_energy_regenerate_htaccess() {
    register_projects_posttype_init();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'renewable_energy_regenerate_htaccess');
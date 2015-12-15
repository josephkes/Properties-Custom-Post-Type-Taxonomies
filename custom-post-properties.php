<?php
/*
 * Plugin Name: Properies
 * Plugin URI: https://github.com/josephkes/Properties-Custom-Post-Type-Taxonomies
 * Description: A simple plugin that adds custom post types and taxonomies to your WordPress installation
 * Version: 0.2
 * Author: Joseph Kesisoglou
 * Author URI: http://josephkesisoglou.co.uk
 * License: GPL2
 */

/*  Copyright 2015  Joseph Kesisoglou  ( info[at]josephkesisoglou.co.uk)

    This plugin is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This plugin is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this plugin; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Create Custom Post Types
function jk_create_post_types() {

   // Properties Post Type    
        $labels = array(
        'name'               => 'Properties',
        'singular_name'      => 'Property',
        'menu_name'          => 'Properties',
        'name_admin_bar'     => 'Properties',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Property',
        'new_item'           => 'New Property',
        'edit_item'          => 'Edit Property',
        'view_item'          => 'View Property',
        'all_items'          => 'All Properties',
        'search_items'       => 'Search Properties',
        'parent_item_colon'  => 'Parent Properties:',
        'not_found'          => 'No Properties found.',
        'not_found_in_trash' => 'No Properties found in Trash.',
    );
    
        $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-building',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'properties' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        'taxonomies'         => array( 'category', 'type', 'id' )
    );
    
    register_post_type( 'properties', $args );
}

add_action('init', 'jk_create_post_types');

// Flush rewrite rules to add "properties" as a permalink slug
function jk_rewrite_flush() {
    jk_create_post_types();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'jk_rewrite_flush' );

// Child Theme Support for Custom Taxonomy
if ( ! function_exists( 'jk_create_taxonomies' ) ) {

// Register Custom Taxonomy
function jk_create_taxonomies() {
    // Custom Taxonomy Type - Property Type
	$labels = array(
		'name'                       => 'Types',
		'singular_name'              => 'Type',
		'menu_name'                  => 'Type',
		'all_items'                  => 'All Types',
		'parent_item'                => 'Parent Type',
		'parent_item_colon'          => 'Parent Type:',
		'new_item_name'              => 'New Type Name',
		'add_new_item'               => 'Add New Type',
		'edit_item'                  => 'Edit Type',
		'update_item'                => 'Update Type',
		'view_item'                  => 'View Type',
		'separate_items_with_commas' => 'Separate type with commas',
		'add_or_remove_items'        => 'Add or remove types',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Types',
		'search_items'               => 'Search Types',
		'not_found'                  => 'No Types found',
		'items_list'                 => 'Types list',
		'items_list_navigation'      => 'Types list navigation',
	);
	$rewrite = array(
		'slug'                       => 'type',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'Type', array( 'properties' ), $args );
    
    // Custom Taxonomy ID - Property ID
	$labels = array(
		'name'                       => 'IDs',
		'singular_name'              => 'ID',
		'menu_name'                  => 'ID',
		'all_items'                  => 'All IDs',
		'parent_item'                => 'Parent ID',
		'parent_item_colon'          => 'Parent ID:',
		'new_item_name'              => 'New ID Name',
		'add_new_item'               => 'Add New ID',
		'edit_item'                  => 'Edit ID',
		'update_item'                => 'Update ID',
		'view_item'                  => 'View ID',
		'separate_items_with_commas' => 'Only use one ID. If several IDs required, separate with commas',
		'add_or_remove_items'        => 'Add or remove IDs',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular IDs',
		'search_items'               => 'Search IDs',
		'not_found'                  => 'No IDs found',
		'items_list'                 => 'IDs list',
		'items_list_navigation'      => 'IDs list navigation',
	);
	$rewrite = array(
		'slug'                       => 'id',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'ID', array( 'properties' ), $args );
    
    // Custom Taxonomy Area - Property Area
	$labels = array(
		'name'                       => 'Areas',
		'singular_name'              => 'Area',
		'menu_name'                  => 'Area',
		'all_items'                  => 'All Areas',
		'parent_item'                => 'Parent Area',
		'parent_item_colon'          => 'Parent Area:',
		'new_item_name'              => 'New Area Name',
		'add_new_item'               => 'Add New Area',
		'edit_item'                  => 'Edit Area',
		'update_item'                => 'Update Area',
		'view_item'                  => 'View Area',
		'separate_items_with_commas' => 'Only use one Area. If several Areas required, separate with commas',
		'add_or_remove_items'        => 'Add or remove Areas',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Areas',
		'search_items'               => 'Search Areas',
		'not_found'                  => 'No Areas found',
		'items_list'                 => 'Areas list',
		'items_list_navigation'      => 'Areas list navigation',
	);
	$rewrite = array(
		'slug'                       => 'area',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'ID', array( 'properties' ), $args );

}
add_action( 'init', 'jk_create_taxonomies', 0 );

}

?>

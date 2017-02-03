<?php
/**
/**
 * Service custom post type class.
 *
 * Defines the service post type.
 *
 * @package    Easy_Boats
 * @subpackage Easy_Boats/admin
 */

class Easy_Boats_Service_Post_Type {

    /**
     * Register Service Post Type
     * @since 1.0.0
     */
    public function register_service_post_type() {
        $labels = array(
            'name'               => _x( 'Services', 'post type general name', 'easy-boats' ),
            'singular_name'      => _x( 'Service', 'post type singular name', 'easy-boats' ),
            'menu_name'          => _x( 'Services', 'admin menu', 'easy-boats' ),
            'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'easy-boats' ),
            'add_new'            => _x( 'Add New', 'service', 'easy-boats' ),
            'add_new_item'       => __( 'Add New Service', 'easy-boats' ),
            'new_item'           => __( 'New Service', 'easy-boats' ),
            'edit_item'          => __( 'Edit Service', 'easy-boats' ),
            'view_item'          => __( 'View Service', 'easy-boats' ),
            'all_items'          => __( 'All Services', 'easy-boats' ),
            'search_items'       => __( 'Search Services', 'easy-boats' ),
            'parent_item_colon'  => __( 'Parent Services:', 'easy-boats' ),
            'not_found'          => __( 'No services found.', 'easy-boats' ),
            'not_found_in_trash' => __( 'No services found in Trash.', 'easy-boats' )
        );

        $rewrite = array(
            'slug'                => 'service',
            'with_front'          => true,
            'pages'               => true,
            'feeds'               => false,
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'rewrite'            => $rewrite,
            'menu_position'      => 8,
            'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
            'menu_icon'          => 'dashicons-admin-generic'
        );

        register_post_type( 'service', $args );
    }

    /**
     * Register Service Type Taxonomy
     * @since 1.0.0
     */
    public function register_service_type_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Types', 'taxonomy general name' ),
            'singular_name'              => _x( 'Type', 'taxonomy singular name' ),
            'search_items'               => __( 'Search Types' ),
            'popular_items'              => __( 'Popular Types' ),
            'all_items'                  => __( 'All Types' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __( 'Edit Type' ),
            'update_item'                => __( 'Update Type' ),
            'add_new_item'               => __( 'Add New Type' ),
            'new_item_name'              => __( 'New Type Name' ),
            'separate_items_with_commas' => __( 'Separate types with commas' ),
            'add_or_remove_items'        => __( 'Add or remove types' ),
            'choose_from_most_used'      => __( 'Choose from the most used types' ),
            'not_found'                  => __( 'No types found.' ),
            'menu_name'                  => __( 'Types' ),
        );

        $args = array(
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'service-type' ),
        );

        register_taxonomy( 'service-type', 'service', $args );
    }
}
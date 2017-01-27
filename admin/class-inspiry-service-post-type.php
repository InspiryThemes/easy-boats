<?php
/**
/**
 * Service custom post type class.
 *
 * Defines the service post type.
 *
 * @package    Inspiry_Yachtpress
 * @subpackage Inspiry_Yachtpress/admin
 */

class Inspiry_Service_Post_Type {

    /**
     * Register Service Post Type
     * @since 1.0.0
     */
    public function register_service_post_type() {
        $labels = array(
            'name'               => esc_html_x( 'Services', 'post type general name', 'inspiry-yachtpress' ),
            'singular_name'      => esc_html_x( 'Service', 'post type singular name', 'inspiry-yachtpress' ),
            'menu_name'          => esc_html_x( 'Services', 'admin menu', 'inspiry-yachtpress' ),
            'name_admin_bar'     => esc_html_x( 'Service', 'add new on admin bar', 'inspiry-yachtpress' ),
            'add_new'            => esc_html_x( 'Add New', 'service', 'inspiry-yachtpress' ),
            'add_new_item'       => esc_html__( 'Add New Service', 'inspiry-yachtpress' ),
            'new_item'           => esc_html__( 'New Service', 'inspiry-yachtpress' ),
            'edit_item'          => esc_html__( 'Edit Service', 'inspiry-yachtpress' ),
            'view_item'          => esc_html__( 'View Service', 'inspiry-yachtpress' ),
            'all_items'          => esc_html__( 'All Services', 'inspiry-yachtpress' ),
            'search_items'       => esc_html__( 'Search Services', 'inspiry-yachtpress' ),
            'parent_item_colon'  => esc_html__( 'Parent Services:', 'inspiry-yachtpress' ),
            'not_found'          => esc_html__( 'No services found.', 'inspiry-yachtpress' ),
            'not_found_in_trash' => esc_html__( 'No services found in Trash.', 'inspiry-yachtpress' )
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
            'name'                       => esc_html_x( 'Types', 'taxonomy general name' ),
            'singular_name'              => esc_html_x( 'Type', 'taxonomy singular name' ),
            'search_items'               => esc_html__( 'Search Types' ),
            'popular_items'              => esc_html__( 'Popular Types' ),
            'all_items'                  => esc_html__( 'All Types' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => esc_html__( 'Edit Type' ),
            'update_item'                => esc_html__( 'Update Type' ),
            'add_new_item'               => esc_html__( 'Add New Type' ),
            'new_item_name'              => esc_html__( 'New Type Name' ),
            'separate_items_with_commas' => esc_html__( 'Separate types with commas' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove types' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used types' ),
            'not_found'                  => esc_html__( 'No types found.' ),
            'menu_name'                  => esc_html__( 'Types' ),
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
<?php
/**
 * Boat custom post type class.
 *
 * Defines the boat post type.
 *
 * @package    Inspiry_Yachtpress
 * @subpackage Inspiry_Yachtpress/admin
 */

class Inspiry_Boat_Post_Type {

    /**
     * Register Boat Post Type
     * @since 1.0.0
     */
    public function register_boat_post_type() {

        $labels = array(
            'name'                => esc_html_x( 'Boats', 'Post Type General Name', 'inspiry-yachtpress' ),
            'singular_name'       => esc_html_x( 'Boat', 'Post Type Singular Name', 'inspiry-yachtpress' ),
            'menu_name'           => esc_html__( 'Boats', 'inspiry-yachtpress' ),
            'name_admin_bar'      => esc_html__( 'Boat', 'inspiry-yachtpress' ),
            'parent_item_colon'   => esc_html__( 'Parent Boat:', 'inspiry-yachtpress' ),
            'all_items'           => esc_html__( 'All Boats', 'inspiry-yachtpress' ),
            'add_new_item'        => esc_html__( 'Add New Boat', 'inspiry-yachtpress' ),
            'add_new'             => esc_html__( 'Add New', 'inspiry-yachtpress' ),
            'new_item'            => esc_html__( 'New Boat', 'inspiry-yachtpress' ),
            'edit_item'           => esc_html__( 'Edit Boat', 'inspiry-yachtpress' ),
            'update_item'         => esc_html__( 'Update Boat', 'inspiry-yachtpress' ),
            'view_item'           => esc_html__( 'View Boat', 'inspiry-yachtpress' ),
            'search_items'        => esc_html__( 'Search Boat', 'inspiry-yachtpress' ),
            'not_found'           => esc_html__( 'Not found', 'inspiry-yachtpress' ),
            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'inspiry-yachtpress' ),
        );

        $rewrite = array(
            'slug'                => apply_filters( 'inspiry_boat_slug', esc_html__( 'boat', 'inspiry-yachtpress' ) ),
            'with_front'          => true,
            'pages'               => true,
            'feeds'               => true,
        );

        $args = array(
            'label'               => esc_html__( 'boat', 'inspiry-yachtpress' ),
            'description'         => esc_html__( 'Boat', 'inspiry-yachtpress' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'page-attributes', 'comments' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
           // 'menu_icon'           => 'dashicons-building',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'post',
        );

        register_post_type( 'boat', $args );

    }

    /**
     * Register Boat Type Taxonomy
     * @since 1.0.0
     */
    public function register_boat_type_taxonomy() {

        $labels = array(
            'name'                       => esc_html_x( 'Boat Type', 'Taxonomy General Name', 'inspiry-yachtpress' ),
            'singular_name'              => esc_html_x( 'Boat Type', 'Taxonomy Singular Name', 'inspiry-yachtpress' ),
            'menu_name'                  => esc_html__( 'Types', 'inspiry-yachtpress' ),
            'all_items'                  => esc_html__( 'All Boat Types', 'inspiry-yachtpress' ),
            'parent_item'                => esc_html__( 'Parent Boat Type', 'inspiry-yachtpress' ),
            'parent_item_colon'          => esc_html__( 'Parent Boat Type:', 'inspiry-yachtpress' ),
            'new_item_name'              => esc_html__( 'New Boat Type Name', 'inspiry-yachtpress' ),
            'add_new_item'               => esc_html__( 'Add New Boat Type', 'inspiry-yachtpress' ),
            'edit_item'                  => esc_html__( 'Edit Boat Type', 'inspiry-yachtpress' ),
            'update_item'                => esc_html__( 'Update Boat Type', 'inspiry-yachtpress' ),
            'view_item'                  => esc_html__( 'View Boat Type', 'inspiry-yachtpress' ),
            'separate_items_with_commas' => esc_html__( 'Separate Boat Types with commas', 'inspiry-yachtpress' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Boat Types', 'inspiry-yachtpress' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'inspiry-yachtpress' ),
            'popular_items'              => esc_html__( 'Popular Boat Types', 'inspiry-yachtpress' ),
            'search_items'               => esc_html__( 'Search Boat Types', 'inspiry-yachtpress' ),
            'not_found'                  => esc_html__( 'Not Found', 'inspiry-yachtpress' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'inspiry_boat_type_slug', esc_html__( 'boat-type', 'inspiry-yachtpress' ) ),
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

        register_taxonomy( 'boat-type', array( 'boat' ), $args );

    }

    /**
     * Register Boat Hull Type Taxonomy
     * @since 1.0.0
     */
    public function register_boat_hull_type_taxonomy() {

        $labels = array(
            'name'                       => esc_html_x( 'Boat Hull Types', 'Taxonomy General Name', 'inspiry-yachtpress' ),
            'singular_name'              => esc_html_x( 'Boat Feature', 'Taxonomy Singular Name', 'inspiry-yachtpress' ),
            'menu_name'                  => esc_html__( 'Hull Types', 'inspiry-yachtpress' ),
            'all_items'                  => esc_html__( 'All Boat Hull Types', 'inspiry-yachtpress' ),
            'parent_item'                => esc_html__( 'Parent Boat Hull Type', 'inspiry-yachtpress' ),
            'parent_item_colon'          => esc_html__( 'Parent Boat Hull Type:', 'inspiry-yachtpress' ),
            'new_item_name'              => esc_html__( 'New Boat Hull Type Name', 'inspiry-yachtpress' ),
            'add_new_item'               => esc_html__( 'Add New Boat Hull Type', 'inspiry-yachtpress' ),
            'edit_item'                  => esc_html__( 'Edit Boat Hull Type', 'inspiry-yachtpress' ),
            'update_item'                => esc_html__( 'Update Boat Hull Type', 'inspiry-yachtpress' ),
            'view_item'                  => esc_html__( 'View Boat Hull Type', 'inspiry-yachtpress' ),
            'separate_items_with_commas' => esc_html__( 'Separate Boat Hull Types with commas', 'inspiry-yachtpress' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Boat Hull Types', 'inspiry-yachtpress' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'inspiry-yachtpress' ),
            'popular_items'              => esc_html__( 'Popular Boat Hull Types', 'inspiry-yachtpress' ),
            'search_items'               => esc_html__( 'Search Boat Hull Types', 'inspiry-yachtpress' ),
            'not_found'                  => esc_html__( 'Not Found', 'inspiry-yachtpress' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'inspiry_boat_hull_type_slug', esc_html__( 'boat-hull-type', 'inspiry-yachtpress' ) ),
            'with_front'                 => true,
            'hierarchical'               => true,
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => false,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
        );

        register_taxonomy( 'boat-hull-type', array( 'boat' ), $args );

    }

    /**
     * Register Boat Status Taxonomy
     * @since 1.0.0
     */
    public function register_boat_status_taxonomy() {

        $labels = array(
            'name'                       => esc_html_x( 'Boat Status', 'Taxonomy General Name', 'inspiry-yachtpress' ),
            'singular_name'              => esc_html_x( 'Boat Status', 'Taxonomy Singular Name', 'inspiry-yachtpress' ),
            'menu_name'                  => esc_html__( 'Statuses', 'inspiry-yachtpress' ),
            'all_items'                  => esc_html__( 'All Boat Statuses', 'inspiry-yachtpress' ),
            'parent_item'                => esc_html__( 'Parent Boat Status', 'inspiry-yachtpress' ),
            'parent_item_colon'          => esc_html__( 'Parent Boat Status:', 'inspiry-yachtpress' ),
            'new_item_name'              => esc_html__( 'New Boat Status Name', 'inspiry-yachtpress' ),
            'add_new_item'               => esc_html__( 'Add New Boat Status', 'inspiry-yachtpress' ),
            'edit_item'                  => esc_html__( 'Edit Boat Status', 'inspiry-yachtpress' ),
            'update_item'                => esc_html__( 'Update Boat Status', 'inspiry-yachtpress' ),
            'view_item'                  => esc_html__( 'View Boat Status', 'inspiry-yachtpress' ),
            'separate_items_with_commas' => esc_html__( 'Separate Boat Statuses with commas', 'inspiry-yachtpress' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Boat Statuses', 'inspiry-yachtpress' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'inspiry-yachtpress' ),
            'popular_items'              => esc_html__( 'Popular Boat Statuses', 'inspiry-yachtpress' ),
            'search_items'               => esc_html__( 'Search Boat Statuses', 'inspiry-yachtpress' ),
            'not_found'                  => esc_html__( 'Not Found', 'inspiry-yachtpress' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'inspiry_boat_status_slug', esc_html__( 'boat-status', 'inspiry-yachtpress' ) ),
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

        register_taxonomy( 'boat-status', array( 'boat' ), $args );

    }

    /**
     * Register Boat Location Taxonomy
     * @since 1.0.0
     */
    public function register_boat_location_taxonomy() {

        $labels = array(
            'name'                       => esc_html_x( 'Boat Location', 'Taxonomy General Name', 'inspiry-yachtpress' ),
            'singular_name'              => esc_html_x( 'Boat Location', 'Taxonomy Singular Name', 'inspiry-yachtpress' ),
            'menu_name'                  => esc_html__( 'Locations', 'inspiry-yachtpress' ),
            'all_items'                  => esc_html__( 'All Boat Cities', 'inspiry-yachtpress' ),
            'parent_item'                => esc_html__( 'Parent Boat Location', 'inspiry-yachtpress' ),
            'parent_item_colon'          => esc_html__( 'Parent Boat Location:', 'inspiry-yachtpress' ),
            'new_item_name'              => esc_html__( 'New Boat Location Name', 'inspiry-yachtpress' ),
            'add_new_item'               => esc_html__( 'Add New Boat Location', 'inspiry-yachtpress' ),
            'edit_item'                  => esc_html__( 'Edit Boat Location', 'inspiry-yachtpress' ),
            'update_item'                => esc_html__( 'Update Boat Location', 'inspiry-yachtpress' ),
            'view_item'                  => esc_html__( 'View Boat Location', 'inspiry-yachtpress' ),
            'separate_items_with_commas' => esc_html__( 'Separate Boat Cities with commas', 'inspiry-yachtpress' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Boat Cities', 'inspiry-yachtpress' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'inspiry-yachtpress' ),
            'popular_items'              => esc_html__( 'Popular Boat Cities', 'inspiry-yachtpress' ),
            'search_items'               => esc_html__( 'Search Boat Cities', 'inspiry-yachtpress' ),
            'not_found'                  => esc_html__( 'Not Found', 'inspiry-yachtpress' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'inspiry_boat_location_slug', esc_html__( 'boat-location', 'inspiry-yachtpress' ) ),
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

        register_taxonomy( 'boat-location', array( 'boat' ), $args );

    }

    /**
     * Register Boat Feature Taxonomy
     * @since 1.0.0
     */
    public function register_boat_feature_taxonomy() {

        $labels = array(
            'name'                       => esc_html_x( 'Boat Features', 'Taxonomy General Name', 'inspiry-yachtpress' ),
            'singular_name'              => esc_html_x( 'Boat Feature', 'Taxonomy Singular Name', 'inspiry-yachtpress' ),
            'menu_name'                  => esc_html__( 'Features', 'inspiry-yachtpress' ),
            'all_items'                  => esc_html__( 'All Boat Features', 'inspiry-yachtpress' ),
            'parent_item'                => esc_html__( 'Parent Boat Feature', 'inspiry-yachtpress' ),
            'parent_item_colon'          => esc_html__( 'Parent Boat Feature:', 'inspiry-yachtpress' ),
            'new_item_name'              => esc_html__( 'New Boat Feature Name', 'inspiry-yachtpress' ),
            'add_new_item'               => esc_html__( 'Add New Boat Feature', 'inspiry-yachtpress' ),
            'edit_item'                  => esc_html__( 'Edit Boat Feature', 'inspiry-yachtpress' ),
            'update_item'                => esc_html__( 'Update Boat Feature', 'inspiry-yachtpress' ),
            'view_item'                  => esc_html__( 'View Boat Feature', 'inspiry-yachtpress' ),
            'separate_items_with_commas' => esc_html__( 'Separate Boat Features with commas', 'inspiry-yachtpress' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Boat Features', 'inspiry-yachtpress' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'inspiry-yachtpress' ),
            'popular_items'              => esc_html__( 'Popular Boat Features', 'inspiry-yachtpress' ),
            'search_items'               => esc_html__( 'Search Boat Features', 'inspiry-yachtpress' ),
            'not_found'                  => esc_html__( 'Not Found', 'inspiry-yachtpress' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'inspiry_boat_feature_slug', esc_html__( 'boat-feature', 'inspiry-yachtpress' ) ),
            'with_front'                 => true,
            'hierarchical'               => true,
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => false,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $rewrite,
        );

        register_taxonomy( 'boat-feature', array( 'boat' ), $args );

    }

    /**
     * Register custom columns
     *
     * @param   array   $defaults
     * @since   1.0.0
     * @return  array   $defaults
     */
    public function register_custom_column_titles ( $defaults ) {

        $new_columns = array(
            "thumb"     => esc_html__( 'Photo', 'inspiry-yachtpress' ),
            "id"        => esc_html__( 'Custom ID', 'inspiry-yachtpress' ),
            "price"     => esc_html__( 'Price', 'inspiry-yachtpress'),
        );

        $last_columns = array();

        if ( count( $defaults ) > 5 ) {

            /* Remove Author */
            unset( $defaults['author'] );

            /* Remove Comments */
            unset( $defaults['comments'] );

            /* get last 4 columns Type, Status, Location and Date */
            $last_columns = array_splice( $defaults, -4, 4 );

            /* Simplify column titles */
            $last_columns[ 'taxonomy-boat-type' ]   = esc_html__( 'Type', 'inspiry-yachtpress' );
            $last_columns[ 'taxonomy-boat-status' ] = esc_html__( 'Status', 'inspiry-yachtpress' );
            $last_columns[ 'taxonomy-boat-location' ]   = esc_html__( 'Location', 'inspiry-yachtpress' );

        }

        $defaults = array_merge( $defaults, $new_columns );
        $defaults = array_merge( $defaults, $last_columns );

        return $defaults;
    }

    /**
     * Display custom column for boats
     *
     * @access  public
     * @param   string $column_name
     * @since   1.0.0
     * @return  void
     */
    public function display_custom_column ( $column_name ) {
        global $post;

        switch ( $column_name ) {

            case 'thumb':
                if ( has_post_thumbnail ( $post->ID ) ) {
                    ?><a href="<?php the_permalink(); ?>" target="_blank"><?php the_post_thumbnail( array( 130, 130 ) );?></a><?php
                } else {
                    _e ( 'No Image', 'inspiry-yachtpress' );
                }
                break;

            case 'id':
                $boat_id = get_post_meta ( $post->ID, 'YACHTPRESS_boat_id', true );
                if( ! empty ( $boat_id ) ) {
                    echo $boat_id;
                } else {
                    _e ( 'NA', 'inspiry-yachtpress' );
                }
                break;

            case 'price':
                $boat_price = get_post_meta ( $post->ID, 'YACHTPRESS_boat_price', true );
                if ( !empty ( $boat_price ) ) {
                    $price_amount = doubleval( $boat_price );
                    $price_postfix = get_post_meta ( $post->ID, 'YACHTPRESS_boat_price_postfix', true );
                    echo Inspiry_Boat::format_price( $price_amount, $price_postfix );
                } else {
                    _e ( 'NA', 'inspiry-yachtpress' );
                }
                break;

            default:
                break;
        }
    }

    /**
     * Register meta boxes related to boat post type
     *
     * @param   array   $meta_boxes
     * @since   1.0.0
     * @return  array   $meta_boxes
     */
    public function register_meta_boxes ( $meta_boxes ){

        $prefix = 'YACHTPRESS_';

        // Agents
        $agents_array = array( -1 => esc_html__( 'None', 'inspiry-yachtpress' ) );
        $agents_posts = get_posts( array (
            'post_type' => 'agent',
            'posts_per_page' => -1,
            'suppress_filters' => 0,
        ) );
        if ( ! empty ( $agents_posts ) ) {
            foreach ( $agents_posts as $agent_post ) {
                $agents_array[ $agent_post->ID ] = $agent_post->post_title;
            }
        }

        // Boat Details Meta Box
        $default_desc = esc_html__( 'Consult theme documentation for required image size.', 'inspiry-yachtpress' );
        $gallery_images_desc = apply_filters( 'inspiry_gallery_description', $default_desc );
        $video_image_desc = apply_filters( 'inspiry_video_description', $default_desc );
        $slider_image_desc = apply_filters( 'inspiry_slider_description', $default_desc );

        $meta_boxes[] = array(
            'id' => 'boat-meta-box',
            'title' => esc_html__('Boat', 'inspiry-yachtpress'),
            'pages' => array('boat'),
            'tabs' => array(
                'details' => array(
                    'label' => esc_html__('Basic Information', 'inspiry-yachtpress'),
                    'icon' => 'dashicons-admin-home',
                ),
                'gallery' => array(
                    'label' => esc_html__('Gallery Images', 'inspiry-yachtpress'),
                    'icon' => 'dashicons-format-gallery',
                ),
                'video' => array(
                    'label' => esc_html__('Boat Video', 'inspiry-yachtpress'),
                    'icon' => 'dashicons-format-video',
                ),
                'agent' => array(
                    'label' => esc_html__('Agent Information', 'inspiry-yachtpress'),
                    'icon' => 'dashicons-businessman',
                ),
                'home-slider' => array(
                    'label' => esc_html__('Homepage Slider', 'inspiry-yachtpress'),
                    'icon' => 'dashicons-images-alt',
                ),
                'banner' => array(
                    'label' => esc_html__('Top Banner', 'inspiry-yachtpress'),
                    'icon' => 'dashicons-format-image',
                ),
            ),
            'tab_style' => 'left',
            'fields' => array(

                // Details
                array(
                    'id' => "{$prefix}boat_price",
                    'name' => esc_html__(' Sale or Rent Price', 'inspiry-yachtpress'),
                    'desc' => esc_html__('Digits Only - Example Value: 435000', 'inspiry-yachtpress'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}boat_length",
                    'name' => esc_html__('Length', 'inspiry-yachtpress'),
                    'desc' => esc_html__('Digits Only - Example Value: 2500', 'inspiry-yachtpress'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}boat_length_postfix",
                    'name' => esc_html__('Length Postfix', 'inspiry-yachtpress'),
                    'desc' => esc_html__('Example Value: Ft or m', 'inspiry-yachtpress'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}boat_built_year",
                    'name' => esc_html__('Built Year', 'inspiry-yachtpress'),
                    'desc' => esc_html__('Example Value: 2017', 'inspiry-yachtpress'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'id' => "{$prefix}boat_id",
                    'name' => esc_html__('Boat ID', 'inspiry-yachtpress'),
                    'desc' => esc_html__('It will help you search a boat directly.', 'inspiry-yachtpress'),
                    'type' => 'text',
                    'std' => "",
                    'columns' => 6,
                    'tab' => 'details',
                ),
                array(
                    'name' => esc_html__('Mark this boat as featured ?', 'inspiry-yachtpress'),
                    'id' => "{$prefix}featured",
                    'type' => 'radio',
                    'std' => 0,
                    'options' => array(
                        1 => esc_html__('Yes ', 'inspiry-yachtpress'),
                        0 => esc_html__('No', 'inspiry-yachtpress')
                    ),
                    'columns' => 6,
                    'tab' => 'details',
                ),

                // Boat Gallery
                array(
                    'name' => esc_html__('Boat Gallery Images', 'inspiry-yachtpress'),
                    'id' => "{$prefix}boat_images",
                    'desc' => $gallery_images_desc,
                    'type' => 'image_advanced',
                    'max_file_uploads' => 48,
                    'columns' => 12,
                    'tab' => 'gallery',
                ),

                // Boat Video
                array(
                    'id' => "{$prefix}tour_video_url",
                    'name' => esc_html__('Virtual Tour Video URL', 'inspiry-yachtpress'),
                    'desc' => esc_html__('Provide virtual tour video URL. YouTube, Vimeo, SWF File and MOV File are supported', 'inspiry-yachtpress'),
                    'type' => 'text',
                    'columns' => 12,
                    'tab' => 'video',
                ),
                array(
                    'name' => esc_html__('Virtual Tour Video Image', 'inspiry-yachtpress'),
                    'id' => "{$prefix}tour_video_image",
                    'desc' => $video_image_desc,
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'columns' => 12,
                    'tab' => 'video',
                ),

                // Agents
                array(
                    'name' => esc_html__('What to display in agent information box ?', 'inspiry-yachtpress'),
                       'id' => "{$prefix}agent_display_option",
                    'type' => 'radio',
                    'std' => 'none',
                    'options' => array(
                        'my_profile_info' => esc_html__('Author information.', 'inspiry-yachtpress'),
                        'agent_info' => esc_html__('Agent Information. ( Select the agent below )', 'inspiry-yachtpress'),
                        'none' => esc_html__('None. ( Hide information box )', 'inspiry-yachtpress'),
                    ),
                    'columns' => 12,
                    'tab' => 'agent',
                ),
                array(
                    'name' => esc_html__('Agent', 'inspiry-yachtpress'),
                    'id' => "{$prefix}agents",
                    'type' => 'select',
                    'options' => $agents_array,
                    'multiple' => true,
                    'select_all_none' => true,
                    'columns' => 12,
                    'tab' => 'agent',
                ),


                // Homepage Slider
                array(
                    'name' => esc_html__('Do you want to add this boat in Homepage Slider ?', 'inspiry-yachtpress'),
                    'desc' => esc_html__('If Yes, Then you need to provide a slider image below.', 'inspiry-yachtpress'),
                    'id' => "{$prefix}add_in_slider",
                    'type' => 'radio',
                    'std' => 'no',
                    'options' => array(
                        'yes' => esc_html__('Yes ', 'inspiry-yachtpress'),
                        'no' => esc_html__('No', 'inspiry-yachtpress')
                    ),
                    'columns' => 12,
                    'tab' => 'home-slider',
                ),
                array(
                    'name' => esc_html__('Slider Image', 'inspiry-yachtpress'),
                    'id' => "{$prefix}slider_image",
                    'desc' => $slider_image_desc,
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'columns' => 12,
                    'tab' => 'home-slider',
                ),

                // Top Banner
                array(
                    'name' => esc_html__('Top Banner Image', 'inspiry-yachtpress'),
                    'id' => "{$prefix}page_banner_image",
                    'desc' => esc_html__('Upload the banner image, If you want to change it for this boat. Otherwise default banner image uploaded from theme options will be displayed. Image should have minimum width of 2000px and minimum height of 230px.', 'inspiry-yachtpress'),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                    'columns' => 12,
                    'tab' => 'banner',
                )

            )
        );

        // apply a filter before returning meta boxes
        $meta_boxes = apply_filters( 'boat_meta_boxes', $meta_boxes );

        return $meta_boxes;
    }

}
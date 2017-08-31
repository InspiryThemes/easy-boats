<?php
/**
 * Boat custom post type class.
 *
 * Defines the boat post type.
 *
 * @package    Easy_Boats
 * @subpackage Easy_Boats/admin
 */

class Easy_Boats_Boat_Post_Type {

    /**
     * Register Boat Post Type
     * @since 1.0.0
     */
    public function register_boat_post_type() {

        $labels = array(
            'name'                => _x( 'Boats', 'Post Type General Name', 'easy-boats' ),
            'singular_name'       => _x( 'Boat', 'Post Type Singular Name', 'easy-boats' ),
            'menu_name'           => __( 'Boats', 'easy-boats' ),
            'name_admin_bar'      => __( 'Boat', 'easy-boats' ),
            'parent_item_colon'   => __( 'Parent Boat:', 'easy-boats' ),
            'all_items'           => __( 'All Boats', 'easy-boats' ),
            'add_new_item'        => __( 'Add New Boat', 'easy-boats' ),
            'add_new'             => __( 'Add New', 'easy-boats' ),
            'new_item'            => __( 'New Boat', 'easy-boats' ),
            'edit_item'           => __( 'Edit Boat', 'easy-boats' ),
            'update_item'         => __( 'Update Boat', 'easy-boats' ),
            'view_item'           => __( 'View Boat', 'easy-boats' ),
            'search_items'        => __( 'Search Boat', 'easy-boats' ),
            'not_found'           => __( 'Not found', 'easy-boats' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'easy-boats' ),
        );

        $rewrite = array(
            'slug'                => apply_filters( 'easy_boats_boat_slug', __( 'boat', 'easy-boats' ) ),
            'with_front'          => true,
            'pages'               => true,
            'feeds'               => true,
        );

        $args = array(
            'label'               => __( 'boat', 'easy-boats' ),
            'description'         => __( 'Boat', 'easy-boats' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'page-attributes', 'comments' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => 'easy_boats',
            'menu_position'       => 5,
            'menu_icon'           => plugin_dir_url( __FILE__ ) . 'images/ship.png',
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
            'name'                       => _x( 'Boat Type', 'Taxonomy General Name', 'easy-boats' ),
            'singular_name'              => _x( 'Boat Type', 'Taxonomy Singular Name', 'easy-boats' ),
            'menu_name'                  => __( 'Types', 'easy-boats' ),
            'all_items'                  => __( 'All Boat Types', 'easy-boats' ),
            'parent_item'                => __( 'Parent Boat Type', 'easy-boats' ),
            'parent_item_colon'          => __( 'Parent Boat Type:', 'easy-boats' ),
            'new_item_name'              => __( 'New Boat Type Name', 'easy-boats' ),
            'add_new_item'               => __( 'Add New Boat Type', 'easy-boats' ),
            'edit_item'                  => __( 'Edit Boat Type', 'easy-boats' ),
            'update_item'                => __( 'Update Boat Type', 'easy-boats' ),
            'view_item'                  => __( 'View Boat Type', 'easy-boats' ),
            'separate_items_with_commas' => __( 'Separate Boat Types with commas', 'easy-boats' ),
            'add_or_remove_items'        => __( 'Add or remove Boat Types', 'easy-boats' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'easy-boats' ),
            'popular_items'              => __( 'Popular Boat Types', 'easy-boats' ),
            'search_items'               => __( 'Search Boat Types', 'easy-boats' ),
            'not_found'                  => __( 'Not Found', 'easy-boats' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'easy_boats_boat_type_slug', __( 'boat-type', 'easy-boats' ) ),
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
            'name'                       => _x( 'Boat Hull Type', 'Taxonomy General Name', 'easy-boats' ),
            'singular_name'              => _x( 'Boat Hull Type', 'Taxonomy Singular Name', 'easy-boats' ),
            'menu_name'                  => __( 'Hull Types', 'easy-boats' ),
            'all_items'                  => __( 'All Boat Hull Types', 'easy-boats' ),
            'parent_item'                => __( 'Parent Boat Hull Type', 'easy-boats' ),
            'parent_item_colon'          => __( 'Parent Boat Hull Type:', 'easy-boats' ),
            'new_item_name'              => __( 'New Boat Hull Type Name', 'easy-boats' ),
            'add_new_item'               => __( 'Add New Boat Hull Type', 'easy-boats' ),
            'edit_item'                  => __( 'Edit Boat Hull Type', 'easy-boats' ),
            'update_item'                => __( 'Update Boat Hull Type', 'easy-boats' ),
            'view_item'                  => __( 'View Boat Hull Type', 'easy-boats' ),
            'separate_items_with_commas' => __( 'Separate Boat Hull Types with commas', 'easy-boats' ),
            'add_or_remove_items'        => __( 'Add or remove Boat Hull Types', 'easy-boats' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'easy-boats' ),
            'popular_items'              => __( 'Popular Boat Hull Types', 'easy-boats' ),
            'search_items'               => __( 'Search Boat Hull Types', 'easy-boats' ),
            'not_found'                  => __( 'Not Found', 'easy-boats' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'easy_boats_boat_hull_type_slug', __( 'boat-hull-type', 'easy-boats' ) ),
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

        register_taxonomy( 'boat-hull-type', array( 'boat' ), $args );

    }

    /**
     * Register Boat Status Taxonomy
     * @since 1.0.0
     */
    public function register_boat_status_taxonomy() {

        $labels = array(
            'name'                       => _x( 'Boat Status', 'Taxonomy General Name', 'easy-boats' ),
            'singular_name'              => _x( 'Boat Status', 'Taxonomy Singular Name', 'easy-boats' ),
            'menu_name'                  => __( 'Statuses', 'easy-boats' ),
            'all_items'                  => __( 'All Boat Statuses', 'easy-boats' ),
            'parent_item'                => __( 'Parent Boat Status', 'easy-boats' ),
            'parent_item_colon'          => __( 'Parent Boat Status:', 'easy-boats' ),
            'new_item_name'              => __( 'New Boat Status Name', 'easy-boats' ),
            'add_new_item'               => __( 'Add New Boat Status', 'easy-boats' ),
            'edit_item'                  => __( 'Edit Boat Status', 'easy-boats' ),
            'update_item'                => __( 'Update Boat Status', 'easy-boats' ),
            'view_item'                  => __( 'View Boat Status', 'easy-boats' ),
            'separate_items_with_commas' => __( 'Separate Boat Statuses with commas', 'easy-boats' ),
            'add_or_remove_items'        => __( 'Add or remove Boat Statuses', 'easy-boats' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'easy-boats' ),
            'popular_items'              => __( 'Popular Boat Statuses', 'easy-boats' ),
            'search_items'               => __( 'Search Boat Statuses', 'easy-boats' ),
            'not_found'                  => __( 'Not Found', 'easy-boats' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'easy_boats_boat_status_slug', __( 'boat-status', 'easy-boats' ) ),
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
            'name'                       => _x( 'Boat location', 'Taxonomy General Name', 'easy-boats' ),
            'singular_name'              => _x( 'Boat location', 'Taxonomy Singular Name', 'easy-boats' ),
            'menu_name'                  => __( 'Locations', 'easy-boats' ),
            'all_items'                  => __( 'All locations', 'easy-boats' ),
            'parent_item'                => __( 'Parent location', 'easy-boats' ),
            'parent_item_colon'          => __( 'Parent location:', 'easy-boats' ),
            'new_item_name'              => __( 'New location name', 'easy-boats' ),
            'add_new_item'               => __( 'Add new location', 'easy-boats' ),
            'edit_item'                  => __( 'Edit location', 'easy-boats' ),
            'update_item'                => __( 'Update location', 'easy-boats' ),
            'view_item'                  => __( 'View location', 'easy-boats' ),
            'separate_items_with_commas' => __( 'Separate locations with commas', 'easy-boats' ),
            'add_or_remove_items'        => __( 'Add or remove locations', 'easy-boats' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'easy-boats' ),
            'popular_items'              => __( 'Popular locations', 'easy-boats' ),
            'search_items'               => __( 'Search locations', 'easy-boats' ),
            'not_found'                  => __( 'Not found', 'easy-boats' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'easy_boats_boat_location_slug', __( 'location', 'easy-boats' ) ),
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
            'name'                       => _x( 'Boat Features', 'Taxonomy General Name', 'easy-boats' ),
            'singular_name'              => _x( 'Boat Feature', 'Taxonomy Singular Name', 'easy-boats' ),
            'menu_name'                  => __( 'Features', 'easy-boats' ),
            'all_items'                  => __( 'All Boat Features', 'easy-boats' ),
            'parent_item'                => __( 'Parent Boat Feature', 'easy-boats' ),
            'parent_item_colon'          => __( 'Parent Boat Feature:', 'easy-boats' ),
            'new_item_name'              => __( 'New Boat Feature Name', 'easy-boats' ),
            'add_new_item'               => __( 'Add New Boat Feature', 'easy-boats' ),
            'edit_item'                  => __( 'Edit Boat Feature', 'easy-boats' ),
            'update_item'                => __( 'Update Boat Feature', 'easy-boats' ),
            'view_item'                  => __( 'View Boat Feature', 'easy-boats' ),
            'separate_items_with_commas' => __( 'Separate Boat Features with commas', 'easy-boats' ),
            'add_or_remove_items'        => __( 'Add or remove Boat Features', 'easy-boats' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'easy-boats' ),
            'popular_items'              => __( 'Popular Boat Features', 'easy-boats' ),
            'search_items'               => __( 'Search Boat Features', 'easy-boats' ),
            'not_found'                  => __( 'Not Found', 'easy-boats' ),
        );

        $rewrite = array(
            'slug'                       => apply_filters( 'easy_boats_boat_feature_slug', __( 'boat-feature', 'easy-boats' ) ),
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
            "thumb"     => __( 'Photo', 'easy-boats' ),
            "id"        => __( 'Custom ID', 'easy-boats' ),
            "price"     => __( 'Price', 'easy-boats'),
        );

        $last_columns = array();

        if ( count( $defaults ) > 6 ) {

            /* Remove Author */
            unset( $defaults['author'] );

            /* Remove Comments */
            unset( $defaults['comments'] );

            /* get last 4 columns Type, Status, Location and Date */
            $last_columns = array_splice( $defaults, -5, 5 );

            /* Simplify column titles */
            $last_columns[ 'taxonomy-boat-type' ]        = __( 'Type', 'easy-boats' );
            $last_columns[ 'taxonomy-boat-hull-type' ]   = __( 'Hull Type', 'easy-boats' );
            $last_columns[ 'taxonomy-boat-status' ]      = __( 'Status', 'easy-boats' );
            $last_columns[ 'taxonomy-boat-location' ]    = __( 'Location', 'easy-boats' );

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
	                esc_html_e( 'No Image', 'easy-boats' );
                }
                break;

            case 'id':
                $boat_id = get_post_meta ( $post->ID, 'EASYBOATS_boat_id', true );
                if( ! empty ( $boat_id ) ) {
                    echo $boat_id;
                } else {
	                esc_html_e( 'NA', 'easy-boats' );
                }
                break;

            case 'price':
                $boat_price = get_post_meta ( $post->ID, 'EASYBOATS_boat_price', true );
                if ( !empty ( $boat_price ) ) {
                    $price_amount = doubleval( $boat_price );
                    $price_postfix = get_post_meta ( $post->ID, 'EASYBOATS_boat_price_postfix', true );
                    echo Easy_Boats_Boat::format_price( $price_amount, $price_postfix );
                } else {
	                esc_html_e( 'NA', 'easy-boats' );
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

        $prefix = 'EASYBOATS_';

        // Agents
        $agents_array = array( -1 => __( 'None', 'easy-boats' ) );
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

        $meta_boxes[] = array(
            'id' => 'boat-meta-box',
            'title' => __('Boat', 'easy-boats'),
            'pages' => array('boat'),
            'tabs' => array(
                'details' => array(
                    'label' => __('Basic Information', 'easy-boats'),
                    'icon' => 'dashicons-admin-home',
                ),
                'media' => array(
	                'label' => __('Boat Media', 'easy-boats'),
	                'icon' => 'dashicons-admin-media',
                ),
                'agent' => array(
                    'label' => __('Agent Information', 'easy-boats'),
                    'icon' => 'dashicons-businessman',
                ),
                'additional-details' => array(
                    'label' => __('Additional Details', 'easy-boats'),
                    'icon' => 'dashicons-welcome-add-page',
                )
            ),
            'tab_style' => 'left',
            'fields' => array(

                // Details
	            array(
		            'id' => "{$prefix}boat_price",
		            'name' => __('Sale or Rent Price ( Only digits )', 'easy-boats'),
		            'desc' => __('Example Value: 435000', 'easy-boats'),
		            'type' => 'text',
		            'std' => "",
		            'columns' => 6,
		            'tab' => 'details',
	            ),
                array(
                    'name' => __('Mark this boat as featured ?', 'easy-boats'),
                    'id' => "{$prefix}featured",
                    'type' => 'radio',
                    'std' => 0,
                    'options' => array(
                        1 => __('Yes ', 'easy-boats'),
                        0 => __('No', 'easy-boats')
                    ),
                    'columns' => 6,
                    'tab' => 'details',
                ),
	            array(
		            'type' => 'divider',
		            'tab'  => 'details'
	            ),
	            array(
		            'id' => "{$prefix}boat_built_year",
		            'name' => __('Built Year', 'easy-boats'),
		            'desc' => __('Example Value: 2017', 'easy-boats'),
		            'type' => 'text',
		            'std' => "",
		            'columns' => 6,
		            'tab' => 'details',
	            ),
	            array(
		            'id' => "{$prefix}boat_id",
		            'name' => __('Boat ID', 'easy-boats'),
		            'desc' => __('It will help you search a boat directly.', 'easy-boats'),
		            'type' => 'text',
		            'std' => "",
		            'columns' => 6,
		            'tab' => 'details',
	            ),
	            array(
		            'type' => 'divider',
		            'tab'  => 'details'
	            ),
	            array(
		            'id' => "{$prefix}boat_length",
		            'name' => __('Length ( Only digits )', 'easy-boats'),
		            'desc' => __('Example Value: 2500', 'easy-boats'),
		            'type' => 'text',
		            'std' => "",
		            'columns' => 6,
		            'tab' => 'details',
	            ),
	            array(
		            'id' => "{$prefix}boat_length_postfix",
		            'name' => __('Length Postfix', 'easy-boats'),
		            'desc' => __('Example Value: ft or m', 'easy-boats'),
		            'type' => 'text',
		            'std' => "",
		            'columns' => 6,
		            'tab' => 'details',
	            ),

                // Boat Gallery
                array(
                    'name' => __('Boat Gallery Images', 'easy-boats'),
                    'id' => "{$prefix}boat_images",
                    'desc' => apply_filters( 'easy_boats_gallery_description',  __( 'Maximum file upload limit is 48.', 'easy-boats' ) ),
                    'type' => 'image_advanced',
                    'max_file_uploads' => 48,
                    'columns' => 12,
                    'tab' => 'media',
                ),

                // DIVIDER
	            array(
		            'type' => 'divider',
		            'tab'  => 'media'
	            ),

                // Boat Video
                array(
                    'id' => "{$prefix}tour_video_url",
                    'name' => __('Virtual Tour Video URL', 'easy-boats'),
                    'desc' => __('Provide virtual tour video URL. YouTube, Vimeo, SWF File and MOV File are supported', 'easy-boats'),
                    'type' => 'text',
                    'columns' => 12,
                    'tab' => 'media',
                ),

                // Agents
                array(
                    'name' => __('What to display in agent information box ?', 'easy-boats'),
                    'id' => "{$prefix}agent_display_option",
                    'type' => 'radio',
                    'std' => 'none',
                    'options' => array(
                        'my_profile_info' => __('Author information.', 'easy-boats'),
                        'agent_info' => __('Agent Information. ( Select the agent below )', 'easy-boats'),
                        'none' => __('None. ( Hide information box )', 'easy-boats'),
                    ),
                    'columns' => 12,
                    'tab' => 'agent',
                ),
                array(
                    'name' => __('Agent', 'easy-boats'),
                    'id' => "{$prefix}agents",
                    'type' => 'select',
                    'options' => $agents_array,
                    'multiple' => true,
                    'select_all_none' => true,
                    'columns' => 12,
                    'tab' => 'agent',
                ),

                // Additional Details
	            array(
		            'id'  => "{$prefix}additional_details",
		            'type'   => 'group',
		            'clone'  => true,
		            'sort_clone' => true,
		            'tab'   => 'additional-details',
		            'fields' => array(
			            array(
				            'name'  => __( 'Title', 'easy-boats' ),
				            'id'    => "title",
				            'columns' => 6,
				            'type'  => 'text',
			            ),
			            array(
				            'name'  => __( 'Value', 'easy-boats' ),
				            'id'    => "value",
				            'columns' => 6,
				            'type'  => 'text',
			            ),
		            )
	            ),
            )
        );

        // apply a filter before returning meta boxes
        $meta_boxes = apply_filters( 'easy_boats_meta_boxes', $meta_boxes );

        return $meta_boxes;
    }

}
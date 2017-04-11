<?php
/**
 * Agent custom post type class.
 *
 * Defines the agent post type.
 *
 * @package    Easy_Boats
 * @subpackage Easy_Boats/admin
 */

class Easy_Boats_Agent_Post_Type {

    /**
     * Register Agent Post Type
     * @since 1.0.0
     */
    public function register_agent_post_type() {

        $labels = array(
            'name'                => _x( 'Agents', 'Post Type General Name', 'easy-boats' ),
            'singular_name'       => _x( 'Agent', 'Post Type Singular Name', 'easy-boats' ),
            'menu_name'           => __( 'Agents', 'easy-boats' ),
            'name_admin_bar'      => __( 'Agent', 'easy-boats' ),
            'parent_item_colon'   => __( 'Parent Agent:', 'easy-boats' ),
            'all_items'           => __( 'All Agents', 'easy-boats' ),
            'add_new_item'        => __( 'Add New Agent', 'easy-boats' ),
            'add_new'             => __( 'Add New', 'easy-boats' ),
            'new_item'            => __( 'New Agent', 'easy-boats' ),
            'edit_item'           => __( 'Edit Agent', 'easy-boats' ),
            'update_item'         => __( 'Update Agent', 'easy-boats' ),
            'view_item'           => __( 'View Agent', 'easy-boats' ),
            'search_items'        => __( 'Search Agent', 'easy-boats' ),
            'not_found'           => __( 'Not found', 'easy-boats' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'easy-boats' ),
        );

        $rewrite = array(
            'slug'                => apply_filters( 'easy_boats_agent_slug', __( 'agent', 'easy-boats' ) ),
            'with_front'          => true,
            'pages'               => true,
            'feeds'               => false,
        );

        $args = array(
            'label'               => __( 'agent', 'easy-boats' ),
            'description'         => __( 'Boat Agent', 'easy-boats' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'menu_position'       => 6,
            'menu_icon'           => 'dashicons-businessman',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => 'post',
        );

        register_post_type( 'agent', $args );

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
            "photo"     => __( 'Photo', 'easy-boats' ),
            "email"     => __( 'Email', 'easy-boats' ),
            "mobile"    => __( 'Mobile', 'easy-boats'),
        );

        $last_columns = array();

        if ( count( $defaults ) > 2 ) {
            $last_columns = array_splice( $defaults, 2, 1 );
        }

        $defaults = array_merge( $defaults, $new_columns );
        $defaults = array_merge( $defaults, $last_columns );

        return $defaults;
    }

    /**
     * Display custom column for agents
     *
     * @access  public
     * @param   string $column_name
     * @since   1.0.0
     * @return  void
     */
    public function display_custom_column ( $column_name ) {
        global $post;

        switch ( $column_name ) {

	        case 'photo':
		        if ( has_post_thumbnail ( $post->ID ) ) {
			        ?>
			        <a href="<?php the_permalink(); ?>" target="_blank">
				        <?php the_post_thumbnail( array( 130, 130 ) );?>
			        </a>
			        <?php
		        } else {
			        esc_html_e ( 'No Image', 'easy-boats' );
		        }
		        break;

	        case 'email':
                $agent_email = is_email( get_post_meta ( $post->ID, 'EASYBOATS_agent_email', true ) );
                if ( $agent_email ) {
                    echo $agent_email;
                } else {
	                esc_html_e ( 'NA', 'easy-boats' );
                }
                break;

            case 'mobile':
                $mobile_number = get_post_meta ( $post->ID, 'EASYBOATS_mobile_number', true );
                if ( !empty( $mobile_number ) ) {
                    echo $mobile_number;
                } else {
	                esc_html_e ( 'NA', 'easy-boats' );
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

        // Agent Meta Box
        $meta_boxes[] = array(
            'id'        => 'agent-meta-box',
            'title'     => __('Contact Details', 'easy-boats'),
            'pages'     => array( 'agent' ),
            'context'   => 'normal',
            'priority'  => 'high',
            'fields'    => array(
                array(
                    'name'  => __( 'Job Title', 'easy-boats' ),
                    'id'    => "{$prefix}job_title",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __( 'Email Address', 'easy-boats' ),
                    'id'    => "{$prefix}agent_email",
                    'desc'  => __( "Agent related messages from contact form on boat details page, will be sent on this email address.", "easy-boats" ),
                    'type'  => 'email',
                ),
                array(
                    'name'  => __( 'Mobile Number', 'easy-boats' ),
                    'id'    => "{$prefix}mobile_number",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __('Office Number', 'easy-boats'),
                    'id'    => "{$prefix}office_number",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __('Fax Number', 'easy-boats'),
                    'id'    => "{$prefix}fax_number",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __( 'Office Address', 'easy-boats' ),
                    'id'    => "{$prefix}office_address",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __('Facebook URL', 'easy-boats'),
                    'id'    => "{$prefix}facebook_url",
                    'type'  => 'url',
                ),
                array(
                    'name'  => __('Twitter URL', 'easy-boats'),
                    'id'    => "{$prefix}twitter_url",
                    'type'  => 'url',
                ),
                array(
                    'name'  => __('Google Plus URL', 'easy-boats'),
                    'id'    => "{$prefix}google_plus_url",
                    'type'  => 'url',
                ),
                array(
                    'name'  => __('YouTube URL', 'easy-boats'),
                    'id'    => "{$prefix}youtube_url",
                    'type'  => 'url',
                ),
                array(
                    'name'  => __('Instagram URL', 'easy-boats'),
                    'id'    => "{$prefix}instagram_url",
                    'type'  => 'url',
                ),
                array(
                    'name'  => __('LinkedIn URL', 'easy-boats'),
                    'id'    => "{$prefix}linked_in_url",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __('Pinterest URL', 'easy-boats'),
                    'id'    => "{$prefix}pinterest_url",
                    'type'  => 'url',
                )
            )
        );

        // apply a filter before returning meta boxes
        $meta_boxes = apply_filters( 'easy_boats_agent_meta_boxes', $meta_boxes );

        return $meta_boxes;

    }

}
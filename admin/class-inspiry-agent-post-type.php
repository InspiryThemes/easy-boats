<?php
/**
 * Agent custom post type class.
 *
 * Defines the agent post type.
 *
 * @package    Inspiry_Yachtpress
 * @subpackage Inspiry_Yachtpress/admin
 */

class Inspiry_Agent_Post_Type {

    /**
     * Register Agent Post Type
     * @since 1.0.0
     */
    public function register_agent_post_type() {

        $labels = array(
            'name'                => esc_html_x( 'Agents', 'Post Type General Name', 'inspiry-yachtpress' ),
            'singular_name'       => esc_html_x( 'Agent', 'Post Type Singular Name', 'inspiry-yachtpress' ),
            'menu_name'           => esc_html__( 'Agents', 'inspiry-yachtpress' ),
            'name_admin_bar'      => esc_html__( 'Agent', 'inspiry-yachtpress' ),
            'parent_item_colon'   => esc_html__( 'Parent Agent:', 'inspiry-yachtpress' ),
            'all_items'           => esc_html__( 'All Agents', 'inspiry-yachtpress' ),
            'add_new_item'        => esc_html__( 'Add New Agent', 'inspiry-yachtpress' ),
            'add_new'             => esc_html__( 'Add New', 'inspiry-yachtpress' ),
            'new_item'            => esc_html__( 'New Agent', 'inspiry-yachtpress' ),
            'edit_item'           => esc_html__( 'Edit Agent', 'inspiry-yachtpress' ),
            'update_item'         => esc_html__( 'Update Agent', 'inspiry-yachtpress' ),
            'view_item'           => esc_html__( 'View Agent', 'inspiry-yachtpress' ),
            'search_items'        => esc_html__( 'Search Agent', 'inspiry-yachtpress' ),
            'not_found'           => esc_html__( 'Not found', 'inspiry-yachtpress' ),
            'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'inspiry-yachtpress' ),
        );

        $rewrite = array(
            'slug'                => apply_filters( 'inspiry_agent_slug', esc_html__( 'agent', 'inspiry-yachtpress' ) ),
            'with_front'          => true,
            'pages'               => true,
            'feeds'               => false,
        );

        $args = array(
            'label'               => esc_html__( 'agent', 'inspiry-yachtpress' ),
            'description'         => esc_html__( 'Boat Agent', 'inspiry-yachtpress' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
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
            "thumb"     => esc_html__( 'Photo', 'inspiry-yachtpress' ),
            "email"     => esc_html__( 'Email', 'inspiry-yachtpress' ),
            "mobile"    => esc_html__( 'Mobile', 'inspiry-yachtpress'),
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

            case 'thumb':
                if ( has_post_thumbnail ( $post->ID ) ) {
                    ?>
                    <a href="<?php the_permalink(); ?>" target="_blank">
                        <?php the_post_thumbnail( array( 130, 130 ) );?>
                    </a>
                    <?php
                } else {
                    _e ( 'No Image', 'inspiry-yachtpress' );
                }
                break;

            case 'email':
                $agent_email = is_email( get_post_meta ( $post->ID, 'YACHTPRESS_agent_email', true ) );
                if ( $agent_email ) {
                    echo $agent_email;
                } else {
                    _e ( 'NA', 'inspiry-yachtpress' );
                }
                break;

            case 'mobile':
                $mobile_number = get_post_meta ( $post->ID, 'YACHTPRESS_mobile_number', true );
                if ( !empty( $mobile_number ) ) {
                    echo $mobile_number;
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

        // Agent Meta Box
        $meta_boxes[] = array(
            'id'        => 'agent-meta-box',
            'title'     => esc_html__('Contact Details', 'inspiry-yachtpress'),
            'pages'     => array( 'agent' ),
            'context'   => 'normal',
            'priority'  => 'high',
            'fields'    => array(
                array(
                    'name'  => esc_html__( 'Job Title', 'inspiry-yachtpress' ),
                    'id'    => "inspiry_job_title",
                    'type'  => 'text',
                ),
                array(
                    'name'  => esc_html__( 'Email Address', 'inspiry-yachtpress' ),
                    'id'    => "{$prefix}agent_email",
                    'desc'  => esc_html__( "Agent related messages from contact form on boat details page, will be sent on this email address.", "inspiry-yachtpress" ),
                    'type'  => 'email',
                ),
                array(
                    'name'  => esc_html__( 'Mobile Number', 'inspiry-yachtpress' ),
                    'id'    => "{$prefix}mobile_number",
                    'type'  => 'text',
                ),
                array(
                    'name'  => esc_html__('Office Number', 'inspiry-yachtpress'),
                    'id'    => "{$prefix}office_number",
                    'type'  => 'text',
                ),
                array(
                    'name'  => esc_html__('Fax Number', 'inspiry-yachtpress'),
                    'id'    => "{$prefix}fax_number",
                    'type'  => 'text',
                ),
                array(
                    'name'  => esc_html__( 'Office Address', 'inspiry-yachtpress' ),
                    'id'    => "inspiry_office_address",
                    'type'  => 'text',
                ),
                array(
                    'name'  => esc_html__('Facebook URL', 'inspiry-yachtpress'),
                    'id'    => "{$prefix}facebook_url",
                    'type'  => 'url',
                ),
                array(
                    'name'  => esc_html__('Twitter URL', 'inspiry-yachtpress'),
                    'id'    => "{$prefix}twitter_url",
                    'type'  => 'url',
                ),
                array(
                    'name'  => esc_html__('Google Plus URL', 'inspiry-yachtpress'),
                    'id'    => "{$prefix}google_plus_url",
                    'type'  => 'url',
                ),
                array(
                    'name'  => esc_html__('LinkedIn URL', 'inspiry-yachtpress'),
                    'id'    => "{$prefix}linked_in_url",
                    'type'  => 'text',
                ),
                array(
                    'name'  => esc_html__('Pinterest URL', 'inspiry-yachtpress'),
                    'id'    => "inspiry_pinterest_url",
                    'type'  => 'url',
                ),
                array(
                    'name'  => esc_html__('Instagram URL', 'inspiry-yachtpress'),
                    'id'    => "inspiry_instagram_url",
                    'type'  => 'url',
                )

            )
        );

        // apply a filter before returning meta boxes
        $meta_boxes = apply_filters( 'agent_meta_boxes', $meta_boxes );

        return $meta_boxes;

    }

}
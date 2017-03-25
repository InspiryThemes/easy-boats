<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://inspirythemes.com
 * @since      1.0.0
 *
 * @package    Easy_Boats
 * @subpackage Easy_Boats/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easy_Boats
 * @subpackage Easy_Boats/admin
 * @author     InspiryThemes <info@inspirythemes.com>
 */
class Easy_Boats_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Price format options
	 * @access   public
	 * @var      array    $options    Contains price format options
	 */
	public $price_format_options;

	/**
	 * URL slugs options
	 * @access   public
	 * @var      array    $options    Contains URL slugs options
	 */
	public $url_slugs_options;

	/**
	 * Initialize the class and set its boats.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->price_format_options =  get_option( 'easy_boats_price_format_option' );
		$this->url_slugs_options = get_option( 'easy_boats_url_slugs_option' );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if ( $this::is_boat_edit_page() || ( isset( $_GET['page'] ) && ( $_GET['page'] == 'easy_boats' ) ) ) {
			wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/easy-boats-admin.css', array(), $this->version, 'all');
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if( $this::is_boat_edit_page() ) {
			wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/easy-boats-admin.js', array('jquery', 'jquery-ui-sortable'), $this->version, false);
		}

	}

	/**
	 * Check if it is a boat edit page.
	 * @return bool
	 */
	public static function is_boat_edit_page(){
		if ( is_admin() ) {
			global $pagenow;
			if ( in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) {
				global $post_type;
				if ( 'boat' == $post_type ) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Add plugin settings page
	 * @since   1.0.0
	 */
	public function add_easy_boats_settings(){

		add_menu_page(
			__( 'Easy Boats Settings', 'easy-boats'),	    // The value used to populate the browser's title bar when the menu page is active
			__( 'Easy Boats', 'easy-boats'),			    // The text of the menu in the administrator's sidebar
			'administrator',					            // What roles are able to access the menu
			'easy_boats',				                    // The ID used to bind submenu items to this menu
			array( $this, 'display_easy_boats_settings'),	// The callback function used to render this menu
			'dashicons-admin-settings',
			'66'
		);
	}

	/**
	 * Display boats settings page
	 *
	 * @param   string  $active_tab name of currently active tab
	 */
	public function display_easy_boats_settings(  $active_tab = ''  ) {
		?>
        <!-- Create a header in the default WordPress 'wrap' container -->
        <div class="wrap">

            <h2><?php _e( 'Easy Boats Settings', 'easy-boats' ); ?></h2>

            <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
			<?php settings_errors(); ?>

			<?php
			if ( isset( $_GET[ 'tab' ] ) ) {
				$active_tab = $_GET[ 'tab' ];
			} else if( $active_tab == 'url_slugs' ) {
				$active_tab = 'url_slugs';
			} else {
				$active_tab = 'price_format';
			}
			?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=easy_boats&tab=price_  format" class="nav-tab <?php echo $active_tab == 'price_format' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Price Format', 'easy-boats' ); ?></a>
                <a href="?page=easy_boats&tab=url_slugs" class="nav-tab <?php echo $active_tab == 'url_slugs' ? 'nav-tab-active' : ''; ?>"><?php _e( 'URL Slugs', 'easy-boats' ); ?></a>
            </h2>

            <!-- Create the form that will be used to render our options -->
            <form method="post" action="options.php">
				<?php

				if( $active_tab == 'url_slugs' ) {

					settings_fields( 'easy_boats_url_slugs_option_group' );
					do_settings_sections( 'easy_boats_url_slugs_page' );

				} else {

					settings_fields( 'easy_boats_price_format_option_group' );
					do_settings_sections( 'easy_boats_price_format_page' );

				}

				submit_button();

				?>
            </form>

        </div><!-- /.wrap -->
		<?php
	}

	/**
	 * Initialize boats settings page
	 */
	public function initialize_price_format_options(){

		// If the price format options do not exist then create them
		if( false == $this->price_format_options ) {
			add_option( 'easy_boats_price_format_option', apply_filters( 'easy_boats_price_format_default_options', array( $this, 'price_format_default_options' ) ) );
		}

		/**
		 * Section
		 */
		add_settings_section(
			'easy_boats_price_format_section',                  // ID used to identify this section and with which to register options
			__( 'Price Format', 'easy-boats'),                  // Title to be displayed on the administration page
			array( $this, 'price_format_settings_desc'),        // Callback used to render the description of the section
			'easy_boats_price_format_page'                      // Page on which to add this section of options
		);

		/**
		 * Price Format Fields
		 */
		add_settings_field(
			'currency_sign',
			__( 'Currency Sign', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_price_format_page',
			'easy_boats_price_format_section',
			array(
				'field_id'        => 'currency_sign',
				'field_option'    => 'easy_boats_price_format_option',
				'field_default'   => '$',
				'field_description' => __( 'Default: $', 'easy-boats' ),
			)
		);

		add_settings_field(
			'currency_position',
			__( 'Currency Sign Position', 'easy-boats' ),
			array( $this, 'select_option_field' ),
			'easy_boats_price_format_page',
			'easy_boats_price_format_section',
			array (
				'field_id'          => 'currency_position',
				'field_option'      => 'easy_boats_price_format_option',
				'field_default'     => 'before',
				'field_options'     => array(
					'before'   => __( 'Before ($450,000)', 'easy-boats' ),
					'after'    => __( 'After (450,000$)', 'easy-boats' ),
				),
				'field_description' => __( 'Default: Before', 'easy-boats' ),
			)
		);

		add_settings_field(
			'thousand_separator',
			__( 'Thousand Separator', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_price_format_page',
			'easy_boats_price_format_section',
			array(
				'field_id'        => 'thousand_separator',
				'field_option'    => 'easy_boats_price_format_option',
				'field_default'   => ',',
				'field_description' => __( 'Default: ,', 'easy-boats' ),
			)
		);

		add_settings_field(
			'decimal_separator',
			__( 'Decimal Separator', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_price_format_page',
			'easy_boats_price_format_section',
			array(
				'field_id'        => 'decimal_separator',
				'field_option'    => 'easy_boats_price_format_option',
				'field_default'   => '.',
				'field_description' => __( 'Default: .', 'easy-boats' ),
			)
		);

		add_settings_field(
			'number_of_decimals',
			__( 'Number of Decimals', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_price_format_page',
			'easy_boats_price_format_section',
			array(
				'field_id'        => 'number_of_decimals',
				'field_option'    => 'easy_boats_price_format_option',
				'field_default'   => '0',
				'field_description' => __( 'Default: 0', 'easy-boats' ),
			)
		);

		add_settings_field(
			'empty_price_text',
			__( 'Empty Price Text', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_price_format_page',
			'easy_boats_price_format_section',
			array(
				'field_id'          => 'empty_price_text',
				'field_option'      => 'easy_boats_price_format_option',
				'field_default'     => __( 'Price on call', 'easy-boats' ),
				'field_description' => __( 'Text to display in case of empty price. Example: Price on call', 'easy-boats' ),
			)
		);

		/**
		 * Register Settings
		 */
		register_setting( 'easy_boats_price_format_option_group', 'easy_boats_price_format_option' );

	}

	public function initialize_url_slugs_options(){

		// create plugin options if not exist
		if( false == $this->url_slugs_options ) {
			add_option( 'easy_boats_url_slugs_option', apply_filters( 'easy_boats_url_slugs_default_options', array( $this, 'url_slugs_default_options' ) ) );
		}

		/**
		 * Section
		 */
		add_settings_section(
			'easy_boats_url_slugs_section',                 // ID used to identify this section and with which to register options
			__( 'URL Slugs', 'easy-boats'),                 // Title to be displayed on the administration page
			array( $this, 'url_slugs_settings_desc'),       // Callback used to render the description of the section
			'easy_boats_url_slugs_page'                     // Page on which to add this section of options
		);

		/*
		 * URL Slugs Fields
		 */
		add_settings_field(
			'boat_url_slug',
			__( 'Boat', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_url_slugs_page',
			'easy_boats_url_slugs_section',
			array(
				'field_id'          => 'boat_url_slug',
				'field_option'      => 'easy_boats_url_slugs_option',
				'field_default'     => __( 'boat', 'easy-boats' ),
				'field_description' => __( 'Default: boat', 'easy-boats' ),
			)
		);

		add_settings_field(
			'boat_type_url_slug',
			__( 'Boat Type', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_url_slugs_page',
			'easy_boats_url_slugs_section',
			array(
				'field_id'          => 'boat_type_url_slug',
				'field_option'      => 'easy_boats_url_slugs_option',
				'field_default'     => __( 'boat-type', 'easy-boats' ),
				'field_description' => __( 'Default: boat-type', 'easy-boats' ),
			)
		);

		add_settings_field(
			'boat_hull_type_url_slug',
			__( 'Boat Hull Type', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_url_slugs_page',
			'easy_boats_url_slugs_section',
			array(
				'field_id'          => 'boat_hull_type_url_slug',
				'field_option'      => 'easy_boats_url_slugs_option',
				'field_default'     => __( 'boat-hull-type', 'easy-boats' ),
				'field_description' => __( 'Default: boat-hull-type', 'easy-boats' ),
			)
		);

		add_settings_field(
			'boat_status_url_slug',
			__( 'Boat Status', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_url_slugs_page',
			'easy_boats_url_slugs_section',
			array(
				'field_id'          => 'boat_status_url_slug',
				'field_option'      => 'easy_boats_url_slugs_option',
				'field_default'     => __( 'boat-status', 'easy-boats' ),
				'field_description' => __( 'Default: boat-status', 'easy-boats' ),
			)
		);

		add_settings_field(
			'boat_location_url_slug',
			__( 'Boat City', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_url_slugs_page',
			'easy_boats_url_slugs_section',
			array(
				'field_id'          => 'boat_location_url_slug',
				'field_option'      => 'easy_boats_url_slugs_option',
				'field_default'     => __( 'boat-location', 'easy-boats' ),
				'field_description' => __( 'Default: boat-location', 'easy-boats' ),
			)
		);

		add_settings_field(
			'boat_feature_url_slug',
			__( 'Boat Feature', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_url_slugs_page',
			'easy_boats_url_slugs_section',
			array(
				'field_id'          => 'boat_feature_url_slug',
				'field_option'      => 'easy_boats_url_slugs_option',
				'field_default'     => __( 'boat-feature', 'easy-boats' ),
				'field_description' => __( 'Default: boat-feature', 'easy-boats' ),
			)
		);

		add_settings_field(
			'agent_url_slug',
			__( 'Agent', 'easy-boats' ),
			array( $this, 'text_option_field' ),
			'easy_boats_url_slugs_page',
			'easy_boats_url_slugs_section',
			array(
				'field_id'          => 'agent_url_slug',
				'field_option'      => 'easy_boats_url_slugs_option',
				'field_default'     => __( 'agent', 'easy-boats' ),
				'field_description' => __( 'Default: agent', 'easy-boats' ),
			)
		);

		/**
		 * Register Settings
		 */
		register_setting( 'easy_boats_url_slugs_option_group', 'easy_boats_url_slugs_option' );

	}

	/**
	 * Price format section description
	 */
	public function price_format_settings_desc() {
		echo '<p>'. __( 'Using options provided below, You can modify price format to match your needs.', 'easy-boats' ) . '</p>';
	}

	/**
	 * URL slugs section description
	 */
	public function url_slugs_settings_desc() {
		echo '<p>'. __( 'You can modify URL slugs to match your needs.', 'easy-boats' ) . '</p>';
		echo '<p><strong>'. __( 'Just make sure to re-save permalinks settings after every change to avoid 404 errors. You can do that from Settings > Permalinks .', 'easy-boats' ) . '</strong></p>';
	}


	/**
	 * Reusable text option field for settings page
	 *
	 * @param $args array   field arguments
	 */
	public function text_option_field( $args ) {
		extract( $args );
		if( $field_id ) {

			// Default value or stored value based on option field
			if ( $field_option == 'easy_boats_url_slugs_option' ) {
				$field_value = ( isset( $this->url_slugs_options[ $field_id ] ) ) ? $this->url_slugs_options[ $field_id ] : $field_default;
			} else {
				$field_value = ( isset( $this->price_format_options[ $field_id ] ) ) ? $this->price_format_options[ $field_id ] : $field_default;
			}

			echo '<input name="' . $field_option . '[' . $field_id . ']" class="inspiry-text-field '. $field_id .'" value="' . $field_value . '" />';
			if ( isset( $field_description ) ) {
				echo '<br/><label class="inspiry-field-description">' . $field_description . '</label>';
			}

		} else {
			_e( 'Field id is missing!', 'easy-boats' );
		}
	}


	/**
	 * Reusable select options field for settings page
	 *
	 * @param $args array   field arguments
	 */
	public function select_option_field( $args ) {
		extract( $args );
		if( $field_id ) {

			// Default value or stored value based on option field
			if ( $field_option == 'easy_boats_url_slugs_option' ) {
				$existing_value = ( isset( $this->url_slugs_options[ $field_id ] ) ) ? $this->url_slugs_options[ $field_id ] : $field_default;
			} else {
				$existing_value = ( isset( $this->price_format_options[ $field_id ] ) ) ? $this->price_format_options[ $field_id ] : $field_default;
			}

			?>
            <select name="<?php echo $field_option . '[' . $field_id . ']'; ?>" class="inspiry-select-field <?php echo $field_id; ?>">
				<?php foreach( $field_options as $key => $value ) { ?>
                    <option value="<?php echo $key; ?>" <?php selected( $existing_value, $key ); ?>><?php echo $value; ?></option>
				<?php } ?>
            </select>
			<?php
			if ( isset( $field_description ) ) {
				echo '<br/><label class="inspiry-field-description">' . $field_description . '</label>';
			}
		} else {
			_e( 'Field id is missing!', 'easy-boats' );
		}
	}

	/**
	 * Add plugin action links
	 *
	 * @param $links
	 * @return array
	 */
	public function easy_boats_action_links( $links ) {
		$links[] = '<a href="'. get_admin_url( null, 'admin.php?page=easy_boats' ) .'">' . __( 'Settings', 'easy-boats' ) . '</a>';
		return $links;
	}


	/**
	 * Provides default values for price format options
	 */
	function price_format_default_options() {

		$defaults = array(
			'currency_sign'		    =>	'$',
			'currency_position'		=>	'before',
			'thousand_separator'	=>	',',
			'decimal_separator'	    =>	'.',
			'number_of_decimals'	=>	'0',
			'empty_price_text'	    =>	'Price on call',
		);

		return $defaults;

	}

	/**
	 * Provides default values for url slugs options
	 */
	function url_slugs_default_options() {

		$defaults = array(
			'boat_url_slug'		        =>	'boat',
			'boat_type_url_slug'		=>	'boat-type',
			'boat_hull_type_url_slug'	=>	'boat-hull-type',
			'boat_status_url_slug'		=>	'boat-status',
			'boat_location_url_slug'	=>	'boat-location',
			'boat_feature_url_slug'		=>	'boat-feature',
			'agent_url_slug'		    =>	'agent',
		);

		return $defaults;
	}

}
<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themeforest.net/user/inspirythemes
 * @since      1.0.0
 *
 * @package    Inspiry_Yachtpress
 * @subpackage Inspiry_Yachtpress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inspiry_Yachtpress
 * @subpackage Inspiry_Yachtpress/admin
 * @author     InspiryThemes <info@inspirythemes.com>
 */
class Inspiry_Yachtpress_Admin {

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
		$this->price_format_options =  get_option( 'inspiry_price_format_option' );
		$this->url_slugs_options = get_option( 'inspiry_url_slugs_option' );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if ( $this::is_boat_edit_page() || ( isset( $_GET['page'] ) && ( $_GET['page'] == 'inspiry_yachtpress' ) ) ) {
			wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/inspiry-yachtpress-admin.css', array(), $this->version, 'all');
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if( $this::is_boat_edit_page() ) {
			wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/inspiry-yachtpress-admin.js', array('jquery', 'jquery-ui-sortable'), $this->version, false);
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
	public function add_yachtpress_settings(){

		add_menu_page(
			__( 'Inspiry Yachtpress Settings', 'inspiry-yachtpress'),	// The value used to populate the browser's title bar when the menu page is active
			__( 'YachtPress', 'inspiry-yachtpress'),					// The text of the menu in the administrator's sidebar
			'administrator',					                        // What roles are able to access the menu
			'inspiry_yachtpress',				                        // The ID used to bind submenu items to this menu
			array( $this, 'display_yachtpress_settings'),			    // The callback function used to render this menu
			'dashicons-admin-multisite',
			'25.786'
		);

		add_submenu_page(
			'inspiry_yachtpress',				                    // The ID of the top-level menu page to which this submenu item belongs
			__( 'URL Slugs', 'inspiry-yachtpress' ),			    // The value used to populate the browser's title bar when the menu page is active
			__( 'URL Slugs', 'inspiry-yachtpress' ),			    // The label of this submenu item displayed in the menu
			'administrator',					                    // What roles are able to access this submenu item
			'inspiry_yachtpress_url_slugs',	                        // The ID used to represent this submenu item
			array( $this, 'display_url_slugs_settings')		        // The callback function used to render the options for this submenu item
		);
	}

	/**
	 * Wrapper function for price format settings
	 */
	public function display_price_format_settings(){
		$this->display_yachtpress_settings( 'price_format' );
	}

	/**
	 * Wrapper function for url slugs settings
	 */
	public function display_url_slugs_settings(){
		$this->display_yachtpress_settings( 'url_slugs' );
	}

	/**
	 * Display real estate settings page
	 *
	 * @param   string  $active_tab name of currently active tab
	 */
	public function display_yachtpress_settings(  $active_tab = ''  ) {
		?>
		<!-- Create a header in the default WordPress 'wrap' container -->
		<div class="wrap">

			<h2><?php _e( 'Inspiry Yachtpress Settings', 'inspiry-yachtpress' ); ?></h2>

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
				<a href="?page=inspiry_yachtpress&tab=price_format" class="nav-tab <?php echo $active_tab == 'price_format' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Price Format', 'inspiry-yachtpress' ); ?></a>
				<a href="?page=inspiry_yachtpress&tab=url_slugs" class="nav-tab <?php echo $active_tab == 'url_slugs' ? 'nav-tab-active' : ''; ?>"><?php _e( 'URL Slugs', 'inspiry-yachtpress' ); ?></a>
			</h2>

			<!-- Create the form that will be used to render our options -->
			<form method="post" action="options.php">
				<?php

				if( $active_tab == 'url_slugs' ) {

					settings_fields( 'inspiry_url_slugs_option_group' );
					do_settings_sections( 'inspiry_url_slugs_page' );

				} else {

					settings_fields( 'inspiry_price_format_option_group' );
					do_settings_sections( 'inspiry_price_format_page' );

				}

				submit_button();

				?>
			</form>

		</div><!-- /.wrap -->
		<?php
	}

	/**
	 * Initialize real estate settings page
	 */
	public function initialize_price_format_options(){

		// If the price format options do not exist then create them
		if( false == $this->price_format_options ) {
			add_option( 'inspiry_price_format_option', apply_filters( 'inspiry_price_format_default_options', array( $this, 'price_format_default_options' ) ) );
		}

		/**
		 * Section
		 */
		add_settings_section(
			'inspiry_price_format_section',                                                 // ID used to identify this section and with which to register options
			__( 'Price Format', 'inspiry-yachtpress'),                                     // Title to be displayed on the administration page
			array( $this, 'price_format_settings_desc'),                     // Callback used to render the description of the section
			'inspiry_price_format_page'                                                     // Page on which to add this section of options
		);

		/**
		 * Price Format Fields
		 */
		add_settings_field(
			'currency_sign',
			__( 'Currency Sign', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'        => 'currency_sign',
				'field_option'    => 'inspiry_price_format_option',
				'field_default'   => '$',
				'field_description' => __( 'Default: $', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'currency_position',
			__( 'Currency Sign Position', 'inspiry-yachtpress' ),
			array( $this, 'select_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array (
				'field_id'          => 'currency_position',
				'field_option'      => 'inspiry_price_format_option',
				'field_default'     => 'before',
				'field_options'     => array(
					'before'   => __( 'Before ($450,000)', 'inspiry-yachtpress' ),
					'after'    => __( 'After (450,000$)', 'inspiry-yachtpress' ),
				),
				'field_description' => __( 'Default: Before', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'thousand_separator',
			__( 'Thousand Separator', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'        => 'thousand_separator',
				'field_option'    => 'inspiry_price_format_option',
				'field_default'   => ',',
				'field_description' => __( 'Default: ,', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'decimal_separator',
			__( 'Decimal Separator', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'        => 'decimal_separator',
				'field_option'    => 'inspiry_price_format_option',
				'field_default'   => '.',
				'field_description' => __( 'Default: .', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'number_of_decimals',
			__( 'Number of Decimals', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'        => 'number_of_decimals',
				'field_option'    => 'inspiry_price_format_option',
				'field_default'   => '0',
				'field_description' => __( 'Default: 0', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'empty_price_text',
			__( 'Empty Price Text', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_price_format_page',
			'inspiry_price_format_section',
			array(
				'field_id'          => 'empty_price_text',
				'field_option'      => 'inspiry_price_format_option',
				'field_default'     => __( 'Price on call', 'inspiry-yachtpress' ),
				'field_description' => __( 'Text to display in case of empty price. Example: Price on call', 'inspiry-yachtpress' ),
			)
		);

		/**
		 * Register Settings
		 */
		register_setting( 'inspiry_price_format_option_group', 'inspiry_price_format_option' );

	}

	public function initialize_url_slugs_options(){

		// create plugin options if not exist
		if( false == $this->url_slugs_options ) {
			add_option( 'inspiry_url_slugs_option', apply_filters( 'inspiry_url_slugs_default_options', array( $this, 'url_slugs_default_options' ) ) );
		}

		/**
		 * Section
		 */
		add_settings_section(
			'inspiry_url_slugs_section',                                                 // ID used to identify this section and with which to register options
			__( 'URL Slugs', 'inspiry-yachtpress'),                           // Title to be displayed on the administration page
			array( $this, 'url_slugs_settings_desc'),          // Callback used to render the description of the section
			'inspiry_url_slugs_page'                                          // Page on which to add this section of options
		);

		/*
		 * URL Slugs Fields
		 */
		add_settings_field(
			'boat_url_slug',
			__( 'Boat', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'boat_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => __( 'boat', 'inspiry-yachtpress' ),
				'field_description' => __( 'Default: boat', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'boat_type_url_slug',
			__( 'Boat Type', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'boat_type_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => __( 'boat-type', 'inspiry-yachtpress' ),
				'field_description' => __( 'Default: boat-type', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'boat_hull_type_url_slug',
			__( 'Boat Hull Type', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'boat_hull_type_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => __( 'boat-hull-type', 'inspiry-yachtpress' ),
				'field_description' => __( 'Default: boat-hull-type', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'boat_status_url_slug',
			__( 'Boat Status', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'boat_status_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => __( 'boat-status', 'inspiry-yachtpress' ),
				'field_description' => __( 'Default: boat-status', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'boat_location_url_slug',
			__( 'Boat City', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'boat_location_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => __( 'boat-location', 'inspiry-yachtpress' ),
				'field_description' => __( 'Default: boat-location', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'boat_feature_url_slug',
			__( 'Boat Feature', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'boat_feature_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => __( 'boat-feature', 'inspiry-yachtpress' ),
				'field_description' => __( 'Default: boat-feature', 'inspiry-yachtpress' ),
			)
		);

		add_settings_field(
			'agent_url_slug',
			__( 'Agent', 'inspiry-yachtpress' ),
			array( $this, 'text_option_field' ),
			'inspiry_url_slugs_page',
			'inspiry_url_slugs_section',
			array(
				'field_id'          => 'agent_url_slug',
				'field_option'      => 'inspiry_url_slugs_option',
				'field_default'     => __( 'agent', 'inspiry-yachtpress' ),
				'field_description' => __( 'Default: agent', 'inspiry-yachtpress' ),
			)
		);

		/**
		 * Register Settings
		 */
		register_setting( 'inspiry_url_slugs_option_group', 'inspiry_url_slugs_option' );

	}

	/**
	 * Price format section description
	 */
	public function price_format_settings_desc() {
		echo '<p>'. __( 'Using options provided below, You can modify price format to match your needs.', 'inspiry-yachtpress' ) . '</p>';
	}

	/**
	 * URL slugs section description
	 */
	public function url_slugs_settings_desc() {
		echo '<p>'. __( 'You can modify URL slugs to match your needs.', 'inspiry-yachtpress' ) . '</p>';
		echo '<p><strong>'. __( 'Just make sure to re-save permalinks settings after every change to avoid 404 errors. You can do that from Settings > Permalinks .', 'inspiry-yachtpress' ) . '</strong></p>';
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
			if ( $field_option == 'inspiry_url_slugs_option' ) {
				$field_value = ( isset( $this->url_slugs_options[ $field_id ] ) ) ? $this->url_slugs_options[ $field_id ] : $field_default;
			} else {
				$field_value = ( isset( $this->price_format_options[ $field_id ] ) ) ? $this->price_format_options[ $field_id ] : $field_default;
			}

			echo '<input name="' . $field_option . '[' . $field_id . ']" class="inspiry-text-field '. $field_id .'" value="' . $field_value . '" />';
			if ( isset( $field_description ) ) {
				echo '<br/><label class="inspiry-field-description">' . $field_description . '</label>';
			}

		} else {
			_e( 'Field id is missing!', 'inspiry-yachtpress' );
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
			if ( $field_option == 'inspiry_url_slugs_option' ) {
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
			_e( 'Field id is missing!', 'inspiry-yachtpress' );
		}
	}

	/**
	 * Add plugin action links
	 *
	 * @param $links
	 * @return array
	 */
	public function inspiry_yachtpress_action_links( $links ) {
		$links[] = '<a href="'. get_admin_url( null, 'admin.php?page=inspiry_yachtpress' ) .'">' . __( 'Settings', 'inspiry-yachtpress' ) . '</a>';
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
			'boat_status_url_slug'		=>	'boat-status',
			'boat_location_url_slug'		=>	'boat-location',
			'boat_feature_url_slug'		=>	'boat-feature',
			'agent_url_slug'		        =>	'agent',
		);

		return $defaults;

	}

}

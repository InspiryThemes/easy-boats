<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://inspirythemes.com
 * @since      1.0.0
 *
 * @package    Easy_Boats
 * @subpackage Easy_Boats/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Easy_Boats
 * @subpackage Easy_Boats/includes
 * @author     InspiryThemes <info@inspirythemes.com>
 */
class Easy_Boats {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Easy_Boats_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Contains plugin easy boats options value
	 *
	 * @var mixed|void $easy_boats_options  Contains easy boats options value.
	 */
	public $easy_boats_options;

	/**
	 * Instance variable for singleton pattern
	 *
	 * @var object class instance
	 */
	private static $instance = null;

	/**
	 * Return class instance
	 *
	 * @return Easy_Boats|null
	 */
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'easy-boats';
		$this->version = '1.0.0';

		$this->easy_boats_options =  get_option( 'easy_boats_options' );

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Easy_Boats_Loader. Orchestrates the hooks of the plugin.
	 * - Easy_Boats_i18n. Defines internationalization functionality.
	 * - Easy_Boats_Admin. Defines all hooks for the admin area.
	 * - Easy_Boats_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-boats-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-boats-i18n.php';

		/**
		 * The class responsible for defining boat functionality
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-boats-boat.php';

		/**
		 * The class responsible for defining agent functionality
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy_boats_agent.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-easy-boats-admin.php';

		/**
		 * The class responsible for providing boat custom post type and related stuff.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-boat-post-type.php';

		/**
		 * The class responsible for providing agent custom post type and related stuff.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-agent-post-type.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-easy-boats-public.php';

		$this->loader = new Easy_Boats_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Easy_Boats_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Easy_Boats_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Easy_Boats_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_easy_boats_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'initialize_easy_boats_options' );
		$this->loader->add_filter( 'plugin_action_links_' . EASYBOATS_PLUGIN_BASENAME, $plugin_admin, 'easy_boats_action_links' );

		// Filters to modify URL slugs
		$this->loader->add_filter( 'easy_boats_boat_slug', $this, 'modify_boat_slug' );
		$this->loader->add_filter( 'easy_boats_boat_type_slug', $this, 'modify_boat_type_slug' );
		$this->loader->add_filter( 'easy_boats_boat_hull_type_slug', $this, 'modify_boat_hull_type_slug' );
		$this->loader->add_filter( 'easy_boats_boat_status_slug', $this, 'modify_boat_status_slug' );
		$this->loader->add_filter( 'easy_boats_boat_location_slug', $this, 'modify_boat_location_slug' );
		$this->loader->add_filter( 'easy_boats_boat_feature_slug', $this, 'modify_boat_feature_slug' );
		$this->loader->add_filter( 'easy_boats_agent_slug', $this, 'modify_agent_slug' );

		// Boat Post Type
		$boat_post_type = new Easy_Boats_Boat_Post_Type();
		$this->loader->add_action( 'init', $boat_post_type, 'register_boat_post_type' );
		$this->loader->add_action( 'init', $boat_post_type, 'register_boat_type_taxonomy' );
		$this->loader->add_action( 'init', $boat_post_type, 'register_boat_hull_type_taxonomy' );
		$this->loader->add_action( 'init', $boat_post_type, 'register_boat_status_taxonomy' );
		$this->loader->add_action( 'init', $boat_post_type, 'register_boat_location_taxonomy' );
		$this->loader->add_action( 'init', $boat_post_type, 'register_boat_feature_taxonomy' );
		$this->loader->add_filter( 'rwmb_meta_boxes', $boat_post_type, 'register_meta_boxes' );

		// Agent Post Type
		$agent_post_type = new Easy_Boats_Agent_Post_Type();
		$this->loader->add_action( 'init', $agent_post_type, 'register_agent_post_type' );
		$this->loader->add_filter( 'rwmb_meta_boxes', $agent_post_type, 'register_meta_boxes' );

		if ( is_admin() ) {
			global $pagenow;

			// boat custom columns
			if ( $pagenow == 'edit.php' && isset( $_GET['post_type'] ) && esc_attr( $_GET['post_type'] ) == 'boat' ) {
				$this->loader->add_filter( 'manage_edit-boat_columns', $boat_post_type, 'register_custom_column_titles' );
				$this->loader->add_action( 'manage_pages_custom_column', $boat_post_type, 'display_custom_column' );
			}

			// agent custom columns
			if ( $pagenow == 'edit.php' && isset( $_GET['post_type'] ) && esc_attr( $_GET['post_type'] ) == 'agent' ) {
				$this->loader->add_filter( 'manage_edit-agent_columns', $agent_post_type, 'register_custom_column_titles' );
				$this->loader->add_action( 'manage_posts_custom_column', $agent_post_type, 'display_custom_column' );
			}
		}
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Easy_Boats_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Easy_Boats_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * To log any thing for debugging purposes
	 *
	 * @since   1.0.0
	 *
	 * @param   mixed   $message    message to be logged
	 */
	public static function log( $message ) {
		if( WP_DEBUG === true ){
			if( is_array( $message ) || is_object( $message ) ){
				error_log( print_r( $message, true ) );
			} else {
				error_log( $message );
			}
		}
	}

	public function get_currency_sign() {
		if( isset( $this->easy_boats_options[ 'currency_sign' ] ) ) {
			return $this->easy_boats_options[ 'currency_sign' ];
		}
		return '$';
	}

	public function get_currency_position() {
		if( isset( $this->easy_boats_options[ 'currency_position' ] ) ) {
			return $this->easy_boats_options[ 'currency_position' ];
		}
		return 'before';
	}

	public function get_thousand_separator() {
		if( isset( $this->easy_boats_options[ 'thousand_separator' ] ) ) {
			return $this->easy_boats_options[ 'thousand_separator' ];
		}
		return ',';
	}

	public function get_decimal_separator() {
		if( isset( $this->easy_boats_options[ 'decimal_separator' ] ) ) {
			return $this->easy_boats_options[ 'decimal_separator' ];
		}
		return '.';
	}

	public function get_number_of_decimals() {
		if( isset( $this->easy_boats_options[ 'number_of_decimals' ] ) ) {
			return intval( $this->easy_boats_options[ 'number_of_decimals' ] );
		}
		return 2;
	}

	public function get_empty_price_text() {
		if( isset( $this->easy_boats_options[ 'empty_price_text' ] ) ) {
			return $this->easy_boats_options[ 'empty_price_text' ];
		}
		return null;
	}

	public function get_boat_url_slug() {
		if( isset( $this->easy_boats_options[ 'boat_url_slug' ] ) ) {
			return sanitize_title( $this->easy_boats_options[ 'boat_url_slug' ] );
		}
		return null;
	}

	public function modify_boat_slug ( $existing_slug ) {
		$boat_url_slug = $this->get_boat_url_slug();
		if ( $boat_url_slug ) {
			return $boat_url_slug;
		}
		return $existing_slug;
	}

	public function get_boat_type_url_slug() {
		if( isset( $this->easy_boats_options[ 'boat_type_url_slug' ] ) ) {
			return sanitize_title( $this->easy_boats_options[ 'boat_type_url_slug' ] );
		}
		return null;
	}

	public function modify_boat_type_slug ( $existing_slug ) {
		$boat_type_url_slug = $this->get_boat_type_url_slug();
		if ( $boat_type_url_slug ) {
			return $boat_type_url_slug;
		}
		return $existing_slug;
	}

	public function get_boat_hull_type_url_slug() {
		if( isset( $this->easy_boats_options[ 'boat_hull_type_url_slug' ] ) ) {
			return sanitize_title( $this->easy_boats_options[ 'boat_hull_type_url_slug' ] );
		}
		return null;
	}

	public function modify_boat_hull_type_slug ( $existing_slug ) {
		$boat_hull_type_url_slug = $this->get_boat_hull_type_url_slug();
		if ( $boat_hull_type_url_slug ) {
			return $boat_hull_type_url_slug;
		}
		return $existing_slug;
	}

	public function get_boat_status_url_slug() {
		if( isset( $this->easy_boats_options[ 'boat_status_url_slug' ] ) ) {
			return sanitize_title( $this->easy_boats_options[ 'boat_status_url_slug' ] );
		}
		return null;
	}

	public function modify_boat_status_slug ( $existing_slug ) {
		$boat_status_url_slug = $this->get_boat_status_url_slug();
		if ( $boat_status_url_slug ) {
			return $boat_status_url_slug;
		}
		return $existing_slug;
	}

	public function get_boat_location_url_slug() {
		if( isset( $this->easy_boats_options[ 'boat_location_url_slug' ] ) ) {
			return sanitize_title( $this->easy_boats_options[ 'boat_location_url_slug' ] );
		}
		return null;
	}

	public function modify_boat_location_slug ( $existing_slug ) {
		$boat_location_url_slug = $this->get_boat_location_url_slug();
		if ( $boat_location_url_slug ) {
			return $boat_location_url_slug;
		}
		return $existing_slug;
	}

	public function get_boat_feature_url_slug() {
		if( isset( $this->easy_boats_options[ 'boat_feature_url_slug' ] ) ) {
			return sanitize_title( $this->easy_boats_options[ 'boat_feature_url_slug' ] );
		}
		return null;
	}

	public function modify_boat_feature_slug ( $existing_slug ) {
		$boat_feature_url_slug = $this->get_boat_feature_url_slug();
		if ( $boat_feature_url_slug ) {
			return $boat_feature_url_slug;
		}
		return $existing_slug;
	}

	public function get_agent_url_slug() {
		if( isset( $this->easy_boats_options[ 'agent_url_slug' ] ) ) {
			return sanitize_title( $this->easy_boats_options[ 'agent_url_slug' ] );
		}
		return null;
	}

	public function modify_agent_slug ( $existing_slug ) {
		$agent_url_slug = $this->get_agent_url_slug();
		if ( $agent_url_slug ) {
			return $agent_url_slug;
		}
		return $existing_slug;
	}
}

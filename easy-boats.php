<?php
/**
 * Plugin Name:       Easy Boats
 * Plugin URI:        https://github.com/InspiryThemes/easy-boats
 * Description:       Easy Boats plugin provides boat post type and agent post type with related functionality.
 * Version:           1.0.0
 * Author:            InspiryThemes
 * Author URI:        https://inspirythemes.com
 * Text Domain:       easy-boats
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'EASYBOATS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-easy-boats-activator.php
 */
function activate_easy_boats() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easy-boats-activator.php';
	Easy_Boats_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-easy-boats-deactivator.php
 */
function deactivate_easy_boats() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easy-boats-deactivator.php';
	Easy_Boats_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_easy_boats' );
register_deactivation_hook( __FILE__, 'deactivate_easy_boats' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-easy-boats.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */

$easy_boats = Easy_Boats::get_instance();
$easy_boats->run();

/*
 * Meta Boxes Stuff
 */

// Deactivate Meta Box Plugin and related extensions if Installed
add_action( 'init', function() {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	// Meta Box Plugin
	if ( is_plugin_active( 'meta-box/meta-box.php' ) ) {
		deactivate_plugins( 'meta-box/meta-box.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p><strong><?php esc_html_e( 'Meta Box plugin has been deactivated!', 'easy-boats' ); ?></strong></p>
				<p><?php esc_html_e( 'As now its functionality is embedded with in Easy Boats plugin.', 'easy-boats' ); ?></p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'easy-boats' ); ?></em></p>
			</div>
			<?php
		} );
	}

	// Meta Box Columns Extension
	if ( is_plugin_active( 'meta-box-columns/meta-box-columns.php' ) ) {
		deactivate_plugins( 'meta-box-columns/meta-box-columns.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Meta Box Columns plugin has been deactivated!', 'easy-boats' ); ?></strong>
					&nbsp;<?php esc_html_e( 'As now its functionality is embedded with in Easy Boats plugin.', 'easy-boats' ); ?>
				</p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'easy-boats' ); ?></em></p>
			</div>
			<?php
		} );
	}

	// Meta Box Tabs Extension
	if ( is_plugin_active( 'meta-box-tabs/meta-box-tabs.php' ) ) {
		deactivate_plugins( 'meta-box-tabs/meta-box-tabs.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Meta Box Tabs plugin has been deactivated!', 'easy-boats' ); ?></strong>
					&nbsp;<?php esc_html_e( 'As now its functionality is embedded with in Easy Boats plugin.', 'easy-boats' ); ?>
				</p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'easy-boats' ); ?></em></p>
			</div>
			<?php
		} );
	}

	// Meta Box Show Hide Extension
	if ( is_plugin_active( 'meta-box-show-hide/meta-box-show-hide.php' ) ) {
		deactivate_plugins( 'meta-box-show-hide/meta-box-show-hide.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Meta Box Show Hide plugin has been deactivated!', 'easy-boats' ); ?></strong>
					&nbsp;<?php esc_html_e( 'As now its functionality is embedded with in Easy Boats plugin.', 'easy-boats' ); ?>
				</p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'easy-boats' ); ?></em></p>
			</div>
			<?php
		} );
	}

	// Meta Box Group Extension
	if ( is_plugin_active( 'meta-box-group/meta-box-group.php' ) ) {
		deactivate_plugins( 'meta-box-group/meta-box-group.php' );
		add_action( 'admin_notices', function () {
			?>
			<div class="update-nag notice is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Meta Box Group plugin has been deactivated!', 'easy-boats' ); ?></strong>
					&nbsp;<?php esc_html_e( 'As now its functionality is embedded with in Easy Boats plugin.', 'easy-boats' ); ?>
				</p>
				<p><em><?php esc_html_e( 'So, You should completely remove it from your plugins.', 'easy-boats' ); ?></em></p>
			</div>
			<?php
		} );
	}

} );

// Embedded meta box plugin
if ( ! class_exists( 'RWMB_Core' ) ) {
	require_once ( plugin_dir_path( __FILE__ ) . 'plugins/meta-box/meta-box.php' );
}

// Meta Box Plugin Extensions

// Columns extension
if ( !class_exists( 'RWMB_Columns' ) ) {
	require_once ( plugin_dir_path( __FILE__ ) . 'plugins/meta-box-extensions/meta-box-columns/meta-box-columns.php' );
}

// Show Hide extension
if ( !class_exists( 'RWMB_Show_Hide' ) ) {
	require_once ( plugin_dir_path( __FILE__ ) . 'plugins/meta-box-extensions/meta-box-show-hide/meta-box-show-hide.php' );
}

// Tabs extension
if ( !class_exists( 'RWMB_Tabs' ) ) {
	require_once ( plugin_dir_path( __FILE__ ) . 'plugins/meta-box-extensions/meta-box-tabs/meta-box-tabs.php' );  // tabs
}

// Group extension
if ( !class_exists( 'RWMB_Group' ) ) {
	require_once ( plugin_dir_path( __FILE__ ) . 'plugins/meta-box-extensions/meta-box-group/meta-box-group.php' );   // tabs
}
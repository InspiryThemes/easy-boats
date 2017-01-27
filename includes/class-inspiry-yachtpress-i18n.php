<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://themeforest.net/user/inspirythemes
 * @since      1.0.0
 *
 * @package    Inspiry_Yachtpress
 * @subpackage Inspiry_Yachtpress/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Inspiry_Yachtpress
 * @subpackage Inspiry_Yachtpress/includes
 * @author     InspiryThemes <info@inspirythemes.com>
 */
class Inspiry_Yachtpress_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'inspiry-yachtpress',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

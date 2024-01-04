<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://digibysr.com/about/our-team/
 * @since      1.0.0
 *
 * @package    Wp_Quiz_Builder
 * @subpackage Wp_Quiz_Builder/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Quiz_Builder
 * @subpackage Wp_Quiz_Builder/includes
 * @author     Ajay Kajla <ajay@digibysr.com>
 */
class Wp_Quiz_Builder_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-quiz-builder',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

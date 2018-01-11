<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       Adapt-tech.org
 * @since      1.0.0
 *
 * @package    Instruction_Post_Plugin
 * @subpackage Instruction_Post_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Instruction_Post_Plugin
 * @subpackage Instruction_Post_Plugin/includes
 * @author     Ajeet Singh <singajeet@gmail.com>
 */
class Instruction_Post_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'instruction-post-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

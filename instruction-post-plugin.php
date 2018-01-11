<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Adapt-tech.org
 * @since             1.0.0
 * @package           Instruction_Post_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Instruction Post
 * Plugin URI:        Adapt-tech.org
 * Description:       Plugin to install custom post type for writing instructions step by step 
 * Version:           1.0.2
 * Author:            Ajeet Singh
 * Author URI:        Adapt-tech.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       instruction-post-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-instruction-post-plugin-activator.php
 */
function activate_instruction_post_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-instruction-post-plugin-activator.php';
	Instruction_Post_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-instruction-post-plugin-deactivator.php
 */
function deactivate_instruction_post_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-instruction-post-plugin-deactivator.php';
	Instruction_Post_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_instruction_post_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_instruction_post_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-instruction-post-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_instruction_post_plugin() {

	$plugin = new Instruction_Post_Plugin();
	$plugin->run();

}
run_instruction_post_plugin();

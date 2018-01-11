<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Adapt-tech.org
 * @since      1.0.0
 *
 * @package    Instruction_Post_Plugin
 * @subpackage Instruction_Post_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Instruction_Post_Plugin
 * @subpackage Instruction_Post_Plugin/admin
 * @author     Ajeet Singh <singajeet@gmail.com>
 */
class Instruction_Post_Plugin_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Instruction_Post_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Instruction_Post_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/instruction-post-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Instruction_Post_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Instruction_Post_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/instruction-post-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}
	
public function add_plugin_admin_menu()
{
	add_options_page('Instruction Post', 'Instruction Post', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
	);
} 
					 
public function add_action_links($links)
{
	$settings_link = array(
		'<a href="' . admin_url('options-general.php?page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>',); 
	return array_merge($settings_link, $links);
}
	
public function display_plugin_setup_page() {
			include_once( 'partials/instruction-post-plugin-admin-display.php' );
}

public function validate($input){
	return $input;
	}
	
public function options_update()
{
	register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	register_setting($this->plugin_name, $this->plugin_name . '-gallery-type', array($this, 'validate'));
}

public function register_instruction_post_type() {
		  $labels = array(
			'name'               => _x( 'Instructions', 'Instructions Post Type' ),
			'singular_name'      => _x( 'Instruction', 'Instruction Post Type' ),
			'add_new'            => _x( 'Add New', 'book' ),
			'add_new_item'       => __( 'Add New Instruction' ),
			'edit_item'          => __( 'Edit Instruction' ),
			'new_item'           => __( 'New Instruction' ),
			'all_items'          => __( 'All Instructions' ),
			'view_item'          => __( 'View Instructions' ),
			'search_items'       => __( 'Search Instructions' ),
			'not_found'          => __( 'No Instruction Posts found' ),
			'not_found_in_trash' => __( 'No Instruction Posts found in the Trash' ), 
			'parent_item_colon'  => '',
			'menu_name'          => 'Instructions'
		  );
		  $args = array(
			'labels'        => $labels,
			'description'   => 'Custom Post Type to write instructions step by step',
			'taxonomies' => array('category'),
			'public'        => true,
			'publicly_queryable' => true,
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'post-formats', 'page-attributes' ),
			'has_archive'   => true,
		  );
		register_post_type( 'instructions-post', $args ); 
	}

public function create_instruction_steps_metabox()
	{
		$cmb_group = new_cmb2_box(
			array(
				'id' => 'instruction_steps_metabox', 
				'title' => 'Instruction Steps', 
				'object_types' => array('instructions-post'),				
			)
		); 
	
		$group_field_id = $cmb_group->add_field(
			array(
				'id' => 'instruction_steps_group_field',
				'type' => 'group', 
				'show_names' => true,
				'options'=>array(
					'group_title' => esc_html__('Step {#}','cmb2'),
					'add_button' => esc_html__('Add Step','cmb2'),
					'remove_button' => esc_html__('Remove Step', 'cmb2'),
				)
			)
		); 
	
		$cmb_group->add_group_field(
			$group_field_id, 
			array(
				'name' => esc_html__('Step Number','cmb2'), 
				'id' => 'stepnumber',
				'type' => 'text',
			)
		);
		
		$cmb_group->add_group_field(
			$group_field_id,
			array(
				'name' => esc_html__('Step Title', 'cmb2'),
				'id' => 'steptitle',
				'type' => 'text',				
			)
		);
		
		$cmb_group->add_group_field(
			$group_field_id,
			array(
				'name' => esc_html__('Step Details', 'cmb2'),
				'id' => 'stepdetails',
				'type' => 'wysiwyg',
			)
		);
		
		$cmb_group->add_group_field(
			$group_field_id,
			array(
				'name' => esc_html__('Step Images', 'cmb2'),
				'id' => 'stepimages',
				'type' => 'file_list',
				'query_args' => array( 'type' => 'image' ),
				'text' => array (
					'add_upload_files_text' => 'Add or Upload Images',
					'file_text' => 'Image:',
				),
			)
		);
		
		
	}
}

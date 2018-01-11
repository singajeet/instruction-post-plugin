<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       Adapt-tech.org
 * @since      1.0.0
 *
 * @package    Instruction_Post_Plugin
 * @subpackage Instruction_Post_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Instruction_Post_Plugin
 * @subpackage Instruction_Post_Plugin/public
 * @author     Ajeet Singh <singajeet@gmail.com>
 */
class Instruction_Post_Plugin_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();
	}

	private function load_dependencies(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-frontend-box.php';

	}
	
	
	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/instruction-post-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/instruction-post-plugin-public.js', array( 'jquery' ), $this->version, false );

	} 
	
	
	
	
	public function create_instruction_steps_form_metabox()
	{
		
		$cmb_metabox = new_cmb2_box(
			array(
				'id' => 'instruction_steps_form_metabox', 
				'title' => 'Instruction Steps', 
				'object_types' => array('instructions-post'),
				'hookup' => false,
				'save_fields' => false,
			)
		); 
	
		$title_field_id = $cmb_metabox->add_field(
			array(
				'id' => 'post_title',
				'desc' => 'Title for your instructions (required)',
				'type' => 'text',
				'name' => __('New Post Title', 'wds-post-submit'),
				'default_cb' => 'yourprefix_maybe_set_default_from_posted_values',
			)
		);
		
		$content_field_id = $cmb_metabox->add_field(
			array(
				'id' => 'post_content',
				'type' => 'wysiwyg',
				'name' => __('New Post Content', 'wds-post-submit'),
				'options' => array(
						'textarea_rows' => 12,
				)
			)
		);
		
		$taxonomy_field_id = $cmb_metabox->add_field(
			array(
				'name' => 'Select Categories for this post',
				'desc' => 'Categories under which it will be posted',
				'id' => 'instruction_categories',
				'type' => 'taxonomy_multicheck',
				'taxonomy' => 'category',
				'remove_default' => false,
				'select_all_button' => false,
			)
		);
	
		$group_field_id = $cmb_metabox->add_field(
			array(
				'id' => 'instruction_steps_group_field',
				'type' => 'group', 
				'show_names' => true,
				'options'=>array(
					'group_title' => __('Step {#}','wds-post-submit'),
					'add_button' => __('Add Step','wds-post-submit'),
					'remove_button' => __('Remove Step', 'wds-post-submit'),
				)
			)
		); 
	
		$cmb_metabox->add_group_field(
			$group_field_id, 
			array(
				'name' => __('Step Number','wds-post-submit'), 
				'id' => 'stepnumber',
				'type' => 'text',
			)
		);
		
		$cmb_metabox->add_group_field(
			$group_field_id,
			array(
				'name' => __('Step Title', 'wds-post-submit'),
				'id' => 'steptitle',
				'type' => 'text',				
			)
		);
		
		$cmb_metabox->add_group_field(
			$group_field_id,
			array(
				'name' => __('Step Details', 'wds-post-submit'),
				'id' => 'stepdetails',
				'type' => 'wysiwyg',
			)
		);
		
		$cmb_metabox->add_group_field(
			$group_field_id,
			array(
				'name' => __('Step Images', 'wds-post-submit'),
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
	
	public function yourprefix_maybe_set_default_from_posted_values( $args, $field ) {
		if ( ! empty( $_POST[ $field->id() ] ) ) {
			return $_POST[ $field->id() ];
		}
		return '';
	}
	
	public function instruction_steps_form_submission_handler( $cmb, $post_data = array()){
		if(empty($_POST)){
			return;
		}
		
		if(
			!isset( $_POST['submit-cmb'], $_POST['object_id'] )
		)		
		{
			return new WP_Error( 'security_fail', __( 'Security check failed.' ) );
		}
		
		if ( empty( $_POST['post_title'] ) ) {
			return new WP_Error( 'post_data_missing', __( 'New post requires a title.' ) );
		}
		
		if(empty($_POST['post_title'])){
			return;
		}	
		
		$_POST['post_type'] = 'instructions-post';
		$_POST['post_status'] = 'publish';
		$_POST['post_author'] = get_current_user_id() ? get_current_user_id() : 1;
		
		$new_post_id = wp_insert_post($_POST, true);
		
		//update post meta if exists
		$meta_key = 'instruction_steps_group_field';
		if( isset($_POST[$meta_key]) ){
			$meta_value_array = $_POST[$meta_key];
			update_post_meta( $new_post_id, $meta_key, $meta_value_array );
		}
		
		
			$terms = $_POST['instruction_categories'];
			foreach($terms as $key => $term_slug){
				$term = get_term_by('slug', $term_slug, 'category');
				wp_set_post_terms( $new_post_id, array($term->term_id), 'category', true );
			}
		
		return  $new_post_id;
	}
	
	public function do_instruction_post_form_shortcode($atts = array()){
		
		global $post;

		/**
		 * Depending on your setup, check if the user has permissions to edit_posts
		 */
		if ( ! current_user_can( 'edit_posts' ) ) {
			return __( 'You do not have permissions to edit this post.', 'lang_domain' );
		}

		/**
		 * Make sure a WordPress post ID is set.
		 * We'll default to the current post/page
		 */
		if ( ! isset( $atts['post_id'] ) ) {
			$atts['post_id'] = $post->ID;
		}

		// If no metabox id is set, yell about it
		if ( empty( $atts['id'] ) ) {
			return __( "Please add an 'id' attribute to specify the CMB2 form to display.", 'lang_domain' );
		}

		$metabox_id = esc_attr( $atts['id'] );
		$object_id = absint( $atts['post_id'] );
		
		$form = '';
		
		// Get our form
		$metabox_form = cmb2_get_metabox_form( $metabox_id, $object_id );

		$new_id = $this->instruction_steps_form_submission_handler( $form, $atts );
		
		if ( isset($new_id) ){
			if( is_wp_error( $new_id )){				
				new Frontend_box( 'Error while saving instructions - ' . $new_id);
			} else {				
				new Frontend_box( 'Instructions saved successfully - <a href="' . esc_url( get_permalink($new_id)) . '">Visit</a>!', array( 'type' => 'success' ));
			}
		}
		
		$form = do_action('front_end_box/header');
		$form .= $metabox_form;
		
		return $form;
		
	}
	
	public function instructions_post_type_single_template($template){
		$post_id = get_the_ID();
		
		//if not instructions post
		if( get_post_type( $post_id ) != 'instructions-post'){
			return $template;
		}
		
		
		if( is_single() ){
			$template = 'single';
 			$template_slug = rtrim( $template, '.php');
		
			$template = $template_slug . '.php';
		
			if($theme_file = locate_template( array( 'plugin_template/' . $template))){
				$file = $theme_file;
			} else {
				$file = plugin_dir_path( __FILE__ ) . '../includes/templates/' . $template;
			} 
		
			return apply_filters( 'instructions_post_template_' . $template, $file);
		} else {
			return $template;
			
		}
	}
	
	
	public function query_instruction_and_default_posts($query){
		if( is_category() ){
			$post_type = get_query_var('post_type');
			if($post_type)
				$post_type = $post_type;
			else
				$post_type = array('nav_menu_item', 'post', 'instructions-post');
			
			$query->set('post_type', $post_type);
			return $query;
		} else {
			return $query;
		}
	}
}

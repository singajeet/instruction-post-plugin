<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       Adapt-tech.org
 * @since      1.0.0
 *
 * @package    Instruction_Post_Plugin
 * @subpackage Instruction_Post_Plugin/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h2><?php echo esc_html(get_admin_page_title()); ?></h2>	
	<form method="post" action="options.php">
		<?php 
			$options = get_option($this->plugin_name); 
			$style_option_name = $this->plugin_name . '-gallery-type';
			$style_option_value = get_option($style_option_name);
		?> 
		
		<?php 
			settings_fields($this->plugin_name); 
			do_settings_sections($this->plugin_name); 
		?> 
		<h4>Gallery style for images in each step:</h4>		
		<div style="width:100%; display:table;">
			<div style="display:table-row-group;">
				<div style="display:table-row;">
					<div style="display:table-cell;">
						<input type="radio" name="<?php echo $style_option_name; ?>" value="thumbnails" 
							<?php if(!empty($style_option_value)) checked($style_option_value, 'thumbnails'); ?> />
					</div>
					<div style="display:table-cell; width:98%">
						<?php esc_attr_e('Thumbnail', 'WpAdminStyle'); ?>
					</div>
				</div>
				<div style="display:table-row;">
					<div style="display:table-cell">
						<input type="radio" name="<?php echo $style_option_name; ?>" value="rectangular" 
							<?php if(!empty($style_option_value)) checked($style_option_value, 'rectangular'); ?> />
					</div>
					<div style="display:table-cell; width:98%">
						<?php esc_attr_e('Rectangular', 'WpAdminStyle'); ?>
					</div>
				</div>
				<div style="display:table-row;">
					<div style="display:table-cell">
						<input type="radio" name="<?php echo $style_option_name; ?>" value="square" 
							<?php if(!empty($style_option_value)) checked($style_option_value, 'square'); ?> />
					</div>
					<div style="display:table-cell; width:98%">
						<?php esc_attr_e('Square', 'WpAdminStyle'); ?>
					</div>
				</div>
				<div style="display:table-row;">
					<div style="display:table-cell">
						<input type="radio" name="<?php echo $style_option_name; ?>" value="circle" 
							<?php if(!empty($style_option_value)) checked($style_option_value, 'circle'); ?> />
					</div>
					<div style="display:table-cell; width:98%">
						<?php esc_attr_e('Circle', 'WpAdminStyle'); ?>
					</div>
				</div>
				<div style="display:table-row;">
					<div style="display:table-cell">
						<input type="radio" name="<?php echo $style_option_name; ?>" value="slideshow" 
							<?php if(!empty($style_option_value)) checked($style_option_value, 'slideshow'); ?> />
					</div>
					<div style="display:table-cell; width:98%">
						<?php esc_attr_e('Slideshow', 'WpAdminStyle'); ?>
					</div>
				</div>
			</div>
		</div>
		
		<?php submit_button(); ?>
</form>
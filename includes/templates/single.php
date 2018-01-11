<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Zoom
 * @since 1.0
 */

get_header();
zoom_set_layout( 'blog', 'left' ); ?>
		<div id="primary" class="site-content<?php zoom_set_layout_class( 'blog' ); ?>">
        <?php if ( zoom_get_array_opt( 'post_meta', 'breadcrumb' ) ) zoom_breadcrumb(); ?>
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				 <?php //get_template_part( 'contents/content', 'single' ); ?> 
				 
				<!-- Instructions post content -->
				<?php $args = array(	'p' => get_the_ID(),
										'post_type' => 'instructions-post',
										'orderby' => 'date',
										'order' => 'DESC',
										); 
				
					$instructions = new WP_Query( $args );
					if( $instructions->have_posts()){
						while( $instructions->have_posts() ){
								$instructions->the_post();
					?>
						<h2><?php the_title() ?></h2>
						<div class='content'>
							<?php the_content() ?>
						</div>
					<!-- instructions steps fields -->
					
					<!-- main outer table - display each "step" in separate row -->
					<div style="width:100%; display:table;">
						<div style="display:table-row-group;">
						<?php 
							$entries = get_post_meta( get_the_ID(), 'instruction_steps_group_field', true );						
							
							foreach( (array)$entries as $key => $entry){
								$stepnumber = $steptitle = $stepdetails = $stepimages = '';
								
								if( isset( $entry['stepnumber'] )){
									$stepnumber = $entry['stepnumber'];
								}
								
								if( isset( $entry['steptitle'] )){
									$steptitle = $entry['steptitle'];
								}
								
								if( isset( $entry['stepdetails'] )){
									$stepdetails = $entry['stepdetails'];
								}
								
								if( isset( $entry['stepimages'] )){
									$stepimages = $entry['stepimages'];
								}
								
								?>
								<!-- Table row belonging to outer table -->
								<div style="display:table-row;">
									<div style="display:table-cell;"> <!-- step start -->
									
										<!-- Inner table for each step -->
										<div style="width:100%; display:table;">
											<div style="display:table-row-group;">
												<!-- Row 1 containing Step# and Step title -->
												<div style="display:table-row;">
													<div style="display:table-cell;">
														<h4><?php echo $stepnumber; ?>. </h4>
													</div>
													<div style="width:95%; display:table-cell;">
														<h4><?php echo $steptitle; ?></h4>
													</div>												
												</div>
												<!-- Row 2 containing  step images -->												
												<div style="display:table-row;">
													<div style="display:table-cell;"></div>
													<div style="display:table-cell;">
													
														<!-- Table for all step images -->
														
																<?php 
																	$image_list='';
																	$type_option_name = 'instruction-post-plugin-gallery-type';
																	$type_option_value = get_option($type_option_name);
																	
																	$gallery_type = 'thumbnails';
																	if( !empty($type_option_value)){
																		$gallery_type = $type_option_value;
																	}
																	
																	foreach( (array)$stepimages as $attachment_id => $attachment_url){
																		$image_list = $image_list . $attachment_id . ',';
																		
																	}
																	
																	$image_list = rtrim($image_list, ',');
																	$shortcode='[gallery type="' . $type_option_value . '" include="' . $image_list . '" ]';
																	echo do_shortcode($shortcode);
																?>
																											
													</div>
												</div>
												<!-- Row 3 containing step details -->
												<div style="display:table-row;">
													<div style="display:table-cell;"></div>
													<div style="display:table-cell;">
														<?php echo $stepdetails ?>
													</div>
												</div>
											</div>
										</div>
									</div> <!-- step end -->
								</div> <!-- outer table row end -->								
								<?php
							}
						?>
						</div>
					</div> <!-- Main outer table end -->					
					<?php
						}						
					}
				?>
				
				<?php zoom_theme_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) {
						comments_template( '', true );
					} elseif ( ! comments_open() ) { ?>
						<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'zoom-lite' ); ?></p>
					<?php } 
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php zoom_set_layout( 'blog', 'right' ); ?>
<?php get_footer(); ?>
(function( $ ) {
	//'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practice to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plug-ins and Themes may be
	 * practicing this, we should strive to set a better example in our own work.
	 */

	 /**
	   * Front-end boxes
	   */

	   $( function(){
		   $('.frontend_box').each(function(){
				console.log($(this).data('auto-close'));
				if( $(this).data('auto-close') == true ){

					$(this).slideDown().delay( $(this).data('delay') * 1000 ).fadeOut();

				} else {

					$(this).slideDown();

				}

		   });
		   
		   $('.frontend_box_close').on('click', function(e){
				  e.preventDefault();
				  $(this).parents('.frontend_box').fadeOut();
			});	
	   });
	   
})( jQuery );

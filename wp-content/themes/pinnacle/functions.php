<?php
/*-----------------------------------------------------------------------------------*/
/* Include Theme Functions */
/*-----------------------------------------------------------------------------------*/
function pinnacle_lang_setup() {
load_theme_textdomain('pinnacle', get_template_directory() . '/languages');
}
add_action( 'after_setup_theme', 'pinnacle_lang_setup' );
//require_once locate_template('/themeoptions/options_assets/pinnacle_extension.php');          		// Options framework
require_once locate_template('/themeoptions/redux/framework.php');          		// Options framework -- font / styling
require_once locate_template('/themeoptions/theme_options.php');          		// Options framework -- font / styling
//require_once locate_template('/lib/utils.php');           		// Utility functions
require_once locate_template('/lib/init.php');            		// Initial theme setup and constants -- menu
require_once locate_template('/lib/sidebar.php');         		// Sidebar class -- Sidebar missing - errors
require_once locate_template('/lib/config.php');          		// Configuration -- fatal errors
require_once locate_template('/lib/cleanup.php');        		// Cleanup -- image overlapping
//require_once locate_template('/lib/nav.php');            		// Custom nav modifications
//require_once locate_template('/lib/cmb_gallery_metabox.php');   // Gallery metaboxes
//require_once locate_template('/lib/metaboxes.php');     		// Custom metaboxes
//require_once locate_template('/lib/comments.php');        		// Custom comments modifications
//require_once locate_template('/lib/shortcodes.php');      		// Shortcodes clean-up
//require_once locate_template('/lib/widgets.php');         		// Sidebars and widgets
require_once locate_template('/lib/mobile_detect.php');        	// Mobile Detect - maybe mobile issue (check)
require_once locate_template('/lib/aq_resizer.php');      		// Resize on the fly -- resizing - menu not working on mobile
//require_once locate_template('/lib/plugin-activate.php');   	// Plugin Activation
//require_once locate_template('/lib/scripts.php');        		// Scripts and stylesheets - all styling and js
//require_once locate_template('/lib/custom.php');          		// Custom functions
//require_once locate_template('/lib/admin_scripts.php');    		// Admin Scripts functions
//require_once locate_template('/lib/authorbox.php');         	// Author box
//require_once locate_template('/lib/custom-woocommerce.php'); 	// Woocommerce functions
require_once locate_template('/lib/output_css.php'); 			// Fontend Custom CSS -- contact page


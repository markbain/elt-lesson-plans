<?php
/*
Plugin Name: 	ELT Lesson Plans
Description: 	Add a "Lesson Plan" custom post type to your site.
Version: 		0.0
Author: 		Mark Bain
Author URI: 	http:/markbaindesign.com
*/

/**
 * Silence is golden; exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bootstrap CMB2
 * No need to check versions or if CMB2 is already loaded... the init file does that already!
 *
 * Check to see if CMB2 exists, and either bootstrap it or add a notice that it is missing
 */
if ( file_exists( dirname( __FILE__ ) . '/inc/CMB2/init.php' ) ) {
	require_once 'inc/CMB2/init.php';
} else {
	add_action( 'admin_notices', 'mbd_cmb2_example_plugin_missing_cmb2' );
}

/**
 * Load metaboxes
 */
require_once 'inc/additional-post-media.php';

/**
 * Add an error notice to the dashboard if CMB2 is missing from the plugin
 *
 * @return void
 */
function mbd_cmb2_example_plugin_missing_cmb2() { ?>
<div class="error">
	<p><?php _e( 'CMB2 Example Plugin is missing CMB2! Shit!', 'cmb2-example-plugin' ); ?></p>
</div>
<?php }


define('GISIGELPATH',   plugin_dir_path(__FILE__));
define('GISIGELURL',    plugins_url('', __FILE__));

if(!class_exists('GISIG_Lesson_Inspiration'))
{
	class GISIG_Lesson_Inspiration
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
        	       	
        	// Register custom post types
            require_once(sprintf("%s/post-types/post_type_template.php", dirname(__FILE__)));
            $Post_Type_Template = new Post_Type_Template();
			
        	// Register custom taxonomies
            require_once(sprintf("%s/post-types/custom_tax_template.php", dirname(__FILE__)));
            $Custom_Tax_Template = new Custom_Tax_Template();


			
		} // END public function __construct
	    
		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		} // END public static function activate
	
		/**
		 * Deactivate the plugin
		 */		
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate
	} // END class GISIG_Lesson_Inspiration
} // END if(!class_exists('GISIG_Lesson_Inspiration'))

if(class_exists('GISIG_Lesson_Inspiration'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('GISIG_Lesson_Inspiration', 'activate'));
	register_deactivation_hook(__FILE__, array('GISIG_Lesson_Inspiration', 'deactivate'));

	// instantiate the plugin class
	$gisig_Lesson_inspiration = new GISIG_Lesson_Inspiration();
		
	// Get options from database
	function mytheme_option( $option ) {
		$options = get_option( 'gisig_Lesson_inspiration-setting_a' );
		if ( isset( $options[$option] ) )
			return $options[$option];
		else
			return false;
	}

	// Load some basic styles
	add_action( 'wp_enqueue_scripts', 'add_gisig_Lesson_stylesheet' );

	function add_gisig_Lesson_stylesheet() {
		$css_path = GISIGELURL . '/css/gisig-Lessons.css';
		wp_register_style( 'gisigLessonStylesheet', $css_path );
		wp_enqueue_style( 'gisigLessonStylesheet' );
	}
}
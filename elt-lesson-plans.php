<?php
/*
Plugin Name: 	ELT Lesson Plans
Description: 	Add a "Lesson Plan" custom post type to your site.
Version: 		0.0
Author: 		Mark Bain
Author URI: 	http:/markbaindesign.com
*/
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
        	// Initialize Settings
            require_once(sprintf("%s/settings.php", dirname(__FILE__)));
            $GISIG_Lesson_Inspiration_Settings = new GISIG_Lesson_Inspiration_Settings();
        	
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
	
	// Add elsesson meta data before content
	function gisig_filter_the_content( $content ) {
	 if ( is_single() && 'Lessons' == get_post_type() ) {
	 
	 global $post;
	 setup_postdata( $post );

		// Show options
		
		$tempoptions = get_option("gisig_plugin_options");
		
		echo '<div id="Lesson-meta">';
		echo $tempoptions[ 'text_string' ];
		echo $tempoptions[ 'check_box' ];

		// Show the custom taxonomies
		
		$args = array( 'taxonomy' => 'topic' );

		$terms = get_terms('topic', $args);

		$count = count($terms); $i=0;
		if ($count > 0) {
			$term_list = '<p class="my_term-archive"><h4>Topics</h4>';
			foreach ($terms as $term) {
				$i++;
				$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a>';
				if ($count != $i) $term_list .= ' &mdash; '; else $term_list .= '</p>';
			}
			echo $term_list;
		}

		$args = array( 'taxonomy' => 'level' );

		$terms = get_terms('level', $args);

		$count = count($terms); $i=0;
		if ($count > 0) {
			$term_list = '<p class="my_term-archive"><h4>Levels</h4>';
			foreach ($terms as $term) {
				$i++;
				$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a>';
				if ($count != $i) $term_list .= ' &mdash; '; else $term_list .= '</p>';
			}
			echo $term_list;
		}
		// Set up variables
			
			$option_1 = get_post_meta($post->ID, 'internet_source', true);
			$option_2 = get_post_meta($post->ID, 'video_duration', true);
			$overview = get_the_excerpt();
						
			// Display post meta data	
			
			echo '<span class="title">Overview</span>';
			echo '<p>' . $overview . '</p>'; 

			echo '<h4>Meta</h4><ul>';
			echo '<li>Internet source = <a href="' . $option_1 . '">' . $option_1 . '</a></li>'; 
			echo '<li>Video duration = ' . $option_2 . '</li>'; 
			echo '</ul></div>';
			
			// Lesson Meta
			
			$Lesson_meta = '';
			
			
			$Lesson_meta .= $content;
			return $Lesson_meta;
		} else {
			return $content;
		}
		
		
		wp_reset_postdata();
	}
	add_filter( 'the_content', 'gisig_filter_the_content' );

	
    // Add a link to the settings page onto the plugin page
    if(isset($gisig_Lesson_inspiration))
    {
        // Add the settings link to the plugins page
        function plugin_settings_link($links)
        { 
            $settings_link = '<a href="options-general.php?page=gisig_Lesson_inspiration">Global Settings</a>'; 
            array_unshift($links, $settings_link); 
            return $links; 
        }

        $plugin = plugin_basename(__FILE__); 
        add_filter("plugin_action_links_$plugin", 'plugin_settings_link');
    }
}
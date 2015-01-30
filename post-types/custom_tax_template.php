<?php

if(!class_exists('Custom_Tax_Template'))

{

	/**

	 * A PostTypeTemplate class that provides 3 additional meta fields

	 */

	class Custom_Tax_Template

	{

		const POST_TYPE	= "Lessons";



		/**

		 * The Constructor

		 */

		public function __construct()

		{

			// register actions

			add_action('init', array(&$this, 'init'));



		} // END public function __construct()



		/**

		 * hook into WP's init action hook

		 */

		public function init()

		{

			// Initialize Post Type

			$this->gisig_register_taxonomies_topics();

			

			// Initialize Post Type

			$this->gisig_register_taxonomies_levels();



		} // END public function init()



		/**

		 * Create the taxonomy

		 */



		public function gisig_register_taxonomies_topics() {



			/* Set up the arguments for the custom "topics "taxonomy. */

			

			$args = array(

				'public'            => true,

				'show_ui'           => true,

				'show_in_nav_menus' => true,

				'show_tagcloud'     => true,

				'show_admin_column' => true,

				'hierarchical'      => false,

				'query_var'         => 'Lessons',

			

			/* Labels used when displaying taxonomy and terms. */

			'labels' => array(

				'name'                       => __( 'Topics',                           'custom-content-portfolio' ),

				'singular_name'              => __( 'Topic',                            'custom-content-portfolio' ),

				'menu_name'                  => __( 'Topics',                           'custom-content-portfolio' ),

				'name_admin_bar'             => __( 'Topic',                            'custom-content-portfolio' ),

				'search_items'               => __( 'Search Topics',                    'custom-content-portfolio' ),

				'popular_items'              => __( 'Popular Topics',                   'custom-content-portfolio' ),

				'all_items'                  => __( 'All Topics',                       'custom-content-portfolio' ),

				'edit_item'                  => __( 'Edit Topic',                       'custom-content-portfolio' ),

				'view_item'                  => __( 'View Topic',                       'custom-content-portfolio' ),

				'update_item'                => __( 'Update Topic',                     'custom-content-portfolio' ),

				'add_new_item'               => __( 'Add New Topic',                    'custom-content-portfolio' ),

				'new_item_name'              => __( 'New Topic Name',                   'custom-content-portfolio' ),

				'separate_items_with_commas' => __( 'Separate topics with commas',      'custom-content-portfolio' ),

				'add_or_remove_items'        => __( 'Add or remove topics',             'custom-content-portfolio' ),

				'choose_from_most_used'      => __( 'Choose from the most used topics', 'custom-content-portfolio' ),

				)

			);

			

			/* Register the 'topic' taxonomy. */

			register_taxonomy( 'topic', array( 'Lessons' ), $args );

			



		}			

		

		public function gisig_register_taxonomies_levels() {



				/* Set up the arguments for the custom "topics "taxonomy. */

				

				$args = array(

					'public'            => true,

					'show_ui'           => true,

					'show_in_nav_menus' => true,

					'show_tagcloud'     => true,

					'show_admin_column' => true,

					'hierarchical'      => false,

					'query_var'         => 'Lessons',

			

				/* Labels used when displaying taxonomy and terms. */

				'labels' => array(

					'name'                       => __( 'Levels',                           'custom-content-portfolio' ),

					'singular_name'              => __( 'Level',                            'custom-content-portfolio' ),

					'menu_name'                  => __( 'Levels',                           'custom-content-portfolio' ),

					'name_admin_bar'             => __( 'Level',                            'custom-content-portfolio' ),

					'search_items'               => __( 'Search levels',                    'custom-content-portfolio' ),

					'popular_items'              => __( 'Popular levels',                   'custom-content-portfolio' ),

					'all_items'                  => __( 'All levels',                       'custom-content-portfolio' ),

					'edit_item'                  => __( 'Edit level',                       'custom-content-portfolio' ),

					'view_item'                  => __( 'View level',                       'custom-content-portfolio' ),

					'update_item'                => __( 'Update level',                     'custom-content-portfolio' ),

					'add_new_item'               => __( 'Add New level',                    'custom-content-portfolio' ),

					'new_item_name'              => __( 'New level Name',                   'custom-content-portfolio' ),

					'separate_items_with_commas' => __( 'Separate levels with commas',      'custom-content-portfolio' ),

					'add_or_remove_items'        => __( 'Add or remove levels',             'custom-content-portfolio' ),

					'choose_from_most_used'      => __( 'Choose from the most used levels', 'custom-content-portfolio' ),

				)

			);

			

			/* Register the 'level' taxonomy. */

			register_taxonomy( 'level', array( 'Lessons' ), $args );

		}

	} // END class Post_Type_Template

} // END if(!class_exists('Post_Type_Template'))

?>
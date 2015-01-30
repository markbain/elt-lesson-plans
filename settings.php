<?php
if(!class_exists('GISIG_Lesson_Inspiration_Settings'))
{
	class GISIG_Lesson_Inspiration_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} // END public function __construct
		
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	// Register Plugin Settings
			
        	register_setting(
				'gisig_Lesson_inspiration-group', 
				'gisig_plugin_options'); // Store all the options in an array

        	// Add Settings Sections
        	
			add_settings_section( // First Section
        	    'gisig_Lesson_inspiration-section-1' /* ID of this section */, 
        	    'Global Description' /* Display name of this section */, 
        	    array(&$this, 'settings_section_one_gisig_Lesson_inspiration'), 
        	    'gisig_Lesson_inspiration'
        	);

			add_settings_section( // Second Section
        	    
				'gisig_Lesson_inspiration-section-2' /* ID of this section */,				
        	    'Second Section' /* Display name of this section */, 
        	    array(&$this, 'settings_section_two_gisig_Lesson_inspiration'), 
        	    'gisig_Lesson_inspiration'
        	);
			
        	// Add Settings Fields
			
            add_settings_field(
                'gisig_Lesson_inspiration-setting_a', 
                'Generic Description Text', 
                array(&$this, 'settings_field_a'), 
                'gisig_Lesson_inspiration', 
                'gisig_Lesson_inspiration-section-1',
                array(
                    'field' => 'setting_a'
                )
            );
			
            add_settings_field( 
                'gisig_Lesson_inspiration-setting_b', // ID
                'Setting B', // Title
                array(&$this, 'settings_field_b'), // Callback
                'gisig_Lesson_inspiration', // Page
                'gisig_Lesson_inspiration-section-1', // Section (optional)
                array(
                    'field' => 'setting_b'
                )
            );

            add_settings_field( // Checkbox
                'gisig_Lesson_inspiration-setting_c', 
                'Setting C', 
                array(&$this, 'settings_field_c'), 
                'gisig_Lesson_inspiration', 
                'gisig_Lesson_inspiration-section-2',
                array(
                    'field' => 'setting_c'
                )
            );
			
        } // END public static function activate
        
        public function settings_section_one_gisig_Lesson_inspiration()
        {
            // Think of this as help text for the section.
            echo 'Here you can write a global description of what the Lessons are, how to use them, etc. This text will be repeated on each Lesson page.';
        }
		
        public function settings_section_two_gisig_Lesson_inspiration()
        {
            // Think of this as help text for the section.
            echo '<strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong> Nullam vehicula mi quis tristique venenatis. Aenean ultricies porta enim non dapibus. Nam id purus sed mauris interdum pellentesque. Nunc tincidunt, sem id <a href="#">placerat pharetra</a>, eros orci varius dui, non adipiscing dui orci ut elit. Nunc volutpat elit augue, ut imperdiet nibh volutpat sit amet. Ut vel magna lectus. Integer hendrerit sapien non leo aliquam, eget ultrices lectus ullamcorper.';
        }
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_a()
        {
            
			$options = get_option( 'gisig_plugin_options' );

			echo "<input id='plugin_text_string' name='gisig_plugin_options[text_string]' size='40' type='text' value='{$options['text_string']}' />";        
		} // END public function settings_field_a($args)

        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_b()
        {
			$options = get_option( 'gisig_plugin_options' );

			echo "<input id='plugin_check_box' name='gisig_plugin_options[check_box]' type='text' value='{$options['check_box']}' />";        
        } // END public function settings_field_input_text($args)

        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_c($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);

            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);

        } // END public function settings_field_three($args)
		
		
        
        /**
         * add a menu
         */		
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
			
        	add_options_page(
        	    'GISIG Lesson Inspiration Settings' /* The text to be displayed in the title tags of the page when the menu is selected */, 
        	    '<img class="menu_pto" src="'. GISIGELURL .'/img/asterisk-small.png" alt="" />GISIG Lesson Inspiration' /* The text to be used for the menu */, 
        	    'manage_options' /* The capability required for this menu to be displayed to the user. */, 
        	    'gisig_Lesson_inspiration' /* The slug name to refer to this menu by (should be unique for this menu). */, 
        	    array(&$this, 'plugin_settings_page')
        	);
        } // END public function add_menu()
    
        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class GISIG_Lesson_Inspiration_Settings
} // END if(!class_exists('GISIG_Lesson_Inspiration_Settings'))

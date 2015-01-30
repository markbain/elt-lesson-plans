<?php
/**
 * Add meta boxes to lesson plans
 */
if( ! function_exists( 'cmb2_example_plugin_post_media' ) ) {
	function cmb2_example_plugin_post_media( array $meta_boxes = array() ) {
		$prefix = '_cmb2_example_post_media_';

		$meta_boxes['cmb2_example_post_media'] = array(
			'id'               => 'cmb2_example_post_media',
			'title'            => __( 'Additional Media', 'cmb2-example-plugin' ),
			'object_types'     => array( 'lessons' ), // These fields should be placed on the USER object.
			'show_names'       => true,
			'fields'           => array(
				array(
					'name'     => __( 'Additional Files', 'cmb2-example-plugin' ),
					'desc'     => __( 'Handouts, etc.', 'cmb2-example-plugin' ),
					'id'       => $prefix . 'files',
					'type'     => 'file_list',
				),
				array(
					'name'     => __( 'Video', 'cmb2-example-plugin' ),
					'desc'     => sprintf( __( 'Add a link to any video from a <a href="%1$s" target="_blank">supported provider</a> and a preview will automatically appear below.', 'cmb2-example-plugin' ), 'http://codex.wordpress.org/Embeds' ),
					'id'       => $prefix . 'youtube',
					'type'     => 'oembed',
				),
				array(
					'name'     => __( 'Lesson Duration', 'cmb2-example-plugin' ),
					'desc'     => __( 'How long does the lesson last?', 'cmb2-example-plugin' ),
					'id'       => $prefix . 'duration',
					'type'     => 'text_small',
				),
			)
		);

		return (array) $meta_boxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'cmb2_example_plugin_post_media' );

// Add content before main content



	function theme_slug_filter_the_content( $content ) {
		
		// Get the post ID
			global $wp_query;
			$postid = $wp_query->post->ID;

		// Lesson Video

			// Get the meta
			$videourl = get_post_meta( $postid, '_cmb2_example_post_media_youtube', true );
			if ( $videourl) {
				// The content
				$video_content .= '<h4 id="lesson-plan-header-video" class="lesson-plan-header">Video</h4><p id="lesson-plan-content-duration" class="lesson-plan-content">';	
				$video_content .= wp_oembed_get($videourl);
				$video_content .= '</p>';
			}
    	

    	// Downloads

			// Get the meta
    		$files = get_post_meta( $postid, '_cmb2_example_post_media_files', true );
    		if ( $files) {

	    		// The content
				$download_content .= '<h4 id="lesson-plan-header-downloads" class="lesson-plan-header">Downloads</h4><ul id="lesson-plan-content-downloads" class="lesson-plan-content">';
				foreach ($files as $file) {	
					$download_content .= '<li><a href="' . $file . '">';
					$download_content .= $file;
					$download_content .= '</a></li>';
				}
				// return $download_content;
				$download_content .= '</ul>';
			}

    	// Lesson Duration
			$duration .= get_post_meta( $postid, '_cmb2_example_post_media_duration', true );
			if ( $duration) {

	    		// The content
		    	$duration_content .= '<h4 id="lesson-plan-header-duration" class="lesson-plan-header">Duration</h4><p id="lesson-plan-content-duration" class="lesson-plan-content">';
		    	$duration_content .= $duration;
		    	$duration_content .= '<p>';
		    }

	    // Language Points

	    	// Get the meta
    		$languages = get_the_term_list( $postid, 'topic', '<li>', '</li><li>', '</li>' );
    		if ( $languages) {

	    		// The content
		    	$language_content .= '<h4 id="lesson-plan-header-language" class="lesson-plan-header">Language Points</h4><ul id="lesson-plan-content-language" class="lesson-plan-content">';
		    	$language_content .= $languages;
		    	$language_content .= '<ul>';
		    }

	    // Level(s)

	    	// Get the meta
    		$levels = get_the_term_list( $postid, 'level', '<li>', '</li><li>', '</li>' );
    		if ( $levels) {
	    		// The content
		    	$level_content .= '<h4 id="lesson-plan-header-level" class="lesson-plan-header">Level(s)</h4><ul id="lesson-plan-content-level" class="lesson-plan-content">';
		    	$level_content .= $levels;
		    	$level_content .= '<ul>';
		    }

    	// Add the custom content to the_content
	    	$custom_content .= 	$video_content;
	    	$custom_content .= 	$download_content;
	    	$custom_content .= 	$duration_content;
	    	$custom_content .= 	$language_content;
	    	$custom_content .= 	$level_content;
	    	$custom_content .= 	$content; // Standard post content
	    	return $custom_content;
		
		// Reset the query
    		wp_reset_query();
	}
	add_filter( 'the_content', 'theme_slug_filter_the_content' );
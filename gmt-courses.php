<?php

/**
 * Plugin Name: GMT Courses
 * Plugin URI: https://github.com/cferdinandi/gmt-courses/
 * GitHub Plugin URI: https://github.com/cferdinandi/gmt-courses/
 * Description: A simple WordPress course plugin.
 * Version: 2.0.0
 * Author: Chris Ferdinandi
 * Author URI: http://gomakethings.com
 * Text Domain: gmt_courses
 * License: GPLv3
 */


// Load plugin files
require_once( plugin_dir_path( __FILE__ ) . 'includes/utilities.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/cpt.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/metabox.php' );
// require_once( plugin_dir_path( __FILE__ ) . 'includes/shortcode.php' );


/**
 * Flush rewrite rules on activation and deactivation
 */
function gmt_courses_flush_rewrites() {
	gmt_courses_add_custom_post_type_lessons();
	gmt_courses_add_custom_post_type_courses();
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'gmt_courses_flush_rewrites' );
<?php
/**
* Plugin Name: Custom Directory Plugin
* Plugin URI: https://github.com/kanhajatthap
* Description: This plugin is provide directorys, WP Custom Directory plugin with Shortcode and Meta Field...
* Version: 0.1
* Author: Kanha jatthap
* Author URI: https://github.com/kanhajatthap
**/

// Custom Post Type: Directory
include('custom-post-types.php');
add_action( 'init', 'directory_init' );

// Custom Fields
include('custom-fields.php');
add_action( 'init', 'directory_init' );

?>
<?php
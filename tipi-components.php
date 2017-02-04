<?php
/*!
Plugin Name: Tipi Components
Plugin URI: https://github.com/codetipi/tipi-components
Author: Codetipi
Author URI: http://codetipi.com
Description: Lightweight collection of general useful components.
Version: 1.0
Text Domain: codetipi
License: GPL
Requires at least: 4.7
Tested up to: 4.7
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Core class
 */
require plugin_dir_path( __FILE__ ) . 'inc/class-tipi-components.php';

if ( ! function_exists( 'tipi_components_init' ) ) :
/**
* Initialize the class
*
* @since 1.0.0
*/
function tipi_components_init() {
	new Tipi_Components;
}
endif;

tipi_components_init();
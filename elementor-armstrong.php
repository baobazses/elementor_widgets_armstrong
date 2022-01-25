<?php
/**
 * Elementor Armstrong WordPress Plugin
 *
 * @package ElementorArmstrong
 *
 * Plugin Name: Elementor Armstrong
 * Description: Elementor Widgets for Armstrong Websites
 * Version:     1.0.0
 * Author:      Armstrong
 * Author URI:  https://armstrong.space/
 * Text Domain: elementor-armstrong
 * Domain Path: languages
 */

define( 'ELEMENTOR_ARMSTRONG', __FILE__ );

/**
 * Include the Elementor_Armstrong class.
 */
require plugin_dir_path( ELEMENTOR_ARMSTRONG ) . 'class-elementor-armstrong.php';
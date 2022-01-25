<?php

/**
 * Widgets class.
 *
 * @category   Class
 * @package    ElementorArmstrong
 * @subpackage WordPress
 * @author     Armstrong <dev@armstrong.space>
 * @copyright  2021 Armstrong
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @since      1.0.0
 * php version 7.3.9
 */

namespace ElementorArmstrong;

// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * Class Plugin
 *
 * Main Plugin class
 *
 * @since 1.0.0
 */
class Widgets
{

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files()
	{
		require_once 'widgets/history.php';
		require_once 'widgets/carousel_progressbar.php';
		require_once 'widgets/carousel_progressbar_left.php';
		require_once 'widgets/image_title_description.php';
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets()
	{
		// It's now safe to include Widgets files.
		$this->include_widgets_files();

		// Register the plugin widget classes.
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\History());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CarouselProgressBar());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\CarouselProgressBarLeft());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\ImageTitleDescription());
	}


	/**
	 * Register Styles
	 *
	 * Register new widgets styles.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_styles()
	{
		wp_register_style('history-style', plugins_url('assets/css/history.css', __FILE__));
		wp_register_style('carousel_progressbar-style', plugins_url('assets/css/carousel_progressbar.css', __FILE__));
		wp_register_style('carousel_progressbar_left-style', plugins_url('assets/css/carousel_progressbar_left.css', __FILE__));
		wp_register_style('image_title_description-style', plugins_url('assets/css/image_title_description.css', __FILE__));
	}


	/**
	 * Register Scripts
	 *
	 * Register new widgets scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function widget_scripts()
	{
		wp_register_script('history-script', plugins_url('assets/js/history.js', __FILE__), ['jquery'], false, true);
		wp_register_script('carousel_progressbar-script', plugins_url('assets/js/carousel_progressbar.js', __FILE__), ['jquery'], false, true);
		wp_register_script('carousel_progressbar_left-script', plugins_url('assets/js/carousel_progressbar_left.js', __FILE__), ['jquery'], false, true);
		wp_register_script('image_title_description-script', plugins_url('assets/js/image_title_description.js', __FILE__));
	}

	/**
	 * Create Category
	 *
	 * Add the Armstrong category to the Elementor widgets list
	 *
	 * @since 1.0.0
	 * @access public
	 */
	function add_armstrong_category($elements_manager)
	{
		$elements_manager->add_category(
			'armstrong',
			[
				'title' => __('Armstrong', 'elementor-armstrong'),
				'icon' => 'fas fa-rocket',
			]
		);
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{
		// Register the styles & scripts.
		add_action('elementor/frontend/after_enqueue_styles', array($this, 'widget_styles'));
		add_action('elementor/frontend/after_register_scripts', array($this, 'widget_scripts'));
		// Register the new Armstrong Categorie
		add_action('elementor/elements/categories_registered', array($this, 'add_armstrong_category'));
		// Register the widgets.
		add_action('elementor/widgets/widgets_registered', array($this, 'register_widgets'));
	}
}

// Instantiate the Widgets class.
Widgets::instance();

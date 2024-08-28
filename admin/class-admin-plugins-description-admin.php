<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://michalrobak.pl
 * @since      1.0.0
 *
 * @package    Admin_Plugins_Description
 * @subpackage Admin_Plugins_Description/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Admin_Plugins_Description
 * @subpackage Admin_Plugins_Description/admin
 * @author     Michał Robak <hello@michalrobak.pl>
 */
class Admin_Plugins_Description_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Admin_Plugins_Description_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Admin_Plugins_Description_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/admin-plugins-description-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Admin_Plugins_Description_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Admin_Plugins_Description_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/admin-plugins-description-admin.js', array('jquery'), $this->version, false);
	}

	public function add_description_form($plugin_file, $plugin_data)
	{
		echo '<div class="apd-form hidden">';
		echo '<textarea type="textarea" class="apd-textarea" data-plugin="' . sanitize_title($plugin_data['Name']) . '" placeholder="' . __('Add custom description...', 'admin-plugins-description') . '"></textarea>';
		echo '<button type="button" class="apd-button button button-primary">' . __('Save', 'admin-plugins-description') . '</button>';
		echo '</div>';
	}

	public function add_description_link($links, $file)
	{
		$plugin_path = WP_PLUGIN_DIR . '/' . $file;
		$plugin_data = get_plugin_data($plugin_path);
		$links[] = '<a class="apd-link" data-plugin="' . sanitize_title($plugin_data['Name']) . '" href="#"><span class="dashicons dashicons-visibility"></span> ' . __('Show description', 'admin-plugins-description') . '</a>';
		// $links[] = '<a style="color: orange;" href="javascript:void(0)"><span class="dashicons dashicons-hidden"></span></span> ' . __('Show description') . '</a>';
		return $links;
	}
}

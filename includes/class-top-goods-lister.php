<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.upwork.com/o/profiles/users/_~01a15cf8508f1d2eec/
 * @since      1.0.0
 *
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/includes
 * @author     Serhii Ruban <rubanwd@gmail.com>
 */
class Top_Goods_Lister {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Top_Goods_Lister_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'TOP_GOODS_LISTER_VERSION' ) ) {
			$this->version = TOP_GOODS_LISTER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'top-goods-lister';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Top_Goods_Lister_Loader. Orchestrates the hooks of the plugin.
	 * - Top_Goods_Lister_i18n. Defines internationalization functionality.
	 * - Top_Goods_Lister_Admin. Defines all hooks for the admin area.
	 * - Top_Goods_Lister_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-top-goods-lister-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-top-goods-lister-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-top-goods-lister-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-top-goods-lister-public.php';

		$this->loader = new Top_Goods_Lister_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Top_Goods_Lister_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Top_Goods_Lister_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Top_Goods_Lister_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $plugin_admin, 'tgl_product_custom_post_init' );

		$this->loader->add_action( 'init', $plugin_admin, 'add_thumbnail_to_product_type' );

		$this->loader->add_action( 'init', $plugin_admin, 'enable_webp_upload' );



		$this->loader->add_action( 'load-post.php', $plugin_admin, 'tgl_product_meta_boxes_setup' );

		$this->loader->add_action( 'load-post-new.php', $plugin_admin, 'tgl_product_meta_boxes_setup' );

		$this->loader->add_action( 'init', $plugin_admin, 'tgl_create_custom_taxonomy_list' );

		$this->loader->add_action( 'get_sample_permalink_html', $plugin_admin, 'hide_permalink' );



		$this->loader->add_action( 'admin_head-post-new.php', $plugin_admin, 'delete_publsh_button' );
		$this->loader->add_action( 'admin_head-post.php', $plugin_admin, 'delete_publsh_button' );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'tgl_options_page' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'tgl_settings_init' );

		

		// $this->loader->add_action( 'admin_menu', $plugin_admin, 'wporg_options_page' );
		// $this->loader->add_action( 'admin_init', $plugin_admin, 'wporg_settings_init' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Top_Goods_Lister_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'tgl', $plugin_public, 'show_top_products' );
		add_shortcode( 'tgl', array( $plugin_public, 'show_top_products') );



	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Top_Goods_Lister_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

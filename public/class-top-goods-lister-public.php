<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.upwork.com/o/profiles/users/_~01a15cf8508f1d2eec/
 * @since      1.0.0
 *
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/public
 * @author     Serhii Ruban <rubanwd@gmail.com>
 */
class Top_Goods_Lister_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Top_Goods_Lister_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Top_Goods_Lister_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/top-goods-lister-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Top_Goods_Lister_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Top_Goods_Lister_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/top-goods-lister-public.js', array( 'jquery' ), $this->version, false );

	}

	public function show_top_products($atts) {

		ob_start();

		// Get params from shortcofe
		$params = shortcode_atts( array( 
			'count' => '1',
			'list'  => '',
			'single' => ''
		), $atts );
		$count = $params["count"];
		$list = $params["list"];
		$single = $params["single"];

	    $args = array(
	    	'name'        => $single,
	        'posts_per_page' => $count,
	        'post_type' => 'product',
	        'order'   => 'ASC',
	        'orderby'   => 'meta_value_num',
            'meta_query' => array(
                                array('key' => 'order',
                                      'value' => []
                                )
                            ),
            'tax_query' => array(
						        array(
						            'taxonomy' => 'list',
						            'field' => 'name',
						            'terms' => $list
						        )
						    )
	    );

	    $products = new WP_Query( $args ); 

		?>
		<?php if ( $products->have_posts() ) : ?>


		

		<?php include_once 'partials/top-goods-lister-public-display.php'; ?>

		<?php else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata();
		
		return ob_get_clean();

	}

}

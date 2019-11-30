<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.upwork.com/o/profiles/users/_~01a15cf8508f1d2eec/
 * @since      1.0.0
 *
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Top_Goods_Lister
 * @subpackage Top_Goods_Lister/includes
 * @author     Serhii Ruban <rubanwd@gmail.com>
 */
class Top_Goods_Lister_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'top-goods-lister',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

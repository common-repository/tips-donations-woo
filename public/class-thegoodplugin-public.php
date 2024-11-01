<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://thegoodplugin.com/
 * @since      1.0.0
 *
 * @package    Thegoodplugin
 * @subpackage Thegoodplugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Thegoodplugin
 * @subpackage Thegoodplugin/public
 * @author     Andre Iluca <admin@themesawesome.com>
 */
class Thegoodplugin_Public {

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
		$this->version     = $version;

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
		 * defined in Thegoodplugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Thegoodplugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/thegoodplugin-public.css', array(), $this->version, 'all' );

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
		 * defined in Thegoodplugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Thegoodplugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$thegoodplugin_amount      = carbon_get_theme_option( 'thegoodplugin_amount' );
		$thegoodplugin_button_text = carbon_get_theme_option( 'thegoodplugin_button_text' );

		if ( class_exists( 'WooCommerce' ) ) {
			$currency = get_woocommerce_currency_symbol();
		} else {
			$currency = '$';
		}

		$price        = '5';
		if ( ! empty( $thegoodplugin_amount ) ) {
			$price = $thegoodplugin_amount;
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/thegoodplugin-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'thegoodplugin_currency_script', array( 'thegoodplugin_tiptext' => $thegoodplugin_button_text, 'thegoodplugin_currency' => $currency, 'thegoodplugin_price' => $price ) );
		wp_enqueue_script( $this->plugin_name . '-cookies', plugin_dir_url( __FILE__ ) . 'js/jquery.cookie.js', array( 'jquery' ), '1.4.1', false );

	}

}

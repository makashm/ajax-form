<?php
/*
Plugin Name: Ajax Form
Description: Ajax Form for Wp
Plugin URI: https://wppeople.net
Author: Al Imran Akash
Author URI: http://im.medhabi.com
Version: 1.0
Text Domain: ajaxform
Domain Path: /languages
*/

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main class for the plugin
 * @package IM_Ajax_Form
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
if( ! class_exists( 'IM_Ajax_Form' ) ) :

class IM_Ajax_Form {
	
	public static $_instance;
	public $plugin_name;
	public $plugin_version;

	public function __construct() {
		self::define();
		self::includes();
		self::hooks();
	}

	/**
	 * Define constants
	 */
	public function define(){
		define( 'IMFILE', __FILE__ );
		$this->plugin_name = 'ajaxform';
		$this->plugin_version = '1.0';
	}

	/**
	 * Includes files
	 */
	public function includes(){
		require_once dirname( IMFILE ) . '/includes/ajaxform-functions.php';
		require_once dirname( IMFILE ) . '/includes/class.ajaxform-public.php';
	}

	/**
	 * Hooks
	 */
	public function hooks(){
		// public hooks
		$public = ( isset( $public ) && ! is_null( $public ) ) ? $public : new IM_Ajax_Form_Public( $this->plugin_name, $this->plugin_version );
		add_action( 'wp_head', array( $public, 'head' ) );
		add_action( 'wp_enqueue_scripts', array( $public, 'enqueue_scripts' ) );
		add_action( 'wp_ajax_im_ajax_form', array( $public, 'im_ajax_form' ) );
	    add_action( 'wp_ajax_nopriv_im_ajax_form', array( $public, 'im_ajax_form' ) );

	}

	/**
	 * Internationalization
	 */
	public function i18n() {
		load_plugin_textdomain( 'ajaxform', false, dirname( plugin_basename( IMFILE ) ) . '/languages/' );
	}

	/**
	 * Cloning is forbidden.
	 */
	private function __clone() { }

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	private function __wakeup() { }

	/**
	 * Instantiate the plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

endif;

IM_Ajax_Form::instance();
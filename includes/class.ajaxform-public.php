<?php

/**
 * All public facing functions
 */

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package IM_Ajax_Form
 * @subpackage IM_Ajax_Form_Public
 * @author Al Imran Akash <alimranakash.bd@gmail.com>
 */
if( ! class_exists( 'IM_Ajax_Form_Public' ) ) :

class IM_Ajax_Form_Public {

    /**
     * Constructor function
     */
    public function __construct( $name, $version ) {
        $this->name = $name;
        $this->version = $version;
    }
    
    /**
     * Enqueue JavaScripts and stylesheets
     */
    public function enqueue_scripts() {
        wp_enqueue_style( $this->name, plugins_url( '/assets/css/public.css', IMFILE ), '', $this->version, 'all' );
        wp_enqueue_script( $this->name, plugins_url( '/assets/js/public.js', IMFILE ), array( 'jquery' ), $this->version, true );
    }

    /**
     * Add some script to head
     */
    public function head() {
        echo '
        <script>
            var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";
        </script>';
    }

    /**
     * Ajax Form
     */
    public function im_ajax_form() {

        global $wpdb;
        // creates my_table in database if not exists
        $table = $wpdb->prefix . "my_table"; 
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            `id` mediumint(9) NOT NULL AUTO_INCREMENT,
            `name` text NOT NULL,
            `email` text NOT NULL,
            `phone` text NOT NULL,
            `address` text NOT NULL,
        UNIQUE (`id`)
        ) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        $name       = $_POST[ 'name' ];
        $email      = $_POST[ 'email' ];
        $phone      = $_POST[ 'phone' ];
        $address    = $_POST[ 'address' ];

    	if( $wpdb->insert( $table, array(
		'name'		=> $name,
		'email'		=> $email,
		'phone'		=> $phone,
		'address'	=> $address,
		)) === FALSE ){

		echo "Error";

		}
		else {
		echo "Customer '". $name . "' successfully added, row ID is ". $wpdb->insert_id;

		}
    	wp_die( $name . $email. $phone . $address );
    }
}

endif;
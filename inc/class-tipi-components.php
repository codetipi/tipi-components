<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 * Core Class
 *
 * @since      1.0.0
 *
 * @package    Tipi Components
 * @subpackage tipi-components/inc
 */

class Tipi_Components {

	/**
     * Constructor
     *
     * @since 1.0.0
     *
    */
	public function __construct() {

		$this->name     = "Tipi Components";
		$this->version  =  '1.0.0';
		$this->slug     = 'tipi-components';
		$this->url  	= plugin_dir_url( dirname( __FILE__ ) );
		$this->dir_path = plugin_dir_path( dirname( __FILE__ ) );
		$this->tipi_components_loader();
		$this->tipi_components_backend();
		$this->tipi_components_frontend();
		$this->tipi_components_locale();

	}

	/**
	 * Loader
	 *
	 * @since 1.0.0
	 */
	public function tipi_components_loader() {

		require_once $this->dir_path . 'frontend/class-tipi-components-frontend.php';
		require_once $this->dir_path . 'frontend/class-tipi-components-shortcodes.php';
		require_once $this->dir_path . 'admin/class-tipi-components-admin.php';
		require_once $this->dir_path . 'admin/class-tipi-components-button.php';
		require_once $this->dir_path . 'admin/class-tipi-components-i18n.php';

	}

	/**
	 * Backend Loader
	 *
	 * @since    1.0.0
	 */
	public function tipi_components_backend() {

		$admin = new Tipi_Components_Admin( $this->slug, $this->version, $this->url, $this->dir_path );
		add_action( 'admin_enqueue_scripts', array( $admin, 'tipi_components_enqueue_scripts' ) );

		$button = new Tipi_Components_Button( $this->slug, $this->url );
		add_action( 'admin_init', array( $button, 'tipi_components_button_init' ) );
		
	}

	/**
	 * Frontend Loader
	 *
	 * @since    1.0.0
	 */
	public function tipi_components_frontend() {

		$frontend = new Tipi_Components_Frontend( $this->slug, $this->version, $this->url );		
		add_action( 'wp_enqueue_scripts', array( $frontend, 'tipi_components_enqueue_scripts_frontend' ) );

		$shortcodes = new Tipi_Components_Shortcodes();
		add_shortcode( 'tipi_button', 	array( $shortcodes, 'tipi_components_shortcode_buttons' ) );
		add_shortcode( 'tipi_divider', 	array( $shortcodes, 'tipi_components_shortcode_divider' ) );
		add_shortcode( 'tipi_dropcap', 	array( $shortcodes, 'tipi_components_shortcode_dropcap' ) );
		add_shortcode( 'tipi_column', 	array( $shortcodes, 'tipi_components_shortcode_column' ) );

	}

    /**
	 * Translation Loader
	 *
	 * @since 1.0.0
	 */
	public function tipi_components_locale() {

		$i18n = new Tipi_Components_i18n( $this->dir_path );
		add_filter( 'mce_external_languages', array( $i18n, 'tipi_components_i18n' ) );

	}
	
}
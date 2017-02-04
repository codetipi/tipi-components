<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 * Frontend
 *
 * @since      1.0.0
 *
 * @package    Tipi Components
 * @subpackage tipi-components/frontend
 */
class Tipi_Components_Frontend {

	/**
	 * Var for slug
	 *
	 * @since    1.0.0
	 */
	private $slug;

	/**
	 * Var for version
	 *
	 * @since    1.0.0
	 */
	private $version;

	/**
	 * Var for URL
	 *
	 * @since    1.0.0
	 */
	private $url;

	/**
     * Constructor
     *
     * @since 1.0.0
     *
    */
	public function __construct( $slug, $version, $url ) {

		$this->slug = $slug;
		$this->version = $version;
		$this->url = $url;

	}

	/**
	 * Frontend scripts
	 *
	 * @since    1.0.0
	 */
	public function tipi_components_enqueue_scripts_frontend() {

		if ( is_admin() ) {
			return;
		}

		wp_enqueue_script( $this->slug . '-js', $this->url  . 'assets/js/' . $this->slug . '.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_style( $this->slug, $this->url  . 'assets/css/style.min.css', array(), $this->version, 'all' );

	}

}
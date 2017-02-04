<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 * Admin Class
 *
 * @since      1.0.0
 *
 * @package    Tipi Components
 * @subpackage tipi-components/admin
 */

class Tipi_Components_Admin {

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
	 * Backend scripts
	 *
	 * @since    1.0.0
	 */
	public function tipi_components_enqueue_scripts( $pagenow ) {

		if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' ) {
			return;
		}
		
		wp_enqueue_style( 'wp-color-picker' ); 
		wp_enqueue_style( $this->slug, $this->url  . 'assets/css/admin-style.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'tipi-icons', $this->url  . 'assets/fonts/style.css', array(), $this->version, 'all' );

	}

}
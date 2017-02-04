<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 * i18n Class
 *
 * @since      1.0.0
 *
 * @package    Tipi Components
 * @subpackage tipi-components/admin
 */

class Tipi_Components_i18n {

	/**
	 * Var for URL
	 *
	 * @since    1.0.0
	 */
	private $dir_path;

	/**
     * Constructor
     *
     * @since 1.0.0
     *
    */
	public function __construct( $dir_path ) {

		$this->dir_path = $dir_path;

	}

	/**
	 * i18n
	 *
	 * @since    1.0.0
	 */
	public function tipi_components_i18n( $i18n ) {

		$i18n[] = $this->dir_path . 'admin/tipi-components-i18n-strings.php';
    	return $i18n;

	}

}
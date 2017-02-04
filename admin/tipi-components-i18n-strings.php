<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 * i18n Strings
 *
 * @since      1.0.0
 *
 * @package    Tipi Components
 * @subpackage tipi-components/admin
 */

$strings = 'tinyMCE.addI18n( "' . _WP_Editors::$mce_locale . '.tipiComponents", {
    insert: "' . esc_html__( 'Insert', 'tipi-components' ) . '",
    close: "' . esc_html__( 'Close', 'tipi-components' ) . '",
    caption: "' . esc_html__( 'Tipi Components', 'tipi-components' ) . '",
    mainTitle: "' . esc_html__( 'Insert Tipi Component', 'tipi-components' ) . '",
    columns: "' . esc_html__( 'Columns', 'tipi-components' ) . '",
    dropcap: "' . esc_html__( 'Dropcap', 'tipi-components' ) . '",
    divider: "' . esc_html__( 'Divider', 'tipi-components' ) . '",
    buttons: "' . esc_html__( 'Buttons', 'tipi-components' ) . '"
} )';
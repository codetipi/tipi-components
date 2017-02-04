<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 * Shortcodes
 *
 * @since      1.0.0
 *
 * @package    Tipi Components
 * @subpackage tipi-components/inc
 */
class Tipi_Components_Shortcodes {

	/**
	 * Shortcode: Buttons
	 *
	 * @since    1.0.0
	 * @todo 	 Add hover effects options.
	 */
	public function tipi_components_shortcode_buttons( $atts, $content = '' ) {

		$atts = shortcode_atts(
			array(
				'url' => '',
				'size' => 'small',
				'color' => '#111',
				'style' => 'solid',
				'alignment' => 'none',
				'target' => 'samewindow',
				'rel' => 'follow',
			), $atts, 'tipi_button' 
		);

		$target = $atts['target'] == 'samewindow' ? '_self' : '_blank';
		$style = $atts['style'] == 'solid' ? 'background-color' : 'border-color';
		$classes = ' tipi-button-size-' . $atts['size'];
		$classes .= ' tipi-button-style-' . $atts['style'];
		$classes .= ' tipi-button-alignment-' . $atts['alignment'];

		$classes .= ' tipi-component-hover-1';

		$output = '<div class="tipi-component tipi-component-button' . esc_attr( $classes ) . '">';
		$output .= '<a href="' . esc_url( $atts['url'] ) . '" target="' . esc_attr( $target ) . '" style="' . esc_attr( $style ) . ': ' . esc_attr( $atts['color'] ) . ';" rel="' . esc_attr( $atts['rel'] ) . '">';
		$output .= $content;
		$output .= '</a>';
		$output .= '</div>';

		return $output;

	}

	/**
	 * Shortcode: Divider
	 *
	 * @since    1.0.0
	 */
	public function tipi_components_shortcode_divider( $atts, $content = '' ) {

		$atts = shortcode_atts(
			array(
				'style' => 'thin',
			), $atts, 'tipi_divider' 
		);

		$classes = ' tipi-divider-style-' . $atts['style'];

		$output = '<div class="tipi-component tipi-component-divider' . esc_attr( $classes ) . '">';
		$output .= $content == '' ? '' : '<span>' . $content . '</span>';
		$output .= '</div>';

		return $output;

	}

	/**
	 * Shortcode: Dropcap
	 *
	 * @since    1.0.0
	 */
	public function tipi_components_shortcode_dropcap( $atts, $content = '' ) {

		$atts = shortcode_atts(
			array(
				'style' => 'standard',
			), $atts, 'tipi_dropcap' 
		);

		$classes = ' tipi-dropcap-style-' . $atts['style'];

		$output = '<div class="tipi-component tipi-component-dropcap' . esc_attr( $classes ) . '">';
		$output .= $content;
		$output .= '</div>';

		return $output;

	}

	/**
	 * Shortcode: Columns
	 *
	 * @since    1.0.0
	 */
	public function tipi_components_shortcode_column( $atts, $content = '' ) {

		$atts = shortcode_atts(
			array(
				'size' => '1-3',
				'position' => '',
			), $atts, 'tipi_columns' 
		);
		switch ( $atts['size'] ) {
			case '1-3':
				$size = 4;
				break;
			case '1-4':
				$size = 3;
				break;
			case '1-2':
				$size = 6;
				break;
			case '2-3':
				$size = 8;
				break;
			case '3-4':
				$size = 9;
				break;
			default:
				$size = 6;
				break;
		}

		$classes = ' tipi-m-' . $size;
		$classes .= $atts['position'] != 'last' ? ' tipi-col-first' : ' tipi-col-last';

		$output = '<div class="tipi-component tipi-xs-12 tipi-component-column tipi-col' . esc_attr( $classes ) . '">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		$output .= $atts['position'] == 'last' ? '<div class="tipi-cf"></div>' : '';

		return $output;

	}

}
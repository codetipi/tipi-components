<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 *
 * Button Class
 *
 * @since      1.0.0
 *
 * @package    Tipi Components
 * @subpackage tipi-components/admin
 */

class Tipi_Components_Button {

    /**
     * Var for slug.
     *
     * @since    1.0.0
     */
    private $slug;

    /**
     * Var for URL.
     *
     * @since    1.0.0
     */
    private $url;

    /**
     * Admin Constructor
     *
     * @since 1.0.0
     *
    */
    public function __construct( $slug, $url ) {

        $this->slug = $slug;
        $this->url = $url;

    }

    /**
     * Button Init
     *
     * @since 1.0.0
     *
    */
    public function tipi_components_button_init() {

        if ( current_user_can('edit_posts') || current_user_can( 'edit_pages' ) ) {
            add_filter( 'mce_external_plugins', array( $this, 'tipi_components_register' ) );
            add_filter( 'mce_buttons', array( $this, 'tipi_components_buttons_callback' ) );
            add_action( 'wp_ajax_tipi_components_buttons_insert_dialog', array( $this, 'tipi_components_box') );
        }

    }

    /**
     * Button registration callback
     *
     * @since 1.0.0
     *
    */
    public function tipi_components_register( $plugin_array ) {

        $plugin_array['tipi_components_buttons'] = $this->url  . 'assets/js/' . $this->slug . '-button.js';
        return $plugin_array;

    }

    /**
     * Button toolbar callback
     *
     * @since 1.0.0
     *
    */
    public function tipi_components_buttons_callback( $buttons ) {

        $buttons[] = 'tipi_components_buttons';
        return $buttons;

    }

    /**
     * Components Box 
     *
     * @since    1.0.0
     */
    public function tipi_components_box() {

        $component = intval( $_POST['component'] );
        $strings = $this->tipi_components_box_i18n( $component );
        ?>

            <div class="tipi-components-box-wrap component-<?php echo intval( $component ); ?>"> 
                <div class="block block-1">
                    <h2 class="tipi-title"><?php echo wp_kses_data( $strings['h2'] ); ?></h2>
                </div>
                <?php
                switch ( $component ) {
                    case 2:
                        $this->tipi_components_buttons( $strings );
                        break;
                    case 3:
                        $this->tipi_components_divider( $strings );
                        break;
                    case 4:
                        $this->tipi_components_dropcap( $strings );
                        break;
                    default:
                        $this->tipi_components_columns( $strings );
                        break;
                }
                ?>
            </div><?php
    }

    /**
     * Columns
     *
     * @since    1.0.0
     * @todo     Add Preview Block
     */
    public function tipi_components_columns( $strings ) {
    ?>
        <div class="block">
            <div class="block-title"><?php echo wp_kses_data( $strings['size'] ); ?></div>
            <div class="block-content">
                <select class="column-size">
                    <option value="1-4" selected="selected"><?php echo wp_kses_data( $strings['3'] ); ?></option>
                    <option value="1-3"><?php echo wp_kses_data( $strings['4']); ?></option>
                    <option value="1-2"><?php echo wp_kses_data( $strings['6']); ?></option>
                    <option value="2-3"><?php echo wp_kses_data( $strings['8']); ?></option>
                    <option value="3-4"><?php echo wp_kses_data( $strings['9']); ?></option>
                </select>
                <label class="checkbox-wrap"><input type="checkbox" id="last"><?php echo wp_kses_data( $strings['last']); ?></label>
            </div>
        </div>
         <div class="block">
            <div class="block-title"><?php echo wp_kses_data( $strings['content'] ); ?></div>
            <div class="block-content">
                <textarea id="content" rows="6"></textarea>
            </div>
        </div>
    <?php
    }

    /**
     * Buttons
     *
     * @since    1.0.0
     */
    public function tipi_components_buttons( $strings ) {
    ?>
        <div class="block">
            <div class="block-content">
                <div class="input-title"><?php echo wp_kses_data( $strings['url'] ); ?></div>
                <input type="text" class="column-url">
            </div>
        </div>
         <div class="block">
            <div class="block-content">
                <div class="input-title"><?php echo wp_kses_data( $strings['text'] ); ?></div>
                <input type="text" class="main-content">
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <div class="select-title"><?php echo wp_kses_data( $strings['size'] ); ?></div>
                <select class="column-size">
                    <option value="small" selected="selected"><?php echo wp_kses_data( $strings['small'] ); ?></option>
                    <option value="big"><?php echo wp_kses_data( $strings['big']); ?></option>
                </select>
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <div class="select-title"><?php echo wp_kses_data( $strings['style'] ); ?></div>
                <select class="column-style">
                    <option value="solid" selected="selected"><?php echo wp_kses_data( $strings['solid'] ); ?></option>
                    <option value="outline"><?php echo wp_kses_data( $strings['outline']); ?></option>
                </select>
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <div class="select-title"><?php echo wp_kses_data( $strings['color'] ); ?></div>
                <input type="text" class="column-color tipi-color-field" value="#111">
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <div class="select-title"><?php echo wp_kses_data( $strings['alignment'] ); ?></div>
                <select class="column-alignment">
                    <option value="none" selected="selected"><?php echo wp_kses_data( $strings['none'] ); ?></option>
                    <option value="center"><?php echo wp_kses_data( $strings['center']); ?></option>
                </select>
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <div class="select-title"><?php echo wp_kses_data( $strings['target'] ); ?></div>
                <select class="column-target">
                    <option value="samewindow" selected="selected"><?php echo wp_kses_data( $strings['samewindow'] ); ?></option>
                    <option value="newwindow"><?php echo wp_kses_data( $strings['newwindow']); ?></option>
                </select>
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <div class="select-title"><?php echo wp_kses_data( $strings['rel'] ); ?></div>
                <select class="column-rel">
                    <option value="follow" selected="selected"><?php echo wp_kses_data( $strings['follow'] ); ?></option>
                    <option value="nofollow"><?php echo wp_kses_data( $strings['nofollow']); ?></option>
                </select>
            </div>
        </div>         
    <?php
    }

    /**
     * Divider
     *
     * @since    1.0.0
     */
    public function tipi_components_divider( $strings ) {
    ?>
         <div class="block">
            <div class="block-content">
                <div class="input-title"><?php echo wp_kses_data( $strings['text'] ); ?></div>
                <input type="text" class="main-content">
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <div class="select-title"><?php echo wp_kses_data( $strings['style'] ); ?></div>
                <select class="column-style">
                    <option value="thin" selected="selected"><?php echo wp_kses_data( $strings['thin'] ); ?></option>
                    <option value="thick"><?php echo wp_kses_data( $strings['thick']); ?></option>
                    <option value="double"><?php echo wp_kses_data( $strings['double']); ?></option>
                    <option value="dotted"><?php echo wp_kses_data( $strings['dotted']); ?></option>
                </select>
            </div>
        </div>         
    <?php
    }

    /**
     * Dropcap
     *
     * @since    1.0.0
     */
    public function tipi_components_dropcap( $strings ) {
    ?>
         <div class="block">
            <div class="block-content">
                <div class="input-title"><?php echo wp_kses_data( $strings['text'] ); ?></div>
                <input type="text" class="main-content">
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <div class="select-title"><?php echo wp_kses_data( $strings['style'] ); ?></div>
                <select class="column-style">
                    <option value="standard" selected="selected"><?php echo wp_kses_data( $strings['standard'] ); ?></option>
                    <option value="extrabig"><?php echo wp_kses_data( $strings['extrabig']); ?></option>
                </select>
            </div>
        </div>         
    <?php
    }

    /**
     * Box i18n
     *
     * @since    1.0.0
     */
    private function tipi_components_box_i18n( $component ) {

        $output = array();

        switch ( $component ) {
            case 1:
                $output['h2']      = esc_html__( 'Columns', 'tipi-components' );
                $output['size']    = esc_html__( 'Column size', 'tipi-components' );
                $output['preview'] = esc_html__( 'Preview', 'tipi-components' );
                $output['3']       = esc_html__( 'One Quarter (25%)', 'tipi-components' );
                $output['4']       = esc_html__( 'One Third (33%)', 'tipi-components' );
                $output['6']       = esc_html__( 'One Half (50%)', 'tipi-components' );
                $output['8']       = esc_html__( 'Two Thirds (66%)', 'tipi-components' );
                $output['9']       = esc_html__( 'Three Quarters (75%)', 'tipi-components' );
                $output['last']    = esc_html__( 'Last column of row', 'tipi-components' );
                $output['content'] = esc_html__( 'Content', 'tipi-components' );
                break;
            case 2:
                $output['h2']       = esc_html__( 'Buttons', 'tipi-components' );
                $output['url']      = esc_html__( 'Button URL', 'tipi-components' );
                $output['text']      = esc_html__( 'Button Text', 'tipi-components' );
                $output['size']      = esc_html__( 'Size', 'tipi-components' );
                $output['rel']      = esc_html__( 'Rel', 'tipi-components' );
                $output['color']      = esc_html__( 'Color', 'tipi-components' );
                $output['follow']      = esc_html__( 'Follow', 'tipi-components' );
                $output['nofollow']      = esc_html__( 'No Follow', 'tipi-components' );
                $output['target']      = esc_html__( 'Target', 'tipi-components' );
                $output['samewindow']      = esc_html__( 'Same Window', 'tipi-components' );
                $output['newwindow']      = esc_html__( 'New Window', 'tipi-components' );
                $output['alignment'] = esc_html__( 'Alignment', 'tipi-components' );
                $output['none'] = esc_html__( 'None', 'tipi-components' );
                $output['center'] = esc_html__( 'Center', 'tipi-components' );
                $output['big'] = esc_html__( 'Big', 'tipi-components' );
                $output['small'] = esc_html__( 'Small', 'tipi-components' );
                $output['outline'] = esc_html__( 'Outline', 'tipi-components' );
                $output['solid'] = esc_html__( 'Solid', 'tipi-components' );
                $output['style']      = esc_html__( 'Style', 'tipi-components' );
                break;
            case 3:
                $output['h2']       = esc_html__( 'Divider', 'tipi-components' );
                $output['text']      = esc_html__( 'Divider Text', 'tipi-components' );
                $output['style']      = esc_html__( 'Style', 'tipi-components' );
                $output['thin']      = esc_html__( 'Thin', 'tipi-components' );
                $output['thick']      = esc_html__( 'Thick', 'tipi-components' );
                $output['double']      = esc_html__( 'Double', 'tipi-components' );
                $output['dotted']      = esc_html__( 'Dotted', 'tipi-components' );
                break;
            case 4:
                $output['h2']       = esc_html__( 'Dropcap', 'tipi-components' );
                $output['text']      = esc_html__( 'Dropcap Letter', 'tipi-components' );
                $output['style']      = esc_html__( 'Style', 'tipi-components' );
                $output['standard']      = esc_html__( 'Standard', 'tipi-components' );
                $output['extrabig']      = esc_html__( 'Extra Big', 'tipi-components' );
                break;
        }

        return $output;
    }

}
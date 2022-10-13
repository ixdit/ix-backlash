<?php
/**
 * Plugin Name:       Ix Backlash
 * Plugin URI:        https://github.com/ixdit/ix-backlash
 * Description:       Plugin page and posts backlash
 * Author:            Dmitry Vorobiev & Artem Abramovich
 * Author URI:        https://github.com/ixdit
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ixbl
 * Domain Path:       /languages/
 *
 * Version:           1.0.0
 *
 * WC requires at least: 5.2.0
 * WC tested up to: 6.1
 *
 * RequiresWP: 5.5
 * RequiresPHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'IXBL_PLUGIN_DIR', __DIR__ );
define( 'IXBL_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
define( 'IXBL_PLUGIN_FILE', plugin_basename( __FILE__ ) );

define( 'IXBL_PLUGIN_VER', '1.0.0' );

define( 'IXBL_PLUGIN_NAME', 'Ix Backlash' );

require IXBL_PLUGIN_DIR . '/vendor/autoload.php';

/**
 * Отладка
 */
function qminfo($str) {
	do_action( 'qm/info',$str);
}
function pre($str){
	echo '<pre>';
	print_r($str);
	echo '</pre>';
}

if ( ! function_exists( 'ixpc' ) ) {
	/**
	 *
	 * @return object IXPC class object.
	 * @since 1.0.0
	 */
	function ixpc(): object {

		return IXPC\Main::instance();;
	}
}

ixpc();
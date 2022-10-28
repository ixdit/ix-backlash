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
 * Создание таблиц
 *
 * @global $wpdb
 */

function ixbl_create_plugin_tables() {
	global $wpdb;

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	$table_name_posts_backlash = $wpdb->prefix . 'posts_backlash';
	$table_name_user_backlash  = $wpdb->prefix . 'user_backlash';

	$table_posts_backlash = "CREATE TABLE $table_name_posts_backlash (
								 id int(11) NOT NULL AUTO_INCREMENT,
								 post_id int NOT NULL,
								 count_like int NOT NULL,
								 count_dislike int NOT NULL,
								 UNIQUE KEY id (id)
								 );
							";
	$table_user_backlash = "CREATE TABLE $table_name_user_backlash (
								 id int(11) NOT NULL AUTO_INCREMENT,
								 user_id int NOT NULL,
								 post_id int NOT NULL,
								 backlash varchar(255) NOT NULL,
								 UNIQUE KEY id (id)
								 );
							";
	dbDelta($table_posts_backlash);
	dbDelta($table_user_backlash);
}

register_activation_hook( __FILE__, 'ixbl_create_plugin_tables' );

/**
 * Отладка
 */
//if ( ! function_exists( 'qminfo' ) ) {
//	function qminfo($str) {
//		do_action( 'qm/info',$str);
//	}
//}
//if ( ! function_exists( 'pre' ) ) {
//	function pre($str){
//		echo '<pre>';
//		print_r($str);
//		echo '</pre>';
//	}
//}


if ( ! function_exists( 'ixbl' ) ) {
	/**
	 *
	 * @return object IXBL class object.
	 * @since 1.0.0
	 */
	function ixbl(): object {

		return IXBL\Main::instance();
	}
}

ixbl();

//TODO: добавить админ часть плагина 152


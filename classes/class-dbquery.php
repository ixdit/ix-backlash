<?php

namespace IXBL;

class DBquery {

	public $table_posts;
	public $table_user;

	public function __construct() {

		global $wpdb;

		$this->table_posts = $wpdb->prefix . 'ixbl_posts';
		$this->table_user  = $wpdb->prefix . 'ixbl_user';
	}

	public function ixbl_create_plugin_tables() {

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$table_posts_backlash = "CREATE TABLE $this->table_posts (
								 id int(11) NOT NULL AUTO_INCREMENT,
								 post_id int NOT NULL,
								 count_like int NOT NULL,
								 count_dislike int NOT NULL,
								 UNIQUE KEY id (id)
								 );
							";
		$table_user_backlash = "CREATE TABLE $this->table_user (
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

	/**
	 * @param $post_id
	 *
	 * @return mixed
	 */
	public function get_row( $post_id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . self::$table_posts;

		$result = $wpdb->get_row(
			$wpdb->prepare(
				"
					SELECT * 
					FROM {$wpdb->prefix}posts_backlash 
					WHERE post_id = %d
				",
				$post_id
			)
		);

		return $result;
	}




}
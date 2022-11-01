<?php

namespace IXBL;

class Create_Table extends DB {

	public function create_tables(): void {

		$this->table_posts();
		$this->table_users();
	}

	public function drop_tables(): void {}

	/**
	 * @param $post_id
	 *
	 * @return mixed
	 */
	public function get_row( $post_id ) {

		global $wpdb;

		return $wpdb->get_row(
			$wpdb->prepare(
				"
					SELECT * 
					FROM $this->table_posts 
					WHERE post_id = %d
				",
				$post_id
			)
		);
	}


	/**
	 * @return void
	 */
	protected function table_posts(): void {

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$table_posts = "CREATE TABLE $this->table_posts (
								 id int(11) NOT NULL AUTO_INCREMENT,
								 post_id int NOT NULL,
								 count_like int NOT NULL,
								 count_dislike int NOT NULL,
								 UNIQUE KEY id (id)
								 );
							";

		dbDelta( $table_posts );
	}


	/**
	 * @return void
	 */
	protected function table_users(): void {

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$table_user = "CREATE TABLE $this->table_user (
								 id int(11) NOT NULL AUTO_INCREMENT,
								 user_id int NOT NULL,
								 post_id int NOT NULL,
								 backlash varchar(255) NOT NULL,
								 UNIQUE KEY id (id)
								 );
							";

		dbDelta( $table_user );
	}

}
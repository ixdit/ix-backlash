<?php

namespace IXBL;

class DB {

	public string $table_posts;
	public string $table_user;

	public function __construct() {

		global $wpdb;

		$this->table_posts = $wpdb->prefix . 'ixbl_posts';
		$this->table_user  = $wpdb->prefix . 'ixbl_user';
	}

}
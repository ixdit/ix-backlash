<?php

namespace IXBL;

class Back {

	public function init_hooks(): void {

		add_action( 'wp_ajax_nopriv_ixbl_ajax_backlash', [ $this, 'ajax_scripts_callback' ] );
		add_action( 'wp_ajax_ixbl_ajax_backlash', [ $this, 'ajax_scripts_callback' ] );

	}

	public function ajax_scripts_callback(): void {

		print_r( $_POST );

		$post_id = $_POST['post_id'];
		$action  = $_POST['backlash'];
		$data    = [];

		if ( $post_id ) {
			//проверяем наличие в базе
			$existence_post_count = $this->get_post_backlash_counter( $post_id );

			if ( empty( $existence_post_count['post_id'] ) ) {

				$add_post_backlash_new_counter = $this->add_post_backlash_counter( $post_id, $action );

			} else {

				$update_post_backlash_counter = $this->update_post_backlash_counter( $post_id, $action );

			}

		}

		wp_send_json( $data );

	}

	public function get_post_backlash_counter( $post_id, $backlash_counter = '' ) {

		global $wpdb;

		$result = $wpdb->get_row( $wpdb->prepare(
			" SELECT * FROM {$wpdb->prefix}posts_backlash WHERE post_id = {$post_id}" ) );

		return [
			'post_id'       => $result->post_id,
			'count_like'    => $result->count_like,
			'count_dislike' => $result->count_dislike,
		];

	}

	public function add_post_backlash_counter( $post_id, $action, $backlash_counter = '' ) {

		global $wpdb;

		$result = $wpdb->insert(
			$wpdb->prefix . 'posts_backlash',
			[
				'post_id'          => $post_id,
				'count_' . $action => 1,
			]
		);

		return $result;

	}

	public function update_post_backlash_counter( $post_id, $action, $backlash_counter = '' ) {

		$cur_counter = $this->get_post_backlash_counter( $post_id );
		$cur_action  = 'count_' . $action;

		foreach ( $cur_counter as $key => $value ) {
			if ( $key == $cur_action ) {
				$new_count = $value + 1;
			}
		}
//		print_r( $new_count );

		global $wpdb;

		$result = $wpdb->update(
			$wpdb->prefix . 'posts_backlash',
			[
				'count_' . $action => $new_count,
			],
			[
				'post_id' => $post_id,
			]
		);

		return $result;

	}

}
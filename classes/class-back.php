<?php

namespace IXBL;

class Back {

	public function init_hooks(): void {

		add_action( 'wp_ajax_nopriv_ixbl_ajax_backlash', [ $this, 'ajax_scripts_callback' ] );
		add_action( 'wp_ajax_ixbl_ajax_backlash', [ $this, 'ajax_scripts_callback' ] );

	}

	public function ajax_scripts_callback() {

		if (!wp_verify_nonce($_POST['nonce'], '_ixbl_backlash_nonce')) {
			wp_die('');
		}

		$post_id = $_POST['post_id'];
		$action = $_POST['backlash'];
		$data = null;

		if ( $post_id ) {

			if ( $action === 'like' ) {
				$cur_backlash_counter = get_post_meta( $post_id, 'backlash_like');
				$new_backlash_counter = $cur_backlash_counter + 1;
				update_post_meta( $post_id, 'backlash_like', $new_backlash_counter );
				$data = get_post_meta( $post_id, 'backlash_like');
			} elseif ( $action === 'dislike') {
				$cur_backlash_counter = get_post_meta( $post_id, 'backlash_dislike');
				$new_backlash_counter = $cur_backlash_counter + 1;
				update_post_meta( $post_id, 'backlash_dislike', $new_backlash_counter );
				$data = get_post_meta( $post_id, 'backlash_dislike');
			}
		}

		wp_send_json( $data );

	}

}
<?php

namespace IXBL;

class Enqueue {

	public function init_hooks(): void {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_script_style' ], 100 );

	}

	function enqueue_script_style() {

		wp_register_script(
			'ixbl-scripts',
			IXBL_PLUGIN_URI . 'assets/js/main.js',
			[ 'jquery' ],
			IXBL_PLUGIN_VER,
			true
		);

		wp_register_style(
			'ixbl-styles',
			IXBL_PLUGIN_URI . 'assets/css/style.css',
			[],
			IXBL_PLUGIN_VER
		);

		wp_enqueue_script( 'ixbl-scripts' );
		wp_enqueue_style( 'ixbl-styles' );

		wp_localize_script(
			'ixbl-scripts',
			'ajax_data',
			[
				'root'    => esc_url_raw( rest_url() ),
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'wp_rest' ),
			],
		);


	}

}
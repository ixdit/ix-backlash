<?php

namespace IXBL;

class Main {

	private static ?Main $instance = null;

	public Templater $templater;

	public static function instance(): Main {

		if ( is_null( self::$instance ) ) :
			self::$instance = new self();
		endif;

		return self::$instance;

	}

	private function __construct() {

		$this->init();

	}

	public function init() {

		$this->templater = new Templater();
		( new Enqueue() )->init_hooks();
		( new Front() )->init_hooks();
		( new Back() )->init_hooks();

	}

}
<?php

namespace IXBL;

class Main {

	private static ?Main $instance = null;

	public Templater $templater;

	/**
	 * @var \IXBL\DB
	 */
	protected DB $db;


	public static function instance(): Main {

		if ( is_null( self::$instance ) ) :
			self::$instance = new self();
		endif;

		return self::$instance;

	}


	private function __construct() {

		$this->init();
		$this->init_hooks();
	}


	public function init(): void {

		$this->db = new DB();

		$this->templater = new Templater();

		( new Enqueue() )->init_hooks();
		( new Front() )->init_hooks();
		( new Back() )->init_hooks();

	}


	public function init_hooks(): void {

		register_activation_hook( IXBL_PLUGIN_FILE, [ $this, 'create_tables' ] );
	}


	public function create_tables() {

		( new Create_Table() )->create_tables();
	}

}
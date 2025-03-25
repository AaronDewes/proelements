<?php
namespace ElementorPro\Core\Connect;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Manager {

	/**
	 * @param \Elementor\Core\Common\Modules\Connect\Module $apps_manager
	 */
	public function register_apps( $apps_manager ) {
		$apps = [];

		foreach ( $apps as $slug => $class ) {
			$apps_manager->register_app( $slug, $class );
		}
	}

	public function __construct() {
		add_action( 'elementor/connect/apps/register', [ $this, 'register_apps' ] );
	}
}

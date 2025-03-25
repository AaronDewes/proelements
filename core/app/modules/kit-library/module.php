<?php
namespace ElementorPro\Core\App\Modules\KitLibrary;

use ElementorPro\Plugin;
use ElementorPro\License\API;
use ElementorPro\License\Admin;
use Elementor\Core\Base\Module as BaseModule;
use ElementorPro\Core\Connect\Apps\Activate;
use Elementor\Core\App\Modules\KitLibrary\Connect\Kit_Library;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Module extends BaseModule {
	/**
	 * Get name.
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function get_name() {
		return 'kit-library';
	}

	private function set_kit_library_settings() {
		$common = Plugin::elementor()->common;
		$app = Plugin::elementor()->app;

		$prev_settings = $app->get_settings( 'kit-library' );

		// BC Support.
		if ( ! $prev_settings || ! $common ) {
			return;
		}

		/** @var Activate $activate */
		$activate = $common->get_component( 'connect' )->get_app( 'activate' );

		/** @var Kit_Library $kit_library */
		$kit_library = $common->get_component( 'connect' )->get_app( 'kit-library' );

		$app->set_settings( 'kit-library', array_merge( $prev_settings, [
			'is_pro' => true,
			'is_library_connected' => false,//API::is_license_active() && $kit_library && $kit_library->is_connected(),
			'library_connect_url' => $activate->get_admin_url( 'authorize', [
				'utm_source' => 'kit-library',
				'utm_medium' => 'wp-dash',
				'utm_campaign' => 'connect-and-activate-license',
				'utm_term' => '%%page%%', // Will be replaced in the frontend.
			] ),
			'access_level' => API::get_library_access_level( 'kit' ),
			'access_tier' => API::get_access_tier(),
		] ) );
	}


	public function __construct() {
		add_action( 'elementor/init', function () {
			$this->set_kit_library_settings();
		}, 13 /** after elementor core */ );
	}
}

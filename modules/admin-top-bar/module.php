<?php

namespace ElementorPro\Modules\AdminTopBar;

use ElementorPro\Plugin;
use ElementorPro\Base\Module_Base;
use ElementorPro\License\API;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_name() {
		return 'admin-top-bar';
	}

	/**
	 * Module constructor.
	 */
	public function __construct() {
		parent::__construct();
	}
}

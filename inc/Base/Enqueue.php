<?php
/**
 * @package  wcdeliverydate
 */

namespace Wcdd\Base;

use Wcdd\Base\BaseController;

/**
 *
 */
class Enqueue extends BaseController {
	public function register() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
	}

	function enqueue() {
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'wcdd-main-script',
			$this->plugin_url . '/assets/js/app.js',
			[ 'jquery' ],
			filemtime( $this->plugin_path . '/assets/js/app.js' ),
			true );
	}
}

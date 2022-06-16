<?php
/**
 * @package  wcdeliverydate
 */

namespace Wcdd\Base;

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
			$this->plugin_url . 'assets/js/app.js',
			[ 'jquery', 'selectWoo' ],
			filemtime( $this->plugin_path . 'assets/js/app.js' ),
			true );

		wp_enqueue_style( 'wcdd-main-style', $this->plugin_url . 'assets/css/main.css', [],
			filemtime( $this->plugin_path . 'assets/css/main.css' ),
			'all'
		);
	}
}

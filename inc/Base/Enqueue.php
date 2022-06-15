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
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
	}

	function enqueue() {
	}
}

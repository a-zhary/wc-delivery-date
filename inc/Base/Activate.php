<?php
/**
 * @package  wcdeliverydate
 */

namespace Wcdd\Base;

class Activate {
	public static function activate() {
		flush_rewrite_rules();
	}
}

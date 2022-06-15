<?php
/**
 * @package  wcdeliverydate
 */

namespace Wcdd\Base;

class Deactivate {
	public static function deactivate() {
		flush_rewrite_rules();
	}
}

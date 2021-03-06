<?php
/**
 * @package  wcdeliverydate
 */

namespace Wcdd\Base;

class BaseController {
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $version = '1.0.0';

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url  = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin      = plugin_basename( dirname( __FILE__, 3 ) ) . '/wc-delivery-date.php';

		load_theme_textdomain( 'wc-delivery-date', $this->plugin_path . 'languages' );
	}
}

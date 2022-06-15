<?php
/**
 * @package  wcdeliverydate
 */

namespace Wcdd\Base;

use Wcdd\Base\BaseController;

class SettingsLinks extends BaseController {
	public function register() {
		add_filter( "plugin_action_links_$this->plugin", [ $this, 'settings_link' ] );
	}

	public function settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=wc_delivery_date_plugin">Settings</a>';
		array_push( $links, $settings_link );

		return $links;
	}
}

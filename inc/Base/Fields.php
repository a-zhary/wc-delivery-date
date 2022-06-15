<?php

namespace Wcdd\Base;

class Fields extends BaseController {

	public function register() {
		add_filter( 'woocommerce_checkout_fields', [ $this, 'create' ] );

		add_action( 'woocommerce_checkout_after_customer_details', [ $this, 'render' ] );

		add_action( 'woocommerce_checkout_update_order_meta', [ $this, 'save_front' ], 10, 2 );

		add_action( 'woocommerce_thankyou', [ $this, 'display_order_data_in_front' ], 20 );
		add_action( 'woocommerce_view_order', [ $this, 'display_order_data_in_front' ], 20 );

		add_action( 'woocommerce_admin_order_data_after_shipping_address', [ $this, 'display_order_data_in_admin' ] );

		add_action( 'woocommerce_process_shop_order_meta', [ $this, 'save_admin' ], 45, 2 );

		add_filter( 'woocommerce_email_order_meta_fields', [ $this, 'email_order' ], 10, 3 );

	}

	public function create( $fields ) {

		$fields[ 'wcdd_delivery_fields' ] = [
			'wcdd_datepicker' => [
				'type'     => 'text',
				'required' => true,
				'class'    => [ 'wcdd-delivery__datepicker' ],
				'id'       => 'wcdd-datepicker',
			],
			'wcdd_time_from'  => [
				'type'     => 'select',
				'required' => true,
				'class'    => [ 'wcdd-delivery__from' ],
				'options'  => [
					'10' => '10:00',
					'11' => '11:00',
					'12' => '12:00',
					'13' => '13:00',
					'14' => '14:00',
					'15' => '15:00',
					'16' => '16:00',
					'17' => '17:00',
					'18' => '18:00',
					'19' => '19:00',
					'20' => '20:00',
					'21' => '21:00',
				],
			],
			'wcdd_time_to'    => [
				'type'     => 'select',
				'required' => true,
				'class'    => [ 'wcdd-delivery__to' ],
				'options'  => [
					'11' => '11:00',
					'12' => '12:00',
					'13' => '13:00',
					'14' => '14:00',
					'15' => '15:00',
					'16' => '16:00',
					'17' => '17:00',
					'18' => '18:00',
					'19' => '19:00',
					'20' => '20:00',
					'21' => '21:00',
					'22' => '22:00',
					'23' => '23:00',
				],
			],
		];

		return $fields;
	}

	public function render() {
		return require_once( $this->plugin_path . '/views/front-checkout.php' );
	}

	// saving data
	public function save_front( $order_id, $posted ) {
		foreach ( $posted as $k => $value ) {
			if ( isset( $value ) ) {
				update_post_meta( $order_id, '_' . $k, sanitize_text_field( $value ) );
			}
		}
	}

	public function display_order_data_in_front( $order_id ) {
		return require_once( $this->plugin_path . '/views/front-checkout-complete.php' );
	}

	public function display_order_data_in_admin( $order ) {
		$id = $order->id;

		return require_once( $this->plugin_path . '/views/admin-order.php' );
	}

	public function save_admin( $post_id, $post ) {
		update_post_meta( $post_id, '_wcdd_datepicker', wc_clean( $_POST[ '_wcdd_datepicker' ] ) );
		update_post_meta( $post_id, '_wcdd_time_from', wc_clean( $_POST[ '_wcdd_time_from' ] ) );
		update_post_meta( $post_id, '_wcdd_time_to', wc_clean( $_POST[ '_wcdd_time_to' ] ) );
	}

	// add the field to email template
	public function email_order( $order, $sent_to_admin, $plain_text ) {
		$order[ 'wcdd_delivery_date' ] = [
			'label' => __( 'Delivery Date', 'wc-delivery-date' ),
			'value' => get_post_meta( $order->id, '_wcdd_datepicker', true ),
		];

		return $order;
	}
}

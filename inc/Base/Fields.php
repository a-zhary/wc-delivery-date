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
				'type'        => 'text',
				'required'    => true,
				'class'       => [ 'wcdd-delivery__datepicker' ],
				'input_class' => [ 'wcdd-delivery__datepicker-input' ],
				'id'          => 'wcdd-datepicker',
				'label'       => __( 'Date', 'wc-delivery-date' ),
				'label_class' => [ 'wcdd-delivery__label' ]
			],
			'wcdd_time_from'  => [
				'type'        => 'select',
				'required'    => true,
				'class'       => [ 'wcdd-delivery__clock', 'wcdd-delivery__clock--from' ],
				'options'     => [
					'10:00' => '10:00',
					'11:00' => '11:00',
					'12:00' => '12:00',
					'13:00' => '13:00',
					'14:00' => '14:00',
					'15:00' => '15:00',
					'16:00' => '16:00',
					'17:00' => '17:00',
					'18:00' => '18:00',
					'19:00' => '19:00',
					'20:00' => '20:00',
					'21:00' => '21:00',
				],
				'label'       => __( 'Time', 'wc-delivery-date' ),
				'label_class' => [ 'wcdd-delivery__label' ]
			],
			'wcdd_time_to'    => [
				'type'        => 'select',
				'required'    => true,
				'class'       => [ 'wcdd-delivery__clock', 'wcdd-delivery__clock--to' ],
				'options'     => [
					'11:00' => '11:00',
					'12:00' => '12:00',
					'13:00' => '13:00',
					'14:00' => '14:00',
					'15:00' => '15:00',
					'16:00' => '16:00',
					'17:00' => '17:00',
					'18:00' => '18:00',
					'19:00' => '19:00',
					'20:00' => '20:00',
					'21:00' => '21:00',
					'22:00' => '22:00',
					'23:00' => '23:00',
				],
				'label'       => __( 'Time', 'wc-delivery-date' ),
				'label_class' => [ 'wcdd-delivery__label' ]
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
	public function email_order( $fields, $sent_to_admin, $order ) {
		$fields[ 'wcdd_delivery_date' ] = [
			'label' => __( 'Delivery Date', 'wc-delivery-date' ),
			'value' => get_post_meta( $order->id, '_wcdd_datepicker', true ),
		];

		$fields[ 'wcdd_delivery_time' ] = [
			'label' => __( 'Delivery Time', 'wc-delivery-date' ),
			'value' => get_post_meta( $order->id, '_wcdd_time_from', true ) . ' - ' . get_post_meta( $order->id,
					'_wcdd_time_to', true ),
		];

		return $fields;
	}
}

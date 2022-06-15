<?php
/**
 * @var integer $id
 */
?>

<h3>
	<?php _e( 'Desired days and hours of delivery', 'wc-delivery-date' ); ?>
</h3>
<div class="form-field form-field-wide">
    <div>
		<?php woocommerce_wp_text_input( [
			'id'            => '_wcdd_datepicker',
			'label'         => __( 'Delivery Date', 'wc-delivery-date' ),
			'wrapper_class' => '_shipping_field'
		] ); ?>
    </div>
    <div>
		<?php woocommerce_wp_text_input( [
			'id'            => '_wcdd_time_from',
			'label'         => __( 'Delivery Time From', 'wc-delivery-date' ),
			'wrapper_class' => '_shipping_field'
		] ); ?>
    </div>
    <div>
		<?php woocommerce_wp_text_input( [
			'id'            => '_wcdd_time_to',
			'label'         => __( 'Delivery Time To', 'wc-delivery-date' ),
			'wrapper_class' => '_shipping_field'
		] ); ?>
    </div>
</div>

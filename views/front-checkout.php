<?php
$checkout = WC()->checkout();
?>
<div class="col2-set wcdd-delivery">
    <h3><?php _e( 'Desired days and hours of delivery', 'wc-delivery-date' ); ?></h3>
    <div class="wcdd-delivery__group">
		<?php
		foreach ( $checkout->checkout_fields[ 'wcdd_delivery_fields' ] as $key => $field ) : ?>
			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
		<?php endforeach; ?>
    </div>
</div>

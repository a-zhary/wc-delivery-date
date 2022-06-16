<?php /** @var integer $order_id */ ?>

<h2><?php _e( 'Desired days and hours of delivery', 'wc-delivery-date' ); ?></h2>
<table class="woocommerce-table woocommerce-table--order-details shop_table order_details wc-delivery-table">
    <tbody>
    <tr>
        <th><?php _e( 'Date', 'wc-delivery-date' ); ?></th>
        <th><?php _e( 'Time', 'wc-delivery-date' ); ?></th>
    </tr>
    <tr>
        <td><?php echo get_post_meta( $order_id, '_wcdd_datepicker', true ); ?></td>
        <td><?php echo get_post_meta( $order_id, '_wcdd_time_from', true ); ?> - <?php echo get_post_meta( $order_id,
                '_wcdd_time_to', true ); ?> </td>
        <td></td>
    </tr>
    </tbody>
</table>

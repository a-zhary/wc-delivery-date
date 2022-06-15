<?php /** @var integer $order_id */ ?>

<h2><?php _e( 'Desired days and hours of delivery' ); ?></h2>
<table class="shop_table shop_table_responsive additional_info">
    <tbody>
    <tr>
        <th><?php _e( 'Additional Field:' ); ?></th>
        <td><?php echo get_post_meta( $order_id, '_wcdd_datepicker', true ); ?></td>
        <td><?php echo get_post_meta( $order_id, '_wcdd_time_from', true ); ?></td>
        <td><?php echo get_post_meta( $order_id, '_wcdd_time_to', true ); ?></td>
    </tr>
    </tbody>
</table>

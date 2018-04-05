<?php

if( ! defined( 'ABSPATH' ) )
    exit;

?>

<div class="page fooevents-admin-pdf-page">
    <table border="0" cellpadding="20" cellspacing="0" class="fooevents-admin-pdf-table">
        <tbody>
            <?php /*
            <tr><th colspan="2"><h2><?php _e( 'Purchaser Details', 'fooevents' ); ?></h2></th></tr>
            <tr>
                <th scope="row"><?php _e( 'Name', 'fooevents' ); ?></th>
                <td class="fooevents-row-value">
                    <?php
                        printf( 
                            esc_html__( '%s %s', 'fooevents' ), 
                            get_post_meta( $ticket->ID, 'WooCommerceEventsPurchaserFirstName', true ),
                            get_post_meta( $ticket->ID, 'WooCommerceEventsPurchaserLastName', true )
                        ); 
                    ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Email', 'fooevents' ); ?></th>
                <td class="fooevents-row-value">
                    <?php print esc_html( get_post_meta( $ticket->ID, 'WooCommerceEventsPurchaserEmail', true ) ); ?>
                </td>
            </tr>
            <?php if( $order ) : ?>
            <tr>
                <th scope="row"><?php _e( 'Phone', 'fooevents' ); ?></th>
                <td class="fooevents-row-value">
                    <?php print esc_html( $order->get_billing_phone() ); ?>
                </td>
            </tr>
            <?php endif; ?> */ ?>

            <tr><th colspan="2"><h2><?php _e( 'Attendee Details', 'fooevents' ); ?></h2></th></tr>
            <tr>
                <th scope="row"><?php _e( 'Name', 'fooevents' ); ?></th>
                <td class="fooevents-row-value">
                    <?php
                        printf( 
                            esc_html__( '%s %s', 'fooevents' ), 
                            get_post_meta( $ticket->ID, 'WooCommerceEventsAttendeeName', true ),
                            get_post_meta( $ticket->ID, 'WooCommerceEventsAttendeeLastName', true )
                        ); 
                    ?>
                </td>
            </tr>
            <?php /*
            <tr>
                <th scope="row"><?php _e( 'Email', 'fooevents' ); ?></th>
                <td class="fooevents-row-value">
                    <?php print esc_html( get_post_meta( $ticket->ID, 'WooCommerceEventsAttendeeEmail', true ) ); ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Phone', 'fooevents' ); ?></th>
                <td class="fooevents-row-value">
                    <?php print esc_html( get_post_meta( $ticket->ID, 'WooCommerceEventsAttendeeTelephone', true ) ); ?>
                </td>
            </tr> */ ?>
            <tr>
                <th scope="row"><?php _e( 'Company', 'fooevents' ); ?></th>
                <td class="fooevents-row-value">
                    <?php print esc_html( get_post_meta( $ticket->ID, 'WooCommerceEventsAttendeeCompany', true ) ); ?>
                </td>
            </tr>

            <tr><th colspan="2"><h2><?php _e( 'Event Details', 'fooevents' ); ?></h2></th></tr>
            <tr>
                <th scope="row"><?php _e( 'Event', 'fooevents' ); ?></th>
                <td class="fooevents-row-value">
                    <?php
                        $product = get_post_meta( $ticket->ID, 'WooCommerceEventsProductID', true );

                        if( false !== get_post_status( $product ) ) {
                            print esc_html( get_the_title( $product ) );
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
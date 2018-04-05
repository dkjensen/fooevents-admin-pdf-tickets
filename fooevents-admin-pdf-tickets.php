<?php
/**
 * Plugin Name: FooEvents Admin PDF Tickets
 * Description: Download tickets as PDF from dashboard
 * Version: 1.0.0
 * Author: David Jensen
 * Author URI: https://dkjensen.com
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if( ! defined( 'ABSPATH' ) )
    exit;


/**
 * Generate the HTML for each ticket page
 *
 * @param array $ticket_ids
 * @return string
 */
function fooevents_generate_admin_pdf_tickets( $ticket_ids ) {
    ob_start();

    $template = '';

    foreach( (array) $ticket_ids as $ticket_id ) {
        if( false !== get_post_status( $ticket_id ) ) {
            $ticket         = get_post( $ticket_id );
            $order_id       = get_post_meta( $post->ID, 'WooCommerceEventsOrderID', true );
            $order          = function_exists( 'wc_get_order' ) ? wc_get_order( $order_id ) : false;
            $customer_id    = get_post_meta( $post->ID, 'WooCommerceEventsCustomerID', true );
            $event_id       = get_post_meta( $post->ID, 'WooCommerceEventsProductID', true );

            require apply_filters( 'foo_events_admin_pdf_ticket_template', 'templates/admin-default-ticket.php', $ticket_id );
        }
    }

    return ob_get_clean();;
}


/**
 * Add our Download Ticket PDF option to bulk options
 *
 * @param array $bulk_actions
 * @return array
 */
function fooevents_admin_pdf_bulk_actions( $bulk_actions ) {
	$bulk_actions['fooevents_download_ticket_pdf'] = __( 'Download Ticket PDF', 'fooevents' );
    
    return $bulk_actions;
}
add_filter( 'bulk_actions-edit-event_magic_tickets', 'fooevents_admin_pdf_bulk_actions' );


/**
 * Generate PDF handler
 * 
 * Anonymous function to avoid bug where redirects to 404
 * 
 * @param string $redirect_to
 * @param string $action
 * @param array $post_ids
 * @return void
 */
add_filter( 'handle_bulk_actions-edit-event_magic_tickets', function( $redirect_to, $action, $post_ids ) {
    if( $action !== 'fooevents_download_ticket_pdf' ) {
		return $redirect_to;
    }

    require_once 'vendor/autoload.php';

    $options = apply_filters( 'foo_events_admin_pdf_ticket_options', array(
        'size'          => 'letter',
        'orientation'   => 'portrait',
        'filename'      => 'FooEvents-Tickets-' . time() . '.pdf'
    ) );

    $tickets = fooevents_generate_admin_pdf_tickets( $post_ids );

    ob_start();

    require apply_filters( 'foo_events_admin_pdf_ticket_template', 'templates/admin-default-template.php' );

    $template = ob_get_clean();

    // instantiate and use the dompdf class
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml( $template );

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper( $options['size'], $options['orientation'] );

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream( $options['filename'] );
}, 10, 3 );
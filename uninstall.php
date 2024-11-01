<?php
/**
 * Uninstall file. If selected all data from SJI Testimonial plugin will be deleted
 */
if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') ) exit();

// delete configuration settings
delete_option('sji_testimonial_settings');

// delete spinwheel
global $wpdb;
// IF wpml is active and spucpt is translated get correct ids for language
$ids = $wpdb->get_results( "SELECT ID FROM {$wpdb->prefix}posts WHERE post_type='testimonial'");
if( !empty( $ids ) ) {
	foreach( $ids as $p ) {
		wp_delete_post( $p->ID, true);
	}
}




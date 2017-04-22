<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

require_once __DIR__ . '/slsm_chek.php';

class SLSMUnistall
{
	public function __construct()
	{
		global $wpdb;

		if (chek_field('slsm_views'))
		{
			$query = "alter table $wpdb->posts drop slsm_views";
			$wpdb->query( $query );
		}
	}
}

$slsm_uninstall = new SLSMUnistall();
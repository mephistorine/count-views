<?php

/**
 * @param $column
 * @return bool
 */
function chek_field( $column ) {
	global $wpdb;

	$fields = $wpdb->get_results("show fields from $wpdb->posts", ARRAY_A );

	foreach ( $fields as $field )
	{
		if ( $field['Filed'] == $column )
		{
			return true;
		}
	}

	return false;
}
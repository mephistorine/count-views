<?php
/*
	Plugin Name: Количество простмотров записи
	Description: Этот плагин показывает количество простмотров записи
	Version: 1.0
	Author: stylesam
	Author URI: http://stylesam.com
*/

require_once __DIR__ . '/slsm_chek.php';

class SLSMCountVews
{
	/**
	 * SLSMCountVews constructor.
	 */
	public function __construct()
	{
		register_activation_hook(__FILE__, [$this, 'create_field']);

		add_filter('the_content', [$this, 'post_views']);

		add_action('wp_head', [$this, 'add_view']);
	}

	public function create_field()
	{
		global $wpdb;

		if ( !chek_field('slsm_views') )
		{
			$query = "alter table $wpdb->posts add slsm_views int not null default '0'";
			$wpdb->query( $query );
		}
	}

	/**
	 * @param $content
	 * @return mixed
	 */
	public function post_views($content)
	{
		if( is_page() )
		{
			return $content;
		}

		global $post;
		$views = $post->slsm_views;

		if ( is_single() )
		{
			$views += 1;
		}

		$content .= 'Count views: ' . $views;
		return $content;
	}

	public function add_view()
	{
		if ( !is_single() )
		{
			return;
		}

		global $post;
		global $wpdb;

		$id = $post->ID;
		$views = $post->slsm_views + 1;
		$wpdb->update(
			$wpdb->posts,
			['slsm_views' => $views],
			['ID' => $id]
		);
	}
}

$slsm_count_views = new SLSMCountVews();